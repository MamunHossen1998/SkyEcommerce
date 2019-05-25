@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-10 offset-2">
        <div class="card">
          <div class="card-header text-center">
            <h4>  Order List</h4>
          </div>
          <div class="card-body " >
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Shipping Id</th>
                  <th>Grand Total</th>
                  <th>Purchase </th>
                  <th>Pament Type</th>
                  <th>Pament Status</th>
                  <th>Purchase At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $all_orders as $all_order)
                <tr>
                  <td>{{ $all_order->shipping_id }}</td>
                  <td>{{ $all_order->grand_total }}</td>
                  <td>{{ $all_order->relationToShipping->first_name }}</td>
                  <td>{{ ($all_order->relationToShipping->pament_type ==1)? "Cash on delivery" : "Cadit card"}}</td>
                  <td>{{ ($all_order->relationToShipping->pament_status ==1)? "Not Yet" : "Pament Success"}}</td>              
                  <td>{{ $all_order->created_at->diffForHumans() }}</td>
                  <td>
                    <a href="{{ url('/view/details/order') }}/{{ $all_order->shipping_id }}" class="btn btn-sm btn-primary">View details</a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
