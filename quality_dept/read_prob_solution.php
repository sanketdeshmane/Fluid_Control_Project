<?php
include('server.php');
$emp_name = getName($link);
include('../include/quality/header.php');
include('../include/quality/navbar.php');
?>

<main style="margin-top: 5px;">
    <div class="container-fluid">
        <div class="card shadow ">
            <div class="card-body">
            <form action="server.php" method="post" enctype="multipart/form-data">
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
                            <td><button class="btn btn-outline-info"><a target="_blank" href="<?php echo $file_name;?>">Open</a></button></td>
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
                        <tr>
                            <td>Comment</td>
                            <td><textarea class="form-control" name="cmt" rows="2" cols="50" placeholder="Write Comment"></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ml-auto mb-3 mr-4">
                
                    <input type="hidden" name="id" value=<?php echo $id?>>
                    <input type="hidden" name="assigned_to" value=<?php echo $assigned_to?>>
                    <button name="sol_accept_btn"class="btn btn-outline-success">ACCEPT</button>
                    <button name="sol_reject_btn" class="btn btn-outline-danger">REJECT</button>
                </form>
            </div>
          
        </div>
    </div>
</main>
</div>
</div>
<?php
include('../include/quality/footer.php');
?>