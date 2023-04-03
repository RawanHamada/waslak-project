<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Term;
use Illuminate\Http\Request;

class TermsAndPolicyController extends Controller
{


    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::all();
        if($terms->count() > 0) {
        //    return response()->json([
        //     'message' => 'All Terms And Policy',
        //     'code' => 200,
        //     'status' => true,
        //     'data' => $terms
        //    ], 201);

        return $this->returnSuccessMessage("سياسة الشروط و الاستخدام",'All Terms And Policy',200,true,$terms);
       }else {
        //    return response()->json([
        //        'message' => 'No Terms Found',
        //        'code' => 200,
        //        'status' => false,
        //        'data' => [],
        //    ], 200);
        return $this->returnErrorMessage("لا يوجد شروط الآن",'No Terms Found',200,true,[]);

       }
    }
}
