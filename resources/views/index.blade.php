
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Film Sales App</title>

    <link rel="canonical" href="">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>

  <body>
@include('partials.navigation')

    <main role="main">
      <div class=""><br><br><br>
      </div>

      <div class="container">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
       <div class="alert alert-danger">
        {{ session()->get('error') }}
       </div>
    @endif
        <!-- Example row of columns -->
        <div class="row">
        @if($films->count() > 0)
          @foreach ($films as $data)
          <div class="col-md-4">
            <h4>{{$data->title}}</h4>
            <p><small>genre</small>: {{$data->genre->name}} <small>purchases</small>: 300 <small>price</small> &#8358;{{number_format($data->price,2)}}</p>
            <p>{{$data->description}}</p>
            <p><a class="btn btn-warning btn-sm" ref="#" role="button">{{$data->status}}</a>    <a class="btn btn-sm btn-info" href="{{url('add_to_cart', $data->id)}}" role="button">Buy</a></p>
          </div>
          @endforeach
        @else
        <h3 class="text-center">No Records Available Now</h3>
        @endif
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

    @include('partials.footer')
