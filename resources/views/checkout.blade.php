@extends('layouts\frontend_master')

@section('frontend_main')
	<!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="">Home</a> /
				<a href="">Sales</a> /
				<a href="">Bags</a> /
				<a href="">Cart</a> /
				<span>Checkout</span>
			</div>
			<img src="img/page-info-art.png" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area cart-page spad">
		<div class="container">
      @auth
        <form class="checkout-form" method="post" action="{{ url('/checkout/insert') }}">
         @csrf
          @php
            $single_customer_data = App\Profile::where('user_id',auth::id())->first();
          @endphp
				<div class="row">
					<div class="col-lg-6">
						<h4 class="checkout-title">Billing Address</h4>
						<div class="row">
							<div class="col-md-6">
								<input type="text" placeholder="First Name *" value="{{ $single_customer_data->first_name }}" name="first_name">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Last Name *" value="{{ $single_customer_data->last_name }}" name="last_name">
							</div>
							<div class="col-md-12">
								<select id="country_id" name="country_id">
									<option>Country *</option>
                  @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                  @endforeach
								</select>
                <select id="city_list" name="city_id">
                  <option>City/Town *</option>
                </select>
								<input type="text" placeholder="Address *" value="{{ $single_customer_data->address }}" name="address">
								<input type="text" placeholder="Zipcode *"  value="{{ $single_customer_data->zip_code }}" name="zip_code">
								<input type="text" placeholder="Phone no *"  value="{{ $single_customer_data->pn_number }}" name="pn_number">
								<input type="email" placeholder="Email Address *" value="{{ auth::user()->email }}" name="email">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="order-card">
							<div class="order-details">
								<div class="od-warp">
									<h4 class="checkout-title">Your order</h4>
									<table class="order-table">
										<tfoot>
											<tr class="order-total">
												<th>Total</th>
                        <input type="hidden" name="grand_total" value="{{ $grand_total }}">
												<th>${{ $grand_total }}</th>
											</tr>
										</tfoot>
									</table>
								</div>
								<div class="payment-method">
									<div class="pm-item">
										<input type="radio" name="pament_type" value="1" id="one" checked>
										<label for="one">Cash on delievery</label>
									</div>
									<div class="pm-item">
										<input type="radio" name="pament_type" value="2" id="two">
										<label for="two">Credit card</label>
									</div>
								</div>
							</div>
							<button class="site-btn btn-full" type="submit">Place Order</button>
						</div>
					</div>
				</div>
			</form>
      @else
        <h3>Please<a href="{{ url('/login') }}">Login</a> Or <a href="{{ url('/customer/register') }}">Register</a> </h3>
      @endauth
		</div>
	</div>
	<!-- Page -->
@endsection

@section('footer_script')
  <script type="text/javascript">
    $(document).ready(function(){
     $('#country_id').change(function(){
       var country_id = $(this).val();
       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
              type:'POST',
              url:'/city/list',
              data: {country_id:country_id},
              success: function (data) {
              $('#city_list').html(data);
              }
            });

     });
    });
  </script>
@endsection
