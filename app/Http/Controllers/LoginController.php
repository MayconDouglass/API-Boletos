<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
//use Auth;
use Hash;

class LoginController extends Controller implements JWTSubject
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['form']]);
    }
    public function form()
    {
        if (JWTAuth::user()){
            return view('welcome');
                      
        }else{
            
            return view('login');

        }
    }

    public function Login(Request $request)
    {
        //dd(bcrypt($request->password));
        $request->validate([
            'cgc' => 'required',
            'password' => 'required'
        ]);


        $lembrar = empty($request->remember) ? false : true;

        $usuario = Cliente::where('cgc', $request->cgc)->where('ativo',1)->first();
        $statusUser = Cliente::where('cgc', $request->cgc)->first();
        //dd($statusUser->ativo);
        //dd(bcrypt($request->senha));
            
        $value = Request::cookie('XSRF-TOKEN');
        

        if ($usuario && Hash::check($request->password, $usuario->password)) {
           
            //Auth::loginUsingId($usuario->id_cliente, $lembrar);
            Auth::login($usuario->id_cliente, $lembrar);
            
            return redirect()->action('LoginController@form');
        }
            
        if($statusUser->ativo==0){
            return redirect()->action('LoginController@form');
        }else{
            return redirect()->action('LoginController@form');
        }
          
    }

 /**
 * Get the identifier that will be stored in the subject claim of the JWT.
 *
 * @return mixed
 */
public function getJWTIdentifier()
{
    return $this->getKey();
}

/**
 * Return a key value array, containing any custom claims to be added to the JWT.
 *
 * @return array
 */
public function getJWTCustomClaims()
{
    return [];
}

}
