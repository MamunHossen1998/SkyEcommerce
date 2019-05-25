@extends('layouts\app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-header text-center">
            Total Order
          </div>
          <div class="card-body text-center" >
          {{-- {{ $total_sale }}  {{ ($total_sale <= 1)?"Order":"Orders" }} --}}
          {{ $total_sale }}  {{ ($total_sale <= 1)?"Order":str_plural('Order') }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
