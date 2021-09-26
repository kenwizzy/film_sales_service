
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
    <div class="col-md-8" style="margin:auto;">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">My Purchases</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <table id="example2" class="table-responsive table table-bordered table-hover">
            @if($results->count() > 0)
                    <thead>
                    <tr>
                      <th>S/n</th>
                      <th>Item(s)</th>
                      <th>Purchased By</th>
                      <th>Purchase Reference</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Date Purchased</th>
                    </tr>
                    </thead>
                    <tbody>
            @foreach($results as $key => $data)
                    <tr>
                      <td>{{$key+1 ?? 'Unavailable'}} </td>
                      <td>
                        @for($i=0; $i<count($data['item']); $i++)
                          {{$data['item'][$i].','}}
                        @endfor
                        </td>
                      <td>{{$data['user']['name'] ?? 'Unavailable'}}</td>
                      <td>{{$data['purchase_reference'] ?? 'Unavailable'}}</td>
                      <td>&#8358;{{$data['amount'] ?? 'Unavailable'}}</td>
                      <td>{{$data['status'] ?? 'Unavailable'}}</td>
                      <td>{{ \Carbon\Carbon::parse($data['created_at'])->diffForHumans() ?? 'Unavailable'}}</td>
                    </tr>
                @endforeach

                    </tbody>
                @else

            <h4 style="color:red;">No Record Found</h4>

                @endif
                    </tbody>
                  </table>
                </div>

              </div>
                </div>

      </div>

    </main>

    @include('partials.footer')
