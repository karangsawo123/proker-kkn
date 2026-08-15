<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\Fasilitas;

class FasilitasPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return true;
    }

    public function view(AdminAccount $account, Fasilitas $fasilitas): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $fasilitas->dusun_id;
    }

    public function create(AdminAccount $account, ?int $dusunId = null): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && ($dusunId === null || $account->dusun_id === $dusunId);
    }

    public function update(AdminAccount $account, Fasilitas $fasilitas): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $fasilitas->dusun_id;
    }

    public function delete(AdminAccount $account, Fasilitas $fasilitas): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $fasilitas->dusun_id;
    }

    public function restore(AdminAccount $account, Fasilitas $fasilitas): bool
    {
        return $account->isSuperAdmin();
    }

    public function forceDelete(AdminAccount $account, Fasilitas $fasilitas): bool
    {
        return $account->isSuperAdmin();
    }
}
