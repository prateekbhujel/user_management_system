<?php
    
    require_once 'session.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php ';


    $mail = new PHPMailer(true);

//Handel Add New Note Ajax Request
    if(isset($_POST['action']) && $_POST['action'] == 'add_note'){
       $title = $cuser->test_input($_POST['title']);
       $note = $cuser->test_input($_POST['note']);

       $cuser->notification($cid, 'admin', 'Note added');
       $cuser->add_new_note($cid, $title, $note);
    }

    // Handel Display All Notes of AN User
    if(isset($_POST['action']) && $_POST['action'] == 'display_notes'){
        $output ='';

        $notes = $cuser->get_notes($cid);

      if($notes){
        $output.='<table class="table table-xs table-striped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
        
        foreach($notes as $row){
            $output .='
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['title'].'</td>
                <td>'.substr($row['note'],0,75).'...</td>
                <td>
                    <a href="#" id="'.$row['id'].'"title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;

                    <a href="#" id="'.$row['id'].'" title="Edit Note" class="text-primary editBtn"><i class="fas fa-edit fa-lg" data-toggle="modal"data-target="#editNoteModal"></i></a>&nbsp;

                    <a href="#" id="'.$row['id'].'" title="Delete Note" class="text-danger deleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                </td>
            </tr>';
        }
        $output .='</tbody>
                    </table>';
        echo $output;
      }
      else{
        echo '<h3 class="text-center text-secondary">:( You have not written any note yet! Write Note now ! </h3>';
      }
    //   $cuser->notification($cid, 'admin', 'Note added');

    }

    // Handel Edit note of the user Ajax Request
    if(isset($_POST['edit_id'])){
     $id = $_POST['edit_id'];

     $row = $cuser->edit_note ($id);
     echo json_encode($row);
    

    }

    // Handel The Update Note of an User Ajax Request
    if(isset($_POST['action']) && $_POST['action']=='update_note'){
       $id = $cuser->test_input($_POST['id']);
       $title = $cuser->test_input($_POST['title']);
       $note = $cuser->test_input($_POST['note']);

       $cuser->update_note($id,$title,$note);
       $cuser->notification($cid, 'admin', 'Note Updated');

    }
// Handel Delete of an Note of an user request Ajax Request

if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];

    $cuser->delete_note($id);
    $cuser->notification($cid, 'admin', 'Note deleted !');

}

//Handle Display a Note of an User AJAX Request
if(isset($_POST['info_id'])){
    $id = $_POST['info_id'];

    $row = $cuser->edit_note($id);
    
    echo json_encode($row);

}

//Handel Profile Update Ajax Request
if(isset($_FILES['image'])){
  $name = $cuser->test_input($_POST['name']);
  $gender = $cuser->test_input($_POST['gender']);
  $dob = $cuser->test_input($_POST['dob']);
  $phone = $cuser->test_input($_POST['phone']);

  $oldImage = $_POST['oldimage'];
  $folder = 'uploads/';

  if(isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")){
    $newImage= $folder.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $newImage);
    
    if($oldImage == null){
        unlink($oldImage);
    }
  }
  else{
    $newImage = $oldImage;
  }
  $cuser->update_profile($name,$gender,$dob,$phone,$newImage,$cid);
  $cuser->notification($cid, 'admin', 'Profile Updated');


}

//Handel The Ajax Request For Change Password
if(isset($_POST['action']) && $_POST['action']=='change_pass'){
    $currentPass = $_POST['curpass'];
    $newPass = $_POST['newpass'];
    $cnewPass = $_POST['cnewpass'];

    $hnewPass = password_hash($newPass, PASSWORD_DEFAULT);

    if($newPass != $cnewPass){
        echo $cuser->showMessage('danger','Password did not matched !');
    }else{
        if(password_verify($currentPass, $cpass)){
            $cuser->change_password($hnewPass,$cid);
            echo $cuser->showMessage('success',"Password Has been Changed Successfully !");
        }
        else{
            echo $cuser->showMessage('danger','Current Password is Incorrect !');
        }
       $cuser->notification($cid, 'admin', 'Password Changed');

    }
    
}
//Handel Verify Email Ajax Request 
if(isset($_POST['action']) && $_POST['action'] == 'verify_email'){
    try{
        $mail->isSMTP();
        $mail->Host = "smtp-mail.outlook.com";
        $mail->SMTPAuth = true;
        $mail->Username =Database::USERNAME;
        $mail->Password =Database::PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom(Database::USERNAME,'U.M.S');
        $mail->addAddress($cemail);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification Link !';
        $mail->Body = '<h3>Click The below Link to Verify Your e-mail id .<br> <a href="http://localhost/user-managment/verify-email.php?email='.$cemail.'">http://localhost/user-managment/verify-email.php?email='.$cemail.'</a><br>Regards<br> Pratik Bhujel | CEO.</h3>';

        $mail->send();
        echo $cuser->showMessage('success','We have send you the Verification link in your E-mail ID, Please check your E-mail!');
    }
    catch(Exception $e){
        echo $cuser->showMessage('danger', 'Something Went Wrong Please Try Again !');
    }
    $cuser->notification($cid, 'admin', 'email Verified !');


}

//Handel Send Feedback To Admin Aajax Request
if(isset($_POST['action']) && $_POST['action']=='feedback'){
    $subject = $cuser->test_input($_POST['subject']);
    $feedback = $cuser->test_input($_POST['feedback']);

    $cuser->send_feedback($subject,$feedback,$cid);
    $cuser->notification($cid, 'admin', 'Feedback Written !');

}
//Handel The Notification
if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
    $notification = $cuser->fetchNotification($cid);
    $output ='';

    if($notification == true){
        foreach($notification as $row){
            $output .='<div class="alert alert-danger" role="alert">
                            <button type="button" id="'.$row['id'].'"class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">
                                New Notfication
                            </h4>
                            <p class="mb-0 lead">'.$row['message'].'</p>
                            <hr class="my-2">
                            <p class="mb-0 float-left">Reply of Feedback from Admin</p>
                            <p class="mb-0 float-right">'.$cuser->timeInAgo($row['created_at']).'</p>
                            <div class="clearfix"></div>
                        </div>';
        }
        echo $output;
    }    
    else
    {
    echo '<h3 class="text-center text-secondary mt-5>No Any New Notification.</h3>';
    }

}

//Check Notification 
if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
    if($cuser->fetchNotification($cid)){
        echo '<i class="fas fa-circle fa-sm text-danger"></i>';
    }
    else{
        echo '';
    }
}

//Remove Notifcation
if(isset($_POST['notification_id'])){
    $id = $_POST['notification_id'];
    $cuser->removeNotification($id);
}


?>