<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function handleResponse($result, $msg, $code = 200)
    {
    	$res = [
            'success' => true,
            'data'    => $result,
            'message' => $msg,
        ];
        return response()->json($result, $code);
    }

    public function handleError($error, $errorMsg = [], $code = 404)
    {
    	$res = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMsg)){
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }
}
