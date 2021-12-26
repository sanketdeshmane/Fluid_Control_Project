<?php
include('server.php');
$emp_name = getName($link);
include('../include/con_dept/header.php');
include('../include/con_dept/navbar.php');

$result = Notification($link,'con_dept');
$email=$_SESSION['email'];
$id = "SELECT * from con_dept  where email = '$email' ";
$res = mysqli_query($link,$id);
$user = mysqli_fetch_assoc($res);
if($user){
    if($user['email']===$email){
        $id=$user['id'];
    }
}
if(isset($_POST['search_btn'])) {
    $defect_id = mysqli_real_escape_string($link,$_POST['search']);
    $query = "SELECT * FROM defects WHERE assigned_to= '$id' and id='$defect_id' and (defect_status = 'ASSIGNED' or defect_status = 'DISAPPROVED'or defect_status = 'ACCEPTED_1')";
    if($query)
    {
        $result = mysqli_query($link,$query);
        if(!$result)
            echo "<div class='alert alert-danger'>No data available!<br>".mysqli_error($link)."</div>";
    }
}
?>


<main style="margin-top: 30px;">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="text-right mb-3">
                    <form method="post">
                        <div class="input-group">
                            <input type="text" placeholder="Search Defect ID" class="form-control" name="search">
                            <div class="input-group-append">
                                <input class="btn btn-outline-dark" type="hidden">
                                <a class="btn btn-outline-dark" href="con_notification.php"><i class="fas fa-redo"></i></a>
                                <button class="btn btn-outline-dark" name="search_btn" type="submit"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th> Defect ID </th>
                                <th> Defect Name </th>
                                <th> Part Name  </th>
                                <th> Description </th>
                                <th> Found By </th>
                                <th> Due Date </th>
                                <th> Evidence </th>
                                <th> Status </th>
                                <th> Solution </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $file_name=$row['evd_file'];
    $file_name="../assets/evidences/".$file_name;
echo '<tr>
<td>'.$row['id'].'</td>
<td>'.$row['defect_name'].'</td>
<td>'.$row['part_name'].'</td>
<td>'.$row['description'].'</td>
<td>'.get_name($link,'quality_control',$row['found_by']).'</td>
<td>'.$row['due_date'].'</td>

<td>';?>
<button class="btn btn-outline-info" onclick="window.open('<?php echo $file_name?>')">Open</button> <?php echo'</td>
<td>'.$row['defect_status'].'</td>
<td> ';
    if($row['defect_status']=="ACCEPTED_1"){
       echo '<form action="problem_solution.php" method="post">
       <input type="hidden" name="id" value="'.$row['id'].'">
       <input type="hidden" name="defect_name" value="'.$row['defect_name'].'">
       <input type="hidden" name="part_name" value="'.$row['part_name'].'">
       <input type="hidden" name="description" value="'.$row['description'].'">
       <button type="submit" name="problem_solving_btn" class="btn btn-outline-danger">Problem Solving</button>
       </form>';
    }
    else{
        echo'
        <form action="solution.php" method="post">
        <input type="hidden" name="id" value="'.$row['id'].'">
        <input type="hidden" name="defect_name" value="'.$row['defect_name'].'">
        <input type="hidden" name="part_name" value="'.$row['part_name'].'">
        <input type="hidden" name="description" value="'.$row['description'].'">
        <button type="submit" name="write_btn" class="btn btn-outline-info">Containment</button>
        </form>';
    }
    echo'
</td> 
</tr>';

    
}

?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</div>

<?php
include('../include/con_dept/footer.php');
?>