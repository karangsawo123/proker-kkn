<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\KategoriFasilitas;

class KategoriFasilitasPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return true;
    }

    public function view(AdminAccount $account, KategoriFasilitas $kategori): bool
    {
        return true;
    }

    public function create(AdminAccount $account): bool
    {
        return $account->isSuperAdmin();
    }

    public function update(AdminAccount $account, KategoriFasilitas $kategori): bool
    {
        return $account->isSuperAdmin();
    }

    public function delete(AdminAccount $account, KategoriFasilitas $kategori): bool
    {
        return $account->isSuperAdmin();
    }

    public function restore(AdminAccount $account, KategoriFasilitas $kategori): bool
    {
        return false;
    }

    public function forceDelete(AdminAccount $account, KategoriFasilitas $kategori): bool
    {
        return $account->isSuperAdmin();
    }
}
