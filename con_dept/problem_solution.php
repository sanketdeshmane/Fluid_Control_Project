<?php
include('server.php');
$emp_name = getName($link);
include('../include/con_dept/header.php');
include('../include/con_dept/navbar.php');

?>

<main style="margin-top: 15px;">
    <div class="container-fluid">
        <div class="card shadow ">
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <form action="server.php" method="POST" enctype="multipart/form-data">
                    <tbody>
                        <tr>
                            <td>Defect Id</td>
                            <td><?php echo $id?></td>
                        </tr>
                        <tr>
                            <td>Defect Name</td>
                            <td><?php echo $defect_name?></td>
                        </tr>
                        <!-- <tr>
                            <td>Part Name</td>
                            <td></td>
                        </tr> -->
                        <tr>
                            <td>Description</td>
                            <td><?php echo $description?></td>
                        </tr>
                        <tr>
                            <td>Containment</td>
                            <td><?php echo $solution?></td>
                        </tr>
                        <tr>
                            <td>Attachment</td>
                            <td><button class="btn btn-outline-info"onclick="window.open('<?php echo $file_name?>')">Open</button></td>
                        </tr>
                        <tr>
                            <td>Why the defect <br>appear?</td>
                            <td><textarea class="form-control" name="why_appear" rows="2" cols="50" placeholder="" required></textarea></td>
                        </tr>
                        <tr>
                            <td>Why the defect <br>was not detected?</td>
                            <td><textarea class="form-control" name="why_not_detected" rows="2" cols="50" placeholder=" "required></textarea></td>
                        </tr>
                        <tr>
                            <td>Occurancy Proposed <br>Action Plan</td>
                            <td><textarea class="form-control" name="occurancy_plan" rows="2" cols="50" placeholder=" "required></textarea></td>
                        </tr>
                        <tr>
                            <td>Non detection Proposed<br> Action Plan </td>
                            <td><textarea class="form-control" name="Non_detection_plan" rows="2" cols="50" placeholder=" "required></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ml-auto mb-3 mr-4">
                <input type="hidden" name="id" value=<?php echo $id?>>
                <button name="add_prob_sol" class="btn btn-outline-success">Submit</button>
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