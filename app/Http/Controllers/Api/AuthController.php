<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use App\Http\Traits\GeneralTrait;
use App\Models\AccessToken;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use GeneralTrait;

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phone_number' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'fcm_token' => 'nullable'
        ]);

        $errors = $validator->errors();

        if( $errors->has('phone_number') ) {
            return response()->json([
                'message_en' => 'The phone number has already been taken.',

                'message_ar' => 'رقم الهاتف مستخدم من قبل.',

                'code' => 400,
                'status' => false,
            ], 400);

        }
        else if($errors->has('email')){
            return response()->json([
                'message_en' => 'The email has already been taken.',
                'message_ar' => "الايميل مستخدم من قبل",
                'code' => 400,
                'status' => false,
            ], 400);


        }

        $user = User::create(
                    $validator->validated()
                );

                return response()->json([
                    'message_en' => 'User successfully registered',
                    'message_ar' =>'تم التسجيل بنجاح',
                    'code' => 200,
                    'status' => true,
                    'data' => $user
                ], 201);

    }
        /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile(Request $request) {
        $token = $request->header('Authorization');

        $arr = explode(' ',$token);


        $user_id =$request->user()->id;

        $mytoken =  AccessToken::where('tokenable_id', '=',$user_id)->get();


    //    $ttt = strval($mytoken->token);


        return response()->json(
            [
                'message_en' => 'User Profile',
                'message_ar' => 'الملف الشخصي',

                'code' => 200,
                'status' => true,
                // 'uuuu' => $mytoken,
                'data' => $request->user()
            ], 201);
    }

    // update user-profile
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'phone_number' => 'required|numeric|digits:10',
            'email' => 'required|string|email|max:100',
            'avatar' => 'nullable|image|mimes:jpg,png,bmp',
            'fcm_token' => 'nullable'
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=> 'Validations fails',
                'errors'=>$validator->errors()
            ],422);
        }
        $user = $request->user();

        if($request->hasFile('avatar')){
            if($user->avatar){
                $old_path = public_path().
                'assets/images/auth/'.$user->avatar;
                if(File::exists($old_path)){
                    File::delete($old_path);
                }
            }
            $image_name = 'profile-image-'.rand().time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('/assets/images/auth'),$image_name);
        }else{
            $image_name=$user->avatar;
        }


        $user->update([
            'name'=>$request->name,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'avatar'=>$image_name
        ]);

        return response()->json([
            'message_en'=>'Profile successfully updated',
            'message_ar'=>'تم تحديث الملف الشخصي بنجاح',

            'code' => 200,
            'status' => true,
            'data'=>$request->user()
        ],200);


    }


    public function getOrdersCountAndMembership(Request $request)
    {

        $user_id =    $request->user()->id;

        $membership = $request->user()->membership;

        $order_count = Order::where('user_id' ,'=' , $user_id)->get()->count();


        // dd($order_count);

        // return $order_count;



         return $this->returnSuccessMessage('ارجاع بيانات المستخدم بنجاح','Success return user data',200,true,
              [
              'order_count'=>$order_count,
              'membership'=>$membership,
              ]
        );



    }


}
