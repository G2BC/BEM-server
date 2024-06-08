<?php

namespace App\Services\Contracts;


interface AuthContract
{
    /**
     * Get a JWT via given credentials.
     
     * @param  array $credentials
     *
     * @return array|null
     */
    public function login($credentials);

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function me();

    /**
     * Log the user out (Invalidate the token).
     *
     * @return void
     */
    public function logout();

    /**
     * Refresh a token.
     *
     * @return array
     */
    public function refresh();
}
