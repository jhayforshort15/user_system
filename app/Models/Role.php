<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'description'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function roleName()
    {
        return $this->role_name;
    }
}