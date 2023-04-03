<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\AccessToken;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RattingController extends Controller
{


    use GeneralTrait;


    public function index(Request $request)
    {


     $user_id = Auth::guard('sanctum')->user()->id;



     $rates = Rate::where('user_id', '=' ,$user_id)->get();


        foreach($rates as $rate ){
            $user = User::where('id','=',$rate->user_id)->first();
            $rate['user'] = $user;
        }

        if($rates) {
        //    return response()->json([
        //     'message' => 'Rates User ',
        //     'code' => 200,
        //     'status' => true,
        //     'data' => $rates
        //    ], 201);

        return $this->returnSuccessMessage("كل تقيماتي",'All Orders',200,true,$rates);

       }else {


        return $this->returnSuccessMessage("لا يوجد تقييمات",'No Rates Found',200,true,[]);

       }

    }


    public function store(Request $request)
    {



        $user_id = Auth::guard('sanctum')->user()->id;

        $request->validate([
            'comment' => 'required',
            'rate' => 'required',
            'user_id' =>array($user_id),
            'ratted_user_id' =>'required',
            'order_id' =>'required',
        ]);

        $rete = Rate::create([
            'comment' => $request->comment,
            'rate' => $request->rate,
            'user_id'=>$user_id,
            'ratted_user_id'=>$request->ratted_user_id,
            'order_id'=>$request->order_id,

        ]);

        if($rete) {

        return $this->returnSuccessMessage("تم انشاء التقييم بنجاح",'Ratting created successfully',200,true,$rete);

        }else {

            return $this->returnErrorMessage("خطأ في انشاء تقييم",'Ratting created Faild',200,true,[]);

        }
    }
}
