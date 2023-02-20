<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // by default user null
        $user = null;
        try{
            $user = JWTAuth::parseToken()->Authenticate();
        }catch(Exception $e)
        {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException ){
                return $this->returnError('E3001','Invalid token');
            }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->returnError('E3001','expired token');

            }else{
                return $this->returnError('E3001','not found token');

            }

        }
        // any orher exception
        catch(Throwable $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException ){
                return $this->returnError('E3001','Invalid token');
            }else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->returnError('E3001','expired token');

            }else{
                return $this->returnError('E3001','not found token');

            }
        }
        if(!$user)
          $this->returnError('400','Unaunticated');

        return $next($request);
    }
}
