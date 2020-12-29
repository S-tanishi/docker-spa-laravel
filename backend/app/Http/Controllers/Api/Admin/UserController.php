<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * Class UserController
 * @package App\Http\Controllers\Api\Admin
 */
class UserController extends Controller
{
    /**
     * ユーザー一覧を返す
     * @Method GET
     * return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return response()->json($users);
    }
}
