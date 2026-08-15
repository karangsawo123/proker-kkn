<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaMedia extends Model
{
    protected $table = 'agenda_medias';

    public function agendaKegiatan(): BelongsTo
    {
        return $this->belongsTo(AgendaKegiatan::class, 'agenda_kegiatan_id');
    }
}
