<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profit\StoreProfitRequest;
use App\Http\Requests\Profit\UpdateProfitRequest;
use App\Libs\Response\ResponseJSON;
use App\Models\Profit;
use App\Repositories\ProfitRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class ProfitController extends Controller
{
    private $profitRepo;

    public function __construct(ProfitRepository $profitRepo)
    {
        $this->profitRepo = $profitRepo;

        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Profit::class);

        return ResponseJSON::successWithData('Profits has been loaded', $this->profitRepo->getProfits());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProfitRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(StoreProfitRequest $request): JsonResponse
    {
        $this->authorize('create', Profit::class);

        $this->profitRepo->storeProfit($request->validated());

        return ResponseJSON::success('New Profit has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $id): JsonResponse
    {
        $this->authorize('view', Profit::findOrFail($id));

        return ResponseJSON::successWithData('Profit has been loaded', $this->profitRepo->getProfit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfitRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateProfitRequest $request, int $id): JsonResponse
    {
        $this->authorize('update', Profit::findOrFail($id));

        $this->profitRepo->updateProfit($request->validated(), $id);

        return ResponseJSON::success('Profit has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        $this->authorize('delete', Profit::findOrFail($id));

        $this->profitRepo->destroyProfit($id);

        return ResponseJSON::success('Profit has been deleted');
    }
}
