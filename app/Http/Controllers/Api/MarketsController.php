<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Address;
use App\Models\Markets;
use Illuminate\Http\Request;

class MarketsController extends Controller
{

    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $markets = Markets::all();
        if($markets->count() > 0) {

        return $this->returnSuccessMessage("كل الماركت",'All Markets',200,true,$markets);

       }else {

        return $this->returnErrorMessage("لا يوجد ماركت",'No Markets Found',200,true,[]);

       }

    }



    public function search(Request $request){

        $address_search = Markets::orderByDesc('id')->where('name', 'like', '%'.$request->name.'%')->get();

            if($address_search) {

                return $this->returnSuccessMessage("تم العثور على اماكن",'Address Found',200,true,$address_search);

            }else {

                return $this->returnErrorMessage("لم يتم العثور على اماكن",'Address Not Found',200,true,[]);

            }
    }

}
