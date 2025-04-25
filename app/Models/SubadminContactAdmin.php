<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubadminContactAdmin extends Model
{
    use HasFactory;
    protected $table = 'subadmin_contact_admins';

    protected $fillable = [
        'name',
        'sender_id',
        'receiver_id',
        'message',
        'is_active',
        'created_by',
    ];

}
