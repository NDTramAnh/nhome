<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * CRUD User controller
 */
class RoleController extends Controller
{
    public function role($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->back()->with('error', 'Không tìm thấy vai trò!');
        }

        return view('role.view', [
            'role' => $role,
            'users' => $role->users
        ]);
    }
}
