@extends('layouts\app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8 ">
        <div class="card">
          <div class="card-header">
            Product information
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="">
                  {{-- <th>Id</th> --}}
                  <th>Product Name</th>
                  <th>Category name</th>
                  <th>Product descriptin</th>
                  <th>Product Image</th>
                  {{-- <th>price</th>
                  <th>quantity</th>
                  <th>alert</th> --}}
                  <th>created at</th>
                  <th>Action</th>
              </thead>
              <tbody>
                  @forelse ($products as $product)
                  <tr>
                      {{-- <td>{{ $loop->index+1}}</td> --}}
                      <td>{{ $product->product_name }}</td>
                      {{-- <td>{{ App\Category::find($product->category_id )->category_name }}</td> --}}
                      <td>{{ $product->relationToCategory->category_name}}</td>
                      <td>{{ $product->product_description }}</td>
                      <td>
                        <img src="{{ asset('uploads\product_images') }}\{{ $product->product_image}}" alt="No found" width="80">
                      </td>
                      {{-- <td>{{ $product->Product_price }}</td>
                      <td>{{ $product->Product_quantity }}</td>
                      <td>{{ $product->Product_alert}}</td> --}}
                      <td>{{ $product->created_at->format(' d-m-Y h:i:s A') }}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                         <a href="{{ url('/product/edit') }}/{{ $product->id }}"type="button" class="btn btn-info btn-sm">edit</a>
                         <a href="{{ url('/product/delete') }}/{{ $product->id }}"type="button" class="btn btn-danger btn-sm">delete</a>
                       </div>
                      </td>
                </tr>
              @empty
                <tr class="text-center text-danger">
                  <td colspan="6"> No product found</td>
                </tr>
              @endforelse
              </tbody>
            </table>
            {{ $products->links() }}
          </div>
        </div>
      </div>
      <div class="col-4 ">
        <div class="card">
          <div class="card-header">
              Add Product Form
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
             <form class="" action="{{ url('product/add/insert') }}" method="post" enctype="multipart/form-data">
               @csrf
                 <div class="">
                   <label for=""> Category Name </label>
                   <select class="form-control" name="category_id">
                       <option value="">--Select One--</option>
                       @foreach ($categories as $category)
                         <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                       @endforeach
                   </select>
                 </div>
                 <div class="">
                   <label for="">Product Name</label>
                   <input type="text" name="product_name" class="form-control" placeholder="Enter your product name" value="{{ old('product_name') }}">
                 </div>
                 <div class="">
                   <label for="">Product Description</label>
                  <textarea name="product_description" rows="2" class="form-control">{{ old('product_description') }}</textarea>
                 </div>
                 <div class="">
                   <label for="">Product Price</label>
                   <input type="text" name="Product_price" class="form-control" placeholder="Enter your product price" value="{{ old('Product_price') }}">
                 </div>
                 <div class="">
                   <label for="">Product Quantity</label>
                   <input type="text" name="Product_quantity" class="form-control" placeholder="Enter your product quantity" value="{{ old('Product_quantity') }}">
                 </div>
                 <div class="">
                   <label for="">Product Alert</label>
                   <input type="text" name="Product_alert" class="form-control" placeholder="Enter your product alert" value="{{ old('Product_alert') }}">
                 </div>
                 <div class="">
                   <label for="">Product Image</label>
                   <input type="file" name="product_image" class="form-control">
                 </div>
                 <div class="">
                  <button type="submit" class="btn btn-success">Add Product</button>
                 </div>
             </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
