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
                <form action="server.php" method="POST" enctype="multipart/form-data">
                <?php include('../errors.php')?>
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
                        <!-- <tr>
                            <td>Evidences</td>
                            <td><button class="btn btn-outline-info" onclick="window.open('')">Open</button></td>
                        </tr> -->
                        <tr>
                            <td>Containment Action</td>
                            <td><textarea class="form-control" name="solution" rows="2" cols="50" placeholder="Write Solution"required ></textarea></td>
                        </tr>
                        <tr>
                            <td>Correction</td>
                            <td><textarea class="form-control" name="correction" rows="2" cols="50" placeholder="Write Correction"required></textarea></td>
                        </tr>
                        <tr>
                            <td>Attachment</td>
                            <td><input type="file"  name="attachment_file" required></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ml-auto mb-3 mr-4">
                <input type="hidden" name="id" value=<?php echo $id?>>
                <button name="add_sol" class="btn btn-outline-success">Submit</button>
                <!-- <button class="btn btn-outline-danger">Save for Later</button> -->
            </div>
            </form>
        </div>
    </div>
</main>
</div>
</div>

<?php
include('../include/con_dept/footer.php');
?>
