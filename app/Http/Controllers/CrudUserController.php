<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{

    /**
     * Login page
     */
    public function login()
    {
        return view('users.login');
    }
    public function home(){
        return view('home');
    }
    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }



    /**
     * Registration page
     */
    public function createUser()
    {
        return view('users.create');
    }

    /**
     * User submit form register
     */

    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect("login")->withSuccess('Registration successful! Please log in.');
    }


    /**
     * View user detail page
     */

    public function readUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        return view('users.read', ['user' => $user]);
    }


    /**
     * Delete user by id
     */
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        $user->delete();

        return redirect("list")->withSuccess('User deleted successfully!');
    }


    /**
     * Form update user page
     */
    public function updateUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        return view('users.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6', // Không bắt buộc nhập lại mật khẩu
        ]);

        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect("list")->withSuccess('User updated successfully!');
    }



    /**
     * List of users
     */

    public function listUser()
    {
        if (!Auth::check()) {
            return redirect('login')->withErrors(['auth_error' => 'You need to log in first']);
        }

        $users = User::all();
        return view('users.list', ['users' => $users]);
    }



    /**
     * Sign out
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}