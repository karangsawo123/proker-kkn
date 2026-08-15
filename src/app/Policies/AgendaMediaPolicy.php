<?php

namespace App\Policies;

use App\Models\AdminAccount;
use App\Models\AgendaKegiatan;
use App\Models\AgendaMedia;

class AgendaMediaPolicy
{
    public function viewAny(AdminAccount $account): bool
    {
        return true;
    }

    public function view(AdminAccount $account, AgendaMedia $media): bool
    {
        $agenda = $media->agendaKegiatan;

        if ($agenda === null) {
            return false;
        }

        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $agenda->scope_level === 'DUSUN' && $account->dusun_id === $agenda->dusun_id;
    }

    public function create(AdminAccount $account, ?AgendaKegiatan $agenda = null): bool
    {
        if ($agenda === null) {
            return false;
        }

        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $agenda->scope_level === 'DUSUN' && $account->dusun_id === $agenda->dusun_id;
    }

    public function update(AdminAccount $account, AgendaMedia $media): bool
    {
        $agenda = $media->agendaKegiatan;

        if ($agenda === null) {
            return false;
        }

        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $agenda->scope_level === 'DUSUN' && $account->dusun_id === $agenda->dusun_id;
    }

    public function delete(AdminAccount $account, AgendaMedia $media): bool
    {
        $agenda = $media->agendaKegiatan;

        if ($agenda === null) {
            return false;
        }

        if ($account->isSuperAdmin()) {
            return true;
        }

        return $account->isAdminDusun() && $agenda->scope_level === 'DUSUN' && $account->dusun_id === $agenda->dusun_id;
    }

    public function restore(AdminAccount $account, AgendaMedia $media): bool
    {
        return false;
    }

    public function forceDelete(AdminAccount $account, AgendaMedia $media): bool
    {
        $agenda = $media->agendaKegiatan;

        if ($agenda === null) {
            return false;
        }

        return $account->isSuperAdmin();
    }
}
