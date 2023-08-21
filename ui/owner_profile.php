<?php
session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/helpers/users.php');
require_once('../app/partials/head.php');
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../app/partials/aside.php');
        $login_id = mysqli_real_escape_string($mysqli, $_SESSION['login_id']);
        $ret = "SELECT * FROM pet_owner WHERE pet_owner_login_id = '{$login_id}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($user = $res->fetch_object()) {
        ?>
            <!-- /.navbar -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"> Profile Settings</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="owner_home">Home</a></li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="../assets/app_data/no-profile.png" alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username text-center"><?php echo $user->pet_owner_full_name; ?></h3>
                                        <p class="text-muted text-center"><?php echo $_SESSION['login_rank']; ?></p>
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
                                                <form method="POST">
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label>Full Names</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" value="<?php echo $user->pet_owner_id; ?>" required type="hidden" name="pet_owner_id">
                                                                <input class="form-control" value="<?php echo $user->pet_owner_full_name; ?>" required type="text" name="pet_owner_full_name">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="text-primary fas fa-user-tag"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Contacts</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" value="<?php echo $user->pet_owner_contacts; ?>" required type="text" name="pet_owner_contacts">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="text-primary fas fa-phone"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <label>Email Address</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" value="<?php echo $user->pet_owner_email; ?>" required type="text" name="pet_owner_email">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="text-primary fas fa-envelope"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label>Address</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" value="<?php echo $user->pet_owner_address; ?>" required type="text" name="pet_owner_address">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <span class="text-primary fas fa-map-marker-alt"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <button class="btn btn-outline-primary mt-3" type="submit" name="Update_Pet_Owner" name="submit">
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
                                                                <input type="hidden" value="<?php echo $_SESSION['login_id']; ?>" name="login_id" required class="form-control">
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
                                                        <button name="Update_Pet_Owner_Password" class="btn btn-outline-primary" type="submit">
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
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        <?php
        }
        require_once('../app/partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>


</html>