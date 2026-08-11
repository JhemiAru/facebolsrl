<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    //protected $redirectTo = '/home';
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        // Validamos los datos + reCAPTCHA
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            //'g-recaptcha-response' => 'required|captcha',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::validate($credentials)) {
            $user = User::where('email', $request->email)->first();

            // Verificar si el usuario tiene inscripción y si está activo
            if ($user->inscripciones && $user->inscripciones->estado !== '1') {
                return back()->with('status', 'Tu cuenta no está activa. Por favor, contactase al administrador FaceBol')->withInput();
            }

            // iniciar sesión
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();

            return redirect()->intended($this->redirectPath());
        }

        // Fallo de autenticación
        return back()->with('status', 'Credenciales incorrectas')->withInput();
    }

    public function showLoginForm()
    {
        // Regenerar el token CSRF si la sesión está por expirar
        if (time() - session('last_activity') > (config('session.lifetime') - 5) * 60) {
            session()->regenerateToken();
        }

        session(['last_activity' => time()]);

        return view('auth.login');
    }
}