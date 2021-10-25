<?php
include('server.php');
$emp_name = getName($link);
include('../include/quality/header.php');
include('../include/quality/navbar.php');

$str = generateEmpList($link,'con_dept');
$str1 = generateEmpList($link,'quality_control');
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0" style="margin: 5px 20px">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 "style="padding-top:5px;padding-bottom:5px;">Add Defect</h1>
                                    </div>
                                    
                                    <form class="user" method="post" enctype="multipart/form-data" action="add_defect.php">
                                    <?php include('../errors.php')?>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Defect Name<span class="asteriskField text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Enter Name of the Defect" name="defect_name" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Part Name<span class="asteriskField text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Enter Part Where it Occured" name="part_name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Found By<span class="asteriskField text-danger">*</span></label>
                                                    <select class="form-control" name="found_by" placeholder='Choose Role' required>
                                                        <?php echo $str1;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Assigned To<span class="asteriskField text-danger">*</span></label>
                                                    <select class="form-control" name="assigned_to" placeholder='Choose Role' required>
                                                        <?php echo $str;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Found on <span class="asteriskField text-danger">*</span></label>
                                                    <input type="date" name="found_on" class="form-control" placeholder="Enter Date" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Due Date<span class="asteriskField text-danger">*</span></label><br>
                                                    <input type="date" name="due_date" placeholder="Enter Due Date" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class=" requiredField">Description<span class="asteriskField text-danger">*</span></label><br>
                                                    <textarea class="form-control" name="description" rows="2" cols="50" placeholder="Enter Description of Defect" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="add_btn" class="mt-1 btn btn-outline-primary btn-block">Add Defect</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
