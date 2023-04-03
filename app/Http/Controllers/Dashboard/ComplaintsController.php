<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TechnicalSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ComplaintsController extends Controller
{
    public function index()
    {
        $complaints = TechnicalSupport::orderByDesc('id')->paginate(10);

        return view('admin.Complaints.index',compact('complaints'));
    }



    public function destroy($id)

    {

        $tech = TechnicalSupport::findOrFail($id);

        File::delete(public_path('uploads/techsuppport/'.$tech->image));


        $tech->delete();

        toastr()->success(__('site.deleted_complaints'));


        return redirect()->route('complaint.index')->with('msg', 'Complaints deleted successfully')->with('type', 'danger');

    }

}
