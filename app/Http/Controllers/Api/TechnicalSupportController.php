<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\AccessToken;
use App\Models\TechnicalSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicalSupportController extends Controller
{

    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable',
            'user_id' => array($user_id),

        ]);

        if($request->has('image')){
            $img_name = rand().time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/techsuppport'), $img_name);
            $tecsupport = TechnicalSupport::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $img_name,
                'user_id'=>$user_id,
            ]);
        }else{
            $tecsupport = TechnicalSupport::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $request->image,
                'user_id'=>$user_id,
            ]);

        }

        if($tecsupport) {

            return $this->returnSuccessMessage("تم تقديم الشكوى بنجاح",'Complaint created successfully',200,true,$tecsupport);

        }else {

            return $this->returnErrorMessage("خطأ في انشاء الشكوى",'Complaint created Faild',200,true,[]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
