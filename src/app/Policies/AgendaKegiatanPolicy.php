<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\AgendaKegiatan;

class AgendaKegiatanPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return true;
    }

    public function view(AdminAccount $account, AgendaKegiatan $agenda): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $agenda->scope_level === 'DUSUN' && $account->dusun_id === $agenda->dusun_id;
    }

    public function create(AdminAccount $account, string $scopeLevel = 'DUSUN', ?int $dusunId = null): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $scopeLevel === 'DUSUN' && ($dusunId === null || $account->dusun_id === $dusunId);
    }

    public function update(AdminAccount $account, AgendaKegiatan $agenda): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $agenda->scope_level === 'DUSUN' && $account->dusun_id === $agenda->dusun_id;
    }

    public function delete(AdminAccount $account, AgendaKegiatan $agenda): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $agenda->scope_level === 'DUSUN' && $account->dusun_id === $agenda->dusun_id;
    }

    public function restore(AdminAccount $account, AgendaKegiatan $agenda): bool
    {
        return $account->isSuperAdmin();
    }

    public function forceDelete(AdminAccount $account, AgendaKegiatan $agenda): bool
    {
        return $account->isSuperAdmin();
    }
}
