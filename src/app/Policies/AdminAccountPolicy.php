<?php

namespace App\Policies;

use App\Models\AdminAccount;

class AdminAccountPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return $account->isSuperAdmin();
    }

    public function view(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return $account->isSuperAdmin();
    }

    public function create(AdminAccount $account): bool
    {
        return $account->isSuperAdmin();
    }

    public function update(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return $account->isSuperAdmin() && $targetAccount->isAdminDusun() && ! $targetAccount->isRemoved();
    }

    public function assignDusun(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return $account->isSuperAdmin() && $targetAccount->isAdminDusun() && ! $targetAccount->isRemoved();
    }

    public function resetPassword(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return $account->isSuperAdmin() && $targetAccount->isAdminDusun() && ! $targetAccount->isRemoved();
    }

    public function logicalRemove(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return $account->isSuperAdmin() && $targetAccount->isAdminDusun() && ! $targetAccount->isRemoved();
    }

    public function removeAccount(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return $this->logicalRemove($account, $targetAccount);
    }

    public function delete(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return false;
    }

    public function restore(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return false;
    }

    public function forceDelete(AdminAccount $account, AdminAccount $targetAccount): bool
    {
        return false;
    }
}
