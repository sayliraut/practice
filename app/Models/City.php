<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cities';
    protected $fillable = [
        'id',
        'name',
        'state_xid',
        'is_active',
        'created_by',
        'modified_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
