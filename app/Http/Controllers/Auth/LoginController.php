<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

/**
 * @group Auth
 */
class LoginController extends Controller
{
    /**
     * Auth Login
     *
     * @bodyParam email string required
     * @bodyParam password string required
     *
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw new AuthenticationException(['message' => 'کاربری با ایمیل مورد نظر یافت نشد.']);
        }

        if (!\Hash::check($request->password, $user->password)) {
            throw new AuthenticationException(['message' => 'رمز عبور اشتباه است.']);
        }

        $token = $user->createToken('my_task_management')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response);
    }
}
