<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Interfaces\AuthTokenGenerator;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OAuthController extends Controller
{
    public const TYPE_PASSWORD = 'password';

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @var AuthTokenGenerator
     */
    private readonly AuthTokenGenerator $tokenGenerator;

    /**
     * @param AuthTokenGenerator $tokenGenerator
     * @param UserService $userService
     */
    public function __construct(AuthTokenGenerator $tokenGenerator, UserService $userService)
    {
        $this->userService = $userService;
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = $this->userService->create($data);

        if ($user instanceof User) {
            return response()->json([
                'message' => "{$user->full_name} create successful",
            ], 201);
        } else {
            return response()->json(['message' =>'Server Error'], 500);
        }
    }

    /**
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::whereEmail($data['email'])
            ->select(['id', 'email', 'first_name', 'last_name','email_verified_at'])
            ->first();

        $response = $this->tokenGenerator->generateTokens($this->prepareCredentials($data), static::TYPE_PASSWORD);

        if ($response->status() !== ResponseAlias::HTTP_OK) {
            return response()->json([
                'message' => "The password is not valid",
                'errors' => json_decode($response->getBody()),
                'success' => false,
            ], 422);
        }

        $result = json_decode($response->getBody(), true);
        $result['message'] = "welcome to system";
        $result['user'] = [
            'userId' => $user->id,
            'email' => $user->email,
            'fullName' => $user->full_name,
        ];

        return response()->json($result);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        if (Auth::check()) {
            $token = Auth::user()->token();
            $token->revoke();
            return response()->json(['message' => "logout successful"]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised',
            ], 401);
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function prepareCredentials(array $data): array
    {
        return [
            'username' => $data['email'],
            'password' => $data['password'],
        ];
    }

}
