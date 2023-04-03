<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;

class AccessTokensController extends Controller
{


      public function validateMobile(Request $request)

      {
        $phoneUser =  $request->phone;

        // $validator = Validator::make($request->all(), [
        //     'phone' => 'required|numeric|digits:10|unique:users',
        // ]);


        // $errors = $validator->errors();
        // dd($phoneUser);




      $test =  User::where('phone_number','=',$phoneUser)->first();




    //   return $test;





        if( empty($test) ) {
            return response()->json([



                'message_en' => 'There is no account associated with this number',
                'message_ar' => ' لا يوجد حساب مرتبط بهذا الرقم',
                'code' => 200,
                'status' => false,
            ], 200);


        }else {
            return response()->json([
                'message_en' => 'The phone number has already been taken.',
                'message_ar' => 'رقم الهاتف مستخدم من قبل.',
                'code' => 200,
                'status' => true,
            ], 200);
        }

      }
    public function login (Request $request){
       $request->validate([
        'phone_number' => 'required|numeric|digits:10',
        'device_name' => 'string|max:255',
        // 'abilities' => 'nullable|array'
        'fcm_token' => 'required'
    ]);






    $user = User::where('phone_number', $request->phone_number)->first();









    if ( $user) {

    $user_id = $user->id;
    $order_count =  Order::where('user_id','=',$user_id)->count();

    if($order_count >= 0 && $order_count <=9) {
       $user['membership'] = 'Regular';

         $user->update(['membership'=>'Regular']);

    } else if ($order_count >= 10 && $order_count <=29){
        $user['membership'] = 'Bronze';
        $user->update(['membership'=>'Bronze']);

    } else if ($order_count >= 30 && $order_count <=49){
        $user['membership'] = 'Siluver';
        $user->update(['membership'=>'Siluver']);

    } else if ($order_count >= 50){
        $user['membership'] = 'Gold';
        $user->update(['membership'=>'Gold']);

    }


    $user->update(['fcm_token'=>$request->fcm_token]);

        // dd($user);
        $device_name = $request->post('device_name', $request->userAgent());
        $token = $user->createToken($device_name);
         $user['token'] =$token->plainTextToken;

        return Response::json([
            'message_en' =>"login",
            'message_ar' =>"تسجيل الدخول",

            'code' => 200,
            'status'=>true,
            // 'token' =>$test,
            'data' => $user,
        ], 201);

     }

     return Response::json([
        'message_en' => ' Login created Faild',
        'message_ar' => 'خطأ في تسجيل الخروج',

        'code' => 200,
        'status' => false,
        'message' => 'Invalid credentials',
    ], 200);
}

  /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message_en' => 'User successfully signed out',
            'message_ar' => 'تم تسجيل الخروج بنجاح',
            'code' => 200,
            'status' => true,
            'data'=>$request->user()
        ],200);
    }
  /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh() {
    //     return $this->createNewToken(auth()->refresh());
    // }

    public function deleteAccount(Request $request){

        $user_image = $request->user()->avatar;

        File::delete(public_path('assets/images/auth/'.$user_image));

        $user = Auth::guard('sanctum')->user();
        $user->delete();


        return response()->json([
            'message_en' => 'User account successfully deleted',
            'message_ar' => 'تم حذف الحساب بنجاح',

            'code' => 200,
            'status' => true,
        ],200);

    }
}


