<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Markets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MarketsWebController extends Controller {

    public function index()
    {

        //  $markets = Markets::get()->orderByDesc('id');

        $markets =   Markets::orderBy('id', 'DESC')->get();

        return view('admin.Market.index',compact('markets'));

    }


    public function create()
    {
        return view('admin.Market.create');

    }

    public function store(Request $request)
    {
       // ['lat', 'long', 'name', 'description','image'];

        $request->validate([
             'lat'=>'required',
             'long'=>'required',
             'name'=>'required',
             'description'=>'required',
             'image'=>'required',
        ]);

        $img_name = rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/markets'), $img_name);


        Markets::create([
            // 'lat'=>$request->lat,
            // 'long'=>$request->long,

            'lat'=>$request->lat,
            'long'=>$request->long,
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$img_name,
        ]);
        toastr()->success(__('site.create_market'));


        return redirect()->route('market.testindex')->with('msg', 'Market created successfully')->with('type', 'success');

    }


    public  function  edite($id){
        $markets = Markets::findOrFail($id);
        return view('admin.Market.edite', compact('markets'));
    }

    public  function  update(Request $request , $id){


        // Validate Data
        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'lat' => 'nullable',
            'long' => 'nullable',
            'image' => 'nullable',
        ]);

        $category = Markets::findOrFail($id);

        // Upload File
        $img_name = $category->image;
        if($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/markets'), $img_name);
        }

        $category->update([
            'title' => $request->title,
            'description' => $request->description,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'image' => $img_name
        ]);
        toastr()->info(__('site.update_market'));
        // Redirect
        return redirect()->route('market.testindex');
//
//
//        $request->validate([
//            'title' => 'required',
//            'description' => 'required',
//            'lat'=>'nullable',
//            'long'=>'nullable',
//            'image' => 'nullable',
//        ]);
//
//        $markets = Markets::findOrFail($id);
//
//        // Upload File
//        $img_name = $markets->image;
//        if($request->hasFile('image')) {
//            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
//            $request->file('image')->move(public_path('uploads/categories'), $img_name);
//        }
//
//        $markets->update([
//            'name' => ,
//            'image' => $img_name,
//            'parent_id' => $request->parent_id
//        ]);
//
//
//
//        // return redirect()->route('orders');
//        toastr()->info(__('site.update_market'));
//
//
//        return redirect()->route('market.testindex');

    }


    public function destroy($id)
    {
        $market = Markets::findOrFail($id);

        File::delete(public_path('uploads/markets/'.$market->image));


        $market->delete();
        toastr()->success(__('site.delete_market'));

        return redirect()->route('market.testindex')->with('msg', 'Market deleted successfully')->with('type', 'danger');

    }
}
