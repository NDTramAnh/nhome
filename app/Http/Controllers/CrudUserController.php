<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use App\Models\Role;


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
    public function home()
    {
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

        return back()->withErrors([
            'login' => 'Email hoặc mật khẩu không chính xác',
        ])->withInput();
    }
    public function product()
    {
        return view('product');
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'regex:/^[^@]+@[^@]+$/',
                'unique:users,email'
            ],
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.regex' => 'Email phải chứa duy nhất một ký tự "@".',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ]);

        // Tạo user mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
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
        // if (!$user) {
        //     abort(404);
        // }
        // Kiểm tra nếu người đăng nhập không có vai trò admin
        if (!Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->route('users.list')->with('error', 'Bạn không có quyền chỉnh sửa user.');
        }

        $user->delete();

        return redirect("list")->withSuccess('User deleted successfully!');
    }


    /**
     * Form update user page
     */





    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request, $id)
    {
        if (!Auth::user()->roles->contains('name', 'admin')) {
            return back()->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
            'roles' => 'nullable|array'
        ], [
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->roles()->sync($request->roles ?? []);

        return redirect()->route('users.list')->with('success', 'Cập nhật user thành công!');
    }





    /**
     * List of users
     */

    public function listUser()
    {
        if (Auth::check()) {
            // $users = User::all();//Lay tat ca du lieu trong ban user
            $users = User::paginate(10);
            return view('users.list', ['users' => $users]); //->with('i',(request()->input('page',1)-1)*2);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
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
