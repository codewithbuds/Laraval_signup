<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function user_login(Request $request) {
   
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
            ])) 
            {
                $user = Auth()->user();
                if ($user->is_active == 1) 
                {
                    return response()->json(['success' => 'Successfully Logged In']);
                } 
                else 
                {
                    return response()->json(['verify_email' => 'Please verify your account first through email.']);
                }
            }
        else
            {
                return response()->json(['error'=> 'Something went wrong']);
            }
    }
}
