
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-light sticky-top" style="padding-left: 0; padding-top: 0; padding-bottom: 0; z-index: 1040;">
        <a class="navbar-brand" href="" style="padding: 0;"><img class="logo" src="../assets/images.png" alt="fluid Control" width="auto" height="56px"></a> <a class="logout-button pl-3" id="sidebarToggle"><i class="fas fa-bars"style="color:black"></i></a>
        <ul class="navbar-nav ml-auto ">
            <li class="nav-item">
                <form action="" method="post">
                    <button class="logout-button" name="logout_btn" href=""><i class="fas fa-power-off fa-2x"></i></button>
                </form>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="profile_info pb-">
                            <i class="fas fa-user-circle fa-3x pb-"style="color:white"></i>
                            <h4 class="profile-info-text pt-2"><?php echo $emp_name?></h4>
                            <h4 class="profile-info-text pb-3" style="font-size: small;">Quality Control Department</h4>
							<small class ="profile-info-text pb-3"><a href="edit_profile.php" class="edit_profile">Edit Profile</a></small>
                        </div><br>
						<a class="pt-3 nav-link" href="quality_index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Dashboard <br>
                        </a>
                        <a class="pt-3 nav-link" href="add_defect.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-bug"></i></div>
                            NC Report <br>
                        </a>
                        <a class="nav-link" href="notification.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                            Notifications
                        </a>
                        <a class="pt-3 nav-link" href="table.php?data=expired">
                            <div class="sb-nav-link-icon"><i class="fas fa-times"></i></div>
                            Expired Containment<br> & Solutions<br>
                        </a>
                        <a class="nav-link" href="analysis.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-file"></i></div>
                            Analysis Report
                        </a>
						<a class="pt-3 nav-link" href="problem_solving.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Problem Solving<br>
                        </a>
                    </div>
                </div>
                <div class="small">
                    <div class="text-muted p-2 pb-2">Copyright &copy; Fluid Control 2021</div>
                </div>
            </nav>
        </div>
        
        <div id="layoutSidenav_content">