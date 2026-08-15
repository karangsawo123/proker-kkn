<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\KontakPelayanan;

class KontakPelayananPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return true;
    }

    public function view(AdminAccount $account, KontakPelayanan $kontak): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $kontak->dusun_id;
    }

    public function create(AdminAccount $account, ?int $dusunId = null): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && ($dusunId === null || $account->dusun_id === $dusunId);
    }

    public function update(AdminAccount $account, KontakPelayanan $kontak): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $kontak->dusun_id;
    }

    public function delete(AdminAccount $account, KontakPelayanan $kontak): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $kontak->dusun_id;
    }

    public function restore(AdminAccount $account, KontakPelayanan $kontak): bool
    {
        return $account->isSuperAdmin();
    }

    public function forceDelete(AdminAccount $account, KontakPelayanan $kontak): bool
    {
        return $account->isSuperAdmin();
    }
}
