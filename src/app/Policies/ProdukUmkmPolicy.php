<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\ProdukUmkm;
use App\Models\Umkm;

class ProdukUmkmPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return true;
    }

    public function view(AdminAccount $account, ProdukUmkm $produk): bool
    {
        $umkm = $produk->umkm;

        if ($umkm === null) {
            return false;
        }

        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $umkm->dusun_id;
    }

    public function create(AdminAccount $account, ?Umkm $umkm = null): bool
    {
        if ($umkm === null) {
            return false;
        }

        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $umkm->dusun_id;
    }

    public function update(AdminAccount $account, ProdukUmkm $produk): bool
    {
        $umkm = $produk->umkm;

        if ($umkm === null) {
            return false;
        }

        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $umkm->dusun_id;
    }

    public function delete(AdminAccount $account, ProdukUmkm $produk): bool
    {
        $umkm = $produk->umkm;

        if ($umkm === null) {
            return false;
        }

        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $account->dusun_id === $umkm->dusun_id;
    }

    public function restore(AdminAccount $account, ProdukUmkm $produk): bool
    {
        return false;
    }

    public function forceDelete(AdminAccount $account, ProdukUmkm $produk): bool
    {
        $umkm = $produk->umkm;

        if ($umkm === null) {
            return false;
        }

        return $account->isSuperAdmin();
    }
}
