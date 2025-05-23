<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UploadCerticates extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'uploaded_certificates';

    protected $fillable = [
        'id',
        'principal_xid',
        'certificate_path',
        'created_by',
    ];
}
