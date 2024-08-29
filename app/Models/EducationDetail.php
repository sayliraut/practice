<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EducationDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'education_details';

    protected $fillable = [
        'id',
        'principal_xid',
        'education',
        'year_of_completion',
        'created_by',
    ];

}
