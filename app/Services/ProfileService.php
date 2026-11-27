<?php

namespace App\Services;

use App\Models\User;

class ProfileService
{
    public function show(User $user): User
    {
        return $user;
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user->refresh();
    }
}
