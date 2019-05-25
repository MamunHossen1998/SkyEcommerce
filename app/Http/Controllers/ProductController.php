<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Image;
class ProductController extends Controller
{
      public function __construct()
      {
        $this->middleware('auth');
        $this->middleware('rolechecker');
      }
    function productaddview(){
      $products= Product::simplePaginate(4);
      $categories = Category::all();
      return view ('product\view',compact('products','categories'));
    }
    function productaddinsert(Request $request)
    {
      $request->validate([
            'product_name'=> 'required',
            'product_description'=> 'required',
            'Product_price'=> 'required |numeric',
            'Product_quantity'=> 'required |numeric',
             'Product_alert'=> 'required |numeric',
      ],[
        'product_name.required'=> 'Product name dan sir',
        'product_description.required'=> 'description dare vi'
      ]);
    $lastinserted_id=Product::insertGetId([
      'product_name'=> $request->product_name,
      'category_id'=> $request->category_id,
      'product_description'=> $request->product_description,
      'Product_price'=> $request->Product_price,
      'Product_quantity'=> $request->Product_quantity,
      'Product_alert'=> $request->Product_alert,
      'created_at'=> Carbon::now()
    ]);
    if($request->hasFile('product_image')){
       $main_photo = $request->product_image;
       $extention = $main_photo->getClientOriginalExtension();
       $image_name = $lastinserted_id.'.'.$extention;
       Image::make($main_photo)->resize(400 ,450)->save(base_path('public\uploads\product_images/'.$image_name));
       Product::find($lastinserted_id)->update([
       'product_image' => $image_name
       ]);
    }
      return back()->with('status','Product added successfully');
      }
      function productdelete($product_id){
      $imagename = Product::find($product_id)->product_image;
      unlink(base_path('public\uploads\product_images/'.$imagename));
      Product::find($product_id)->delete();
        return back();
      }
      function productedit($product_id){
        $product_info = Product::findorfail($product_id);
        $categories = Category::all();
        return view('product\edit',compact('product_info','categories'));
      }
      function producteditinsert(Request $request){
        Product::find($request->product_id)->update([
          'product_name'=> $request->product_name,
          'category_id'=> $request->category_id,
          'product_description'=> $request->product_description,
          'Product_price'=> $request->Product_price,
          'Product_quantity'=> $request->Product_quantity,
          'Product_alert'=> $request->Product_alert,
        ]);
        if($request->hasFile('product_image')){
           if(Product::find($request->product_id)->product_image != 'defaultimage.jpg'){
            $deleteTophoto = Product::find($request->product_id)->product_image;
             unlink(base_path('public\uploads\product_images/'.$deleteTophoto));
          }
          $main_photo = $request->product_image;
          $extention = $main_photo->getClientOriginalExtension();
          $image_name = $request->product_id.'.'.$extention;
           Image::make($main_photo)->resize(400 ,450)->save(base_path('public\uploads\product_images/'.$image_name));
           Product::find($request->product_id)->update([
           'product_image' => $image_name
           ]);
        }
         return back()->with('status','Product update successfully');
      }
}
