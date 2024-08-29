<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProfessionDetail extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'profession_details';

    protected $fillable = [
        'id',
        'principal_xid',
        'profession',
        'company_name',
        'job_started_from',
        'business_name',
        'business_location',
        'created_by',
    ];
}
