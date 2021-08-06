<?php


namespace App\Services;

/**
 * Class VerificaPerfil
 * @package App\Services
 */
class VerificaPerfil
{
    public function isMasterOrAdmin(): bool
    {
        $user = auth('api')->user();

        if ($user->type == 'master' OR $user->type == 'admin')
            return true;

        return false;
    }

    public function isMaster(): bool
    {
        $user = auth('api')->user();

        if ($user->type == 'master')
            return true;

        return false;
    }

    public function isAdmin(): bool
    {
        $user = auth('api')->user();

        if ($user->type == 'admin')
            return true;
    }

    public function isNotMasterOrAdmin(): bool
    {
        $user = auth('api')->user();

        if ($user->type != 'master' OR $user->type != 'admin')
            return true;
    }
}
