<?php

namespace App\Http\Controllers;

use Exception;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use GeneralTrait;
    public function login(Request $request){


        // validation
        try{
        $rules=[

            'email'=>'required|exists:admins,email',
            'password'=>'required'
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            $code=$this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code,$validator);
        }

   //login
   $credentiel= $request->only(['email','password']);

   $token = Auth::guard('admin-api')->attempt($credentiel);
        if(!$token)
            return $this->returnError('E001','email and password not correct');

     //get admin with token
     $admin = Auth::guard('admin-api')->user();
     $admin->api_token=$token;
//return token jwt
      return $this->returnData('admin',$admin,'succes');

    }catch(Exception $e){
        return $this->returnError($e->getCode(),$e->getMessage());
    }


    }

    // log out
    public function logout(Request $request){
        $token = $request->header('auth-token');
        //Invalidate token => security side
        if($token)
        {//tokrn exist
           try{
            // put token in black list
            JWTAuth::setToken($token)->Invalidate();//logout

            }catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){

                return $this->returnError('','something went wrong!');


            }
             return $this->returnSuccessMessage('Logout Successfully!');
        }
        else
        {//token not exist
            return $this->returnError('','token is Empty!');
        }


    }

    public function UserLogin(Request $request){
  // validation
  try{
    $rules=[

        'email'=>'required|exists:users,email',
        'password'=>'required'
    ];
    $validator = Validator::make($request->all(),$rules);

    if($validator->fails()){
        $code=$this->returnCodeAccordingToInput($validator);
        return $this->returnValidationError($code,$validator);
    }

//login
$credentiel= $request->only(['email','password']);

$token = Auth::guard('user-api')->attempt($credentiel);
    if(!$token)
        return $this->returnError('E001','email and password not correct');

 //get user with token
 $user = Auth::guard('user-api')->user();
 $user->api_token=$token;
//return token jwt
  return $this->returnData('user',$user,'succes');

}catch(Exception $e){
    return $this->returnError($e->getCode(),$e->getMessage());
}
    }
}
