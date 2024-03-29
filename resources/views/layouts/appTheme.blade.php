<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{asset('theme/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('theme/css/sb-admin.css') }}" rel="stylesheet">
  @yield('style')
  <script src="{{asset('theme/vendor/jquery/jquery.min.js') }}"></script>
</head>

<body id="page-top">

  @include('theme.header')

  <div id="wrapper">

    <!-- Sidebar -->
    @include('theme.sidebar')

    <div id="content-wrapper">

      @yield('content')
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      @include('theme.footer')

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit(); {{ __('Logout') }} ">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{asset('theme/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('theme/js/sb-admin.min.js') }}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{asset('theme/js/demo/datatables-demo.js') }}"></script>
  <script src="{{asset('theme/js/demo/chart-area-demo.js') }}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
       headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
  </script>
  @yield('script')
</body>

</html>
