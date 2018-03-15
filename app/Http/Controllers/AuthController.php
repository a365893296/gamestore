<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

/**
 * Class AuthController
 * @package App\Http\Controllers\Meeting
 */
class AuthController extends Controller
{
    //AuthController 只负责用户登录注册验证等
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $isLogin = Auth::attempt(
            [
                'email' => $email,
                'password' => $password
            ], true);

        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'status_code' => '200',
            'islogin' => $isLogin,
            'user' => $user,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {

            $this->validate($request, [
                'email' => 'bail|required|min:4|max:20|email',
                'name' => 'bail|required|min:4|max:20',
                'password' => 'bail|required'
            ]);

            $email = $request->get('email');
            $name = $request->get('name');
            $password = $request->get('password');

        } catch (Exception $exception) {

            return response()->json([
                'status' => 'failed',
                'status_code' => '403',
                'isRegister' => false,
                'message' => $exception->getMessage(),
            ]);

        }


        if (User::where('email', $email)->first()) {
            return response()->json([
                'status' => 'failed',
                'status_code' => '403',
                'isRegister' => false,
                'message' => '用户已存在!'
            ]);
        }

        User::create([
            'email' => $email,
            'name' => $name,
            'password' => bcrypt($password),
//            'name' => $request->get('name')
        ]);

        Auth::attempt(['email' => $email, 'password' => $password]);
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'isRegister' => true
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return response()->json([
            'status' => 'success',
            'status_code' => '200',
            'isLogout' => 'true',
            'message' => 'exit'
        ]);
    }
}
