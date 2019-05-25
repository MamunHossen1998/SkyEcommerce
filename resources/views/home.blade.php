@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                         <thead class="bg-dark text-white">
                            <td>Name</td>
                            <td>Email</td>
                            <td>Created_at</td>
                         </thead>
                         <tbody>
                       @foreach ($data_users as $value)
                              <td>{{ $value->name }}</td>
                              <td>{{ $value->email }}</td>
                              <td>{{ $value->created_at }}</td>
                         </tbody>
                        @endforeach
                    </table>
                    {{ $data_users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
