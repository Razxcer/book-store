<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\SendCodeRequest;
use App\Http\Requests\Api\V1\Auth\VerifyCodeRequest;
use App\Http\Resources\Api\V1\AuthTokenResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    /**
     * Отправка кода подтверждения
     *
     * <b> Генерирует 4-значный код и записывает его в логи </b> (пока что)
     *
     * @unauthenticated
     */
    public function sendCode(SendCodeRequest $request): JsonResponse
    {
        $this->authService->sendCode((string) $request->validated('contact'));

        return response()->json([
            'message' => 'Код подтверждения отправлен.',
        ]);
    }

    /**
     * Проверка кода и авториация
     *
     * <b> Проверяет полученный код </b> <br/>
     * Если код не верный - выдаёт ошибку <i>422</i> <br/>
     * Если код верный - авторизует пользователя и отдаёт Bearer токен
     */
    public function verifyCode(VerifyCodeRequest $request): AuthTokenResource
    {
        $validated = $request->validated();

        $result = $this->authService->verifyCode((string) $validated['contact'], (string) $validated['code']);

        return new AuthTokenResource($result);
    }

    /**
     * Выход из системы
     *
     * <b> Удаляет текущий токен </b>
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        $this->authService->logout($user);

        return response()->json([
            'message' => 'Вы успешно вышли из аккаунта.',
        ]);
    }
}
