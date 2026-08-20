<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    protected $table = 'desas';

    public function dusuns(): HasMany
    {
        return $this->hasMany(Dusun::class, 'desa_id');
    }

    public function kategoriFasilitas(): HasMany
    {
        return $this->hasMany(KategoriFasilitas::class, 'desa_id');
    }

    public function agendaKegiatans(): HasMany
    {
        return $this->hasMany(AgendaKegiatan::class, 'desa_id');
    }

    public function pengumumans(): HasMany
    {
        return $this->hasMany(Pengumuman::class, 'desa_id');
    }
}
