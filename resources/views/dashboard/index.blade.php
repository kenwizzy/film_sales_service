@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div>
    </div>
    <!-- Main content -->
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$films->count()}}</h3>
                <p>Films that have Genre – Action</p>
                <a href="{{url('dashboard/sorted_films')}}">View Details</a>
              </div>
              <div class="icon">
                <i class="ion ion-video"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$usersAge->count()}}<sup style="font-size: 20px"></sup></h3>
                <p>Customers whose age is above 50</p>
                <a href="{{url('dashboard/get_users_50')}}">View Details</a>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$sn}}</h3>
                <p>The films that end with the character ‘s’</p>
                <a href="#">View Details</a>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>

        </div>
      </div><!-- /.container-fluid -->
      <div class="row">
          <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$results->where(date("created_at"), '=', date('m'))->count()}}</h3>
                <p>The total number of sales for {{ Carbon\Carbon::parse(now(), 'UTC')->isoFormat('MMMM') }}.</p>
                <a href="#">View Details</a>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$results->count()}}</h3>
                <p>The total number of films purchased by the customers</p>
                <a href="#">View Details</a>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
          </div>
    </section>

    <section class="content">
      <div class="container-fluid">
  <div class="row">
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example2" class="table-responsive table table-bordered table-hover">
        @if($users->count() > 0)
                <thead>
                <tr>
                  <th>S/n</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Age</th>
                  <th>User Role</th>
                  <th>Date Registered</th>
                  <th>Change Role</th>
                </tr>
                </thead>
                <tbody>
        @foreach($users as $key => $output)
                <tr>
                  <td>{{$key+1 ?? 'Unavailable'}} </td>
                  <td>{{$output['name'] ?? 'Unavailable'}}</td>
                  <td>{{$output['email'] ?? 'Unavailable'}}</td>
                  <td>{{Carbon\Carbon::parse($output['dob'])->age}}</td>
                  <td>{{$output['role']['name'] ?? 'Unavailable'}}</td>
                  <td>{{ \Carbon\Carbon::parse($output['created_at'])->diffForHumans() ?? 'Unavailable'}}</td>
                  <td><form id="delete-form-{{$output['id']}}" method="POST" action="{{url('update_user', $output['id'])}}" style="display: none;">
                    @csrf
                    @method('patch')
               </form>
               <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to update this user role?')) {event.preventDefault();document.getElementById('delete-form-{{ $output->id }}').submit();
                   }else {
                    event.preventDefault();
                  }">
               <span class="badge badge-danger">{{$output['role']['name'] == 'Admin'? 'Change to Customer':'Change to Admin'}}</span>
              </button></td>
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

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Purchases</h3>
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
    </div>
        </div>
      </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
@endsection
