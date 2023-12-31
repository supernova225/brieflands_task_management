<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @group Auth
 */
class LogoutController extends Controller
{
    /**
     * Auth Logout
     *
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response(__('auth.logout'));
    }
}
