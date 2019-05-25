<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;
use Image;
use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use App\User;
use App\Country;
use App\City;
use App\Shipping;
use App\Sale;
use App\Billing_detail;
use Auth;
use Session;

class FrontendController extends Controller
{
  function index(){
    $products = Product::all();
    $categories = Category::all();
    $banners = Banner::all();
    return view('welcome',compact('products','categories','banners'));
  }
  function productdetails($product_id){
     $single_productinfo = Product::find($product_id);
    $related_products = Product::where('category_id', $single_productinfo->category_id)->where('id', '!=', $product_id)->get();
    return view('productdetails',compact('single_productinfo','related_products'));
  }
  function about(){
    return view('about');
  }
  function contact(){
    return view('contact');
  }
  function categorywiseproduct($category_id){
    $products = Product::where('category_id',$category_id)->get();
    return view('categorywiseproduct', compact('products'));
  }

  function addbannerview(){
   $banners = Banner::paginate(4);
   return view('banner\view',compact('banners'));
  }
  function baneraddinsert(Request $request){
     $lastiserted_id = Banner::insertGetId([
      'collection_name' => $request->collection_name,
      'collection_price' => $request->collection_price,
      'year' => $request->year,
     ]);
     if($request->hasFile('banner_img')){
       $main_photo = $request->banner_img;
       $extention = $main_photo->getClientOriginalExtension();
       $image_name = $lastiserted_id.'.'.$extention;
       Image::make($main_photo)->resize(1036,846)->save( base_path('public\uploads\banner_img/'.$image_name));
      Banner::find($lastiserted_id)->update([
       'banner_img' => $image_name
      ]);
     }
      return back()->with('status','Banner added successfully');
  }
   //Add to cart function----
  function addtocart($product_id){
    //print_r($_SERVER ['REMOTE_ADDR']);
    $ip_address = $_SERVER ['REMOTE_ADDR'];
    if(Cart::where('customer_id',$ip_address)->where('product_id',$product_id)->exists()){
      Cart::where('customer_id',$ip_address)->where('product_id',$product_id)->increment('product_quantity',1);
      return back();
    }else{
    Cart::insert([
      'customer_id'=> $ip_address,
      'product_id'=> $product_id,
      'created_at'=> Carbon::now()
    ]);
    return back();
    }
  }
  function cart($coupon_name = ""){
     if($coupon_name == ""){
       $ip_address = $_SERVER ['REMOTE_ADDR'];
       $cart_items = Cart::where('customer_id',$ip_address)->get();
       $discount_amount = 0;
       return view('cart',compact('cart_items','discount_amount','coupon_name'));
     }
     else{
      if( Coupon::where('coupon_name',$coupon_name)->exists()){
        if(Carbon::now()->format('Y-m-d') <= Coupon::where('coupon_name',$coupon_name)->first()->valid_till){
          $ip_address = $_SERVER ['REMOTE_ADDR'];
          $cart_items = Cart::where('customer_id',$ip_address)->get();
          $discount_amount = Coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
          return view('cart',compact('cart_items','discount_amount','coupon_name'));
        }else{
          echo "Invalid coupon";
        }
      }
      else {
      echo "nai";
      }
     }
  }

  function singlecartdelete($cart_id){
    Cart::find($cart_id)->delete();
    return back();
  }
  function clearcart(){
      $ip_address = $_SERVER ['REMOTE_ADDR'];
      Cart::where('customer_id',$ip_address)->delete();
      return back();
  }
  function updatecart(Request $request){
    $ip_address = $_SERVER ['REMOTE_ADDR'];
    foreach ($request->product_id as $key_of_product_id => $value_of_product_id) {
      if(Product::find($value_of_product_id)->Product_quantity >=$request->user_given_quantity[$key_of_product_id]){
        Cart::where('customer_id',$ip_address)->where('product_id',$value_of_product_id)->update([
          'product_quantity' => $request->user_given_quantity[$key_of_product_id]
        ]);
      }
    }
    return back();
  }
  function customerregister(){
    return view('customer_register');
  }
  function customerregisterinsert(Request $request){
    User::insert([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => 2,
      'created_at'=> Carbon::now()
    ]);
    return back();
  }
  function checkout(Request $request){
    $grand_total = $request->grand_total;
    $countries = Country::all();
    return view('checkout',compact('countries','grand_total'));
  }
   function checkoutinsert(Request $request){
        $shipping_id = Shipping::insertGetId([
           'user_id' => Auth::id(),
           'first_name' => $request->first_name,
           'last_name' => $request->last_name,
           'address' => $request->address,
           'pn_number' => $request->pn_number,
           'zip_code' => $request->zip_code,
           'country_id' => $request->country_id,
           'city_id' => $request->city_id,
           'pament_type' => $request->pament_type,
           'pament_status' => 1,
           'created_at' => Carbon::now()
        ]);
        $sale_id = Sale::insertGetId([
           'user_id' => Auth::id(),
           'shipping_id' => $shipping_id,
           'grand_total' => $request->grand_total,
           'created_at' => Carbon::now()
        ]);
          $ip_address = $_SERVER['REMOTE_ADDR'];
          $cart_items = Cart::where('customer_id',$ip_address)->get();
          foreach ($cart_items as $cart_item) {
            Billing_detail::insert([
               'sale_id' => $sale_id,
               'product_id' => $cart_item->product_id,
               'product_unit_price' => Product::find($cart_item->product_id)->Product_price,
               'product_quantity' => $cart_item->product_quantity,
            ]);
            Product::find($cart_item->product_id)->decrement('Product_quantity',$cart_item->product_quantity);
            $cart_item->delete();
          }
          if($request->pament_type == 1){
            Session::flash('success_cod', 'Your order place successfully');
             return redirect('cart');
          }
          elseif($request->pament_type == 2){
            $grand_total = $request->grand_total;
            return redirect('stripe')->with('grand_total', $grand_total)->with('shipping_id', $shipping_id);;
          }
   }
  function citylist(Request $request){
    $stringTosend = "<option>-Select One-</option>";
    $cities = City::where('country_id',$request->country_id)->get();
    foreach ($cities as $city) {
      $stringTosend .= "<option value='".$city->id."' >".$city->name."</option>";
    }
    echo $stringTosend;
  }
}
