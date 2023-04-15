<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Closure;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

    public function checkUser(): bool
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }
    public function create()
    {
        $auth = $this->checkUser();
        if ($auth == true) {
            return redirect()->intended(RouteServiceProvider::USER_HOME);
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $users = User::select('users.id', 'user_types.user_type as user_role')->join('user_types', 'user_types.id', '=', 'users.user_type_id')->where('email', $request->email)->get();
        foreach ($users as $user) {
            if ($user->user_role == "User") {
                session_start();
                $_SESSION['user'] = $user->id;
                return redirect()->intended(RouteServiceProvider::USER_HOME);
            }
        }
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN_DESHBOARD);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
