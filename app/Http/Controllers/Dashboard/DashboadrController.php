<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Markets;
use App\Models\Order;
use App\Models\TechnicalSupport;
use App\Models\User;
use Illuminate\Http\Request;

class DashboadrController extends Controller
{
    public function index()
    {



      $allOrders = Order::all();
      $allUsers = User::all();
      $allMarkets = Markets::all();
      $allComplaints = TechnicalSupport::all();


      $users =  User::orderByDesc('id')->take(5)->get();
      $orders =  Order::orderByDesc('id')->take(5)->get();
      $tech =  TechnicalSupport::orderByDesc('id')->take(5)->get();
      $markets = Markets::orderByDesc('id')->take(5)->get();

      foreach($orders as $order ) {

        $user = User::where('id','=',$order->user_id)->first();
        $order['user'] = $user;

        $driverid = $order->driver_id;
        $markets_id = User::where('id','=',$driverid)->first();
        $order['driver'] = $markets_id;

      }

    //   dd($allOrders);

        return view('admin.index',compact('users','orders','tech','markets','allOrders','allUsers','allMarkets','allComplaints'));
    }




}
