<?php
include('server.php');
$emp_name = getName($link);
include('../include/quality/header.php');
include('../include/quality/navbar.php');
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
                            <td>Solution</td>
                            <td><?php echo $solution?></td>
                        </tr>
                        <tr>
                            <td>Attachment</td>
                            <td><button class="btn btn-outline-info"onclick="window.open('<?php echo $file_name?>')">Open</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ml-auto mb-3 mr-4">
                <form action="server.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="id" value=<?php echo $id?>>
                    <input type="hidden" name="assigned_to" value=<?php echo $assigned_to?>>
                    <button name="accept_btn"class="btn btn-outline-success">Approve</button>
                    <button name="reject_btn" class="btn btn-outline-danger">Disapprove</button>
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