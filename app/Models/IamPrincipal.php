<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Database\Eloquent\SoftDeletes;



class IamPrincipal extends Authenticatable
//  implements JWTSubject
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'iam_principal';

    protected $fillable = [
        'id',
        'principal_type_xid',
        'password',
        'name',
        'email_address',
        'gender',
        'date_of_birth',
        'phone_number',
        'profile_photo',
        'state_xid',
        'city_xid',
        'is_active',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_xid', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_xid', 'id');
    }


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}


