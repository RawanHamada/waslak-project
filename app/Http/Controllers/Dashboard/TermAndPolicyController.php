<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermAndPolicyController extends Controller
{
    public function index()
    {
        $terms = Term::all();
        return view('admin.TermAndPolicy.index',compact('terms'));
    }


    public function create()
    {
        return view('admin.TermAndPolicy.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',

        ]);

        Term::create([
            'title_ar' =>$request->title_ar,
            'title_en' =>$request->title_en,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,

        ]);

        toastr()->success(__('site.create_term'));


        return redirect()->route('terms.index')->with('msg', 'Term created successfully')->with('type', 'success');


    }
    public  function  edite($id){
        $term = Term::findOrFail($id);
        return view('admin.TermAndPolicy.edite', compact('term'));
    }


        public function update(Request $request, $id)
        {
            $term = Term::findOrfail($id);


            $term->update($request->all());




            toastr()->info(__('site.update_term'));

            // Redirect
//            return redirect()->back();
            return redirect()->route('terms.index')->with('msg', 'Terms updated successfully')->with('type', 'info');

//            return redirect()->route('terms.index')->with('msg', 'Terms updated successfully')->with('type', 'info');
        }





    public function  destroy($id)
    {

        $term = Term::findOrFail($id);
        $term->delete();


        toastr()->success(__('site.delete_term'));

        return redirect()->route('terms.index')->with('Term deleted successfully')->with('type','danger');

    }
}
