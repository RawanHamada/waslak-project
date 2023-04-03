<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    use GeneralTrait;

    public function index()
    {
        $contact = Contact::where('id','=','1')->select('email','whatsapp')->first();
        if($contact->count() > 0) {
        return $this->returnSuccessMessage("طلبات التواصل",'All Contact',200,true, $contact
    );
       }else {
        return $this->returnErrorMessage("لا يوجد طلبات تواصل",'No Contact Found',200,true,[]);

       }
    }
}
