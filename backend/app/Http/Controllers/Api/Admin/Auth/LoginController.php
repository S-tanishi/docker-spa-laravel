<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api\Admin|Auth
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @Method POST
     * @param Request $request
     * @return JsonResponse
     */
    protected function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // login成功処理
        if ($this->attemptLogin($request, $credentials)) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            return response()->json(['message' => 'OK!'], 200);
        }

        return response()->json(['message' => 'ユーザーが見つかりません。'], 422);
    }

    /**
     * @param Request $request
     * @param $credentials
     * @return mixed
     */
    protected function attemptLogin(Request $request, $credentials)
    {
        return Auth::guard('api')->attempt($credentials, $request->filled('remember'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    protected function logout(Request $request)
    {
        Auth::guard('api')->logout();

        $request->session()->invalidate();

        return response()->json(['message' => 'done logout'], 200);
    }
}