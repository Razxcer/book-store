<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    private const CODE_TTL_MINUTES = 5;

    public function sendCode(string $contact): void
    {
        $code = (string) random_int(1000, 9999);

        Cache::put($this->getCacheKey($contact), $code, now()->addMinutes(self::CODE_TTL_MINUTES));

        Log::info("Код подтверждение для {$contact} - {$code}");
    }

    public function verifyCode(string $contact, string $code): array
    {
        $cacheKey = $this->getCacheKey($contact);
        $cachedCode = Cache::get($cacheKey);

        if ($cachedCode === null || $cachedCode != $code) {
            throw ValidationException::withMessages([
                'code' => ['Введён неверный или истёкший код подтверждения'],
            ]);
        }

        Cache::forget($cacheKey);

        $field = filter_var($contact, FILTER_VALIDATE_EMAIL) !== false ? 'email' : 'phone';

        $user = User::firstOrCreate(
            [$field => $contact],
            [$field . '_verified_at' => now()]
        );

        $token = $user->createToken('auth-token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];

    }

    public function logout(User $user): void
    {
        $token = $user->currentAccessToken();

        if ($token instanceof PersonalAccessToken) {
            $token->delete();
        }
    }

    private function getCacheKey(string $contact): string
    {
        return "auth_opt:{$contact}";
    }
}
