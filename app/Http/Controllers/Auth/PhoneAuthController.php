<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Providers\RouteServiceProvider;

class PhoneAuthController extends Controller
{
    public function index()
    {
        return view('auth.phone_login');
    }

    public function verifyMobileNumber(Request $request)
    {
        $mobile = $request->number;
        if (User::where('mobile_number', $mobile )->exists()) {
            return true;
        }
        return false;
    }

    function verifyUser(Request $request)
    {
        $users = User::select('users.id', 'user_types.user_type as user_role')->join('user_types', 'user_types.id', '=', 'users.user_type_id')->where('users.mobile_number', $request->number)->get();
        foreach ($users as $user) {
            if ($user->user_role == "User") {
                session_start();
                $_SESSION['user'] = $user->id;
                return redirect()->intended(RouteServiceProvider::USER_HOME);
            }
        }
    }
}
