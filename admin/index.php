<?php
    session_start();
    if(isset($_SESSION['username'])){
        header('location:admin-dashboard.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>   
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" integrity="sha512-rt/SrQ4UNIaGfDyEXZtNcyWvQeOq0QLygHluFQcSjaGB04IxWhal71tKuzP6K8eYXYB6vJV4pHkXcmFGGQ1/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />\
    <!-- Custom css -->
    <style>
        html.body{
            height: 100%;
        }
    </style>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body class="bg-dark">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-lg-5">
                <div class="card border-danger shadow-lg">
                    <div class="card-header bg-danger">
                        <h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp;Admin Panel Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="px-3" id="admin-login-form">
                            <div id="adminLoginAlert"></div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-conmtrol-lg rounded-0" placeholder="username" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-conmtrol-lg rounded-0" placeholder="password" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="admin-login" class="btn btn-danger btn-block btn-lg rounded-0" value="Login" id="adminLoginBtn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>

    </div>
    
<!-- jQuery CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Twitter Bootsrap js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.bundle.min.js" integrity="sha512-igl8WEUuas9k5dtnhKqyyld6TzzRjvMqLC79jkgT3z02FvJyHAuUtyemm/P/jYSne1xwFI06ezQxEwweaiV7VA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Font awesome js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" integrity="sha512-xd+EFQjacRjTkapQNqqRNk8M/7kaek9rFqYMsbpEhTLdzq/3mgXXRXaz1u5rnYFH5mQ9cEZQjGFHFdrJX2CilA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#adminLoginBtn').click(function(e){
           if($("#admin-login-form")[0].checkValidity()){
            e.preventDefault();
            $(this).val('Please Wait  . . .');
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: $("#admin-login-form").serialize()+'&action=adminLogin',
                success:function(response){
                    if(response === 'admin_login'){
                        window.location = 'admin-dashboard.php';
                    }
                    else{
                        $("#adminLoginAlert").html(response);
                    }
                    $("#adminLoginBtn").val('Login');
                }
            });
           } 
        });      
    });
</script>

</body>
</html>