<?php
include('server.php');
$emp_name = getName($link);
include('../include/con_dept/header.php');
include('../include/con_dept/navbar.php');

$result = getUserData($link,'con_dept');
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
                            <tr>
                                <th> Defect ID </th>
                                <th> Defect Name </th>
                                <th> Part Name  </th>
                                <th> Description </th>
                                <th> Found By </th>
                                <th> Found On </th>
                                <th> Due Date </th>
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
<td>'.$row['due_date'].'</td>
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