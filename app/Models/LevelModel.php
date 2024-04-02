<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level';
    protected $primaryKey = 'level_id';
    protected $keyType = 'int';

    protected $fillable = [
        'level_id',
        'level_name',
        'level_kode',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }

    public function useris(): HasMany
    {
        return $this->hasMany(m_user::class, 'level_id', 'level_id');
    }
}
