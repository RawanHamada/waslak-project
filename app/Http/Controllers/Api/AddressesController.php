<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\AccessToken;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressesController extends Controller
{

    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

           $user_id = $request->user()->id;

           $addresses = Address::where('user_id', '=' ,$user_id)->get();



            foreach($addresses as $address ) {

                $user = User::where('id','=',$address->user_id)->first();
                $address['user'] = $user;

            }


            // $address = Address::all();
        if($addresses->count() > 0) {

           return $this->returnSuccessMessage('كل الماكن ','All Address',200,true,$addresses);

       }else {
           return $this->returnErrorMessage('لا ي،جة اماكن متاحه','No Address Found',200,true,[]);

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

    $user_id = $request->user()->id;

        $request->validate([
            'user_id' => array($user_id),
            'lat' => 'required',
            'long' => 'required',
            'name' => 'nullable',
            'description' => 'required',
        ]);


        $address = Address::create([
            'user_id' => $user_id,
            'lat' => $request->lat,
            'long' => $request->long,
            'name' => $request->name,
            'description' => $request->description,

        ]);



        if($address) {

           return $this->returnSuccessMessage("تم انشاط المكان بنجاح ",'Address created successfully',200,true,$address);

        }else {

           return $this->returnErrorMessage("خطآ في انشاط المكان",'Address created Faild',200,true,[]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);
        if($address) {

           return $this->returnSuccessMessage("العناوين",'Address '.$id,200,true,$address);

        }else {

           return $this->returnErrorMessage("لا يوجد عناوين",'No Address Found',200,true,[]);

        }
    }


    public function destroy($id)
    {
        $address= Address::destroy($id);

        if($address) {
            return response()->json([
                'message_en' => 'Address '.$id .' Deleted Successfuly',
                'message_ar' => 'تم حذف المكان بنجاح',

                'status' => true,
                 'code'=>200,
            ], 200);
        }else {
            return response()->json([
                'message_en' => 'Something Erorr',
                'message_ar' => 'هنالك خطا ما ',

                'status' => false,
                'code'=>200,
            ], 200);
        }
    }




}
