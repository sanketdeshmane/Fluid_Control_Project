<?php

session_start();

require ('../vendor/autoload.php');

$errors = array();

$reject_count=0;

//connect to db

$link = mysqli_connect('localhost','root','','fluid_control');

if(isset($_POST["download_cont_btn"])){
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $defect_name = mysqli_real_escape_string($link,$_POST['defect_name']);
    $part_name = mysqli_real_escape_string($link,$_POST['part_name']);
    $description = mysqli_real_escape_string($link,$_POST['description']);
    $found_by = mysqli_real_escape_string($link,$_POST['found_by']);
    $assigned_to = mysqli_real_escape_string($link,$_POST['assigned_to']);
    $found_on = mysqli_real_escape_string($link,$_POST['found_on']);
    $due_date = mysqli_real_escape_string($link,$_POST['due_date']);
    $containment = mysqli_real_escape_string($link,$_POST['containment']);
    $correction = mysqli_real_escape_string($link,$_POST['correction']);

    $html="";
    $html='<center><h1>DEFECT MANAGMENT SYSTEM</h1><h4>Fluid Control Pvt. Limited</h4></center><table>';
    $html.='<tr>
                <td>Defect ID - </td>
                <td>'.$id.'</td>
            </tr>
            <tr>
                <td>Defect Name - </td>
                <td>'.$defect_name.'</td>
            </tr>
            <tr>
                <td>Part Name - </td>
                <td>'.$part_name.'</td>
            </tr>
            <tr>
                <td>Description - </td>
                <td>'.$description.'</td>
            </tr>
            <tr>
                <td>Found by - </td>
                <td>'.get_name($link,'quality_control',$found_by).'</td>
            </tr>
            <tr>
                <td>Assigned to - </td>
                <td>'.get_name($link,'con_dept',$assigned_to).'</td>
            </tr>
            <tr>
                <td>found_on - </td>
                <td>'.$found_on.'</td>
            </tr>
            <tr>
                <td>Due Date - </td>
                <td>'.$due_date.'</td>
            </tr>
            <tr>
                <td>Containment - </td>
                <td>'.$containment.'</td>
            </tr>
            <tr>
                <td>Correction - </td>
                <td>'.$correction.'</td>
            </tr>
            <tr>
                <td>Status - </td>
                <td>Working</td>
            </tr>';
            
    $html.='</table>';
    $mpdf = new Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $file=time().'.pdf';
    $mpdf->output($file,'D');
    echo $html;
}


