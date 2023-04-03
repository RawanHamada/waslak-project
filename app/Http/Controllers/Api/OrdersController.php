<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\AccessToken;
use App\Models\Markets;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Rate;
use App\Models\RejectedOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrdersController extends Controller
{

    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user_id = Auth::guard('sanctum')->user()->id;


        if($request->time == 'current'){

            $orders = Order::where('user_id', '=' ,$user_id)->where(function($query)
            {
            $query->where('status_order','pending')
            ->orWhere('status_order','ondelivery')
            ->orWhere('status_order','delivered');

            //  dd($query);
        })->orderByDesc('id')->get();
        }else if ($request->time == 'previous'){
            //  dd($user_id);

            $orders = Order::where('user_id', '=' ,$user_id)->where(function($query)
            {
                $query->where('status_order','canceledByUser')
            ->orWhere('status_order','canceledByDriver')
            ->orWhere('status_order','completed');

            //  dd($query);
        })->orderByDesc('id')->get();


        //  $orders = Order::where('user_id', '=' ,$user_id)
        //     ->orWhere('status_order','canceledByUser')
        //     ->orWhere('status_order', 'canceledByDriver')
        //     ->orWhere('status_order', 'completed')->orderByDesc('id')
        //     ->get();
         }

        foreach($orders as $order ) {
            $user = User::where('id','=',$order->user_id)->first();
            $order['user'] = $user;

                  $marketid = $order->market_id;
            $markets_id = Markets::where('id','=',$marketid)->first();
            $order['market'] = $markets_id;


            $driverid = $order->driver_id;
            $markets_id = User::where('id','=',$driverid)->first();
            $order['driver'] = $markets_id;

              $isRejected = false;

              $object =  RejectedOrder::where('order_id' ,'=',$order->id)->where('user_id' ,'=',$user_id)->first();


          if($object){
            $isRejected =true;
          }

          $order['isRejected'] = $isRejected;




          $isRatted =false;


          $ratting = Rate::where('order_id','=',$order->id)->where('user_id','=',$user_id)->first();

          if($ratting){
            $isRatted = true;
          }


          $order['isRated'] = $isRatted;


        }

        if($orders->count() > 0) {


        return $this->returnSuccessMessage('كل الطلبات','All Orders',200,true,$orders);
       }else {

        return $this->returnErrorMessage('لا يوجد طلبات','Orders Not Found',200,true,[]);

       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = Auth::guard('sanctum')->user()->id;
        $fcm_token = Auth::guard('sanctum')->user()->fcm_token;


        $user_data_id = User::select('fcm_token','id')->where('id' ,'!=' , $user_id)->get();

        $listFcmTokenData  = [];

        $listIdUserData = [];


        foreach($user_data_id as $uid){

          array_push($listFcmTokenData,$uid['fcm_token']);
          array_push($listIdUserData,$uid['id']);


        }

        // dd($listIdData);

        $request->validate([
            'lat' => 'required',
            'long' => 'required',
            'market_id' => 'required',
            'order_details' => 'required',
            'address_name' => 'nullable',
            'distance' => 'required',
            'price' => 'required',
            'status_order'=>'required',
            'user_id'=>array($user_id),
            'driver_id'=>'nullable',
        ]);


        $order = Order::create([
            'lat' => $request->lat,
            'long' => $request->long,
            'market_id' => $request->market_id,
            'order_details' => $request->order_details,
            'address_name' => $request->address_name,
            'distance' => $request->distance,
            'price' => $request->price,
            'status_order'=>$request->status_order,
            'user_id'=>$user_id,
            'driver_id'=>$request->driver_id,
        ]);

        if($order) {
            // dd($order->id);
            $request->validate([
                'user_id' => array($listFcmTokenData),
                'order_id' => array($order->id),
                'title' =>  'طلب',
                'body' => 'هناك طلب جديد متاح',
             ]);
                 foreach($listIdUserData as $id){
                    $notification =  Notification::create([
                        'user_id' => $id,
                        'order_id' => $order->id,

                        'title' => 'طلب',
                        'body' => 'هناك طلب جديد متاح',
                    ]);
                 }


        //     $user_data = User::where('fcm_token', '!=' ,$fcm_token)->select('fcm_token')->get();

        // $listTokenUser  = [];

        // foreach($user_data as $uid){

        //   array_push($listTokenUser,$uid['fcm_token']);

        // }

            //   return response($firebaseToken);

            // dd($listTokenUser);

                        $SERVER_API_KEY = 'AAAAjdqJ7cs:APA91bG1CcCmXTs7e4g-G70mWfehkzRcangY212I522bm7fNpTE7izU8GS8NbX6gtE4KcMRJ0obV_aTMBK5a63yC3UEy53085Xo6n6Vs8RDWjqZs42ZS155so09uaSI_t4VKVPpaP3Id';
           $data = [
                "registration_ids" => $listFcmTokenData,
                "notification" => [
                    "title" => 'طلب',
                    "body" => 'هناك طلب جديد متاح',
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


           $userLogin = Auth::guard('sanctum')->user();



           $userLogin = $request->user();

           $order_count =  Order::where('user_id','=',$user_id)->count();

           if($order_count >= 0 && $order_count <=9) {
              $userLogin['membership'] = 'Regular';
              $userLogin->update(['membership'=>'Regular']);
           } else if ($order_count >= 10 && $order_count <=29){
               $userLogin['membership'] = 'Bronze';
              $userLogin->update(['membership'=>'Bronze']);

           } else if ($order_count >= 30 && $order_count <=49){
               $userLogin['membership'] = 'Siluver';
              $userLogin->update(['membership'=>'Siluver']);

           } else if ($order_count >= 50){
               $userLogin['membership'] = 'Gold';
              $userLogin->update(['membership'=>'Gold']);

           }

            return $this->returnSuccessMessage('تم انشاء الطلب بنجاح','Order created successfully',200,true,$userLogin);


            return $response;
        }else {


            return $this->returnErrorMessage("فشل انشاء الطلب ",'Order created Faild',200,true,[]);

        }



    }


    public function show($id)
    {
        $orders = Order::find($id);
        if($orders) {


        return $this->returnSuccessMessage("الطلب".$id,'Order'.$id,200,true,$orders);

        }else {

            return $this->returnErrorMessage("الطلب غير مجود",'No Order Found',200,false,[]);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $order=Order::find($id);
        $status_order = $request->status_order;

        if($status_order == 'ondelivery'){
            if( $order->driver_id != null)

            return $this->returnErrorMessage('هذا الطلب غير متاح','This Order Unavailable',200,false,[]);
        }

        $order->update($request->all());


        $user_id = Auth::guard('sanctum')->user()->id;
        $fcm_token = Auth::guard('sanctum')->user()->fcm_token;

        // dd($request->status_order);





        if($order) {


            if($status_order == 'ondelivery') {
                $request->validate([
                    'user_id' => $order->user_id,
                    'order_id' => array($order->id),
                    'title' =>  'الطلب',
                    'body' => 'تم قبول طلبك من قبل سائق',
                 ]);

                $notification =  Notification::create([
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'title' => 'الطلب',
                    'body' => 'تم قبول طلبك من قبل سائق',
                ]);

                $user_data = User::where('id', '=' , $order->user_id)->select('fcm_token')->get();


                // return $user_data;



                $firebaseToken  = [];



                // $firebaseToken = $user_data;


                // foreach($user_data as $fcmToken){
                //     // dd($fcmToken['fcm_token']);
                //   array_push($firebaseToken,$fcmToken['fcm_token']);
                // }


                // dd($firebaseToken);

                //   return response($firebaseToken);

                $SERVER_API_KEY = 'AAAAjdqJ7cs:APA91bG1CcCmXTs7e4g-G70mWfehkzRcangY212I522bm7fNpTE7izU8GS8NbX6gtE4KcMRJ0obV_aTMBK5a63yC3UEy53085Xo6n6Vs8RDWjqZs42ZS155so09uaSI_t4VKVPpaP3Id';
        $data = [
            "registration_ids" => [$user_data[0]['fcm_token']],
            "notification" => [
                'title' => 'الطلب',
                'body' => 'تم قبول طلبك من قبل سائق',
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


                // return $response;

            }else if ($status_order == 'delivered'){
                $request->validate([
                    'user_id' => $order->user_id,
                    'order_id' => array($order->id),
                    'title' => 'الطلب',
                    'body' => ' طلبك الآن قيد التوصيل',
                 ]);

                $notification =  Notification::create([
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'title' => 'الطلب',
                    'body' => 'تم توصيل طلبك بنجاح وبانتظار تاكيد التسليم من العميل',

                ]);

                $user_data = User::where('id', '=' , $order->user_id)->select('fcm_token')->get();

                $firebaseToken  = [];



                $SERVER_API_KEY = 'AAAAjdqJ7cs:APA91bG1CcCmXTs7e4g-G70mWfehkzRcangY212I522bm7fNpTE7izU8GS8NbX6gtE4KcMRJ0obV_aTMBK5a63yC3UEy53085Xo6n6Vs8RDWjqZs42ZS155so09uaSI_t4VKVPpaP3Id';
                $data = [
                    "registration_ids" => [$user_data[0]['fcm_tokem']],
                    "notification" => [
                                           'title' => 'الطلب',
                    'body' => 'تم توصيل طلبك بنجاح وبانتظار تاكيد التسليم من العميل',

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
                // return $response;

            }else if ($status_order == 'completed'){
                $request->validate([
                    'user_id' => array($order->driver_id),
                    'order_id' => array($order->id),
                    'title' => 'الطلب',
                    'body' => 'تم استلام الطلب من قبل العميل',

                 ]);

                $notification =  Notification::create([
                    'user_id' => $order->driver_id,
                    'order_id' => $order->id,
                        'title' => 'الطلب',
                    'body' => 'تم استلام الطلب من قبل العميل',
                ]);



        $user_data = $order->driver_id;


        $driverToken = User::where('id', '=',$user_data)->select('fcm_token')->get();

      $driverIdToken =  $driverToken[0]['fcm_token'];

      $SERVER_API_KEY = 'AAAAjdqJ7cs:APA91bG1CcCmXTs7e4g-G70mWfehkzRcangY212I522bm7fNpTE7izU8GS8NbX6gtE4KcMRJ0obV_aTMBK5a63yC3UEy53085Xo6n6Vs8RDWjqZs42ZS155so09uaSI_t4VKVPpaP3Id';
      $data = [
          "registration_ids" => [$driverIdToken],
          "notification" => [
                    'title' => 'الطلب',
'body' => 'تم استلام الطلب من قبل العميل',
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

            }else if ($status_order == 'canceledByUser') {
                //  dd($status_order);
                $request->validate([
                    'user_id' => array($order->driver_id),
                    'order_id' => array($order->id),
                    'title' => 'الطلب',
                    'body' => "تم إلغاء الطلب من قبل المستخدم",
                 ]);

                $notification =  Notification::create([
                    'user_id' =>$order->driver_id,
                    'order_id' => $order->id,
                    'title' => 'الطلب',
                    'body' => "تم إلغاء الطلب من قبل المستخدم",
                ]);



        $user_data = $order->driver_id;

        // dd($user_data);


        $driverToken = User::where('id', '=',$user_data)->select('fcm_token')->get();

      $driverIdToken =  $driverToken[0]['fcm_token'];

      $SERVER_API_KEY = 'AAAAjdqJ7cs:APA91bG1CcCmXTs7e4g-G70mWfehkzRcangY212I522bm7fNpTE7izU8GS8NbX6gtE4KcMRJ0obV_aTMBK5a63yC3UEy53085Xo6n6Vs8RDWjqZs42ZS155so09uaSI_t4VKVPpaP3Id';
      $data = [
          "registration_ids" => [$driverIdToken],
          "notification" => [
            'title' => 'الطلب',
            'body' => "تم إلغاء الطلب من قبل المستخدم",
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

            }else if ($status_order == 'canceledByDriver') {

                $request->validate([
                    'user_id' => $order->user_id,
                    'order_id' => array($order->id),
                    'title' => 'الطلب',
                    'body' => "تم الغاء الطلب من قبل السائق",
                 ]);

                $notification =  Notification::create([
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'title' => 'الطلب',
                    'body' => "تم الغاء الطلب من قبل السائق",
                ]);

                $user_data = User::where('fcm_token', '=' , $fcm_token)->select('fcm_token')->get();



              $driverIdToken =  $user_data[0]['fcm_token'];

                $firebaseToken  = [];



                // $firebaseToken = $user_data;




                // foreach($user_data as $fcmToken){
                //     // dd($fcmToken['fcm_token']);
                //   array_push($firebaseToken,$fcmToken['fcm_token']);
                // }

                // dd($firebaseToken);

                //   return response($firebaseToken);

                $SERVER_API_KEY = 'AAAAjdqJ7cs:APA91bG1CcCmXTs7e4g-G70mWfehkzRcangY212I522bm7fNpTE7izU8GS8NbX6gtE4KcMRJ0obV_aTMBK5a63yC3UEy53085Xo6n6Vs8RDWjqZs42ZS155so09uaSI_t4VKVPpaP3Id';
                $data = [
                    "registration_ids" => [$driverIdToken],
                    "notification" => [
                        'title' => 'الطلب',
                        'body' => "تم الغاء الطلب من قبل السائق",
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


            }

        return $this->returnSuccessMessage("تم تغيير حالة الطلب",'Order '.$id,200,true,$order);

        }else {

        return $this->returnErrorMessage("الطلب غير موجود",'No Order Found ',200,true,$order);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }




    public function getMyDelivery(Request $request)
    {

        $user_id = Auth::guard('sanctum')->user()->id;



         if($request->time == 'current'){


             $orders = Order::where('driver_id', '=' ,$user_id)->where(function($query)
            {
                $query->where('status_order','pending')
            ->orWhere('status_order','ondelivery')
            ->orWhere('status_order','delivered');

        })->orderByDesc('id')->get();
         }else if ($request->time == 'previous'){

            $orders = Order::where('driver_id', '=' ,$user_id)->where(function($query)
            {
                $query->where('status_order','canceledByUser')
            ->orWhere('status_order','canceledByDriver')
            ->orWhere('status_order','completed');

            //  dd($query);
        })->orderByDesc('id')->get();
         }
        //   to get object market in order
        foreach($orders as $order){
            $user = User::where('id','=',$order->user_id)->first();
            $order['user'] = $user;
        }

         // to get object market in order
        foreach($orders as $market ) {
            $marketid = $market->market_id;
            $markets_id = Markets::where('id','=',$marketid)->first();
            $market['market'] = $markets_id;
        }


       if($orders->count() > 0) {


        return $this->returnSuccessMessage("كل الطلبات",'All Orders',200,true,$orders);

      }else {


          return $this->returnErrorMessage("الطلب غير موجود",'No Orders Found',200,true,[]);

      }
    }



    public function rejectedOrder(Request $request)
    {

        //    dd($request->order_id);
     $order =   Order::find($request->order_id);

        if( $order->driver_id != null){

            return $this->returnErrorMessage('هذا الطلب غير متاح','This Order Unavailable',200,false,[]);

              }




              $user_id = Auth::guard('sanctum')->user()->id;

        $request->validate([
            'user_id' => array($user_id),
            'order_id' =>'required',
        ]);

        $rejected = RejectedOrder::create([
            'user_id' => $user_id,
            'order_id' => $request->order_id,
        ]);

        if($rejected){


            return $this->returnSuccessMessage("تم رفض الطب بنجاح",'Rejected Order Successsfuly',200,true,$rejected);

        }else {


            return $this->returnErrorMessage("خطأ في رفض الطلب",'Rejected Order Falid',200,true,[]);

        }

    }


        // ! Transfer to notification controller
       public function getMyNotification(Request $request)
    {

        $user_id = Auth::guard('sanctum')->user()->id;

        $myNotification = Notification::where('user_id', '=' ,$user_id)->orderByDesc('id')->get();

        foreach($myNotification as $item ) {

            $order = Order::where('id','=',$item->order_id)->first();
            $item['order'] = $order;

            $user = User::where('id','=',$order->user_id)->first();
            $order['user'] = $user;

                  $marketid = $order->market_id;
            $markets_id = Markets::where('id','=',$marketid)->first();
            $order['market'] = $markets_id;


            $driverid = $order->driver_id;
            $markets_id = User::where('id','=',$driverid)->first();
            $order['driver'] = $markets_id;

        }
            if($myNotification){


                return $this->returnSuccessMessage("كل اشعاراتي",'All My Notification',200,true,$myNotification);

            }else {

                return $this->returnErrorMessage("حدث خطأ ما",'Something Error',200,true,[]);

            }

    }





}
