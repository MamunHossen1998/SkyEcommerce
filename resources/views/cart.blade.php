@extends('layouts\frontend_master')

@section('frontend_main')
  <!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="">Home</a> /
				<a href="">Sales</a> /
				<a href="">Bags</a> /
				<span>Cart</span>
			</div>
			<img src="img/page-info-art.png" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area cart-page spad">
		<div class="container">
			@if (session('success'))
			<div class="alert alert-success">
			 {{ session('success') }}
			</div>
       @endif
			 @if (session('success_cod'))
 			<div class="alert alert-success">
 			 {{ session('success_cod') }}
 			</div>
        @endif
			<form action="{{ url('update/cart') }}" method="post">
				@csrf
					<div class="cart-table">
						<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th>Price</th>
									<th>Quantity</th>
									<th class="total-th">Total</th>
								</tr>
							</thead>
							<tbody>
								@php
									$sub_total= 0;
								@endphp
		            @forelse ($cart_items as $cart_item)
									{{-- {{ $cart_item->relationToProduct }} --}}
		              <tr>
									<td class="product-col">
									<img src="{{ asset ('uploads/product_images') }}/{{ $cart_item->relationToProduct->product_image}} " alt="Not fount" width="100">
										<div class="pc-title">
											<h4>{{ $cart_item->relationToProduct->product_name }}</h4>
											<a href="#">Edit Product</a>
										</div>
									</td>
									<td class="price-col">${{ $cart_item->relationToProduct->Product_price}}</td>
									<td class="quy-col">
										<input type="hidden" name="product_id[]" value="{{ $cart_item->product_id }}">
										<div class="quy-input">
											<span>Qty</span>
											<input type="number" name="user_given_quantity[]" value="{{ $cart_item->product_quantity }}">
										</div>
									</td>
									<td class="total-col">$
										{{ $cart_item->relationToProduct->Product_price* $cart_item->product_quantity}}
										@php
											$sub_total +=($cart_item->relationToProduct->Product_price* $cart_item->product_quantity);
										@endphp
									</td>
		              <td>
										<a href="{{ url('/single/cart/delete') }}/{{ $cart_item->id }}">
											<span class="fa fa-2x fa-trash"></span>
										</a>
		              </td>
								</tr>
							@empty
								<tr class="text-center text-danger">
									<td colspan="4"> No product is here!</td>
								</tr>
							@endforelse
							</tbody>
						</table>
					</div>
					<div class="row cart-buttons">
						<div class="col-lg-5 col-md-5">
							<a class="site-btn btn-continue" href="{{ url('/') }}">Continue shooping</a>
						</div>
					<div class="col-lg-7 col-md-7 text-lg-right text-left">
						<a class="site-btn btn-clear" href="{{ url('/clear/cart') }}" >Clear cart</a>
						<button type="submit" class="site-btn btn-line btn-update" >Update Cart</button>
					</div>
						</form>
			</div>
		</div>
		<div class="card-warp">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="shipping-info">
							<h4>Shipping method</h4>
							<p>Select the one you want</p>
							<div class="shipping-chooes">
								<div class="sc-item">
									<input type="radio" name="sc" id="one">
									<label for="one" id="label_one">Next day delivery<span>$4.99</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="two">
									<label for="two" id="label_two">Standard delivery<span>$1.99</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="three">
									<label for="three" id="label_three">Personal Pickup<span>Free</span></label>
								</div>
							</div>
							<h4>Cupon code</h4>
							<p>Enter your cupone code</p>
							<div class="cupon-input">
								<input type="text" id="user_insert_coupon_name" value="{{ $coupon_name }}">
								<button class="site-btn" id="apply_coupon_btn">Apply</button>
							</div>
						</div>
					</div>
					<div class="offset-lg-2 col-lg-6">
						<div class="cart-total-details">
							<h4>Cart total</h4>
							<p>Final Info</p>
							<ul class="cart-total-card">
								<li>Subtotal<span>${{ $sub_total }}</span></li>
								<li>Discount Amount <span>{{ $discount_amount }}%</span></li>
								<li>Shipping<span id="shipping_amount">Free</span></li>
								<li class="total">
									<span style="display:none" id="take_grand_total">{{ $sub_total-($sub_total*( $discount_amount/100 )) }}</span>
									Grand Total<span id="grand_total">{{ $sub_total-($sub_total*( $discount_amount/100 )) }}</span>
									<span>$</span></li>
							</ul>
						  <form class="" action="{{ url('/checkout') }}" method="post">
								@csrf
						  	<input type="hidden" id="grand_total_input_field" name="grand_total" value="{{ $sub_total-($sub_total*( $discount_amount/100 )) }}" >
								<button class="site-btn btn-full" name="submit">Proceed to checkout</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page end -->
@endsection
@section('footer_script')
	<script type="text/javascript">
			 $(document).ready(function(){
			$('#apply_coupon_btn').click(function(){
				var coupon_name = $('#user_insert_coupon_name').val();
        window.location.href = "{{ url('/cart') }}"+"/"+coupon_name;
			});
			$('#label_one').click(function(){
				var label_one = parseFloat(4.99);
				 $('#shipping_amount').html(label_one);
				var grand_total = parseFloat($('#take_grand_total').html());
				var final_grand_total = grand_total + label_one;
				$('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
					$('#grand_total_input_field').val(parseFloat(final_grand_total).toFixed(2));
			});
			$('#label_two').click(function(){
				var label_two = parseFloat(1.99);
				 $('#shipping_amount').html(label_two);
				var grand_total = parseFloat($('#take_grand_total').html());
				var final_grand_total = grand_total + label_two;
				$('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
				$('#grand_total_input_field').val(parseFloat(final_grand_total).toFixed(2));
			});
			$('#label_three').click(function(){
				var label_three = parseFloat(0);
				 $('#shipping_amount').html(label_three);
				var grand_total = parseFloat($('#grand_total').html());
				var final_grand_total = grand_total + label_three;
				$('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
				$('#grand_total_input_field').val(parseFloat(final_grand_total).toFixed(2));
			});
			 });
	</script>
@endsection
