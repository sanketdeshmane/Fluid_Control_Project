<?php

session_start();

$errors = array();


//connect to db
$link = mysqli_connect('localhost','root','','fluid_control')or die(mysql_error());

$id = ( !empty($_POST['id']) ) ? $_POST['id']: "";
$msg = "Hello! You have a new notification. Submiited solution for defect ID $id. You need to approve/disapprove it";

// //name of user
function getName($link){
    $email=$_SESSION['email'];
    $user_check_query = "SELECT * FROM con_dept WHERE email= '$email' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['email']===$email){
            $name=$user['emp_name'];
        }
    }
    return $name;
}

//get notification
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
    $query = "SELECT * FROM defects WHERE assigned_to= '$id' and (defect_status = 'ASSIGNED' or defect_status = 'DISAPPROVED')";
    //echo $query;
    $result = mysqli_query($link,$query);
    
    if(!$result) {
      echo mysqli_error($link);
      return ;
    } 
    return $result;
}

// //disapproved_notification

function disapproved_notification($link,$type) {
    $email=$_SESSION['email'];
    $id = "SELECT * from ".$type."  where email = '$email' ";
    $result = mysqli_query($link,$id);
    $user = mysqli_fetch_assoc($result);
    
    if($user){
        if($user['email']===$email){
            $id=$user['id'];
        }
    }
    $query = "SELECT * FROM defects WHERE assigned_to= '$id' and defect_status='DISAPPROVED' ";
    $result = mysqli_query($link,$query);
    
    if(!$result) {
      echo mysqli_error($link);
      return ;
    } 
    return $result;
}

//add_sol btn


// read and write again solution
if(isset($_POST['read_write_btn'])) {
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $defect_name = mysqli_real_escape_string($link,$_POST['defect_name']);
    $part_name = mysqli_real_escape_string($link,$_POST['part_name']);
    $description = mysqli_real_escape_string($link,$_POST['description']);
    $user_check_query = "SELECT * FROM solution WHERE defect_id= '$id' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if($user){
        if($user['defect_id']===$id){
            $solution=$user['solution'];
        }
    }
}

if(isset($_POST['write_btn'])) {
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $defect_name = mysqli_real_escape_string($link,$_POST['defect_name']);
    $part_name = mysqli_real_escape_string($link,$_POST['part_name']);
    $description = mysqli_real_escape_string($link,$_POST['description']);
}

//table renderin
function getUserData($link,$type) {
    $email=$_SESSION['email'];
    $id = "SELECT * from ".$type."  where email = '$email' ";
    $result = mysqli_query($link,$id);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['email']===$email){
            $id=$user['id'];
        }
    }
    $query = "SELECT * FROM defects where assigned_to='$id' ";
    //echo $query;
    $result = mysqli_query($link,$query);
    if(!$result) {
      echo mysqli_error($link);
      return ;
    } 
    return $result;
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
// //logout btn
if(isset($_POST['logout_btn'])){
    session_destroy();
    header('location:../login.php');
}


if(isset($_POST['add_sol'])){
    if( isset($_POST["id"]) && isset($_POST["solution"]) && empty($_FILES['attachment_file']['name'])){
        $defect_id = mysqli_real_escape_string($link,$_POST['id']);
        $solution = mysqli_real_escape_string($link,$_POST['solution']);
        
        $user_check_query = "SELECT * FROM defects WHERE id= '$defect_id' limit 1";
        $result = mysqli_query($link,$user_check_query);
        $user = mysqli_fetch_assoc($result);
        
        if($user){
            if($user['id']===$defect_id && $user['defect_status']==='DISAPPROVED'){
                $query = "UPDATE solution SET solution='$solution'  WHERE defect_id ='$defect_id' ";
                $update_defect_status = "UPDATE `defects` SET defect_status='SUBMITTED_AGAIN'  WHERE id ='$defect_id' ";
            }
            else{
                $query = "INSERT INTO solution (defect_id,solution) VALUES ('$defect_id','$solution')";
                $update_defect_status = "UPDATE `defects` SET defect_status='SUBMITTED'  WHERE id ='$defect_id' ";
            }
        }
        
        mysqli_query($link,$query);
        mysqli_query($link, $update_defect_status);
        $_SESSION['success']="added solution";
        header('location: con_index.php');
    }
    else if(isset($_POST["id"]) && isset($_FILES['attachment_file']['name']) && empty($_POST["solution"])){
        $file_name=$_FILES['attachment_file']['name'];
        $tmp = $_FILES['attachment_file']['tmp_name'];
        $path="../assets/attachments/".$file_name;
        move_uploaded_file($tmp,$path);
        $defect_id = mysqli_real_escape_string($link,$_POST['id']);
    
        $user_check_query = "SELECT * FROM defects WHERE id= '$defect_id' limit 1";
        $result = mysqli_query($link,$user_check_query);
        $user = mysqli_fetch_assoc($result);
        
        if($user){
            if($user['id']===$defect_id && $user['defect_status']==='DISAPPROVED'){
                $query = "UPDATE solution SET attachment='$file_name'  WHERE defect_id ='$defect_id' ";
                $update_defect_status = "UPDATE `defects` SET defect_status='SUBMITTED_AGAIN'  WHERE id ='$defect_id' ";
            }
            else{
                $MSG="Uploaded File";
                $query = "INSERT INTO solution (defect_id,solution,attachment) VALUES ('$defect_id','$MSG','$file_name')";
                $update_defect_status = "UPDATE `defects` SET defect_status='SUBMITTED'  WHERE id ='$defect_id' ";
            }
        }
        
        mysqli_query($link,$query);
        mysqli_query($link, $update_defect_status);
        $_SESSION['success']="added solution";
        header('location: con_index.php');
    }
    else{
        $defect_id = mysqli_real_escape_string($link,$_POST['id']);
        $solution = mysqli_real_escape_string($link,$_POST['solution']);
        
        $file_name=$_FILES['attachment_file']['name'];
        $tmp = $_FILES['attachment_file']['tmp_name'];
        $path="../assets/attachments/".$file_name;
        move_uploaded_file($tmp,$path);
        $user_check_query = "SELECT * FROM defects WHERE id= '$defect_id' limit 1";
        $result = mysqli_query($link,$user_check_query);
        $user = mysqli_fetch_assoc($result);
        
        if($user){
            if($user['id']===$defect_id && $user['defect_status']==='DISAPPROVED'){
                $query = "UPDATE solution SET solution='$solution' and attachment='$file_name'  WHERE defect_id ='$defect_id' ";
                $update_defect_status = "UPDATE `defects` SET defect_status='SUBMITTED_AGAIN'  WHERE id ='$defect_id' ";
            }
            else{
                $query = "INSERT INTO solution (defect_id,solution,attachment) VALUES ('$defect_id','$solution','$file_name')";
                $update_defect_status = "UPDATE `defects` SET defect_status='SUBMITTED'  WHERE id ='$defect_id' ";
            }
        }
        
        mysqli_query($link,$query);
        mysqli_query($link, $update_defect_status);
        $_SESSION['success']="added solution";
        header('location: con_index.php');
    }
    
}
?>