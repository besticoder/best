<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="{{asset('theme/css/sb-admin.css') }}" rel="stylesheet">
  <style type="text/css">.err{color: red}</style>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="name" id="firstName" class="form-control @error('name') is-invalid @enderror" placeholder="First name" required="required" autofocus="autofocus">
              <label for="firstName">Name</label>
            </div>
            @error('name')
                <span class="err" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>
            </div>
            @error('email')
                <span class="err" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
                @error('password')
                    <span class="err" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="{{route('login')}}">Login Page</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('theme/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

</body>

</html>