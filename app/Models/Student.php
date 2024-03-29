<?php

namespace App\Models;

use App\Traits\Model\Relations\StudentRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes, StudentRelations;

    const IS_A_RESELLER = 1;
    const IS_NOT_A_RESELLER = 0;

    protected $fillable = [
        'classroom_id',
        'profile_id',
        'parent_completness_id',
        'parent_income_id',
        'other_criteria_id',
        'nisn',
        'is_reseller'
    ];
}
