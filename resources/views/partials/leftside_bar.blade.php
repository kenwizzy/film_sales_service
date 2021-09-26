<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('/')}}" class="brand-link">HOME</a>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item has-treeview">
            <a href="{{url('dashboard')}}" class="nav-link active">
              <p>
                Dashboard

              </p>
            </a>

          </li>

          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Films
                <i class="fas fa-angle-left right"></i>
              </p>
            </a> --}}
            {{-- <ul class="nav nav-treeview"> --}}
             <li class="nav-item">
                <a href="{{route('dashboard/genre')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Genre</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('dashboard/manage_films')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Films</p>
                </a>
              </li>
            
              {{-- <li class="nav-item">
                <a href="{{url('weights')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Weights</p>
                </a>
              </li> --}}
            {{-- </ul> --}}
          {{-- </li> --}}
            </ul>
          </li>

        </ul>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>
