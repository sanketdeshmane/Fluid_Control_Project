<?php
include('server.php');
$emp_name = getName($link);
include('../include/con_dept/header.php');
include('../include/con_dept/navbar.php');
?>

<main style="margin-top: 30px;">
    <div class="container-fluid">
        <div class="card shadow ">
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>Defect Id</td>
                            <td><?php echo $id?></td>
                        </tr>
                        <tr>
                            <td>Defect Name</td>
                            <td><?php echo $defect_name?></td>
                        </tr>
                        <tr>
                            <td>Part Name</td>
                            <td><?php echo $part_name?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><?php echo $description?></td>
                        </tr>
                        <tr>
                            <td>Previous Solution</td>
                            <td><?php echo $solution?></td>
                        </tr>
                        <tr>
                            <td>Previous Attachment</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="ml-auto mb-3 mr-4">
                <form action="solution.php" method="post">
                    <input type="hidden" name="id" value=<?php echo $id?>>
                    <input type="hidden" name="defect_name" value=<?php echo $defect_name?>>
                    <input type="hidden" name="part_name" value=<?php echo $part_name?>>
                    <input type="hidden" name="description" value=<?php echo $description?>>
                    <button type="submit" name="write_btn" class="btn btn-outline-info">Write Again</button>
                </form>
            </div>
          
        </div>
    </div>
</main>
</div>
</div>
<?php
include('../include/con_dept/footer.php');
?>