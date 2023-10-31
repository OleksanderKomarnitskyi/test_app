<?php

namespace App\Http\Controllers;

use App\Enums\Statuses;
use App\Models\Tariff;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Tariff $tariff
     * @return JsonResponse
     * @throws Exception
     */
    public function buyTariff(Tariff $tariff): JsonResponse
    {
        if ($tariff->status == Statuses::Blocked->value) {
            return response()->json(['message' => "Your request cannot be fulfilled"], 403);
        }

        $user = auth('api')->user();
        $result = $this->userService->applyTariff($user, $tariff);

        if($result) {
            return response()->json(['message' => "The tariff has been successfully purchased"], 201);
        } else {
            return response()->json(['message' => 'Server Error'], 500);
        }

    }

}
