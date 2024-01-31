<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(){
        return view('auth.register');
    }

    public function store(Request $req){
        //vallidate data
       $this->validate($req, [
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|confirmed',
       ]);
        //Store user
       User::create([
        'name'=> $req->name,
        'username' => $req->username,
        'email' => $req->email,
        'password' => Hash::make($req->password),
       ]);
       
        //Signin user
        auth()->attempt($req->only('email', 'password'));
        //Redirect 
        return redirect()->route('dashboard');
    }
}
