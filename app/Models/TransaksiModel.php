<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransaksiModel extends Model
{
    use HasFactory;
    protected $table = 't_penjualan';
    protected $primaryKey = 'penjualan_id';
    protected $keyType = 'int';

    protected $fillable =
        [
            'updated_by',
            'user_id',
            'pembeli',
            'penjualan_tanggal',
            'penjualan_kode'
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(DetailTransaksiModel::class, 'penjualan_id', 'penjualan_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'updated_by', 'user_id');
    }
}
