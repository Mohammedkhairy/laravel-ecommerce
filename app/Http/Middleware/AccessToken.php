<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->bearerToken());
        $user = User::where('token', $request->header('Authorization'))->first();
        if (empty($user)) {
            return response()->json(['message' => 'unAuthorize'], 401);
        }
        return $next($request);
    }
}
