@extends('layouts.dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Film</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    

           @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
           @endif
    
            <div class="row">
            <div class="col-sm-6">  
            @if(session()->has('errors'))
            @if(count($errors) > 0)
            @foreach($errors->all() as $errors)
            <div class="alert alert-danger">
                {{ $errors }}
             </div>
            @endforeach
            @endif
     @endif
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Update Film</h3>
            </div>
           
            <div class="card-body">
    <form action="{{url('update', $film['id'])}}" method="post">
         @method('PATCH')
        @csrf()
        <div class="form-group">
          <label for="title">Film Title</label>
          <input type="text" name="title" value="{{$film['title']}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="genre">Select Genre</label>
        <select name="genre_id" class="form-control">
             <option value="{{$film->genre->id}}">{{$film->genre->name}}</option>
            @foreach($genres as $genre)
             @if($genre->name != $film->genre->name)
               <option value="{{$genre->id}}">{{$genre->name}}</option>
            @endif
            @endforeach
            </select>
        </div>

        <div class="form-group">
        <label for="amount">Film Description</label>
        <textarea name="description" class="form-control">{{$film['description']}}</textarea>
        </div>

        <div class="form-group">
          <label for="amount">Price</label>
          <input type="text" name="price" value="{{$film['price']}}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
            </div>
        </div>
            </div>
      </div>
@endsection