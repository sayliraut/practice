<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;

class Faq extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'faqs';
    protected $fillable = [
        'id',
        'question',
        'answer',
        'is_active',
        'created_by',
        'modified_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
