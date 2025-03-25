<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationDataException;
use App\Models\User;
use App\Services\PositionService;
use App\Services\UserService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected PositionService $positionService) {}


    public function index()
    {
        $users = User::simplePaginate(6);

        return view('users', compact('users'));
    }

    public function show(User $user)
    {
        $position = $this->positionService->getPositionById($user->position_id);

        return view('user', [
            'user' => $user,
            'position' => $position->name,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->userService->isDataUnique($request);
            $this->userService->validateUserData($request);

            $imagePass = $this->userService->compressImage($request);
            $positionId = $this->positionService->getPositionId($request->position);

            return $this->userService->registerUser(array_merge($request->all(),
                ['photo' => $imagePass, 'position_id' => $positionId]));

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }

    public function create()
    {
        return view('create');
    }

    public function generateToken()
    {
        $token = $this->userService->generateToken();

        return response()->json(['success' => true, 'token' => $token]);
    }
}
