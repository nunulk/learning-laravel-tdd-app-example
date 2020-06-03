<?php

namespace Tests\Factories\Traits;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Arr;

trait CreatesUser
{
    private function createUser(array $options = []): User
    {
        $user = factory(User::class)
            ->states(Arr::get($options, 'states.user', []))
            ->create(Arr::get($options, 'attributes.user', []));
        $user->profile()->save(
            factory(UserProfile::class)
                ->states(Arr::get($options, 'states.user_profile', []))
                ->make(Arr::get($options, 'attributes.user_profile', []))
        );

        return $user;
    }
}
