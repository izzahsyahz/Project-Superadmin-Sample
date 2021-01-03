<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- sweetalert style -->
  <link rel="stylesheet" href="libs/sweetalert2/sweetalert2.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="loginform">
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
 <!-- Sweetalert -->
 <script src="libs/sweetalert2/sweetalert2.min.js"></script>

<script>
     $(document).ready(function (){
          $("#loginform").submit(false);
          $("#loginform").on("submit", function(){
              var email =  $("#email").val();
              var password =  $("#password").val();

              var formData = {
                  "action": "login",
                  "email": email,
                  "password": password
              }
              if (email == ""){
                  swal({
                      type : "error",
                      title : "Oops!",
                      text : "Please fill in your email",
                      animation : true
                  })
              }else if(password == ""){
                  swal({
                      type : "error",
                      title : "Oops!",
                      text : "Please fill in your password",
                      animation : true
                  })
              }
              else{
                $.ajax({
                            type: "post",
                            url: "action.php",
                            data: formData,
                            success: function(result){
                                var result_obj = JSON.parse(result);
                                // var result_obj = JSON.parse(JSON.stringify(result));
                                console.log(result_obj);
                                if (result_obj.valid){
                                    swal({
                                        type : "success",
                                        title : "Success!",
                                        text : result_obj.msg,
                                        animation: true
                                    }).then(function () {
                                        location.href = "home.php";
                                    });
                                }
                                else{
                                    swal({
                                        type : "error",
                                        title : "Oops!",
                                        text : result_obj.msg,
                                        animation : true
                                    }).then(function (){
                                        
                                    })
                                }
                            }
                    })
                }
        })
    })
</script>
</body>
</html>
