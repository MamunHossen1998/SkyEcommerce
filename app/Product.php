<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
   use SoftDeletes;
   protected $fillable=['product_name','category_id','product_description','Product_price','Product_quantity','Product_alert','product_image'];
  //Relation table
   function relationToCategory(){
   return $this->hasOne('App\Category','id', 'category_id');
   }
}
