<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\Pengumuman;

class PengumumanPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return true;
    }

    public function view(AdminAccount $account, Pengumuman $pengumuman): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $pengumuman->scope_level === 'DUSUN' && $account->dusun_id === $pengumuman->dusun_id;
    }

    public function create(AdminAccount $account, string $scopeLevel = 'DUSUN', ?int $dusunId = null): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $scopeLevel === 'DUSUN' && ($dusunId === null || $account->dusun_id === $dusunId);
    }

    public function update(AdminAccount $account, Pengumuman $pengumuman): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $pengumuman->scope_level === 'DUSUN' && $account->dusun_id === $pengumuman->dusun_id;
    }

    public function delete(AdminAccount $account, Pengumuman $pengumuman): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $pengumuman->scope_level === 'DUSUN' && $account->dusun_id === $pengumuman->dusun_id;
    }

    public function restore(AdminAccount $account, Pengumuman $pengumuman): bool
    {
        return $account->isSuperAdmin();
    }

    public function forceDelete(AdminAccount $account, Pengumuman $pengumuman): bool
    {
        return $account->isSuperAdmin();
    }
}
