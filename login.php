<?php include('server.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <div class="login">
        <div class="container pt-5 mt-5">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card o-hidden border-0 shadow-lg my-3">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pl-5 pr-5 pb-2 pt-2">
                                        <div class="text-center mt-3"><h4>Fluid Control Private Limited</h4></div>
                                        <form action="login.php" method="POST">
                                        <?php include('errors.php')?>
                                            <div class="p-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Email address</label>
                                                    <input type="email" class="form-control" name="email" required/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" required/>
                                                </div>
                                                <div class="mb-4">
                                                    <label>Choose Role</label>
                                                    <select class="form-control" name="option" placeholder='Choose Role' required >
                                                        <option  disabled>Choose Role</option>
                                                        <option>Quality Control Department</option>
                                                        <option>Concerned Department</option>
                                                    </select>
                                                </div>
                                                <div class="justify-content-center align-items-center">
                                                    <button type="submit" name="login" class="btn btn-outline-primary">Login</button>
                                                </div> 
                                                <div class="pt-1 small">
                                                    Don't have an account? <a href="signup.php">Sign up here</a>
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
</body>
</html>