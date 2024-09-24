<?php

namespace App\Http\Controllers;

use App\Models\IamPrincipal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('Admin.login');
    }

    public function login_check(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $user = IamPrincipal::where('email_address', $validatedData['email'])
            ->whereIn('principal_type_xid', [1, 3])
            ->first();

        if ($user) {
            if (Hash::check($validatedData['password'], $user->password)) {

                Auth::guard('admin')->login($user);
                return jsonResponseWithSuccessMessage(__('authentic success'), 200);
            } else {
                return jsonResponseWithErrorMessage(__('The provided password is incorrect.'), 401);
            }
        } else {
            return jsonResponseWithErrorMessage(__('Email not found.'), 401);
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