if(isset($_POST["download_btn"])){
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $defect_name = mysqli_real_escape_string($link,$_POST['defect_name']);
    $part_name = mysqli_real_escape_string($link,$_POST['part_name']);
    $description = mysqli_real_escape_string($link,$_POST['description']);
    $found_by = mysqli_real_escape_string($link,$_POST['found_by']);
    $assigned_to = mysqli_real_escape_string($link,$_POST['assigned_to']);
    $found_on = mysqli_real_escape_string($link,$_POST['found_on']);
    $due_date = mysqli_real_escape_string($link,$_POST['due_date']);
    $containment = mysqli_real_escape_string($link,$_POST['containment']);
    $correction = mysqli_real_escape_string($link,$_POST['correction']);
    $why_appear = mysqli_real_escape_string($link,$_POST['why_appear']);
    $why_not_detected = mysqli_real_escape_string($link,$_POST['why_not_detected']);
    $occurancy_plan = mysqli_real_escape_string($link,$_POST['occurancy_plan']);
    $Non_detection_plan = mysqli_real_escape_string($link,$_POST['Non_detection_plan']);

    $html="";
    $html='<center><h1>DEFECT MANAGMENT SYSTEM</h1><h4>Fluid Control Pvt. Limited</h4></center><table>';
    $html.='<tr>
                <td>Defect ID - </td>
                <td>'.$id.'</td>
            </tr>
            <tr>
                <td>Defect Name - </td>
                <td>'.$defect_name.'</td>
            </tr>
            <tr>
                <td>Part Name - </td>
                <td>'.$part_name.'</td>
            </tr>
            <tr>
                <td>Description - </td>
                <td>'.$description.'</td>
            </tr>
            <tr>
                <td>Found by - </td>
                <td>'.get_name($link,'quality_control',$found_by).'</td>
            </tr>
            <tr>
                <td>Assigned to - </td>
                <td>'.get_name($link,'con_dept',$assigned_to).'</td>
            </tr>
            <tr>
                <td>found_on - </td>
                <td>'.$found_on.'</td>
            </tr>
            <tr>
                <td>Due Date - </td>
                <td>'.$due_date.'</td>
            </tr>
            <tr>
                <td>Containment - </td>
                <td>'.$containment.'</td>
            </tr>
            <tr>
                <td>Correction - </td>
                <td>'.$correction.'</td>
            </tr>
            <tr>
                <td>Why Defect Appear? - </td>
                <td>'.$why_appear.'</td>
            </tr>
            <tr>
                <td>Why the defect was not detected? - </td>
                <td>'.$why_not_detected.'</td>
            </tr>
            <tr>
                <td>Occurancy Proposed Action Plan - </td>
                <td>'.$occurancy_plan.'</td>
            </tr>
            <tr>
                <td>Non detection Proposed Action Plan - </td>
                <td>'.$Non_detection_plan.'</td>
            </tr>
            <tr>
                <td>Status - </td>
                <td>Closed</td>
            </tr>';
            
    $html.='</table>';
    $mpdf = new Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $file=time().'.pdf';
    $mpdf->output($file,'D');
    echo $html;
}






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
    && isset($_POST["found_on"])&& isset($_POST["due_date"])&& isset($_POST["description"])&&isset($_FILES['evd_file']['name'])) {
        $defect_name = mysqli_real_escape_string($link,$_POST['defect_name']);
        $part_name = mysqli_real_escape_string($link,$_POST['part_name']);
        $found_by = mysqli_real_escape_string($link,$_POST['found_by']);
        $assigned_to = mysqli_real_escape_string($link,$_POST['assigned_to']);
        $found_on = mysqli_real_escape_string($link,$_POST['found_on']);
        $due_date = mysqli_real_escape_string($link,$_POST['due_date']);
        $description = mysqli_real_escape_string($link,$_POST['description']);
         
        $file_name=$_FILES['evd_file']['name'];
        $tmp = $_FILES['evd_file']['tmp_name'];
        $path="../assets/evidences/".$file_name;
        move_uploaded_file($tmp,$path);
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
        $query = "INSERT INTO defects (defect_name,part_name,found_by,assigned_to,found_on,due_date,description,evd_file,defect_status) 
        VALUES ('$defect_name','$part_name','$found_by','$assigned_to','$found_on','$due_date','$description','$file_name','ASSIGNED')";
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
    $query = "SELECT * FROM defects WHERE found_by= '$id' and 
            (defect_status='SUBMITTED' or defect_status='SUBMITTED_AGAIN' or defect_status='SUBMITTED_sol' or defect_status='SUBMITTED_sol_again') LIMIT 5";
    //echo $query;
    $result = mysqli_query($link,$query);
    if(!$result) {
      echo mysqli_error($link);
      return ;
    } 
    return $result;
}

