<?php
include('server.php');
$emp_name = getName($link);
include('../include/quality/header.php');
include('../include/quality/navbar.php');
//table rendering

$filter = $_GET['data'];
$email=$_SESSION['email'];
$id = "SELECT * from quality_control  where email = '$email' ";
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
    case 'pending_defects':
        $query = "SELECT * FROM defects WHERE found_by= '$id' and sol_status='1' and defect_status='REJECTED_1'and rejected_count='1'";
        break;
}
if($query)
{
    $result = mysqli_query($link,$query);
}

?>

<main style="margin-top: 30px;">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="text-right mb-3">
                    <form method="post">
                        <div class="input-group">
                            <input type="text" placeholder="Search Defect or Defect ID or Found On Date in format DD-MM-YYYY" class="form-control" name="search" {% if search_query %}value="{{ search_query }}"{% endif %}>
                            <div class="input-group-append">
                                <input class="btn btn-outline-dark" type="hidden">
                                <button class="btn btn-outline-dark" type="submit"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <?php

if(isset($result) && strcmp($filter,'tot_defects') ===0) {
echo '
<tr>
<th> Defect ID </th>
<th> Defect Name </th>
<th> Part Name  </th>
<th> Description </th>
<th> Found By </th>
<th> Found On </th>
<th> Assigned to </th>
<th> Due Date </th>
<th> Status </th>
</tr>
';
} else if(isset($result) && strcmp($filter,'pending_defects') ===0) {
    echo '
    <tr>
    <th> Defect ID </th>
    <th> Defect Name </th>
    <th> Part Name  </th>
    <th> Description </th>
    <th> Assigned to </th>
    <th> Due Date </th>
    <th>Prevoius <br> Solution </th>
    </tr>
    ';
}

?>               
            </thead>
            <?php
    if(isset($result) && strcmp($filter,'tot_defects') ===0)
    {
        while($row = $result -> fetch_assoc())
        {
            
            echo '<tbody>
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['defect_name'].'</td>
                <td>'.$row['part_name'].'</td>
                <td>'.$row['description'].'</td>
                <td>'.$row['found_by'].'</td>
                <td>'.$row['found_on'].'</td>
                <td>'.$row['assigned_to'].'</td>
                <td>'.$row['due_date'].'</td>
                <td>'.$row['defect_status'].'</td>
            </tr>
            </tbody>';
        }
    } else if(isset($result) && strcmp($filter,'pending_defects') ===0) {
        while($row = $result -> fetch_assoc())
        {
            
            echo '<tbody>
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['defect_name'].'</td>
                <td>'.$row['part_name'].'</td>
                <td>'.$row['description'].'</td>
                <td>'.$row['assigned_to'].'</td>
                <td>'.$row['due_date'].'</td>
                <td>
                    <form action="read_solution.php" method="post">
                        <input type="hidden" name="id" value="'.$row['id'].'">
                        <input type="hidden" name="defect_name" value="'.$row['defect_name'].'">
                        <input type="hidden" name="part_name" value="'.$row['part_name'].'">
                        <input type="hidden" name="description" value="'.$row['description'].'">
                        <button type="submit" name="read_btn" class="btn btn-outline-info">Read</button>
                    </form>
                </td>
            </tr>
            </tbody>';
        } 
    }
?>
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
<td>"blank"</td>
</tr>';

}

?>

