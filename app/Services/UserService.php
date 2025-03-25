<?php

namespace App\Services;

use App\Exceptions\UniqueDataException;
use App\Exceptions\ValidationDataException;
use App\Models\User;
use App\Repositories\UserRepository;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserService {

    public function __construct(
        protected UserRepository $userRepository,
    ) {}

    public function registerUser(array $data): JsonResponse
    {
        return $this->userRepository->registerUser($data);
    }

    public function validateUserData(Request $request): void
    {
        try {
            Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:60'],
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => ['required', 'numeric', 'unique:users', 'starts_with:+380'],
                'password' => ['required', 'string', 'min:8'],
                'position' => ['required','string'],
                'photo'=>['required', 'image', 'mimes:jpeg,jpg', 'dimensions:min_height=70,min_width=70', 'max:5120'],
            ]);
            } catch (\Exception $e) {
              throw new ValidationDataException();
        }
    }

    public function isDataUnique(Request $request): void
    {
        if(User::where('phone', $request->phone)->exists() ||
            User::where('email', $request->email)->exists()) {

            throw new UniqueDataException();
        }
    }

    public function compressImage(Request $request): string
    {
        try{
            $client = new Client();

            $imageData = file_get_contents($request->photo->getRealPath());

            $response = $client->post('https://api.tinify.com/shrink', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode('api:' . env('TINYPNG_API_KEY')),
                ],
                'body' => $imageData,
            ]);

            if ($response->getStatusCode() === 201) {
                $body = json_decode($response->getBody()->getContents());
                $compressedImageUrl = $body->output->url;

                $compressedImage = file_get_contents($compressedImageUrl);

                $imagePath = '/images/uploads/' . time() . '.' . $request->photo->getClientOriginalExtension();
                file_put_contents(public_path($imagePath), $compressedImage);
                return $imagePath;
            }

        } catch (\GuzzleHttp\Exception\RequestException $e){
            echo($e->getMessage());
        }

        return '';
    }

    public function generateToken(): string
    {
        $payload = [
            'iss' => 'test-assignment',
            'sub' => 'registration',
            'iat' => now()->timestamp,
            'exp' => now()->addMinutes(40)->timestamp,
        ];

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return $jwt;
    }
}
