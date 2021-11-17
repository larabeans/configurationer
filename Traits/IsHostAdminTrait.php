<?php

namespace App\Containers\Vendor\Configurationer\Traits;

use Illuminate\Support\Facades\Auth;

trait IsHostAdminTrait
{
    public function isHost(): bool
    {
        $user = Auth::user();
        if (sizeof($user->roles) == 0) {
            return false;
        } else {
            foreach ($user->roles as $role) {
                if ($role->name == "admin") {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
}
