<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
//use Auth;
use Hash;

class LoginEmpController extends Controller implements JWTSubject
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
            
            return view('loginEmp');

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

        $usuario = Empresa::where('auth_rest', $request->auth_rest)->where('ativo',1)->first();
        $statusUser = Empresa::where('auth_rest', $request->auth_rest)->first();
  
        

        if ($usuario && Hash::check($request->password, $usuario->password)) {
           
            //Auth::loginUsingId($usuario->id_cliente, $lembrar);
            Auth::login($usuario->id_cliente, $lembrar);
            
            return redirect()->action('LoginEmpController@form');
        }
            
        if($statusUser->ativo==0){
            return redirect()->action('LoginEmpController@form');
        }else{
            return redirect()->action('LoginEmpController@form');
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
