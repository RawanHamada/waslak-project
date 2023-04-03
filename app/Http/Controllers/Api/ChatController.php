<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Events\ChatEvent;
use App\Models\AccessToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Pusher\Laravel\Facades\Pusher;


class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function fetchMessages(Request $request, $id)
    {




        $validator = Validator::make([$id],[
            $id => 'required|exists:orders,id'
        ]);

        if(!$validator->fails()){
            // $order_id = Order::find($id)->id;
            $order_id= $request->id;
            $message =Message::where('order_id', '=',$order_id)->orderByDesc('id')->get();

            return response()->json([
                'message' => 'Message Found',
                'code' => 200,
                'status' => true,
                'data' => $message
            ], 200);
        }
        else{
        return response()->json([
            'message' => 'Order does not exist',
            'code' => 400,
            'status' => false,
            'data' => []
        ], 400);
    }


    }

    public function sendMessage(Request $request)
    {








        $receiver_id = $request->receiver_id;

        $user_data = User::select('fcm_token')->where('id', '=' ,$receiver_id)->get();

        $listTokenUser  = [];

        foreach($user_data as $uid){

          array_push($listTokenUser,$uid['fcm_token']);

        }

        $SERVER_API_KEY = 'AAAAjdqJ7cs:APA91bG1CcCmXTs7e4g-G70mWfehkzRcangY212I522bm7fNpTE7izU8GS8NbX6gtE4KcMRJ0obV_aTMBK5a63yC3UEy53085Xo6n6Vs8RDWjqZs42ZS155so09uaSI_t4VKVPpaP3Id';
        $data = [

                "registration_ids" => $listTokenUser,
                "notification" => [
                    'title' => 'رسالة جديدة',
                    'body' => "لديك رسالة جديدة",
                    "content_available" => true,
                    "priority" => "high",
                ],

                "data" => [
                    "priority" => "high",
                    "sound"=>"app_sound.wav",
                    "content_available" => true,
                    "order_id" =>$request->order_id
                ]
            ];
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);


     $user_id =  Auth::guard('sanctum')->user()->id;

            // Validate the request data
    $validator =  Validator::make($request->all(), [
        'sender_id' =>array($user_id),
        'receiver_id' => 'required',
        'order_id' =>'required',
        'message' => 'nullable',
        'lat' => 'nullable',
        'long' => 'nullable',
        'image'=> 'nullable',
    ]);

        $errors = $validator->errors();

        if( $errors->has('receiver_id')){
            return response()->json([
                'message' => 'error',
                'code' => 400,
                'status' => false,
            ], 400);
        }
        $img =null;
        if($request->has('image')){
            $img_name ='profile-image-'. rand().time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/chat'), $img_name);
            $img =$img_name;
        }
        else{
            $img = $request->get('image');

        }
        // $user = Auth::user();
        $message = new Message();
        $message->sender_id = auth()->user()->id;
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $request->get('receiver_id');
        $message->order_id = $request->get('order_id');
        $message->message = $request->get('message');
        $message->lat = $request->get('lat');
        $message->long = $request->get('long');
        $message->image = $img;

        $message->save();
        broadcast(new ChatEvent($message))->toOthers();

        // Pusher::trigger('chat', 'new-message',
        // ['message' => $message]);

        return response()->json([
            'message' => 'Message Sent!',
            'code' => 200,
            'status' => true,
            'data' => $message
        ], 200);

    }

}
