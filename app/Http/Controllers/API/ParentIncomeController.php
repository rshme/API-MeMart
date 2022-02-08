<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParentIncome\StoreParentIncomeRequest;
use App\Http\Requests\ParentIncome\UpdateParentIncomeRequest;
use App\Libs\Response\ResponseJSON;
use App\Models\ParentIncome;
use App\Repositories\EloquentParentIncomeRepository;

class ParentIncomeController extends Controller
{
    protected $parentIncomeRepo;

    public function __construct(EloquentParentIncomeRepository $parentIncomeRepo)
    {
        $this->parentIncomeRepo = $parentIncomeRepo;

        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', ParentIncome::class);

        $incomes = $this->parentIncomeRepo->getParentIncomes();

        return ResponseJSON::successWithData('Parent Incomes has been loaded', $incomes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ParentIncome\StoreParentIncomeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParentIncomeRequest $request)
    {
        $this->authorize('create', ParentIncome::class);

        $requests = $request->validated();

        $res = $this->parentIncomeRepo->storeParentIncome($requests);

        if (!$res) {
            return ResponseJSON::internalServerError('Internal Server Error');
        }

        return ResponseJSON::success('New Parent Income has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', ParentIncome::findOrFail($id));

        $income = $this->parentIncomeRepo->getParentIncome($id);

        return ResponseJSON::successWithData('Parent Income has been loaded', $income);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ParentIncome\UpdateParentIncomeRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParentIncomeRequest $request, $id)
    {
        $this->authorize('update', ParentIncome::findOrFail($id));

        $requests = $request->validated();

        $res = $this->parentIncomeRepo->updateParentIncome($requests, $id);

        if (!$res) {
            return ResponseJSON::internalServerError('Internal Server Error');
        }

        return ResponseJSON::success('Parent Income has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', ParentIncome::findOrFail($id));

        try {
            $this->parentIncomeRepo->destroyParentIncome($id);
            return ResponseJSON::success('Parent Income has been deleted');
        } catch (\Exception $ex) {
            return ResponseJSON::unprocessableEntity($ex->getMessage());
        }
    }
}
