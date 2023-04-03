<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Markets;
use App\Models\Order;
use App\Models\Order_status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{


    // public function searchByDropdown(Request $request)
    // {
    //     $order_status = Order_status::all();
    //     $dropdown = $request->input('dropdown');

    //     $results = Order_status::
    //         where('name', $dropdown)
    //         ->get();

    //     return view('admin.Order.index', ['results' => $results,'order_status'=>$order_status]);
    // }

    public function index(Request $request)
    {

    //    $order_status = Order_status::all();

    //     if(request()->has('search')) {
    //         $orders = User::where('name', 'like', '%'.request()
    //         ->orWhere('status_order',$request)
    //         ->search.'%')->orderBy('id', 'desc')->paginate(6);
    //     }else {
    //         $orders  = Order::orderByDesc('id')->paginate(6);
    //     }

    //     return view('admin.Order.index',compact('orders','order_status'));


    // $orders  = Order::orderByDesc('id')->paginate(6);
    // $search = $request->input('search');
    // $dropdown = $request->input('dropdown');
    // $order_status = Order_status::all();

    // $results = Order::
    //     where('order_details', 'like', '%'.$search.'%')
    //     ->where('status_order', $dropdown)
    //     ->first();

    // return view('admin.Order.index', ['results' => $results,'orders'=>$orders,'order_status'=>$order_status]);





    if(request()->has('search')) {

        $orders = Order::where('order_details', 'like', '%'.request()->search.'%')->orderBy('id', 'desc')->paginate(6);
    }else {
        $orders  = Order::orderByDesc('id')->paginate(6);
    }

    foreach($orders as $order ) {

        $user = User::where('id','=',$order->user_id)->first();
        $order['user'] = $user;

        $driverid = $order->driver_id;
        $markets_id = User::where('id','=',$driverid)->first();
        $order['driver'] = $markets_id;

      }

    return view('admin.Order.index',compact('orders'));


    }





        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrfail($id);
        $markets = Markets::all();
        $users = User::all();
        $statuses = Order_status::all();
        return view('admin.Order.edit',compact('order','markets','users','statuses'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrfail($id);


        $order->update($request->all());



        // return redirect()->route('orders');
        toastr()->info(__('site.update_order'));

        return redirect()->route('orders')->with('msg', 'orders updated successfully')->with('type', 'success');

    }

    public function destroy($id)
    {

       $order = Order::findOrFail($id);

        $order->delete();
        toastr()->success(__('site.delete_order'));

        return redirect()->route('orders')->with('msg', 'Order deleted successfully')->with('type', 'danger');
    }
}
