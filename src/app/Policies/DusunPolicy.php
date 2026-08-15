<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\Dusun;

class DusunPolicy
{
    public function viewAny(?AdminAccount $account = null): bool
    {
        return true;
    }

    public function view(?AdminAccount $account, Dusun $dusun): bool
    {
        return true;
    }

    public function create(AdminAccount $account): bool
    {
        return false;
    }

    public function update(AdminAccount $account, Dusun $dusun): bool
    {
        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $dusun->id;
    }

    public function activate(AdminAccount $account, Dusun $dusun): bool
    {
        return $account->isSuperAdmin();
    }

    public function deactivate(AdminAccount $account, Dusun $dusun): bool
    {
        return $account->isSuperAdmin();
    }

    public function delete(AdminAccount $account, Dusun $dusun): bool
    {
        return false;
    }

    public function restore(AdminAccount $account, Dusun $dusun): bool
    {
        return false;
    }

    public function forceDelete(AdminAccount $account, Dusun $dusun): bool
    {
        return false;
    }
}
