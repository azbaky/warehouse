<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | @yield('title')</title>
  @section('title','HOME')

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
  @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Search</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
               <img src="{{asset('/cms/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle"> 
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('/cms/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('/cms/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
    
  <!-- Main Sidebar Container -->
        
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('cms/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> <b>WAREHOUSE 360</b> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img @if (auth()->user()->UserName=='Mohammed alazbaky')
            src="{{asset('/cms/dist/img/azbaky.jpg')}}" 
            @else src="{{asset('/cms/dist/img/user2-160x160.jpg')}}"
          @endif  class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <b> {{auth()->user()->UserName}} </b> </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li> --}}
          @canany(['Add-Admin', 'Read-Admins', 'Add-MemberCustomer','Read-MemberCustomer'])
               <li class="nav-header">Human Resources</li>
          @endcanany
            
                  @canany(['Add-Admin', 'Read-Admins'])
                  
          <li class="nav-item menu-close">
            <a href="#" class="nav-link ">
           
                  
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Admins
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">                
              @can('Add-Admin')
              <li class="nav-item">
                <a href="{{route('admins.create')}}" class="nav-link ">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Create</p>
                </a>
              </li>
              @endcan

              @can('Read-Admins')              
              <li class="nav-item">
                <a href="{{route('admins.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>index</p>
                  </a>
              </li>
              @endcan
            </ul>
          </li>
              
          @endcanany
          @canany(['Add-MemberCustomer', 'Read-MemberCustomer'])
              
          
          <li class="nav-item menu-close">
            <a href="#" class="nav-link ">

              <i class="nav-icon fas fa-users"></i>
              <p>
                Member Customer 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('Add-MemberCustomer')
                
              
               <li class="nav-item">
                <a href="{{route('brokers.create')}}" class="nav-link ">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Add member</p>
                </a>
              </li>
              @endcan
              @can('Read-MemberCustomer')
                
              
               <li class="nav-item">
                <a href="{{route('brokers.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>index</p>
                  </a>
              </li>
             @endcan 
            </ul>
          </li> 
        @endcanany  
          @canany(['Read-Permissions', 'Create-Permission', 'Create-Role','Read-Roles'])
            <li class="nav-header">Roles & Permissions</li>
            @canany(['Create-Role', 'Read-Roles'])
                
                
          <li class="nav-item menu-close">
              <a href="#" class="nav-link ">

                <i class="nav-icon fas fa-check-square"></i>
                  <p>
                    Roles
                    <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                @can('Create-Role')
                  <li class="nav-item">
                    <a href="{{route('roles.create')}}" class="nav-link ">
                      <i class="nav-icon fas fa-plus"></i>
                      <p>Create</p>
                    </a>
                </li>
                @endcan
                @can('Read-Roles')
                  <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>index</p>
                    </a>
                </li>
                @endcan
                
              </ul>
          </li>
          @endcanany
          @canany(['Create-Permission', 'Read-Permissions', ])
              
          
          <li class="nav-item menu-close">
            <a href="#" class="nav-link ">

              <i class="nav-icon fas fa-check-square"></i>
              <p>
                Permissions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('Create-Permission')
                <li class="nav-item">
                <a href="{{route('permissions.create')}}" class="nav-link ">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Create</p>
                </a>
              </li>
              @endcan
              @can('Read-Permissions')
              <li class="nav-item">
                <a href="{{route('permissions.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>index</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>  
          @endcanany
          @endcanany
          {{-- oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo --}}
         
          @canany(['Create-Customer', 'Read-Customers'])

              
          
          <li class="nav-header"> Oprations </li>
             <li class="nav-item menu-close">
            <a href="#" class="nav-link ">

              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('Create-Customer')
                <li class="nav-item">
                  <a href="{{route('customers.create')}}" class="nav-link ">
                    <i class="nav-icon fas fa-plus"></i>
                    <p>Add New Customer</p>
                  </a>
                </li>
              @endcan
                
             @can('Read-Customers')
                <li class="nav-item">
                <a href="{{route('customers.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Customers</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>  

          @endcanany
          {{-- meeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee --}}
          @canany(['Create-Item', 'Read-Items'])
          <li class="nav-item menu-close">
            <a href="#" class="nav-link ">
              <i class="fas fa-warehouse"></i>
              <p>
                Items
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('Create-Item')
              <li class="nav-item">
                <a href="{{route('items.create')}}" class="nav-link ">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Add New Items</p>
                </a>
              </li>
              @endcan
          
             @can('Read-Items')
               <li class="nav-item">
                <a href="{{route('items.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>All Items</p>
                </a>
              </li>
             @endcan
              
              
            </ul>
          </li>  
          @endcanany
          @canany(['Create-Order', 'Read-Orders'])
              
          <li class="nav-item menu-close">
            <a href="#" class="nav-link ">

              <i class="fas fa-inbox"></i>
              {{-- <i class="fa-solid fa-cart-shopping"></i> --}}
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('Create-Order')
                <li class="nav-item">
                <a href="{{route('orders.create')}}" class="nav-link ">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Create New Orders
                  
                  </p>
                </a>
              </li>
              @endcan
              @can('Read-Orders')
              <li class="nav-item">
                <a href="{{route('orders.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>All Orders</p>
                </a>
              </li>                
              @endcan

              
            </ul>
          </li> 
          @endcanany
          @canany(['Create-Category','Read-Categorys'])
              
         
          <li class="nav-item menu-close">
            <a href="#" class="nav-link ">

              <i class="nav-icon fas fa-layer-group"></i>
              
              <p>
                categries
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('Create-Category')
                <li class="nav-item">
                  <a href="{{route('categories.create')}}" class="nav-link ">
                    <i class="nav-icon fas fa-plus"></i>
                    <p>Create</p>
                  </a>
                </li>
              @endcan
              @can('Read-Categorys')
                <li class="nav-item">
                <a href="{{route('categories.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  
                  <p>index</p>
                </a>
              </li>
              @endcan
              
            </ul>
          </li>
          @endcanany
          {{-- @endcanany --}}
         {{-- nany(['Create-City', 'Read-Cities', 'delete']) --}} 
          {{-- <li class="nav-item menu-close">
            <a href="#" class="nav-link ">

              <i class="nav-icon fas fa-globe"></i>
              <p>
                Cities
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              {{-- @can('Create-City') --}}
              {{-- <li class="nav-item">
                <a href="{{route('cities.create')}}" class="nav-link ">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Create</p>
                </a>
              </li> --}}
              {{-- @endcan --}}
              {{-- @can('Read-Cities') --}}
              {{-- <li class="nav-item">
                <a href="{{route('cities.index')}}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                  <p>index</p>
                </a>
              </li> --}}
              {{-- @endcan --}}
              
            {{-- </ul>
          </li>   --}}
          {{-- @endcanany --}}
         
         {{-- @canany(['Create-Category', 'Create-Category']) --}}
          
          {{-- @endcanany --}}
          {{-- <li class="nav-item menu-close">
                  <a href="#" class="nav-link ">

                    <i class="nav-icon fas fa-car"></i>
                    <p>
                      Cars
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route('cars.create')}}" class="nav-link ">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Create</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('cars.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>index</p>
                      </a>
                    </li>
                  </ul>
          </li> --}}
          <li class="nav-header">Settings</li>
          <li class="nav-item">
            @can('Edit-Profile')
            <a href="{{route('auth.edit-profile')}}" class="nav-link">
              <i class="fas fa-edit nav-icon"></i>
              <p>Edit Profile</p>
            </a>
            @endcan

          <li class="nav-item">
            <a href="{{route('auth.edit-password')}}" class="nav-link">
              <i class="fas fa-lock nav-icon"></i>
              <p>Edit PassWord</p>
            </a>
            
          </li>
          
            
          </li>
          <li class="nav-item">
            <a href="{{route('auth.logout')}}" class="nav-link">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
          
        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6" >
            <h1 class="m-0">@yield('page-big-title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6" >
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@yield('page-main-title')</a></li>
              <li class="breadcrumb-item active">@yield('page-sub-title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

 
    <!-- Main  -->
    
    @yield('content')
  </div>
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
       
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024-2025 <a href="#">Waerhouse Management System</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b> 
        {{-- <p>Current date and time: {{ \Carbon\Carbon::now()->toDateTimeString() }}</p> --}}
         {{ \Carbon\Carbon::now()->format('l, F j, Y') }}</b> 
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
@yield('scripts')
</body>
</html>
