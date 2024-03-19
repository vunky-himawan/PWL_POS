<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_user extends Model
{
    protected $table = "useri";
    public $timestamps = false;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'password',
    ];
}
