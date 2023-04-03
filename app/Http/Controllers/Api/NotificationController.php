<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {


        $user_data = User::select('fcm_token')->get();

        $firebaseToken  = [];

        foreach($user_data as $fcmToken){

          array_push($firebaseToken,$fcmToken['fcm_token']);

        }
        // dd($firebaseToken);
        // dd($firebaseToken);
        //   return response($firebaseToken);
        

        $SERVER_API_KEY = 'AAAAjdqJ7cs:APA91bG1CcCmXTs7e4g-G70mWfehkzRcangY212I522bm7fNpTE7izU8GS8NbX6gtE4KcMRJ0obV_aTMBK5a63yC3UEy53085Xo6n6Vs8RDWjqZs42ZS155so09uaSI_t4VKVPpaP3Id';
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'test title',
                "body" => 'test body',
                "content_available" => true,
                "priority" => "high",
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

        // dd($response);


       return  $response;



        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'Authorization' => 'key=AAAAdCyqryo:APA91bH__O83O9NL6dhw3YmMG1q3-SgxmcYe_y2k1uD6Gkv9X8kvSWggx-eobBu6j-L5jGFo_KlIdsLQ-_tnwdsC-6ioCL39PWrQ1i4mmUNydmHA1DwfFtAxbcQNQZmJVqJAe8Um3UgH'
        // ])->post('https://fcm.googleapis.com/fcm/send', [
        //     'title' => $request->title,
        //     'body' => $request->body,

        // ]);



//         define( 'API_ACCESS_KEY', 'AAAAdCyqryo:APA91bH__O83O9NL6dhw3YmMG1q3-SgxmcYe_y2k1uD6Gkv9X8kvSWggx-eobBu6j-L5jGFo_KlIdsLQ-_tnwdsC-6ioCL39PWrQ1i4mmUNydmHA1DwfFtAxbcQNQZmJVqJAe8Um3UgH');




// $registrationIds = array("e975d224df18445bd70301840a3a54f82b745d12378651223d7488cb56db9d04");

// // prep the bundle
// $msg = array
// (
//     'message'       => 'here is a message. message',
//     'title'         => 'This is a title. title',
//     'subtitle'      => 'This is a subtitle. subtitle',
//     'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
//     'vibrate'   => 1,
//     'sound'     => 1
// );

// $fields = array
// (
//     'registration_ids'  => $registrationIds,
//     'data'              => $msg
// );

// $headers = array
// (
//     'Authorization: key=' . API_ACCESS_KEY,
//     'Content-Type: application/json'
// );

// $ch = curl_init();
// curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
// curl_setopt( $ch,CURLOPT_POST, true );
// curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
// curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
// curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
// curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
// $result = curl_exec($ch );
// curl_close( $ch );

// echo $result;






    }
}
