<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group Auth
 */
class RegisterController extends Controller
{

    /**
     * Auth Register
     *
     * @bodyParam first_name string required
     * @bodyParam last_name string required
     * @bodyParam email string required
     * @bodyParam password string required
     *
     *
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $user->createToken('my_task_management')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
}
