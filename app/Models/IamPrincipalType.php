<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class IamPrincipalType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'iam_principal_type';
    protected $fillable =
    [
        'principal_type_title',
        'is_active'
    ];

    public function iamPrincipals()
    {
        return $this->hasMany(IamPrincipal::class, 'principal_type_xid', 'id');
    }

}
