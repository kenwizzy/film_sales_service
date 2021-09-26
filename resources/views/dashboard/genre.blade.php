@extends('layouts.dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Genres</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


           @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
           @endif

            @if(session()->has('errors'))
            @if(count($errors) > 0)
            @foreach($errors->all() as $errors)
            <div class="alert alert-danger">
                {{ $errors }}
             </div>
            @endforeach
            @endif
            @endif
        <div class="row">
           <div class="col-sm-6">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Create Genre</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
    <form action="{{url('add_genre')}}" method="post">
        @csrf()
        <div class="form-group">
          <label for="Title">Name:</label>
          <input type="text" name="name" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>
        </div>
            </div>

            <div class="col-sm-6">


        <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Genres</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example2" class="table table-bordered table-hover">
        @if($results->count() > 0)
                <thead>
                <tr>
                  <th>s/n</th>
                  <th>Name</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
            @foreach($results as $key => $data)
                <tr>
                  <td>{{$key + 1}}</td>
                    <td><a href="{{url('edit_genre',$data['id'])}}">{{$data['name']}}</a></td>
                  <td>{{ \Carbon\Carbon::parse($data['created_at'])->diffForHumans()}}</td>
                  <td>{{ \Carbon\Carbon::parse($data['updated_at'])->diffForHumans()}}</td>
                  <td>
                     <form id="delete-form-{{$data['id']}}" method="POST" action="{{url('delete_genre', $data['id'])}}" style="display: none;">
                          @csrf
                          @method('delete')
                     </form>
                     <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this genre?')) {event.preventDefault();document.getElementById('delete-form-{{ $data->id }}').submit();
                         }else {
                          event.preventDefault();
                        }">
                     <span class="badge badge-danger">Delete</span>
                    </button>
                  </td>
                </tr> 
            @endforeach

                </tbody>
            @else

        <h4 style="color:red;">No Record Found</h4>

            @endif
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


@endsection
