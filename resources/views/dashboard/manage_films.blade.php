@extends('layouts.dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Films</h1>
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

            <div class="col-sm-6">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Create Film</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
    <form action="{{url('add_film')}}" method="post">
        @csrf()
        <div class="form-group">
          <label for="Title">Film Title:</label>
          <input type="text" name="title" class="form-control">
        </div>

        <div class="form-group">
            <label for="Title">Select Genre</label>
        <select name="genre_id" class="form-control">
            <option value="">Select Option</option>
            @foreach($genres as $genre)
               <option value="{{$genre->id}}">{{$genre->name}}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
        <label for="amount">Film Description</label>
        <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
          <label for="amount">Price</label>
          <input type="text" name="price" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enter</button>
        </form>
            </div>
        </div>
            </div>

            <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Films</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example2" class="table-bordered table-hover table-responsive">
        @if($results->count() > 0)
                <thead>
                <tr>
                  <th>s/n</th>
                  <th>Film Tilte</th>
                  <th>Description</th>
                  <th>Genre</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
            @foreach($results as $key => $data)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td><a href="{{url('dashboard/edit', $data['uuid'])}}">{{$data['title']}}</a></td>
                  <td>{{$data['description']}}</td>
                  <td>{{$data['genre']['name']}}</td>
                  <td>{{$data['price']}}</td>
                  <td>
            @if(Str::lower($data['status']) == 'available for sale')
            <a href="{{url('update_to_not_available', $data['id'])}}"><input type="submit" class="btn btn-success btn-sm" value="{{$data['status']}}"></a>
            @else
            <a href="{{url('update_to_available', $data['id'])}}"><input type="submit" class="btn btn-warning btn-sm" value="{{$data['status']}}"></a>
            @endif
            </td>
                  <td>{{ \Carbon\Carbon::parse($data['created_at'])->diffForHumans()}}</td>
                  <td>{{ \Carbon\Carbon::parse($data['updated_at'])->diffForHumans()}}</td>
                  <td>
                     <form id="delete-form-{{$data['id']}}" method="POST" action="{{url('delete', $data['id'])}}" style="display: none;">
                          @csrf
                          @method('delete')
                     </form>
                     <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this Film?')) {event.preventDefault();document.getElementById('delete-form-{{ $data['id'] }}').submit();
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
        <!-- /.col -->
      </div>
      <!-- /.row -->


@endsection
