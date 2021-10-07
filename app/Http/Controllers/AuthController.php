<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    
    function index()
    {
        if(Session::get('username')){
            return redirect('admin/dashboard');
        }
        return view('auth/login');
    }
    function login(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi cuy!!!',
            'min'=>':attribute minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
        ];
        $this->validate($request,[
            'username' => 'required|min:5',
        ], $messages);
        $akun = DB::table('akun')->where([
            'username' => $request->username,
        ])->first();
        if($akun <> ''){
            if(password_verify($request->password, $akun->password)){
                Session::put('username', $request->username);
                Session::put('login', TRUE);

                return redirect('admin/dashboard');
                
            }else{
                return back()->with('success', 'Password Salah.');
            }
        }else{
            return back()->with('success', 'Username dan Password Salah');
        }
        
    }
    function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
