<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Auth;
use Carbon\Carbon;
use App\Shipping;
use App\Billing_detail;
use App\Sale;

class CustomerController extends Controller
{
    function customerdashboard(){
      $total_sale = Sale::where('user_id',auth::id())->count();
      return view('customer\dashboard',compact('total_sale'));
    }
    function customerprofile(){
      return view('customer\profile');
    }
    function customerprofileinsert(Request $request){
    Profile::insert([
      'user_id' => Auth::id(),
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'address' => $request->address,
      'pn_number' => $request->pn_number,
      'zip_code' => $request->zip_code,
      'created_at' => Carbon::now()
    ]);
    return back();
    }
    function customerprofileupdate(Request $request){
      Profile::where('user_id', Auth::id())->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'address' => $request->address,
        'pn_number' => $request->pn_number,
        'zip_code' => $request->zip_code,
      ]);
      return back();
    }
    function order(){
      $all_orders = Sale::where('user_id',auth::id())->get();
      return view('customer\order',compact('all_orders'));
    }
    function viewdetailsorder($shipping_id){
      $shipping_id = Sale::where('shipping_id',$shipping_id)->first()->shipping_id;
      $customer_orders =  Billing_detail::where('sale_id',$shipping_id)->get();
     return view('customer\order_view_details',compact('customer_orders'));
    }

}
