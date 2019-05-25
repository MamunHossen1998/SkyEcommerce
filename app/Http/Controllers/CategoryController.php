<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('rolechecker');
    }
    function categoryaddview(){
       $categories = Category::paginate(5);
      return view('category\view',compact('categories'));
    }
    function categoryaddinsert(Request $request){
      $request->validate([
        'category_name' => 'required',
      ],[
        'category_name.required'=> 'Category name dan sir'
      ]);
      Category::insert([
        'category_name' => $request->category_name,
        'created_at' => Carbon::now()
      ]);
      return back()->with('status','Category added successfully');
    }
}
