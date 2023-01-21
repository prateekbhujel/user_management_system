<?php
require_once 'admin-db.php';
$admin = new Admin();
session_start();
//Handle Admin Login Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'adminLogin'){
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);

    $hpassword = sha1($password);

    $loggedInAdmin = $admin->admin_login($username, $hpassword);

    if($loggedInAdmin != null){
        echo 'admin_login';
        $_SESSION['username'] = $username;
    }
    else{
        echo $admin->showMessage('danger','Username or Password is Incorrect');
    }
}

//Handel Fetch ALl Users Ajax Requests
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers'){
    $output ='';
    $data = $admin->fetchAllUsers(0);
    $path ='../assets/php/';

    if($data){
        $output .= '<table class="table table-striped table-bordered text-center">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Verified</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
    foreach ($data as $row){
        if($row['photo'] != ''){
            $uphoto = $path.$row['photo'];
        }else{
            $uphoto = '../assets/img/avatar.png';
        }
        $output .=' <tr>
                        <td>'.$row['id'].'</td>
                        <td><img src="'.$uphoto.'" class="rounded-circle"width="40px"></td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['gender'].'</td>
                        <td>'.$row['verified'].'</td>
                        <td>
                            <a href="#" id="'.$row['id'].'" title ="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                            
                            <a href="#" id="'.$row['id'].'" title ="Delete User" class="text-danger deleteUserIcon"><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                        </td>
                    </tr>';
            }
        $output .='     </tbody>
                    </table';
        echo $output;
    }                    
    else{
        echo '<h3 class="text-center text-secondary"> No Any Users Has Registered Yet ! </h3>';
    }
}

// Handel Display User in Details Ajax Request
if(isset($_POST['details_id'])){
    $id = $_POST['details_id'];

    $data = $admin->fetchuserDetailsById($id);

    echo json_encode($data);
}

// Handle Delete an User Ajax Request
if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];
    $admin->userAction($id, 0);
}

// Handel Fetch All deleted User Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllDeletedUsers'){
    $output ='';
    $data = $admin->fetchAllUsers(1);
    $path ='../assets/php/';

    if($data){
        $output .= '<table class="table table-striped table-bordered text-center">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Verified</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
    foreach ($data as $row){
        if($row['photo'] != ''){
            $uphoto = $path.$row['photo'];
        }else{
            $uphoto = '../assets/img/avatar.png';
        }
        $output .=' <tr>
                        <td>'.$row['id'].'</td>
                        <td><img src="'.$uphoto.'" class="rounded-circle"width="40px"></td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['gender'].'</td>
                        <td>'.$row['verified'].'</td>
                        <td>
                            <a href="#" id="'.$row['id'].'" title ="Restore User" class="text-white restoreUserIcon badge badge-dark p-2">Restore</a>
                        </td>
                    </tr>';
            }
        $output .='     </tbody>
                    </table';
        echo $output;
    }                    
    else{
        echo '<h3 class="text-center text-secondary"> No Any Users Has Deleted Yet ! </h3>';
    }
}
//Handel Restore Deleted User Ajax Request
if(isset($_POST['res_id'])){
    $id = $_POST['res_id'];

    $admin->userAction($id, 1);
}

// Handel Fetch All Notes Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllNotes'){
    $output ='';
    $note = $admin->fetchAllNotes();

    if($note){
        $output .= '<table class="table table-striped table-bordered text-center">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Note Title</th>
                        <th>Notes</th>
                        <th>Written On</th>
                        <th>Updated On</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
    foreach ($note as $row){
        $output .=' <tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['title'].'</td>
                        <td>'.$row['note'].'</td>
                        <td>'.$row['created_at'].'</td>
                        <td>'.$row['updated_at'].'</td>
                        <td>
                            <a href="#" id="'.$row['id'].'" title ="Delete Note" class="text-danger deleteNoteIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                    </tr>';
            }
        $output .='     </tbody>
                    </table';
        echo $output;
    }                    
    else{
        echo '<h3 class="text-center text-secondary"> No Any Notes has Written Yet ! </h3>';
    }
}

//Handel Delete note of an user Ajax Request
if(isset($_POST['note_id'])){
    $id = $_POST['note_id'];

    $admin->deleteNoteOfUser($id);
}

// Handel Fetch All FeedBack of Users AJax Request
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllFeedback'){
    $output ='';
    $feedback = $admin->fetchFeedback();

    if($feedback){
        $output .= '<table class="table table-striped table-bordered text-center">
                        <thead>
                        <tr>
                        <th>Feedback ID</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Subject</th>
                        <th>Feedback</th>
                        <th>Sent On</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
    foreach ($feedback as $row){
        $output .=' <tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['uid'].'</td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['subject'].'</td>
                        <td>'.$row['feedback'].'</td>
                        <td>'.$row['created_at'].'</td>
                        <td>
                            <a href="#" fid="'.$row['id'].'" id="'.$row['uid'].'" title ="Reply" class="text-primary replyFeedbackIcon" data-toggle="modal" data-target="#showReplyModal"><i class="fas fa-reply fa-lg"></i></a>
                        </td>
                    </tr>';
            }
        $output .='     </tbody>
                    </table';
        echo $output;
    }                    
    else{
        echo '<h3 class="text-center text-secondary"> No Any Feedback has Been Written By The Uses Yet ! </h3>';
    }
}

// Handel the Ajax Request of Feedback Reply 
if(isset($_POST['message'])){
   $uid = $_POST['uid'];
   $message = $admin->test_input($_POST['message']);
   $fid = $_POST['fid'];

   $admin->replyFeedback($uid, $message);

   $admin->feedbackReplied($fid);
}

//Handel Fetch Notification AJax Request
if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
    $notification = $admin->fetchNotification();
    $output ='';

    if($notification == true){
        foreach($notification as $row){
            $output .='<div class="alert alert-dark" role="alert">
                            <button type="button" id="'.$row['id'].'"class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">
                                New Notfication
                            </h4>
                            <p class="mb-0 lead">'.$row['message'].' by '.$row['name'].'</p>
                            <hr class="my-2">
                            <p class="mb-0 float-left"><b>User E-Mail : </b>'.$row['email'].'</p>
                            <p class="mb-0 float-right">'.$admin->timeInAgo($row['created_at']).'</p>
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

// Handel the Check Notification Ajax Request 
if (isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
    if($admin->fetchNotification()){
        echo '<i class="fas fa-circle text-danger fa-sm"></i>';
    }else{
        echo'';
    }
}

//Handel the Remove Notification Ajax Request
if(isset($_POST['notification_id'])){
    $id = $_POST['notification_id'];

    $admin->removeNotification(($id));

}

//Handel export all users in excel
if(isset($_GET['export']) && $_GET['export'] == 'excel'){
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=users.xls');
    header('Pragma: no-cache');
    header('Expires: 0');

    $data = $admin->exportAllUsers();
    echo '<table border="1" align="center">';
    
    echo '  <tr>
                <th>#</th>
                <th>Name</th>
                <th>E-mail Address</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Date Of Birth</th>
                <th>Joined On</th>
                <th>Verified</th>
                <th>Deleted</th>
            </tr>';

    foreach ($data as $row){
        echo ' <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['dob'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td>'.$row['verified'].'</td>
                    <td>'.$row['deleted'].'</td>
               </tr> ';
    }
    echo'</table>';

}

?>