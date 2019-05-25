@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-5 offset-3">
        <div class="card">
          <div class="card-header">
            Add Information Form
          </div>
          <div class="card-body">
            @if (App\Profile::where('user_id',auth::id())->exists())
              @php
                $single_customer_data = App\Profile::where('user_id',auth::id())->first();
              @endphp
                  <form class="" action="{{ url('/customer/profile/update') }}" method="post">
                @csrf
                <div class="">
                  <label for="">First Name</label>
                   <input class="form-control" type="text" name="first_name" value="{{ $single_customer_data->first_name }}">
                </div>
                <div class="">
                   <label for="">Last Name</label>
                   <input class="form-control" type="text" name="last_name" value="{{ $single_customer_data->last_name }}">
                </div>
                <div class="">
                   <label for="">Address</label>
                   <input class="form-control" type="text" name="address" value="{{ $single_customer_data->address }}">
                </div>
                <div class="">
                   <label for="">Phone Number</label>
                   <input class="form-control" type="text" name="pn_number" value="{{ $single_customer_data->pn_number }}">
                </div>
                <div class="">
                   <label for="">Zip Code</label>
                   <input class="form-control" type="text" name="zip_code" value="{{ $single_customer_data->zip_code }}">
                </div>
                <div class="mt-1">
                  <button type="submit" class="btn btn-info" >Update Information</button>
                </div>
              </form>
             @else
               <form class="" action="{{ url('/customer/profile/insert') }}" method="post">
             @csrf
             <div class="">
               <label for="">First Name</label>
                <input class="form-control" type="text" name="first_name" value="">
             </div>
             <div class="">
                <label for="">Last Name</label>
                <input class="form-control" type="text" name="last_name" value="">
             </div>
             <div class="">
                <label for="">Address</label>
                <input class="form-control" type="text" name="address" value="">
             </div>
             <div class="">
                <label for="">Phone Number</label>
                <input class="form-control" type="text" name="pn_number" value="">
             </div>
             <div class="">
                <label for="">Zip Code</label>
                <input class="form-control" type="text" name="zip_code" value="">
             </div>
             <div class="mt-1">
               <button type="submit" class="btn btn-primary" >Add Information</button>
             </div>
           </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
