<?php require_once 'assets/php/auth.php';
    $user = new Auth();

    $msg = '';

    if(isset($_GET['email']) && isset($_GET['token'])){
        $email = $user->test_input($_GET['email']);
        $token = $user->test_input($_GET['token']);

        $auth_user = $user->reset_pass_auth($email, $token);

        if($auth_user !=null){
            if(isset($_POST['submit'])){
                $newpass = $_POST['pass'];
                $cnewpass = $_POST['cpass'];

                $hnewpass = password_hash($newpass, PASSWORD_DEFAULT);

                if($newpass == $cnewpass){
                    $user->update_new_pass($hnewpass, $email);
                    $msg = 'Password Changed Suceesfully <br> <a href="index.php"> Login Here !</a>';
                }
                else{
                    $msg = 'Password Did Not Matched !';
                }
            }
        }
        else{
            header('location:index.php');
            exit();
        }
    }
    else{
        header('location:index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>U M S | User Management System </title>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>
  <body class="bg-info">
    <div class="container">
      <!-- Reset Form Start -->
      <div class="row justify-content-center wrapper">
        <div class="col-lg-10 my-auto myShadow">
          <div class="row">
            <div class="col-lg-7 bg-white p-4">
              <h1 class="text-center font-weight-bold text-primary">Enter New Password !</h1>
              <hr class="my-3" />
              <form action="#" method="post" class="px-3">

              <div class="text-center lead mb-2"><?= $msg; ?></div>
                
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" name="pass" class="form-control rounded-0" minlength="5" placeholder="New Password" required autocomplete="off" />
                </div>

                                
                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fas fa-key fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" name="cpass" class="form-control rounded-0" minlength="5" placeholder="Confirm New Password" required autocomplete="off" />
                </div>

                <div class="form-group clearfix">
                  
                </div>
                <div class="form-group">
                  <input type="submit" value="submit" name ="submit"class="btn btn-primary btn-lg btn-block myBtn" />
                </div>
              </form>
            </div>
            <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
              <h1 class="text-center font-weight-bold text-white">Reset Your Password Here !</h1>
            </div>
          </div>
        </div>
      </div>
    </div>



     <!-- jQuery CDN -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Twitter Bootsrap js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha512-c4wThPPCMmu4xsVufJHokogA9X4ka58cy9cEYf5t147wSw0Zo43fwdTy/IC0k1oLxXcUlPvWZMnD8be61swW7g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Font awesome js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" integrity="sha512-xd+EFQjacRjTkapQNqqRNk8M/7kaek9rFqYMsbpEhTLdzq/3mgXXRXaz1u5rnYFH5mQ9cEZQjGFHFdrJX2CilA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  </body>
</html>