<?php

    require_once 'config.php';

    class Auth extends Database{

        // Regustering New User

        public function register($name, $email, $password){
            $sql = "INSERT INTO users(name, email,password) VALUES (:name, :email ,:pass)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['name'=>$name, 'email'=>$email, 'pass'=>$password]);
            return true;
        }

        // Checking If the user already exists
        public function user_exist($email){
            $sql = "SELECT email FROM users WHERE email= :email";
            $stmt= $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result;
        } 

        //Login Existing User
        public function login($email){
            $sql = "SELECT email, password FROM users WHERE email = :email AND deleted !=0";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Current User In Session
        public function currentUser($email){
            $sql = "SELECT * FROM users where email= :email AND deleted !=0";
            $stmt =$this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        // Forgot Password

        public function forgot_password($token,$email){
            $sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['token'=>$token, 'email'=>$email]);
           
            return true;
        }

        // Reset Password User Authentication

        public function reset_pass_auth($email, $token){
            $sql="SELECT id FROM users WHERE email= :email AND token = :token AND token != '' AND token_expire > NOW() AND deleted != 0";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email, 'token'=> $token]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        // Update New Password 
        
        public function update_new_pass($pass, $email){
            $sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted != 0";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['pass'=>$pass, 'email'=>$email]);
            return true;
        }

    //Add New Note
    public function add_new_note($u_id, $title, $note)
    {

        $sql = "INSERT INTO notes(u_id, title, note) VALUES (:u_id, :title, :note)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['u_id'=>$u_id, 'title'=>$title, 'note'=>$note]);
        return true;
    }

    //Fetch All Note of an User
    public function get_notes($u_id){
        $sql = 'SELECT * FROM notes where u_id= :u_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['u_id'=>$u_id]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    //Edit Note of an User
    public function edit_note($id){
        $sql = "SELECT * FROM notes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    }

    // Update Note of the User
    public function update_note($id, $title, $note){
        $sql = "UPDATE notes SET title = :title, note= :note, updated_at = NOW() where id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['title'=>$title,'note'=>$note,'id'=>$id]);
        return true;
    }

    // Delete an note of an user
    public function delete_note($id){
        $sql ="DELETE FROM notes WHERE id = :id" ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        return true;

    }

    //Update Profile of the user
    public function update_profile($name,$gender,$dob,$phone,$photo,$id){

        $sql="UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo WHERE id = :id AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name'=>$name,'gender'=>$gender,'dob'=>$dob,'phone'=>$phone,'photo'=>$photo,'id'=>$id]);
        return true;

    }

    //Change Password of the user
    public function change_password($pass, $id){
        $sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pass'=>$pass,'id'=>$id]);

        return true;
    }

    //Verify Email of an user
    public function verify_email($email){
        $sql = "UPDATE users SET verified = 1 WHERE email = :email AND deleted != 0;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=>$email]);

        return true;
    }

    //send feedback to admin 
    public function send_feedback($subject,$feedback,$uid)
    {
        $sql="INSERT INTO feedback (uid,subject,feedback) VALUES (:uid,:sub,:feed)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid,'sub'=>$subject,'feed'=>$feedback]);

        return true;


    }

    //Insert Notifications

    public function notification($uid,$type,$message){
        $sql= "INSERT INTO notification (uid, type, message) VALUES (:uid, :type, :message)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid,'type'=>$type,'message'=>$message]);

        return true;
    }

    //fetch notification 

    public function fetchNotification($uid){
        $sql = "SELECT * FROM notification WHERE uid= :uid and type= 'user'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid'=>$uid]);

        $result =$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    //Remove Notfification
    public function removeNotification($id){
        $sql = "DELETE FROM notification WHERE id = :id AND type = 'user'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }
}

?>