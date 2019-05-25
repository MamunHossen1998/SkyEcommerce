<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  function relationToShipping(){
  return $this->hasOne('App\Shipping','id', 'shipping_id');
  }
}
