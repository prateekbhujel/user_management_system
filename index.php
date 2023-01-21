<?php session_start();
if(isset($_SESSION['user'])){
  header('location:home.php');
}

include_once 'assets/php/config.php';
$db = new Database() ;

$sql = "UPDATE visitors SET hits = hits+1 WHERE id = 0";
$stmt = $db->conn->prepare($sql);
$stmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>U M S | User Management System </title>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" />
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>
  <body class="bg-info">
    
    <div class="container">
      <!-- Login Form Start -->
      <div class="row justify-content-center wrapper" id="login-box">
        <div class="col-lg-10 my-auto myShadow">
          <div class="row">
            <div class="col-lg-7 bg-white p-4">
              <h1 class="text-center font-weight-bold text-primary">Sign in to Account</h1>
              <hr class="my-3" />
              <form action="#" method="post" class="px-3" id="login-form">
                <div id="loginAlert"></div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="far fa-envelope fa-lg fa-fw"></i></span>
                  </div>
                  <input type="email" id="email" name="email" class="form-control rounded-0" value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email'];}?>"placeholder="E-Mail" required />
                </div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" id="password" name="password" class="form-control rounded-0" minlength="5" placeholder="Password" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password']; }?>"required autocomplete="off" />
                </div>
                <div class="form-group clearfix">
                  <div class="custom-control custom-checkbox float-left">
                    <input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['email'])) { ?> checked <?php } ?>/>
                    <label class="custom-control-label" for="customCheck">Remember me</label>
                  </div>
                  <div class="forgot float-right">
                    <a href="#" id="forgot-link">Forgot Password?</a>
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" id="login-btn" value="Sign In" class="btn btn-primary btn-lg btn-block myBtn" />
                </div>
              </form>
            </div>
            <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
              <h1 class="text-center font-weight-bold text-white">Hello Friends!</h1>
              <hr class="my-3 bg-light myHr" />
              <p class="text-center font-weight-bolder text-light lead">Enter your personal details and start your journey with us!</p>
              <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link">Sign Up</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Login Form End -->

      <!-- Registration Form Start -->
      <div class="row justify-content-center wrapper" id="register-box" style="display: none;">
        <div class="col-lg-10 my-auto myShadow">
          <div class="row">
            <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
              <h1 class="text-center font-weight-bold text-white">Welcome Back!</h1>
              <hr class="my-4 bg-light myHr" />
              <p class="text-center font-weight-bolder text-light lead">To keep connected with us please login with your personal info.</p>
              <button class="btn btn-outline-light btn-lg font-weight-bolder mt-4 align-self-center myLinkBtn" id="login-link">Sign In</button>
            </div>
            <div class="col-lg-7 bg-white p-4">
              <h1 class="text-center font-weight-bold text-primary">Create Account</h1>
              <hr class="my-3" />
              <form action="#" method="post" class="px-3" id="register-form">
                <div id="regAlert"></div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="far fa-user fa-lg fa-fw"></i></span>
                  </div>
                  <input type="text" id="name" name="name" class="form-control rounded-0" placeholder="Full Name" required />
                </div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="far fa-envelope fa-lg fa-fw"></i></span>
                  </div>
                  <input type="email" id="remail" name="email" class="form-control rounded-0" placeholder="E-Mail" required value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email'];} ?>" />
                </div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" id="rpassword" name="password" class="form-control rounded-0" minlength="5" placeholder="Password" required value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>" />
                </div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" id="cpassword" name="cpassword" class="form-control rounded-0" minlength="5" placeholder="Confirm Password" required />
                </div>
                <div class="form-group">
                  <div id="passError" class="text-danger font-weight-bolder"></div>
                </div>
                <div class="form-group">
                  <input type="submit" id="register-btn" value="Sign Up" class="btn btn-primary btn-lg btn-block myBtn" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Registration Form End -->
      <!-- Forgot Password Form Start -->
      <div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
        <div class="col-lg-10 my-auto myShadow">
          <div class="row">
            <div class="col-lg-7 bg-white p-4">
              <h1 class="text-center font-weight-bold text-primary">Forgot Your Password?</h1>
              <hr class="my-3" />
              <p class="lead text-center text-secondary">To reset your password, enter the registered e-mail adddress and we will send you password reset instructions on your e-mail!</p>
              <form action="#" method="post" class="px-3" id="forgot-form">
                <div id="forgotAlert"></div>
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="far fa-envelope fa-lg"></i></span>
                  </div>
                  <input type="email" id="femail" name="email" class="form-control rounded-0" placeholder="E-Mail" required />
                </div>
                <div class="form-group">
                  <input type="submit" id="forgot-btn" value="Reset Password" class="btn btn-primary btn-lg btn-block myBtn" />
                </div>
              </form>
            </div>
            <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
              <h1 class="text-center font-weight-bold text-white">Reset Password!</h1>
              <hr class="my-4 bg-light myHr" />
              <button class="btn btn-outline-light btn-lg font-weight-bolder myLinkBtn align-self-center" id="back-link">Back</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Forgot Password Form End -->
    </div>
    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <!-- Twitter Bootsrap js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.bundle.min.js" integrity="sha512-igl8WEUuas9k5dtnhKqyyld6TzzRjvMqLC79jkgT3z02FvJyHAuUtyemm/P/jYSne1xwFI06ezQxEwweaiV7VA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!-- Font awesome js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" integrity="sha512-xd+EFQjacRjTkapQNqqRNk8M/7kaek9rFqYMsbpEhTLdzq/3mgXXRXaz1u5rnYFH5mQ9cEZQjGFHFdrJX2CilA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   
   <script type="text/javascript">
        $(document).ready(function(){
           $("#register-link").click(function(){
            $("#login-box").hide();
            $("#register-box").show();
           });

           $("#login-link").click(function(){
                $("#login-box").show();
                $("#register-box").hide();
           });

           $("#forgot-link").click(function(){
                $("#login-box").hide();
                $("#forgot-box").show();
           });

           $("#back-link").click(function(){
                $("#login-box").show();
                $("#forgot-box").hide();
           });

           // Register Ajax Request 
           $("#register-btn").click(function(e){
            if($("#register-form")[0].checkValidity()){
              e.preventDefault();
              $("#register-btn").val('Please Wait . . . ');
              
              if($("#rpassword").val() !=$("#cpassword").val())
              {
                $("#passError").text('Password did not matched !');
                $("#register-btn").val('Sign Up');
              }
              else
              {
                $("#passError").text('');
                $.ajax({
                  url: 'assets/php/action.php',
                  method: 'post',
                  data: $("#register-form").serialize()+'&action=register',
                  success: function(response){
                    $("#register-btn").val('Sign Up');
                    if(response == 'register'){
                      window.location = 'home.php';
                    }else{
                      $("#regAlert").html(response);
                    }
                  }
                });
              }
            }
           });

           //Login Ajax Request
           $("#login-btn").click(function(e){
            if($("#login-form")[0].checkValidity()){
              e.preventDefault();

              $("#login-btn").val("Checking . . . ");
              $.ajax({
                url: 'assets/php/action.php',
                method: 'post',
                data: $("#login-form").serialize()+'&action=login',
                success: function(response){
                  console.log(response);
                  $("#login-btn").val("Sign In");
                  if(response === 'login'){
                    window.location = 'home.php';
                  }else{
                    $("#loginAlert").html(response);
                  }
                } 
              });
            }
           });

           //Forget Password Ajax Request
           $("#forgot-btn").click(function(e){
            if($("#forgot-form")[0].checkValidity()){
              e.preventDefault();

              $("#forgot-btn").val('Please Wait . . .');

              $.ajax({
                  url: 'assets/php/action.php',
                  method: 'post',
                  data: $("#forgot-form").serialize()+'&action=forgot',
                  success:function(response){
                    $("#forgot-btn").val('Reset Password');
                    $("#forgot-form")[0].reset();
                    $("#forgotAlert").html(response);
                    console.log(response);
                  }
              });
            }
           });
            //Check Notification
        checkNotification();
        function checkNotification(){
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: { action: 'checkNotification'},
                success:function(response){
                    $("#checkNotification").html(response);
                }
            });
        }
        });
    </script>
   
   <!-- <script src="js/script.js"></script> -->
  </body>
</html>