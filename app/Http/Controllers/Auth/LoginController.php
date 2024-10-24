<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
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


    // View untuk pengawas login
    public function showPengawasLoginForm()
    {
        return view('dashboard_pengawas.login');
    }



    // Metode untuk login pengawas
    public function superPengawasLogin(Request $request)
    {
        // Validasi input dari form login
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Proses autentikasi pengguna
            if (Auth::attempt($credentials)) {
                // Autentikasi berhasil, periksa apakah pengguna adalah pengawas
                $user = Auth::user();
                if ($user->role == 'Pengawas') {
                    // Pengguna adalah pengawas, arahkan ke halaman pengawas
                    return redirect()->route('pengawas.index');
                } else {
                    // Pengguna bukan pengawas, kembalikan dengan pesan flash
                    Session::flash('error', 'Anda tidak punya akses untuk halaman ini.');
                    Auth::logout(); // Logout pengguna yang bukan pengawas
                    return redirect()->route('login');
                }
            } else {
                // Autentikasi gagal, kembali ke halaman login dengan pesan error
                return redirect()->route('login')->withErrors([
                    'email' => 'Email atau password salah.',
                ]);
            }
    }

    public function logoutpengawas(Request $request)
    {
        // Add your custom logout logic here, if needed

        // Logout the user
        Auth::logout();

        // Clear the session data
        $request->session()->invalidate();
        dd(2);
        // Redirect to the login page or any other page you prefer
        return redirect('/pengawas/login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        // if (Auth::user()->role == 'Admin') {
            return '/dashboard';
        // } 
        // else {
        //     return '/';
        // }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}