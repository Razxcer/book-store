<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\Api\UserResource;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileService $profileService
    ) {
    }

    /**
     * Информация о пользователе
     *
     * Выводит информацию о пользователе (Имя/Фамилия/email/Телефон)
     */
    public function show(Request $request): UserResource
    {
        $user = $request->user();
        $profile = $this->profileService->show($user);

        return new UserResource($profile);
    }

    /**
     * Изменить данные пользователя
     *
     * Изменяет Имя/Фамилию/email/Телефон пользователя
     */
    public function update(UpdateProfileRequest $request): UserResource
    {
        $user = $request->user();
        $validated = $request->validated();
        $profile = $this->profileService->update($user, $validated);

        return new UserResource($profile);
    }
}
