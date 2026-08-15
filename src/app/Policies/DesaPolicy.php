<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\Desa;

class DesaPolicy
{
    public function viewAny(?AdminAccount $account = null): bool
    {
        return true;
    }

    public function view(?AdminAccount $account, Desa $desa): bool
    {
        return true;
    }

    public function create(AdminAccount $account): bool
    {
        return false;
    }

    public function update(AdminAccount $account, Desa $desa): bool
    {
        return $account->isSuperAdmin();
    }

    public function delete(AdminAccount $account, Desa $desa): bool
    {
        return false;
    }

    public function restore(AdminAccount $account, Desa $desa): bool
    {
        return false;
    }

    public function forceDelete(AdminAccount $account, Desa $desa): bool
    {
        return false;
    }
}
