<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (!$email || !$password) {
            return response()->json([
                'success' => false,
                'message' => 'Enter your email or password'
            ], 400);
        }
        $status = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
        if ($status) {
            // Tạo token
            $user = Auth::user(); // Lấy thông tin user đang đăng nhập
            $token = $user->createToken('auth')->plainTextToken; // Tạo token

            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $token,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'sku' => $user->sku,
                    'role' => $user->roles->pluck('name')->toArray(), // Lấy danh sách tên role
                    'permission' => []
                ],
                'message' => "User login successfully"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Email or password invalid"
        ]);
    }

    public function logout()
    {
        $user = Auth::user(); // Lấy user đang đăng nhập

        if ($user && $user->currentAccessToken()) {
            // Xoá token hiện tại
            $user->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Đăng xuất thành công',
                'test' => $user->currentAccessToken()
            ]);
        }
    }

    public function profile()
    {
        $user = Auth::user(); // Lấy thông tin user đang đăng nhập

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }
}
