<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'barang_id' => $this->barang_id,
            'barang_nama' => $this->barang_nama,
            'barang_harga' => $this->harga_jual,
            'barang_stok' => $this->stok
        ];
    }
}
