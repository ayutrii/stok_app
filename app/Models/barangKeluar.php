<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class barangKeluar extends Model
{
    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getPelanggan(): BelongsTo
    {
        return $this->belongsTo(pelanggan::class, 'pelanggan_id', 'id');
    }
    public function getStok(): BelongsTo
    {
        return $this->belongsTo(stok::class, 'barang_id', 'id');
    }
}
