<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class barangMasuk extends Model
{
    public function getStok(): BelongsTo {
        return $this->belongsTo(stok::class, 'nama_barang_id', 'id');
    }
    public function getSuplier(): BelongsTo {
        return $this->belongsTo(suplier::class, 'suplier_id', 'id');
    }
    public function getAdmin(): BelongsTo {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
