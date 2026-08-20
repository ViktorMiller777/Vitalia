<?php

namespace App\Support;

use App\Exceptions\ApiException;
use App\Models\FamilyLink;
use App\Models\User;

class ResidentAccess
{
    /**
     * Administradores y Cuidadores pueden acceder a cualquier interno.
     * Los Familiares solo pueden acceder a los internos que tienen vinculados.
     */
    public static function ensureCanAccess(int $residentId, ?User $user): void
    {
        if (! $user || ! $user->rol) {
            throw new ApiException('AUTH-1003', 'No tienes permiso para realizar esta acción', 403);
        }

        if ($user->rol->nombre !== 'Familiar') {
            return;
        }

        $linked = FamilyLink::where('interno_id', $residentId)
            ->where('usuario_id', $user->id)
            ->where('estado', 'active')
            ->exists();

        if (! $linked) {
            throw new ApiException('AUTH-1003', 'No tienes permiso para acceder a este interno', 403);
        }
    }
}
