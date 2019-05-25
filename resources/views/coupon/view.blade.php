@extends('layouts\app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ">
        <div class="card">
          <div class="card-header">
            Category information
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="bg-dark text-white">
                  <th>Coupon Name</th>
                  <th>Valid Till(date)</th>
                  <th>Created_at</th>
                  <th>Discount Amount</th>
                  <th>Status</th>
                  <th>Action</th>
              </thead>
              <tbody>
                @forelse($coupons as $coupon)
                  <tr>
                    <td>{{ $coupon->coupon_name }}</td>
                    <td>{{ $coupon->valid_till }}</td>
                    <td>{{ $coupon->created_at->format('d-m-Y h:i:s A') }}</td>
                    <td>{{ $coupon->discount_amount }}</td>
                    <td>
                      @if (Carbon\Carbon::now()->format('Y-m-d') <= $coupon->valid_till )
                       <span class="bg-info">Valid</span>
                     @else
                         Invalid
                      @endif
                    </td>
                    <td>#</td>
                  </tr>
                  @empty
                       <tr class="text-center">
                         <td colspan="5"> No coupon found </td>
                       </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-4 ">
        <div class="card">
          <div class="card-header">
              Add Coupon Form
          </div>
          @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
            <div class="card-body">
              @if ($errors->all())
                <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                  </div>
              @endif
             <form class="" action="{{ url('coupon/add/insert') }}" method="post">
               @csrf
                 <div class="">
                   <label for="">Coupon Name</label>
                   <input type="text" name="coupon_name" class="form-control" placeholder="Enter your coupon name" value="{{ old('coupon_name') }}">
                 </div>
                 <div class="">
                   <label for="">Discount Amount(%)</label>
                   <input type="text" name="discount_amount" class="form-control" placeholder="Enter your discount_amount" value="{{ old('discount_amount') }}">
                 </div>
                 <div class="">
                   <label for="">Valid Till(date)</label>
                   <input type="date" name="valid_till" class="form-control" placeholder="Enter your coupon_date" value="{{ old('valid_till') }}">
                 </div>
                 <div class="py-1">
                  <button type="submit" class="btn btn-success">Add Coupon</button>
                 </div>
             </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
