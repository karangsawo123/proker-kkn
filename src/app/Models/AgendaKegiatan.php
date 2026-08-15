<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgendaKegiatan extends Model
{
    use SoftDeletes;

    protected $table = 'agenda_kegiatans';

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function dusun(): BelongsTo
    {
        return $this->belongsTo(Dusun::class, 'dusun_id');
    }

    public function agendaMedias(): HasMany
    {
        return $this->hasMany(AgendaMedia::class, 'agenda_kegiatan_id');
    }

    public function effectiveStatusFor(CarbonInterface $businessDate): string
    {
        if ($this->manual_status_override !== null) {
            return $this->manual_status_override;
        }

        $timezone = config('app.business_timezone', 'Asia/Jakarta');
        $day = CarbonImmutable::parse(
            CarbonImmutable::instance($businessDate)->setTimezone($timezone)->toDateString(),
            $timezone,
        )->startOfDay();
        $start = CarbonImmutable::parse($this->tanggal_mulai->toDateString(), $timezone)->startOfDay();
        $end = $this->tanggal_selesai === null
            ? $start
            : CarbonImmutable::parse($this->tanggal_selesai->toDateString(), $timezone)->startOfDay();

        if ($day->isBefore($start)) {
            return 'AKAN_DATANG';
        }

        if ($day->isAfter($end)) {
            return 'SELESAI';
        }

        return 'BERLANGSUNG';
    }
}
