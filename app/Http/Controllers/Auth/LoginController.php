<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use function Spatie\MediaLibrary\MediaCollections\all;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:superAdmin')->except('logout');
        \auth()->guard('superAdmin')->logout();
        $this->middleware('guest:admins')->except('logout');
        \auth()->guard('admins')->logout();
        $this->middleware('guest:web')->except('logout');
        \auth()->guard('web')->logout();
    }

    public function showStudentLoginForm()
    {
        return view('auth.login', ['url' => 'student']);
    }

    public function showSuperAdminLoginForm()
    {
        return view('auth.login', ['url' => 'superadmin']);
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function superAdminLogin(Request $request)
    {
        $request->validate([
            'superAdmin_email' => 'required|email',
            'superAdmin_password' => 'required|string|min:8'
        ]);
        $superAdmin = SuperAdmin::where('email', $request->superAdmin_email)->first();
        $remember_me  = ( !empty( $request->superAdmin_remember ) ) ? TRUE : FALSE;
        if ($superAdmin){
            if (Hash::check($request->superAdmin_password, $superAdmin->password)) {
                auth()->guard('superAdmin')->login($superAdmin, $remember_me);
                return redirect('superadmin/home');
            }else {
                return back()->with('passwordError', 'Oops! You have entered an invalid password for super admin. Please try again.');
            }
        } else {
            return back()->with('emailError', 'Oops! You have entered an invalid email for super admin. Please try again.');
        }
        return back()->withInput($request->only('superAdmin_email', 'superAdmin_remember'));
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
        $student = User::where('email', $request->email)->first();
        $remember_me  = ( !empty( $request->remember ) ) ? TRUE : FALSE;

        if ($student){
            if (Hash::check($request->password, $student->password)) {
                auth()->guard()->login($student, $remember_me);
                return redirect('/user/home');
            }else {
                return back()->with('passwordError', 'Oops! You have entered an invalid password for student. Please try again.');
            }
        } else {
            return back()->with('emailError', 'Oops! You have entered an invalid email for student. Please try again.');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'admin_email' => 'required|email',
            'admin_password' => 'required|string|min:8'
        ]);
        $admin = Admin::where('email', $request->admin_email)->first();
        $remember_me  = ( !empty( $request->admin_remember ) ) ? TRUE : FALSE;

        if ($admin){
            if (Hash::check($request->admin_password, $admin->password)) {
                auth()->guard('admins')->login($admin, $remember_me);
                return redirect('/admins/home');
            }else {
                return back()->with('passwordError', 'Oops! You have entered an invalid password for admins. Please try again.');
            }
        } else {
            return back()->with('emailError', 'Oops! You have entered an invalid email for admins. Please try again.');
        }
        return back()->withInput($request->only('admin_email', 'admin_remember'));
    }
}
