<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function save_user(request $request)
    {
        $validatedData = $request->validate([
            'fname' =>'required|max:255',
            'lname' =>'required|max:255',
            'email' =>'required',
            'password' =>'required',
        ]);
        $user = User::where('email', $request['email'])->first();

        if ($user)
        {
            return response()->json(['exists' => 'Email already exist']);
        }
        else {
            $user = new user;
            $user->fname = $request['fname'];
            $user->lname = $request['lname'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
        }
        $user->save();
       $status= event(new Registered($user));
       //return $status;
       return response()->json(['success'=>'User registered successfully']);
    }
}
