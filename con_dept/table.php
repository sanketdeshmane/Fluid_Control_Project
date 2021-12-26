<?php
include('server.php');
$emp_name = getName($link);
include('../include/con_dept/header.php');
include('../include/con_dept/navbar.php');

//table rendering

$filter = $_GET['data1'];
$email=$_SESSION['email'];
$query="";
$id = "SELECT * from con_dept  where email = '$email' ";
$result = mysqli_query($link,$id);
$user = mysqli_fetch_assoc($result);
if($user){
    if($user['email']===$email){
        $id=$user['id'];
    }
}
switch($filter) {
    case 'tot_defects':
        $query = "SELECT * FROM defects";
        break;
    case 'expired':
        $query = "SELECT * FROM defects WHERE assigned_to= '$id' and 
                (defect_status='ASSIGNED' or defect_status='ACCEPTED_1' OR defect_status='REJECTED' OR defect_status='DISAPPROVED') 
                and due_date <CURDATE()";
        break;
}
if($query){
    $result = mysqli_query($link,$query);
}

if(isset($_POST['search_btn'])) {
    $defect_id = mysqli_real_escape_string($link,$_POST['search']);
    switch($filter) {
        case 'tot_defects':
            $query = "SELECT * FROM defects WHERE id='$defect_id' ";
            break;
        case 'expired':
            $query = "SELECT * FROM defects WHERE assigned_to= '$id' and id='$defect_id' and 
                (defect_status='ASSIGNED' or defect_status='ACCEPTED_1' OR defect_status='REJECTED' OR defect_status='DISAPPROVED') 
                and due_date <CURDATE()";
            break;
        default:
            $query = false;
            $php_errormsg = '404 - PAGE NOT FOUND!';
    }
    if($query)
    {
        $result = mysqli_query($link,$query);
        if(!$result)
            echo "<div class='alert alert-danger'>No data available!<br>".mysqli_error($link)."</div>";
    }
    elseif ($php_errormsg)
        {
            $result = false;
            echo "<div class='alert alert-danger'>".$php_errormsg."</div>";
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
                                <?php
                            if(isset($result) && strcmp($filter,'tot_defects') ===0) { echo'
                                <a class="btn btn-outline-dark" href="table.php?data1=tot_defects"><i class="fas fa-redo"></i></a>
                                <button class="btn btn-outline-dark" name="search_btn" type="submit"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>';
                            
                                echo'
                                <tr>
                                <th> Defect ID </th>
                                <th> Defect Name </th>
                                <th> Part Name  </th>
                                <th> Description </th>
                                <th> Found By </th>
                                <th> Found On </th>
                                <th> Due Date </th>
                                <th> Status </th>
                            </tr>';
                            }
                            else if(isset($result) && strcmp($filter,'expired') ===0){
                                echo'
                                <a class="btn btn-outline-dark" href="table.php?data1=expired"><i class="fas fa-redo"></i></a>
                                <button class="btn btn-outline-dark" name="search_btn" type="submit"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>';
                                echo'
                                <tr>
                                <th> Defect ID </th>
                                <th> Defect Name </th>
                                <th> Part Name  </th>
                                <th> Description </th>
                                <th> Found By </th>
                                <th> Found On </th>
                                <th> Due Date </th>
                                <th> Status </th>
                            </tr>';
                            }
                            ?>
                        </thead>
                        <tbody>
                        <?php
if(isset($result) && strcmp($filter,'tot_defects') ===0)
{
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

    echo '<tr>
    <td>'.$row['id'].'</td>
    <td>'.$row['defect_name'].'</td>
    <td>'.$row['part_name'].'</td>
    <td>'.$row['description'].'</td>
    <td>'.get_name($link,'quality_control',$row['found_by']).'</td>
    <td>'.$row['found_on'].'</td>
    <td>'.$row['due_date'].'</td>
    <td>'.$row['defect_status'].'</td>

    </tr>';

    }
}
else if(isset($result) && strcmp($filter,'expired') ===0){
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

        echo '<tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['defect_name'].'</td>
        <td>'.$row['part_name'].'</td>
        <td>'.$row['description'].'</td>
        <td>'.get_name($link,'quality_control',$row['found_by']).'</td>
        <td>'.$row['found_on'].'</td>
        <td>'.$row['due_date'].'</td>
        <td>'.$row['defect_status'].'</td>
    
        </tr>';
    }
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

<!-- // <td>
//     <form action="solution.php" method="post">
//         <input type="hidden" name="id" value="'.$row['id'].'">
//         <input type="hidden" name="defect_name" value="'.$row['defect_name'].'">
//         <input type="hidden" name="part_name" value="'.$row['part_name'].'">
//         <input type="hidden" name="description" value="'.$row['description'].'">
//         <button type="submit" name="write_btn" class="btn btn-outline-info">Write</button>
//     </form>
// </td> -->