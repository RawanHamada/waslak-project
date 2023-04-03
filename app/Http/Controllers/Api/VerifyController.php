<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VerifyCode;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function index()
    {
        $code = VerifyCode::all();
        if($code->count() > 0) {
           return response()->json([
            'message_en' => 'The Verify Code',
            'message_ar' => 'كود التفعيل',

            'code' => 200,
            'status' => true,
            'data' => $code
           ], 201);
       }else {
           return response()->json([
               'message_en' => 'No Verify Code Send',
               'message_ar' => 'كودالتفعيل غير متاح',
               'code' => 200,
               'status' => false,
               'data' => [],
           ], 200);
       }
    }
}
