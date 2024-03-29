<?php

namespace App\Http\Resources;

use App\Models\ParentCompletness;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'is_reseller' => $this->is_reseller,
            'classroom' => ClassroomResource::make($this->whenLoaded('classroom')),
            'profile' => ProfileResource::make($this->whenLoaded('profile')),
            'parent_completness' => ParentCompletnessResource::make($this->whenLoaded('parent_completness')),
            'parent_income' => ParentIncomeResource::make($this->whenLoaded('parent_income')),
            'other_criteria' => OtherCriteriaResource::make($this->whenLoaded('other_criteria')),
            'profits' => ProfitResource::collection($this->whenLoaded('profits')),
        ];
    }
}
