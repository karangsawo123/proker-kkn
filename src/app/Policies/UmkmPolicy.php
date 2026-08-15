<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\Umkm;

class UmkmPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return true;
    }

    public function view(AdminAccount $account, Umkm $umkm): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $umkm->dusun_id;
    }

    public function create(AdminAccount $account, ?int $dusunId = null): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && ($dusunId === null || $account->dusun_id === $dusunId);
    }

    public function update(AdminAccount $account, Umkm $umkm): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $umkm->dusun_id;
    }

    public function delete(AdminAccount $account, Umkm $umkm): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $umkm->dusun_id;
    }

    public function restore(AdminAccount $account, Umkm $umkm): bool
    {
        return $account->isSuperAdmin();
    }

    public function forceDelete(AdminAccount $account, Umkm $umkm): bool
    {
        return $account->isSuperAdmin();
    }
}
