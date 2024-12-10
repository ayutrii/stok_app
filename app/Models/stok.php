<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; //important

class stok extends Model
{
    /**
     * Get the getSuplier that owns the stok
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSuplier(): BelongsTo //important
    {
        return $this->belongsTo(suplier::class, 'suplier_id', 'id');
    }
}
