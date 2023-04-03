<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        // $admin = Admin::all();
        // Auth::guard(session('admin'))->user()->id;

        $auth_user = Auth::guard(session('guardName'))->user()->id;

        $admin = Admin::where('id', $auth_user)->first();
        $contact = Contact::first();

        return view('admin.profile.index',compact('admin','contact'));
    }

    public function edit($id)
    {
        $admin = Auth::guard(session('guardName'))->user($id);

        $contact = Contact::first();


        return view('admin.profile.edit',compact('admin', 'contact'));

    }

     /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'avatar' => ['nullable'],
        ]);

        $image = null;

        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');

            $image = $file->store('/', [
                'disk' => 'avatar',
            ]);
            $admin_image = $request->user()->avatar;

            File::delete(public_path('uploads/avatar/'.$admin_image));
        }else{
            $image = $admin->avatar;
        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $image,
        ]);

        toastr()->info(__('site.update_profile'));


        return redirect()->route('admin.profile.index');
    }


     /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update_contact(Request $request, $id)
    {


        $contact = Contact::findOrFail($id);

        $request->validate([
            'whatsapp' => ['required', 'min:3'],
            'email' => ['required', 'email'],
        ]);


        $contact->update([
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
        ]);

        toastr()->info(__('site.update_contact'));

        return redirect()->route('admin.profile.index');
    }




}
