<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function store(Request $req){
        $this->validate($req, [ 
            'email' => 'required|email',
            'password' => 'required',
           ]);
           if (!auth()->attempt($req->only('email', 'password'), $req->remember)) {
                return back()->with('status', 'Invalide login details');
           }
           
           return redirect()->route('dashboard');
    }

    public function index(Request $req){
        return view('auth.login');
    }
}
