<?php
session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/helpers/users.php');
require_once('../app/partials/head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once('../app/partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once('../app/partials/aside.php');
        $login_id = mysqli_real_escape_string($mysqli, $_SESSION['login_id']);
        $ret = "SELECT * FROM login WHERE login_id = '{$login_id}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($user = $res->fetch_object()) {
        ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Profile</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                    <li class="breadcrumb-item active">User Profile</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="../assets/app_data/no-profile.png" alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username text-center"><?php echo $user->login_email; ?></h3>
                                        <p class="text-muted text-center">Administrator</p>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card card-primary card-outline">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#profile_settings" data-toggle="tab">Profile Settings</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change Password</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="profile_settings">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label>Login Email</label>
                                                            <div class="input-group mb-3">
                                                                <input type="hidden" value="<?php echo $user->login_id; ?>" name="login_id" required class="form-control">
                                                                <input type="email" value="<?php echo $user->login_email; ?>" name="login_email" required class="form-control">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="text-primary fas fa-envelope"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="text-right">
                                                        <button name="Update_Administrator_Profile" class="btn btn-outline-primary" type="submit">
                                                            <i class="fas fa-save"></i> Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="change_password">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label>Old Password</label>
                                                            <div class="input-group mb-3">
                                                                <input type="hidden" value="<?php echo $user->login_id; ?>" name="login_id" required class="form-control">
                                                                <input type="password" name="old_password" required class="form-control">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="text-primary fas fa-lock"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>New Password</label>
                                                            <div class="input-group mb-3">
                                                                <input type="password" name="new_password" required class="form-control">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="text-primary fas fa-lock"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Confirm Password</label>
                                                            <div class="input-group mb-3">
                                                                <input type="password" name="confirm_password" required class="form-control">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="text-primary fas fa-lock"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="text-right">
                                                        <button name="Update_Administrator_Password" class="btn btn-outline-primary" type="submit">
                                                            <i class="fas fa-save"></i> Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        <?php }
        require_once('../app/partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>


</html>