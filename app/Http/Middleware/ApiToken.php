<?php

namespace App\Http\Middleware;

use App\Helpers\Api\Response as ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bearerToken = $request->bearerToken();
        $secretHeader = $request->header('signature');

        if (!$bearerToken || !$secretHeader) {
            return ApiResponse::error('Missing token or signature', 401);
        }

        $hashedToken = hash('sha256', explode('|', $bearerToken, 2)[1]);
        $checkToken = PersonalAccessToken::where('token', $hashedToken)->first();

        if (!$checkToken) {
            return ApiResponse::error('Invalid token', 401);
        }

        if ($checkToken->expired_at && strtotime($checkToken->expired_at) < time()) {
            return ApiResponse::error('Token expired', 401);
        }

        $expectedSignature = generateSignature(
            $bearerToken,
            config('app.name'),
            $checkToken->created_at->format('Y-m-d H:i:s')
        );

        if (!hash_equals($expectedSignature, $secretHeader)) {
            return ApiResponse::error('Invalid signature', 401);
        };

        return $next($request);
    }
}
