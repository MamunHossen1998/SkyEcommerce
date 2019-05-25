@extends('layouts/frontend_master')

@section('frontend_main')
 <!-- Page Info -->
 <div class="page-info-section page-info-big">
   <div class="container">
     <h2>Dresses</h2>
     <div class="site-breadcrumb">
       <a href="">Home</a> /
       <span>Dresses</span>
     </div>
     <img src="img/categorie-page-top.png" alt="" class="cata-top-pic">
   </div>
 </div>
 <!-- Page Info end -->
 <!-- Page -->
 <div class="page-area categorie-page spad">
   <div class="container">
     <div class="categorie-filter-warp">
       <p>Showing 12 results from 369 products</p>
       <div class="cf-right">
         <form action="#">
           <select>
             <option>Color</option>
           </select>
           <select>
             <option>Brand</option>
           </select>
           <select>
             <option>Sort by</option>
           </select>
         </form>
       </div>
     </div>
     <div class="row">
       @foreach ($products as $product)
         <div class="col-lg-3">
         <div class="product-item">
           <figure>
             <img src="{{ asset('uploads\product_images') }}\{{ $product->product_image}}" alt="">
             <div class="pi-meta">
               <div class="pi-m-left">
                 <img src="{{ asset('frotend_assets\img\icons\eye.png') }}" alt="">
                 <p>view</p>
               </div>
               <div class="pi-m-right">
                 <img src="{{ asset('frotend_assets\img/icons/heart.png') }}" alt="">
                 <p>save</p>
               </div>
             </div>
           </figure>
           <div class="product-info">
             <h6>{{ $product->product_name }}</h6>
             <p>${{ $product->Product_price}}</p>
             <a href="{{ url('/product/details') }}/{{ $product->id }}" class="site-btn btn-line">ADD TO CART</a>
           </div>
         </div>
       </div>
       @endforeach
     </div>
   </div>
 </div>
 <!-- Page -->
@endsection
