<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        session_start();
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            return redirect('/');
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
