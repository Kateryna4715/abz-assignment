<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->header('token');
            $token ?? throw new \Exception();

            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

            if ($decoded->exp < Carbon::now()->timestamp) throw new \Exception();

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'The token expired.',
            ], 401);
        }

         return $next($request);
    }
}
