<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/adminlte.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Login - Teste</title>
</head>

<body>


  <div class="modal-dialog text-center">
    <div class="col-sm-9 main-section">
      <div class="modal-content">
        <div class="col-12 user-img">
          <img src="storage/sys/logo.png">
        </div>
        @if (session('status_login_error'))
        <div class="alert alert-danger">
          {{ session('status_login_error') }}
        </div>
        @endif
        <div class="col-12">
          <form class="login-form" method="POST" action="/api/auth/login">
            @csrf
           
            <div class="form-group">
              <input type="text" placeholder="cgc" name="cgc" autofocus>
            </div>

            <div class="form-group">
              <input type="password" placeholder="Senha" name="password">
            </div>


            <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Entrar</button>

            <div class="col-12">
              <input type="checkbox" name="remember"><span class="texto"> Lembrar</span>
            </div>

          </form>

          <div class="col-12 forgot">
            <a href="/recuperar/password">Esqueci a senha</a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Essential javascripts for application to work-->
  <script src="{{url('/')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{url('/')}}/js/popper.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="{{url('/')}}/js/main.js"></script>
  <script src="{{url('/')}}/js/test.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <script type="text/javascript">
    // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
  </script>
</body>

</html>