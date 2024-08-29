<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class State extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    protected $table = 'states';
    protected $fillable = [
        'id',
        'name',
        'is_active',
        'created_by',
        'modified_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

}
