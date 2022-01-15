<?php

namespace App\Http\Requests\ParentCompletness;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreParentCompletnessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => [
                'required',
                Rule::unique('parent_completnesses')->whereNull('deleted_at')
            ],
            'score' => 'required|integer|min:0|max:10'
        ];
    }
}
