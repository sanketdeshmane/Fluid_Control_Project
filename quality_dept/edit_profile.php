<?php
include('server.php');
$emp_name = getName($link);
include('../include/quality/header.php');
include('../include/quality/navbar.php');

?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0" style="margin: 5px 20px">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-3">
                                    <div class="pl-5 pr-5 pb-2 pt-2">
                                        <div class="text-center mt-3"><h4>Reset Password</h4></div>
                                            <form action="../server.php" method="POST">
                                                <?php include('../errors.php')?>
                                                <div class="p-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email address</label>
                                                        <input type="email" class="form-control" name="email" required/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">New Password</label>
                                                        <input type="password" class="form-control" name="password1" required/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Re-Enter Password</label>
                                                        <input type="password" class="form-control" name="password2" required/>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label>Choose Role</label>
                                                        <select class="form-control" name="option" required placeholder='Choose Role'>
                                                            <option  disabled>Choose Role</option>
                                                            <option>Quality Control Department</option>
                                                            <option>Concerned Department</option>
                                                        </select>
                                                    </div>
                                                    <div class="justify-content-center align-items-center">
                                                        <button type="submit" name="reset_btn" class="btn btn-outline-primary">Reset</button>
                                                    </div> 
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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