<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use SoftDeletes;

    protected $table = 'pengumumans';

    protected function casts(): array
    {
        return [
            'tanggal_kedaluwarsa' => 'date',
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

    public function isArchivedFor(CarbonInterface $businessDate): bool
    {
        $timezone = config('app.business_timezone', 'Asia/Jakarta');
        $day = CarbonImmutable::parse(
            CarbonImmutable::instance($businessDate)->setTimezone($timezone)->toDateString(),
            $timezone,
        )->startOfDay();
        $expiresOn = CarbonImmutable::parse(
            $this->tanggal_kedaluwarsa->toDateString(),
            $timezone,
        )->startOfDay();

        return $day->isAfter($expiresOn);
    }
}