function Notification($link,$type) {
    $email=$_SESSION['email'];
    $id = "SELECT * from ".$type."  where email = '$email' ";
    $result = mysqli_query($link,$id);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['email']===$email){
            $id=$user['id'];
        }
    }
    $query = "SELECT * FROM defects WHERE found_by= '$id' and (defect_status='SUBMITTED' or defect_status='SUBMITTED_AGAIN'or defect_status='SUBMITTED_sol' or defect_status='SUBMITTED_sol_again' )";
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
    $cmt=mysqli_real_escape_string($link,$_POST['cmt']);
    if(isset($_POST['accept_btn'])){
        $message = "Hello! Your solution for defect having ID - $id is now approved with a comment as - $cmt";
        $subject="Solution Approved";
        mail_function($assigned_to_mail,$subject,$message);
        $new_due=date('y-m-d', strtotime("+15 days"));
        $query = "UPDATE defects SET defect_status = 'ACCEPTED_1',due_date='$new_due' WHERE id = '$id' ";
    } else {
        $message = "Hello! Your solution for defect having ID $id disapproved with a comment as - $cmt. Please write it again";
        $subject="Solution Disapproved";
        mail_function($assigned_to_mail,$subject,$message);
        $new_due=date('y-m-d', strtotime("+2 days"));
        $query = "UPDATE defects SET defect_status = 'DISAPPROVED',due_date='$new_due'WHERE id = '$id' ";
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
            $correction=$user['correction'];
            $file_name=$user['attachment'];
            $file_name="../assets/attachments/".$file_name;
        }
    }
}


if(isset($_POST['read_prob_sol_btn'])) {
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $defect_name = mysqli_real_escape_string($link,$_POST['defect_name']);
    $assigned_to = mysqli_real_escape_string($link,$_POST['assigned_to']);
    $user_check_query = "SELECT * FROM solution WHERE defect_id= '$id' limit 1";
    $result = mysqli_query($link,$user_check_query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        if($user['defect_id']===$id){
            $solution=$user['solution'];
            $correction=$user['correction'];
            $file_name=$user['attachment'];
            $file_name="../assets/attachments/".$file_name;
        }
    }
    $user_check_query1 = "SELECT * FROM problem_solving WHERE defect_id= '$id' limit 1";
    $result1 = mysqli_query($link,$user_check_query1);
    $user1 = mysqli_fetch_assoc($result1);
    if($user1){
        if($user1['defect_id']===$id){
            $why_appear=$user1['why_appear'];
            $why_not_detected=$user1['why_not_detected'];
            $occurancy_plan=$user1['occurancy_plan'];
            $Non_detection_plan=$user1['Non_detection_plan']; 
        }
    }
}

if(isset($_POST['sol_accept_btn']) || isset($_POST['sol_reject_btn'])) {
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $assigned_to=mysqli_real_escape_string($link,$_POST['assigned_to']);
    $assigned_to_mail=get_email($link,'con_dept',$assigned_to);
    $cmt=mysqli_real_escape_string($link,$_POST['cmt']);
    if(isset($_POST['sol_accept_btn'])){
        $message = "Hello! Your solution for defect having ID - $id is now approved with a comment as - $cmt.";
        $subject="Solution Accepted";
        mail_function($assigned_to_mail,$subject,$message);
        $query = "UPDATE defects SET defect_status = 'CLOSED' WHERE id = '$id' ";
        $query1 = "UPDATE problem_solving SET status = '1' WHERE defect_id = '$id' ";
    } else {
        $message = "Hello! You have a new notification.  Your solution for defect having ID $id disapproved with a comment as - $cmt. Please write it again";
        $subject="Solution Rejected";
        mail_function($assigned_to_mail,$subject,$message);
        $new_due=date('y-m-d', strtotime("+15 days"));
        $query = "UPDATE defects SET defect_status = 'REJECTED',due_date='$new_due' WHERE id = '$id' ";
        $query1 = "UPDATE problem_solving SET status = '0' WHERE defect_id = '$id' ";
    }
    mysqli_query($link,$query);
    mysqli_query($link,$query1);
    header('location: quality_index.php');
}

if(isset($_POST['reset'])){
    $id = mysqli_real_escape_string($link,$_POST['id']);
    $due_date = mysqli_real_escape_string($link,$_POST['due_date']);
    $query="UPDATE defects SET due_date='$due_date' WHERE id = '$id' ";
    mysqli_query($link,$query);
}









?>