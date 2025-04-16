<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class Role_Permission_UserController extends Controller
{
    public function setRole(Request $request)
    {
        $userId = $request->input('userId');
        $roleIds = $request->input('roleId'); // Nhận vào mảng role_id
        $userType = $request->input('userType');

        // Xóa tất cả các role của user trước khi thêm mới
        DB::table('role_user')->where('user_id', $userId)->delete();

        // Kiểm tra nếu roleIds là mảng thì lặp qua từng phần tử để chèn vào DB
        if (is_array($roleIds) && count($roleIds) > 0) {
            foreach ($roleIds as $roleId) {
                DB::table('role_user')->insert([
                    'user_id' => $userId,
                    'role_id' => $roleId,
                    'user_type' => $userType,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Added roles into user successfully',
        ]);
    }

    public function getAllRole(Request $request)
    {
        $roles = Role::get();

        return response()->json([
            'success' => true,
            'roles' => $roles,
            'message' => 'Role retrieved successfully',
        ]);
    }
}
