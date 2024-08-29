<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IamPrincipal extends Model
{
    use HasFactory;


    protected $table = 'iam_principal';

    protected $fillable = [
        'id',
        'name',
        'email_address',
        'gender',
        'date_of_birth',
        'phone_number',
        'profile_photo',
        'state_xid',
        'city_xid',
        'phone_number',
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
}


