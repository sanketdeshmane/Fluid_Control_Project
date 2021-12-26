<?php
include('server.php');
$emp_name = getName($link);
include('../include/quality/header.php');
include('../include/quality/navbar.php');

$query = "SELECT * FROM problem_solving" ;
if($query){
    $result = mysqli_query($link,$query);
}

if(isset($_POST['search_btn'])) {
    $defect_id = mysqli_real_escape_string($link,$_POST['search']);
    $query = "SELECT * FROM problem_solving WHERE defect_id='$defect_id' " ;
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
                                <th> Download </th>
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
echo'</td> 
<td>';
$id=$row['defect_id'];
$query = "SELECT * from defects where id = $id";
$res = mysqli_query($link,$query);
while($row1 = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $id=$row1['id'];
    $defect_name=$row1['defect_name'];
    $part_name=$row1['part_name'];
    $description=$row1['description'];
    $found_by=$row1['found_by'];
    $assigned_to=$row1['assigned_to'];
    $found_on=$row1['found_on'];
    $due_date=$row1['due_date'];
};
$query1 = "SELECT * from solution where defect_id = $id";
$res = mysqli_query($link,$query1);
while($row2 = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $containment=$row2['solution'];
    $correction=$row2['correction'];
};
$query2 = "SELECT * from problem_solving where defect_id = $id";
$res = mysqli_query($link,$query2);
while($row3 = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $why_appear=$row3['why_appear'];
    $why_not_detected=$row3['why_not_detected'];
    $occurancy_plan=$row3['occurancy_plan'];
    $Non_detection_plan=$row3['Non_detection_plan'];
};
if($row['status']==='0'){
    // echo $id;
    echo '
    <form action="server.php" method="post" >
        <input type="hidden" name="id" value=" '.$id.' " >
        <input type="hidden" name="defect_name" value="'.$defect_name.'">
        <input type="hidden" name="part_name" value="'.$part_name.'">
        <input type="hidden" name="description" value="'.$description.'">
        <input type="hidden" name="found_by" value="'.$found_by.'">
        <input type="hidden" name="assigned_to" value="'.$assigned_to.'">
        <input type="hidden" name="found_on" value="'.$found_on.'">
        <input type="hidden" name="due_date" value="'.$due_date.'">
        <input type="hidden" name="containment" value="'.$containment.'">
        <input type="hidden" name="correction" value="'.$correction.'">
        <button type="submit" name="download_cont_btn" class="btn btn-outline-info">Download</button>
    </form>
    ';
}
else{
    // echo $id;
    echo '
    <form action="server.php" method="post" >
        <input type="hidden" name="id" value="'.$id.'">
        <input type="hidden" name="defect_name" value="'.$defect_name.'">
        <input type="hidden" name="part_name" value="'.$part_name.'">
        <input type="hidden" name="description" value="'.$description.'">
        <input type="hidden" name="found_by" value="'.$found_by.'">
        <input type="hidden" name="assigned_to" value="'.$assigned_to.'">
        <input type="hidden" name="found_on" value="'.$found_on.'">
        <input type="hidden" name="due_date" value="'.$due_date.'">
        <input type="hidden" name="containment" value="'.$containment.'">
        <input type="hidden" name="correction" value="'.$correction.'">
        <input type="hidden" name="why_appear" value="'.$why_appear.'">
        <input type="hidden" name="why_not_detected" value="'.$why_not_detected.'">
        <input type="hidden" name="occurancy_plan" value="'.$occurancy_plan.'">
        <input type="hidden" name="Non_detection_plan" value="'.$Non_detection_plan.'">
        <button type="submit" name="download_btn" class="btn btn-outline-info">Download</button>
    </form>
    ';
}echo'
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
include('../include/quality/footer.php');
?>