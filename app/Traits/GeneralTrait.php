<?php

namespace App\Traits;

trait GeneralTrait
{

    public function getCurrentLang(){
        return app()->getLocale();
    }
    public function returnError($errNum, $msg){
        return response()->json([
            'status'=>false,
            'errNum'=>$errNum,
            'msg'=>$msg
        ]);
    }
    public function returnSuccessMessage($msg="",$errNum="S000"){
        return [
            'status'=>true,
            'errNum'=>$errNum,
            'msg'=>$msg
        ];
    }
    public function returnData($key,$value,$msg=""){
        return response()->json([
            'status'=>true,
            'errNum'=>"S000",
            'msg'=>$msg,
            $key=>$value,
        ]);
    }

    // public function returnValidationError($code="E001",$validator){

    // }

}

