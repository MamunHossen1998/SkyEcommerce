@extends('layouts\app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-6 ">
        <div class="card">
          <div class="card-header">
            Category information
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="bg-dark text-white">
                  <th>Sl No</th>
                  <th>Name</th>
                  <th>Created_at</th>
                  <th>Action</th>
              </thead>
              <tbody>
                @forelse ($categories as $category)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                         <a href="#"type="button" class="btn btn-info btn-sm">edit</a>
                         <a href="#"type="button" class="btn btn-danger btn-sm">delete</a>
                       </div>
                      </td>
                </tr>
              @empty
                <tr class="text-center text-danger">
                  <td colspan="4"> No data Avilable </td>
                </tr>
             @endforelse
              </tbody>
            </table>
            {{ $categories->links() }}
          </div>
        </div>
      </div>
      <div class="col-6 ">
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
             <form class="" action="{{ url('category/add/insert') }}" method="post">
               @csrf
                 <div class="">
                   <label for="">Product Name</label>
                   <input type="text" name="category_name" class="form-control" placeholder="Enter your category name" value="{{ old('cateory_name') }}">
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
