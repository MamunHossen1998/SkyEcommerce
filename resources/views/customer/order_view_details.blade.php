@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8 offset-2">
        <div class="card">
          <div class="card-header">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/customer/order') }}">Customer Orders</a></li>
                {{-- <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
              </ol>
              </nav>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Product Name</th>
                  <th>Product Unit Price</th>
                  <th>Total Price</th>
                  <th>Product Image</th>
                  <th>Product Quantity</th>
                </tr>
              </thead>
              @foreach ($customer_orders as $customer_order)
              <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $customer_order->relationToproduct->product_name }}</td>
                <td>{{ $customer_order->product_unit_price }}</td>
                <td>{{ $customer_order->product_unit_price*$customer_order->product_quantity }}</td>
                <td>
                  <img src="{{ asset('uploads\product_images') }}/{{ $customer_order->relationToproduct->product_image}}" width="100" alt="">
                </td>
                <td>{{ $customer_order->product_quantity }}</td>
              </tr>
                  @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
