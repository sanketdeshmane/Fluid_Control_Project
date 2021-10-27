<?php
include('server.php');
$emp_name = getName($link);
include('../include/con_dept/header.php');
include('../include/con_dept/navbar.php');
?>

<main style="margin-top: 30px;">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="text-center mt-3"><h4>Analysis</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
                        </div>
                        <div class="col-lg-6">

                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include('../include/con_dept/footer.php');
?>