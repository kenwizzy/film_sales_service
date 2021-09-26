
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
      <br><br><br>

      <div class="container">

          <div class="col-md-8" style="margin:auto;">
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
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Edit Profile</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{url('update_profile')}}" method="post">
                        @method('patch')
                        @csrf()
                        <div class="form-group">
                          <label for="Title">Name:</label>
                          <input type="text" name="name" value={{$user->name}} class="form-control">
                        </div>

                        <div class="form-group">
                        <label for="amount">Email Address</label>
                        <input name="email" value="{{$user->email}}" class="form-control">
                        </div>

                        <div class="form-group">
                          <label for="amount">New Password</label>
                          <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="amount">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                          </div>

                        <div class="form-group">
                            <label for="amount">Verify Previous Password</label>
                            <input type="password" name="old_password" class="form-control">
                          </div>

                        <button type="" class="btn btn-primary">Submit</button>
                        </form>

                </div>

              </div>
                </div>

      </div>

    </main>

    @include('partials.footer')
