<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function users()
    {

        if(request()->has('search')) {
            $users = User::where('name', 'like', '%'.request()->search.'%')->orderBy('id', 'desc')->paginate(6);
        }else {
            $users  = User::orderByDesc('id')->paginate(6);
        }

        return view('admin.users',compact('users'));

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // $user_image = user()->avatar;


        // File::delete(public_path('assets/images/auth/'.$user_image));


        $user->delete();

        toastr()->success(__('site.delete_user'));


        return redirect()->route('admin.users')->with('msg', 'User deleted successfully')->with('type', 'danger');
    }
}
