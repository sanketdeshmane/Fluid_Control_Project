<?php

session_start();

$errors = array();

//connect to db
$link = mysqli_connect('localhost','root','','fluid_control');

//name of user
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
    $query = "SELECT * FROM defects WHERE assigned_to= '$id' and defect_status != 'ACCEPTED_1' ";
    //echo $query;
    $result = mysqli_query($link,$query);
    
    if(!$result) {
      echo mysqli_error($link);
      return ;
    } 
    return $result;
}

//disapproved_notification

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
    $query = "SELECT * FROM defects WHERE assigned_to= '$id' and sol_status='1' and rejected_count='1' ";
    $result = mysqli_query($link,$query);
    
    if(!$result) {
      echo mysqli_error($link);
      return ;
    } 
    return $result;
}

//add_sol btn
if(isset($_POST['add_sol'])){
    $defect_id = mysqli_real_escape_string($link,$_POST['id']);
    $solution = mysqli_real_escape_string($link,$_POST['solution']);
    // $attachment_file = mysqli_real_escape_string($link,$_POST['attachment_file']);
    $user_check_query = "SELECT * FROM defects WHERE id= '$defect_id' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if($user){
        if($user['id']===$defect_id && $user['defect_status']==='REJECTED_1'){
            $query = "UPDATE solution SET solution='$solution' WHERE defect_id ='$defect_id' ";;
        }
        else{
            $query = "INSERT INTO solution (defect_id,solution) VALUES ('$defect_id','$solution')";
        }
    }
    
    mysqli_query($link,$query);
    $update_status = "UPDATE `defects` SET sol_status='1'  WHERE id ='$defect_id' ";
    $update_defect_status = "UPDATE `defects` SET defect_status='REJECTED_1'  WHERE id ='$defect_id' ";
    mysqli_query($link, $update_status);
    mysqli_query($link, $update_defect_status);
    $_SESSION['success']="added solution";
    header('location: con_index.php');
}

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












?>