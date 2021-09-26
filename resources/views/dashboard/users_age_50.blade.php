@extends('layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div>
    </div>
      <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Customers whose age is above 50</h3>
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
        </div>
    </div>
        </div>
      </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
@endsection
