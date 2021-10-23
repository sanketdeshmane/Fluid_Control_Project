<?php
include('server.php');
$emp_name = getName($link);
include('../include/con_dept/header.php');
include('../include/con_dept/navbar.php');

$result = getUserNotification($link,'con_dept');

?>

<main>
    <div class="container-fluid pt-4">
        <div class="row mb-2">
            <div class="col-xl-3 col-md-6 mb-3 mt-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">Total Defects
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="table.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xl-3 col-md-6 mb-3 mt-2">
                <div class="card bg-success text-white">
                    <div class="card-body">Pending Defects
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="table.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> -->
            <div class="col-xl-3 col-md-6 mb-3 mt-2">
                <div class="card bg-secondary text-white">
                    <div class="card-body">Total Analysis 
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3 mt-2">
                <div class="card bg-danger text-white">
                    <div class="card-body">Notifications
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="con_notification.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<main style="margin-top: 30px;">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> Defect ID </th>
                                <th> Defect Name </th>
                                <th> Part Name  </th>
                                <th> Description </th>
                                <th> Found By </th>
                                <th> Found On </th>
                                <th> Assigned to </th>
                                <th> Due Date </th>
                                <th> Solution </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo '<tr>
<td>'.$row['id'].'</td>
<td>'.$row['defect_name'].'</td>
<td>'.$row['part_name'].'</td>
<td>'.$row['description'].'</td>
<td>'.$row['found_by'].'</td>
<td>'.$row['found_on'].'</td>
<td>'.$row['assigned_to'].'</td>
<td>'.$row['due_date'].'</td>
<td>
    <form action="solution.php" method="post">
        <input type="hidden" name="id" value="'.$row['id'].'">
        <input type="hidden" name="defect_name" value="'.$row['defect_name'].'">
        <input type="hidden" name="part_name" value="'.$row['part_name'].'">
        <input type="hidden" name="description" value="'.$row['description'].'">
        <button type="submit" name="write_btn" class="btn btn-outline-info">Write</button>
    </form>
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
