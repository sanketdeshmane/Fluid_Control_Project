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
                            <td>Solution</td>
                            <td><?php echo $solution?></td>
                        </tr>
                        <tr>
                            <td>Correction</td>
                            <td><?php echo $correction?></td>
                        </tr>
                        <tr>
                            <td>Attachment</td>
                            <td><button class="btn btn-outline-info"onclick="window.open('<?php echo $file_name?>')">Open</button></td>
                        </tr>
                        <tr>
                            <td>Why the defect <br>appear?</td>
                            <td><?php echo $why_appear?></td>
                        </tr>
                        <tr>
                            <td>Why the defect <br>was not detected?</td>
                            <td><?php echo $why_not_detected?></td>
                        </tr>
                        <tr>
                            <td>Occurancy Proposed <br>Action Plan</td>
                            <td><?php echo $occurancy_plan?></td>
                        </tr>
                        <tr>
                            <td>Non detection Proposed<br> Action Plan </td>
                            <td><?php echo $Non_detection_plan?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="ml-auto mb-3 mr-4">
                <form action="problem_solution.php" method="post">
                    <input type="hidden" name="id" value=<?php echo $id?>>
                    <input type="hidden" name="defect_name" value=<?php echo $defect_name?>>
                    <input type="hidden" name="part_name" value=<?php echo $part_name?>>
                    <input type="hidden" name="description" value=<?php echo $description?>>
                    <input type="hidden" name="why_appear" value=<?php echo $why_appear?>>
                    <input type="hidden" name="why_not_detected" value=<?php echo $why_not_detected?>>
                    <input type="hidden" name="occurancy_plan" value=<?php echo $occurancy_plan?>>
                    <input type="hidden" name="Non_detection_plan" value=<?php echo $Non_detection_plan?>>
                    <button type="submit" name="write_prob_btn" class="btn btn-outline-info">Write Again</button>
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