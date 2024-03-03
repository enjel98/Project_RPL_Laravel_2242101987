<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function verify(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::guard('user')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect()->intended('/admin');
        }else{
            return redirect(route('auth.index'))->with('pesan','Kombinasi email dan password salah')->withErrors(['email' => 'Kombinasi email dan password tidak cocok']);
        }
    }

    public function logout(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }
        return redirect(route('auth.index'));
    }
}
