<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriFasilitas extends Model
{
    protected $table = 'kategori_fasilitas';

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(Fasilitas::class, 'kategori_fasilitas_id');
    }
}
