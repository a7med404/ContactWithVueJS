<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    // private $contact = null;
    // public function __construct(Contact $con){
    //     $this->$contact = $con;
    // }

    public function index(Contact $contact){
      return $contact::latest()->get();
    }

    public function show(Contact $contact, $id){
      return $contact::findOrFail($id);
    }

    public function store(Request $request){
      $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone
      ];
      return Contact::create($data);
    }


    public function update(Request $request, $id){
      $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone
      ];
      Contact::findOrFail($id)->update($data);
    }

    public function delete($id){
        Contact::find($id)->delete();
    }
}
