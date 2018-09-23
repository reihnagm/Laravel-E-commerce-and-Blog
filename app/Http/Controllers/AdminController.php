<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Charts\AllUsers;

use App\Models\User;
use App\Models\Order;

use DB;

class AdminController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth:admin');

    }

    public function index()
    {

      $usersAllRecords = User::all()->count();
      
      $chart = new AllUsers;

      $chart->labels(['All Users']);
      $chart->dataset('Sample', 'pie', [$usersAllRecords]);
      
      return view('admin/index', ['chart' => $chart]);

    }

    public function create()
    {

    }

    public function store(Request $request)
    {

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
