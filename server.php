<?php

session_start();

$errors = array();


//connect to db

$link = mysqli_connect('localhost','root','','fluid_control');


//register varibles
if(isset($_POST["registerbtn"])){
    if( isset($_POST["name"]) && isset($_POST["email"])&& isset($_POST["password1"])&& isset($_POST["password2"])) {
        $name = mysqli_real_escape_string($link,$_POST['name']);
        $email = mysqli_real_escape_string($link,$_POST['email']);
        $password1 = mysqli_real_escape_string($link,$_POST['password1']);
        $password2 = mysqli_real_escape_string($link,$_POST['password2']);
        $type = mysqli_real_escape_string($link,$_POST['option']);
        if(strcmp($type,'Concerned Department') == 0){
            $table_name = 'con_dept';
        }
        else{
            $table_name = 'quality_control';
        }
    }
    
    
    //form validation
    
    if(empty($name)){array_push($errors,"name already exists");}
    if(empty($email)){array_push($errors,"email already exists");}
    if(empty($password1)){array_push($errors,"password already exists");}
    if(isset($password1) != isset($password2)){array_push($errors,"password do not match");}
    
    
    //checking if email already exists
    
    $user_check_query = "SELECT * from ".$table_name." where email = '$email' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if($user){
        if($user['email']===$email){
            array_push($errors,"email already exists");
        }
    }
    
    //register if no error
    
    if(count($errors)==0){
        $pass = md5($password1);
        $query = "INSERT INTO ".$table_name." (emp_name,email,password) VALUES ('$name','$email','$pass')";
        mysqli_query($link,$query);
        $_SESSION['email']=$email;
        $_SESSION['success']="YOU ARE NOW LOGGED IN";
        mail("$email",'Sign UP','Successfully signed-up on Fluid control Pvt. Limited Defect Management System','From: fluidcontrol2711@gmail.com');
        if(strcmp($table_name,'con_dept') == 0){
            header('location: con_dept/con_index.php');
        }
        else{
            header('location: quality_dept/quality_index.php');
        }
    }
}


//login

if(isset($_POST["login"])){
    $email = mysqli_real_escape_string($link,$_POST['email']);
    $password = mysqli_real_escape_string($link,$_POST['password']);
    $type = mysqli_real_escape_string($link,$_POST['option']);
    if(strcmp($type,'Concerned Department') == 0){
        $table_name = 'con_dept';
    }
    else{
        $table_name = 'quality_control';
    }
    if(empty($email)){array_push($errors,"enter the email");}
    if(empty($password)){array_push($errors,"enter the password");}
    if(count($errors)==0){
        $password=md5($password);
        $query = "SELECT * FROM ".$table_name." WHERE email='$email' AND password='$password'";
        $results=mysqli_query($link,$query);
        if(mysqli_num_rows($results)){
            $_SESSION['email']=$email;
            $_SESSION['success']="YOU ARE NOW LOGGED IN";
            if(strcmp($table_name,'con_dept') == 0){
                header('location: con_dept/con_index.php');
            }
            else{
                header('location: quality_dept/quality_index.php');
            }
            
        }
        else{
            array_push($errors,"credentials are wrong ");
        }
    }
}

//reset

if(isset($_POST["reset_btn"])){
    if( isset($_POST["email"])&& isset($_POST["password1"])&& isset($_POST["password2"])&& isset($_POST["option"])) {
        $email = mysqli_real_escape_string($link,$_POST['email']);
        $password1 = mysqli_real_escape_string($link,$_POST['password1']);
        $password2 = mysqli_real_escape_string($link,$_POST['password2']);
        $type = mysqli_real_escape_string($link,$_POST['option']);
        if(strcmp($type,'Concerned Department') == 0){
            $table_name = 'con_dept';
        }
        else{
            $table_name = 'quality_control';
        }
        if(isset($password1) != isset($password2)){
            array_push($errors,"password do not match");
            
        }
        
        if(count($errors)==0){
            $pass = md5($password1);
            $query = "UPDATE ".$table_name." SET password='$pass'  WHERE email='$email' ";
            mysqli_query($link,$query);
            $_SESSION['email']=$email;
            $_SESSION['success']="YOU ARE NOW LOGGED IN";
            if(strcmp($table_name,'con_dept') == 0){
                header('location: con_dept/con_index.php');
            }
            else{
                header('location: quality_dept/quality_index.php');
            }
        }

    }

}
?>