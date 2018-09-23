<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Requests\AddressRequest;

use Toastr;

use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index()
    {

      return view('address/index');

    }


    public function create()
    {

    }


    public function store(AddressRequest $request)
    {

      $address = Address::create([
          'addressline' => $request->addressline,
          'city' => $request->city,
          'state' => $request->state,
          'zip' => $request->zip,
          'phone' => $request->phone,
          'user_id' => auth()->user()->id
      ]);

      auth()->user()->addresses()->save($address);

      Toastr::success('Successfully!');

      return redirect(route('payment.index'));

    }


    public function show($id)
    {

    }

    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {

    }

}
