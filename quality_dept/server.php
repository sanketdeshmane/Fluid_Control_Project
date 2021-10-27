<?php

session_start();

$errors = array();

$reject_count=0;

//connect to db

$link = mysqli_connect('localhost','root','','fluid_control');

function mail_function($email,$subject,$msg){
    mail($email,$subject,$msg,'From: fluidcontrol2711@gmail.com');
}


function get_id($link,$table_name,$check){
    $query = "SELECT * from ".$table_name." where email = '$check' limit 1";
    $result = mysqli_query($link,$query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['email']===$check){
            $id = $user['id'];
        }
    }
    return $id;
}
//add defects

if(isset($_POST["add_btn"])){
    if( isset($_POST["defect_name"]) && isset($_POST["part_name"])&& isset($_POST["found_by"])&& isset($_POST["assigned_to"])
    && isset($_POST["found_on"])&& isset($_POST["due_date"])&& isset($_POST["description"])) {
        $defect_name = mysqli_real_escape_string($link,$_POST['defect_name']);
        $part_name = mysqli_real_escape_string($link,$_POST['part_name']);
        $found_by = mysqli_real_escape_string($link,$_POST['found_by']);
        $assigned_to = mysqli_real_escape_string($link,$_POST['assigned_to']);
        $found_on = mysqli_real_escape_string($link,$_POST['found_on']);
        $due_date = mysqli_real_escape_string($link,$_POST['due_date']);
        $description = mysqli_real_escape_string($link,$_POST['description']);    
    }
    
    //checking if defect_name already exists
    
    $user_check_query = "SELECT * from defects where defect_name = '$defect_name' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if($user){
        if($user['defect_name']===$defect_name){
            array_push($errors,"Defect_Name already exists");
        }
    }
    
    //adding defect if no error
    
    if(count($errors)==0){
        $pass = md5($password1);
        $found_by_name=get_name($link,'quality_control',$found_by);
        $assigned_to_mail=get_email($link,'con_dept',$assigned_to);
        $query = "INSERT INTO defects (defect_name,part_name,found_by,assigned_to,found_on,due_date,description,defect_status) 
        VALUES ('$defect_name','$part_name','$found_by','$assigned_to','$found_on','$due_date','$description','ASSIGNED')";
        mysqli_query($link,$query);
        $_SESSION['success']="added defect";
        $message = "Hello! You have a new notification. $found_by_name has added a defect. 
        Defect has name $defect_name and it has occured in $part_name. You have to write solution for it before - $due_date";
        $subject="Added Defect";
        mail_function($assigned_to_mail,$subject,$message);
        header('location: quality_index.php');
    }
}

//getting notification to accept/reject solu

function getUserNotification($link,$type) {
    $email=$_SESSION['email'];
    $id = "SELECT * from ".$type."  where email = '$email' ";
    $result = mysqli_query($link,$id);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['email']===$email){
            $id=$user['id'];
        }
    }
    $query = "SELECT * FROM defects WHERE found_by= '$id' and (defect_status='SUBMITTED' or defect_status='SUBMITTED_AGAIN' )";
    //echo $query;
    $result = mysqli_query($link,$query);
    if(!$result) {
      echo mysqli_error($link);
      return ;
    } 
    return $result;
}




//approve or disaprrove

if(isset($_POST['accept_btn']) || isset($_POST['reject_btn'])) {
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $assigned_to=mysqli_real_escape_string($link,$_POST['assigned_to']);
    $assigned_to_mail=get_email($link,'con_dept',$assigned_to);
    if(isset($_POST['accept_btn'])){
        $message = "Hello! Your solution for defect having ID - $id is now approved.";
        $subject="Solution Approved";
        mail_function($assigned_to_mail,$subject,$message);
        $query = "UPDATE defects SET defect_status = 'ACCEPTED_1' WHERE id = '$id' ";
    } else {
        $message = "Hello! You have a new notification.  Your solution for defect having ID $id disapproved. Please write it again";
        $subject="Solution Disapproved";
        mail_function($assigned_to_mail,$subject,$message);
        $query = "UPDATE defects SET defect_status = 'DISAPPROVED' WHERE id = '$id' ";
    }
    mysqli_query($link,$query);
    header('location: quality_index.php');
}

function generateEmpList($link,$type) {
    $query = "SELECT `id`,`emp_name` from ".$type."";
    $result = mysqli_query($link,$query);
    $empIdArr = array();
    $empNameArr = array();
    while($row = mysqli_fetch_array($result)) {
        array_push($empIdArr,$row['id']);
        $name = $row['emp_name'];
        array_push($empNameArr,$name);
    }
    $str = "";
    for($i=0;$i<sizeof($empIdArr);$i++) {
        $str.='<option value="'.$empIdArr[$i].'">'.$empNameArr[$i].'</option>';
    };
    return $str;

}

//name of user
function getName($link){
    $email=$_SESSION['email'];
    $user_check_query = "SELECT * FROM quality_control WHERE email= '$email' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['email']===$email){
            $name=$user['emp_name'];
        }
    }
    return $name;
}

function get_email($link,$table_name,$check){
    $query = "SELECT * from ".$table_name." where id = '$check' limit 1";
    $result = mysqli_query($link,$query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['id']===$check){
            $email = $user['email'];
        }
    }
    return $email;
}

function get_name($link,$table_name,$check){
    $query = "SELECT * from ".$table_name." where id = '$check' limit 1";
    $result = mysqli_query($link,$query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['id']===$check){
            $name = $user['emp_name'];
        }
    }
    return $name;
}


//logout btn
if(isset($_POST['logout_btn'])){
    session_destroy();
    header('location:../login.php');
}



//read_sol btn
if(isset($_POST['read_btn'])) {
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $defect_name = mysqli_real_escape_string($link,$_POST['defect_name']);
    $part_name = mysqli_real_escape_string($link,$_POST['part_name']);
    $description = mysqli_real_escape_string($link,$_POST['description']);
    $assigned_to = mysqli_real_escape_string($link,$_POST['assigned_to']);
    // $file_name=$_FILES['attachment_file']['name'];
    $user_check_query = "SELECT * FROM solution WHERE defect_id= '$id' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['defect_id']===$id){
            $solution=$user['solution'];
            
            $file_name=$user['attachment'];
            $file_name="../assets/attachments/".$file_name;
        }
    }
}
?>