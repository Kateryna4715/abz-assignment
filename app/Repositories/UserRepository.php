<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class UserRepository {

    public function registerUser(array $data): JsonResponse
    {
        $user = new User($data);
        $user->save();

        return response()->json(
            [
                "success" => true,
                "user_id" => $user->id,
                "message" => "New user successfully registered",
            ]
        );
    }
}
