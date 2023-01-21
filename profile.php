<?php
require_once 'assets/php/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary">
                    <ul class="nav nav-tabs card-header-tabs">
                    
                    <li class="nav-item">
                            <a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#editProfile" class="nav-link font-weight-bold" data-toggle="tab">Edit Profile</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#changepass" class="nav-link font-weight-bold" data-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Profile Tab Content Start! -->
                        <div class="tab-pane container active"id="profile">
                            <div id="verifyEmailAlert"></div>
                            <div class="card-deck">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-light text-center lead">
                                        User ID: <?= $cid; ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b> Full Name: </b><?= $cname;?>
                                        </p>

                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Email ID: </b><?= $cemail;?>
                                        </p>

                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Gender:</b> <?= $cgender;?>
                                        </p>

                                        
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Date Of Birth: </b><?= $cdob;?>
                                        </p>

                                        
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Phone Number: </b><?= $cphone;?>
                                        </p>

                                        
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Register On : </b><?= $reg_on;?>
                                        </p>

                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Email Verfied : </b><?= $verified;?>
                                            <?php if($verified == 'Not Verfied'): ?>
                                                <a href="#" id="verify-email" class="float-right">
                                                    Verify Now
                                                </a>
                                                <?php endif; ?>
                                        </p>
                                        <div class="clearfix"></div> 
                                    
                                    </div>
                                </div>
                                <div class="card border-primary align-self-center">
                                    <?php if(!$cphoto): ?>
                                        <img src="assets/img/avatar.png" alt="Profile Photo" class="img-thumbnail img-fluid" width="400px">
                                    <?php else: ?>
                                        <img src="<?= 'assets/php/'.$cphoto; ?>" alt="Profile Photo" class="img-thumbnail img-fluid" width="408px">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Profile Tab Content Ends Here -->
                        
                        <!--Edit Profile Tab Content Starts Here -->
                        <div class="tab-pane container fade" id="editProfile">
                            <div class="card-deck">
                                <div class="card border-danger align-self-center">
                                <?php if(!$cphoto): ?>
                                    <img src="assets/img/avatar.png" alt="Profile Photo" class="img-thumbnail img-fluid" width="400px">
                                <?php else: ?>
                                    <img src="<?= 'assets/php/'.$cphoto; ?>" alt="Profile Photo" class="img-thumbnail img-fluid" width="408px">
                                <?php endif; ?>
                                </div>
                                <div class="card border-danger">
                                    <form action=""method="post" id="profile-update-form"class="px-3 mt-2" enctype="multipart/form-data">
                                        <input type="hidden" name="oldimage" value="<?= $cphoto; ?>">
                                        <div class="form-group m-0">
                                            <label for="profilephoto" class="m-1">Upload Profile Photo</label>
                                            <input type="file" name="image" id="profilePhoto">
                                        </div>

                                        <div class="form-group m-0">
                                            <label for="name" class="m-1">Full Name :</label>
                                            <input type="text" name="name" id="name" class="form-control" value="<?=$cname;?>">
                                        </div>

                                        <div class="form-group m-0">
                                            <label for="profilephoto" class="m-1">Gender : </label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" disabled <?php if($cgender == null) {echo 'selected';}?>>--Select--</option>
                                                <option value="male" <?php if($cgender == 'male') {echo 'selected';}?>>Male</option>
                                                <option value="Female" <?php if($cgender == 'female') {echo 'selected';}?>>Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group m-0">
                                            <label for="dob" class="m-1">Date Of Birth :</label>
                                            <input type="date" name="dob" value="<?= $cdob; ?>" class="form-control" id="dob">
                                        </div>

                                        <div class="form-group m-o">
                                            <label for="dob" class="m-1">Phone Number :</label>
                                            <input type="tel" name="phone" value="<?= $cphone; ?>" class="form-control" id="phone" placeholder="Enter Phone Number">
                                        </div>

                                        <div class="form-group mt-2">
                                            <input type="submit"name="profile_update"value="Update Profile" class="btn btn-success btn-block" id="profileUpdateBtn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Edit Profile Tab Content Ends Here -->

                        <!-- Change Password Tab Conetnt Start here -->
                        <div class="tab-pane container fade" id="changepass">
                            <div id="changepassAlert"></div>
                            <div class="card-deck">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white text-center lead">
                                        Change Password
                                    </div>
                                    <form action="#"method="post" class="px-3 mt-2"id="change-pass-form">
                                        <div class="form-group">
                                            <label for="curpass"><b>Enter Your Current Password :</b></label>
                                            <input type="password" name="curpass" placeholder="Current Password " class="form-control form-control-lg" id="currpass" required minlength="5">
                                        </div>

                                        <div class="form-group">
                                            <label for="newpass"><b>Enter Your New Password :</b></label>
                                            <input type="password" name="newpass" placeholder="New Password " class="form-control form-control-lg" id="newpass" required minlength="5">
                                        </div>
                                        <div class="form-group">
                                            <p class="text-danger"id="changepassError"></p>
                                        </div>

                                        <div class="form-group">
                                            <label for="cnewpass"><b>Confirm Your New Password :</b></label>
                                            <input type="password" name="cnewpass" placeholder="Confirm New Password " class="form-control form-control-lg" id="cnewpass" required minlength="5">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" name="changepass" value="Update Password" class="btn btn-success btn-block btn-lg" id="changePassBtn">
                                        </div>
                                    </form>
                                </div>
                                        
                                        <div class="card border-success align-self-center">
                                            <img src="assets/img/pass.jpg" alt="Thmbnail" class="img-thumbnail img-fluid" width="408px">
                                        </div>
                            </div>
                        </div>
                        <!-- Change Password Tab Conetnt Ends here-->
                        <!-- video 15 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   <script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
   

   <script type="text/javascript">
        $(document).ready(function(){

            //Profile Update Ajax Request
            $("#profile-update-form").submit(function(e){
                e.preventDefault();

                $.ajax({
                    url : 'assets/php/process.php',
                    method:'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: new FormData(this),
                    success: function(response){
                       location.reload();
                    }
                });
            });
            //Change Password Ajax Request
            $("#changePassBtn").click(function(e){
                if($("#change-pass-form")[0].checkValidity()){
                    e.preventDefault();
                    $("#changePassBtn").val('Please Wait . . . ');

                    if($("#newpass").val() != $("#cnewpass").val()){
                        $("#changepassError").text('* Password did not matched !');
                        $("#changePassBtn").val('Update Password');

                    }
                    else{
                        $.ajax({
                            url: 'assets/php/process.php',
                            method: 'post',
                            data: $("#change-pass-form").serialize()+'&action=change_pass',
                            success: function(response){
                               $("#changepassAlert").html(response);
                               $("#changePassBtn").val("Update Password");
                               $("#changepassError").text('');
                               $("#change-pass-form")[0].reset();
                            }
                        });
                    }
                }
            });

            //Verify Email Ajax Request 
            $("#verify-email").click(function(e){
                e.preventDefault();
                $(this).text('Please Wait . . . .');

                $.ajax({
                    url: 'assets/php/process.php',
                    method:'post',
                    data: {action: 'verify_email'},
                    success:function(response){
                        $("#verifyEmailAlert").html(response);
                        $("#verify-email").text('Verify Now');
                    }
                });
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


</body>

</html>