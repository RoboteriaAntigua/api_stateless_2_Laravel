<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json('Gracias por conectarte, todo ok');
    }

  
    /**
     * Register
     */
    public function store(Request $request)
    {
        $credenciales = $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:8'
        ]);

        $user = User::create( [
            'name'=>$credenciales['name'],
            'email'=>$credenciales['email'],
            'password'=>Hash::make($credenciales['password'])
        ]);

        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json( $token );
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        if( ! Auth::attempt( $request->only('email','password')) ){
            return response()->json('Acceso denegado, reingresar credenciales');
        }
        $user = User::where('email',$request->email)->firstOrfail();
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json($token);
    }

    /**
     * Logout
     */
    public function logout()
    {
        $user= request()->user();
        $user->tokens()->delete();
        return response()->json('logout');
    }

  
}
