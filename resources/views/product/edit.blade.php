@extends('layouts\app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-6 offset-3">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashborad</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/product/add/view') }}">Product List</a></li>
            <li class="breadcrumb-item">{{ $product_info->product_name }}</a></li>

          </ol>
        </nav>
      <div class="card">
        <div class="card-header">
            Edit Product Form
        </div>
        @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif
          <div class="card-body">
            {{-- @if ($errors->all())
              <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
                </div>
            @endif --}}
           <form class="" action="{{ url('product/edit/insert') }}" method="post" enctype="multipart/form-data">
             @csrf
                <div class="">
                  <label for="">Category Name </label>
                  <select class="form-control" name="category_id">
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ ($product_info->category_id==$category->id)?"selected":"" }}> {{ $category->category_name }}</option>
                    @endforeach
                  </select>
                </div>
               <div class="">
                 <label for="">Product Name</label>
                 <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                 <input type="text" name="product_name" class="form-control" placeholder="Enter your product name" value="{{ $product_info->product_name }}">
               </div>
               <div class="">
                 <label for="">Product Description</label>
                <textarea name="product_description" rows="2" class="form-control">{{ $product_info->product_description }}</textarea>
               </div>
               <div class="">
                 <label for="">Product Price</label>
                 <input type="text" name="Product_price" class="form-control" placeholder="Enter your product price" value="{{ $product_info->Product_price }}">
               </div>
               <div class="">
                 <label for="">Product Quantity</label>
                 <input type="text" name="Product_quantity" class="form-control" placeholder="Enter your product quantity" value="{{ $product_info->Product_quantity }}">
               </div>
               <div class="">
                 <label for="">Product Alert</label>
                 <input type="text" name="Product_alert" class="form-control" placeholder="Enter your product alert" value="{{ $product_info->Product_alert}}">
               </div>
               <div class="">
                 <label for="">Product Image</label>
                 <input type="file" name="product_image" class="form-control">
               </div>
               <div class="">
                <button type="submit" class="btn btn-info">Edit Product</button>
               </div>
           </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
