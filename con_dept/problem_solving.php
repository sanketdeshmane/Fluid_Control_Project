<?php
include('server.php');
$emp_name = getName($link);
include('../include/con_dept/header.php');
include('../include/con_dept/navbar.php');

$query = "SELECT * FROM problem_solving" ;
if($query){
    $result = mysqli_query($link,$query);
}
if(isset($_POST['search_btn'])) {
    $defect_id = mysqli_real_escape_string($link,$_POST['search']);
    $query = "SELECT * FROM problem_solving WHERE defect_id='$defect_id'";
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
                                <a class="btn btn-outline-dark" href="problem_solving.php"><i class="fas fa-redo"></i></a>
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
                                <th> Why Defect<br>Appear?</th>
                                <th> Why the defect <br>was not detected?</th>
                                <th> Occurancy Proposed <br>Action Plan</th>
                                <th>Non detection Proposed<br> Action Plan</th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo '<tr>
<td>'.$row['defect_id'].'</td>
<td>'.$row['why_appear'].'</td>
<td>'.$row['why_not_detected'].'</td>
<td>'.$row['occurancy_plan'].'</td>
<td>'.$row['Non_detection_plan'].'</td>
<td>';
if($row['status']==='0'){
    echo 'Working';
}
else{
    echo 'Closed';
}
'</td> 
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