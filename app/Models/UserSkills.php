<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserSkills extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'user_skills';

    protected $fillable = [
        'id',
        'principal_xid',
        'skill_id',
        'created_by',
    ];


    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id', 'id');
    }
}
