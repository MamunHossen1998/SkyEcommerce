<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing_detail extends Model
{
  function relationToproduct(){
  return $this->hasOne('App\Product','id', 'product_id');
  }
}
