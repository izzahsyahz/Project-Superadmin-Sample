<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- sweetalert style -->
    <link rel="stylesheet" href="libs/sweetalert2/sweetalert2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form id="registerform">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="fullname" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="retype_password" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-auth-links text-center">
                        <button type="submit" class="btn btn-block btn-primary">Register </button>
                    </div>
                </form>

                

                <a href="login.html" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- Sweetalert -->
    <script src="libs/sweetalert2/sweetalert2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function (){
          
            $("#registerform").submit(false);
            $("#registerform").on("submit", function(){
                var fullname =  $("#fullname").val();
                var email =  $("#email").val();
                var password =  $("#password").val();
                var retype_password =  $("#retype_password").val();

                var formData = {
                    "action": "register",
                    "fullname": fullname,
                    "email": email,
                    "password": password
                }
                if (fullname == ""){
                    swal({
                        type : "error",
                        title : "Oops!",
                        text : "Please fill in your fullname",
                        animation : true
                    })
                }else if(email == ""){
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
                }else if(retype_password == ""){
                    swal({
                        type : "error",
                        title : "Oops!",
                        text : "Please fill in your retype password",
                        animation : true
                    })
                }else if(password != retype_password){
                    swal({
                        type : "error",
                        title : "Oops!",
                        text : "Your retype password does not match with password",
                        animation : true
                    })
                }else{
                    $.ajax({
                            type: "post",
                            url: "action.php",
                            data: formData,
                            success: function(result){
                                var result_obj = JSON.parse(result);
                                console.log(result_obj);
                                if (result_obj.valid){
                                    swal({
                                        type : "success",
                                        title : "Success!",
                                        text : result_obj.msg,
                                        animation: true
                                    })
                                }
                                else{
                                    swal({
                                        type : "error",
                                        title : "Oops!",
                                        text : result_obj.msg,
                                        animation : true
                                    }).then(function () {
                                        location.reload();
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