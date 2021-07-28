<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/select2/dist/css/select2.min.css') }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/admin/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('/admin/dist/css/skins/_all-skins.min.css') }}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('/admin/plugins/iCheck/all.css') }}">

  <link rel="stylesheet" href="{{ asset('/admin/style.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="shortcut icon" href="{{ asset('/public/favicon.ico') }}" type="image/x-icon"/>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue sidebar-mini" @yield('event-js')>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>BJ</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>BJ</span>
    </a>

    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="container-fluid">

        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{ asset('/admin/dist/img/noavatar.png') }}" class="user-image" alt="{{ Auth::user()->name }}">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{ asset('/admin/dist/img/noavatar.png') }}" class="img-circle" alt="{{ Auth::user()->name }}">
                  <p>
                  {{ isset(Auth::user()->email) ? Auth::user()->email : Auth::user()->name }}
                    <small>Member since {{ isset(Auth::user()->created_at) ? Auth::user()->created_at->format('m/d/Y') : Auth::user()->email }}</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-default">Profile</button>
                  </div>
                  <div class="pull-right">
                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('/admin/dist/img/noavatar.png') }}" alt="{{ Auth::user()->name }}">
              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
              <p class="text-muted text-center">{{ Auth::user()->email }}</p>
              <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Full Width Column -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      @include('admin.menu')

    </section>
    <!-- /.sidebar -->
  </aside>


  <div class="content-wrapper">
      <!-- Main content -->
      <!-- <section class="content"> -->
      @if((Auth::user()->type == 'employee' && (Request::is('admin/orders') || Request::is('admin/orders-export')) || Request::is('admin')) || Auth::user()->type == 'admin')
        @yield('content')
      @else
      <section class="content">
        <div class="error-page">
          <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
            <p>Administrator permission issues</p>
          </div>
        </div>
      </section>
      @endif
        <!-- /.box -->
      <!-- </section> -->
      <!-- /.content -->
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container-fluid">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; {{ now()->year }} <a target="_blank" href="{{ url('/') }}">Applefox</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('/admin/plugins/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/admin/dist/js/jquery.validate.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('/admin/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/admin/plugins/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/admin/dist/js/adminlte.min.js') }}"></script>

<script src="{{ asset('/admin/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<!-- bootstrap datepicker -->
<script src="{{ asset('/admin/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- iCheck 1.0.1 -->
<script src="{{ asset('/admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('/admin/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="/admin/dist/js/demo.js"></script> -->

<!-- InputMask -->
<script src="{{ asset('/admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('/admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('/admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

@yield('script')
@stack('js-partials')
</body>
</html>
