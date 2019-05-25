@extends('layouts\app')

@section('content')
  <div class="container">
    <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          All Banner Information
        </div>
        <div class="card-body">
         <table class="table table-bordered">
           <thead>
             <td>Banner Img</td>
             <td>Collection Name</td>
             <td>Collection Price</td>
             <td>Collectin Year</td>
           </thead>
           <tbody>
             @foreach ($banners as $banner)
                <tr>
               <td>
                 <img src="{{ asset('uploads\banner_img') }}\{{ $banner->banner_img}}" alt="No found" width="80">
               </td>
                 <td>{{ $banner->collection_name }}</td>
                 <td>{{ $banner->collection_price}}</td>
                 <td>{{ $banner->year}}</td>
               </tr>
             @endforeach
           </tbody>
         </table>
          {{ $banners->links() }}
        </div>
      </div>
    </div>
  <div class="col-6 ">
    <div class="card">
      <div class="card-header">
          Add Baner Form
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
         <form class="" action="{{ url('/baner/add/insert') }}" method="post" enctype="multipart/form-data">
           @csrf
             <div class="">
                <label for="">Banner Image</label>
                <input type="file" name="banner_img" class="form-control">
             </div>
             <div class="">
               <label for=""> Collection Name </label>
               <input type="text" name="collection_name" class="form-control" value="">
             </div>
             <div class="">
               <div class="">
                 <label for="">Collection Price </label>
                 <input type="text" name="collection_price" class="form-control" value="">
               </div>
               <div class="">
               <label for=""> Year </label>
               <input type="number" name="year" class="form-control" value="">
             </div>
             <div class="py-1">
               <button type="submit" class="btn btn-success">Add Category</button>
             </div>
         </form>
        </div>
    </div>
  </div>
</div>
</div>
@endsection
