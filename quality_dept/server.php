<?php

session_start();

$errors = array();

$reject_count=0;

//connect to db

$link = mysqli_connect('localhost','root','','fluid_control');

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
    //form validation
    
    if(empty($defect_name)){array_push($errors,"defect_name required");}
    if(empty($part_name)){array_push($errors,"part_name required");}
    if(empty($found_by)){array_push($errors,"found_by required");}
    if(empty($assigned_to)){array_push($errors,"assigned_to required");}
    if(empty($description)){array_push($errors,"description required");}
    if(empty($found_on)){array_push($errors,"found_on required");}
    if(empty($due_date)){array_push($errors,"due_date required");}
    
    //checking if defect_name already exists
    
    $user_check_query = "SELECT * from defects where defect_name = '$defect_name' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if($user){
        if($user['defect_name']===$defect_name){
            array_push($errors,"defect_name already exists");
        }
    }
    
    //adding defect if no error
    
    if(count($errors)==0){
        $pass = md5($password1);
        // $assigned_to_person = "SELECT * from con_dept where id = '$assigned_to' limit 1";
        // $result = mysqli_query($link,$assigned_to_person);
        // $user = mysqli_fetch_assoc($result);
        // if($user){
        //     if($user['id']===$assigned_to){
        //         $assigned_to=$user['emp_name'];
        //     }
        // }
        $query = "INSERT INTO defects (defect_name,part_name,found_by,assigned_to,found_on,due_date,description,sol_status,rejected_count) 
        VALUES ('$defect_name','$part_name','$found_by','$assigned_to','$found_on','$due_date','$description','0','0')";
        mysqli_query($link,$query);
        $_SESSION['success']="added defect";
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
    $query = "SELECT * FROM defects WHERE found_by= '$id' and sol_status='1' and defect_status='REJECTED_1' and rejected_count='0'";
    //echo $query;
    $result = mysqli_query($link,$query);
    if(!$result) {
      echo mysqli_error($link);
      return ;
    } 
    return $result;
}

//notification page
// function notification($link,$type) {
//     $email=$_SESSION['email'];
//     $id = "SELECT * from ".$type."  where email = '$email' ";
//     $result = mysqli_query($link,$id);
//     $user = mysqli_fetch_assoc($result);
//     if($user){
//         if($user['email']===$email){
//             $id=$user['id'];
//         }
//     }
//     $query = "SELECT * FROM defects WHERE found_by= '$id' and sol_status='1' and defect_status='REJECTED_1'";
//     //echo $query;
//     $result = mysqli_query($link,$query);
//     if(!$result) {
//       echo mysqli_error($link);
//       return ;
//     } 
//     return $result;
// }




//read_sol btn
if(isset($_POST['read_btn'])) {
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

//approve or disaprrove

if(isset($_POST['accept_btn']) || isset($_POST['reject_btn'])) {
    $id = mysqli_real_escape_string($link,$_POST['id']);
    if(isset($_POST['accept_btn'])){
        $query = "UPDATE defects SET defect_status = 'ACCEPTED_1' WHERE id = '$id' ";
    } else {
        $reject_count=$reject_count+1;
        $query1 = "UPDATE defects SET rejected_count = '$reject_count' WHERE id = '$id' ";
        $query = "UPDATE defects SET defect_status = 'REJECTED_1' WHERE id = '$id' ";
    }
    mysqli_query($link,$query);
    mysqli_query($link,$query1);
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

?>