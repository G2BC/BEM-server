<?php

namespace App\Services;

use App\Services\Contracts\AuthContract;

class AuthService implements AuthContract
{
    /**
     * Get a JWT via given credentials.
     
     * @param  array $credentials
     *
     * @return array|null
     */
    public function login($credentials)
    {
        if (!$token = auth()->attempt($credentials)) {
            return null;
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function me()
    {
        return auth()->user();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
    }

    /**
     * Refresh a token.
     *
     * @return array
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return array
     */
    private function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
