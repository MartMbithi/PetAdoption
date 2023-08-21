<?php

session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/codeGen.php');
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
        <?php require_once('../app/partials/aside.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Administrators</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Administrators</li>
                            </ol>
                        </div><!-- /.col -->
                        <hr>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
                <div class="card-header p-2">
                    <h3 class="text-right">
                        <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus"></i> Register New Administrator
                        </button>
                        <a href="reports_export?type=PDF&report=admins" class="btn btn-outline-primary">
                            <i class="fas fa-file-pdf"></i> Export To PDF
                        </a>
                        <a href="reports_export?type=excel&report=admins" class="btn btn-outline-primary">
                            <i class="fas fa-file-spreadsheet"></i> Export To Excel
                        </a>
                    </h3>
                </div><!-- /.card-header -->
            </div>
            <!-- /.content-header -->

            <div class="modal fade" id="add_modal">
                <div class="modal-dialog modal-dialog-centered  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Register New Administrator - Fill All Required Fields </h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Login Email</label>
                                        <div class="input-group mb-3">
                                            <input type="email" name="login_email" required class="form-control">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="text-primary fas fa-envelope"></span>
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
                                    <button name="Add_Administrator" class="btn btn-outline-primary" type="submit">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered text-truncate" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Email</th>
                                                        <th>Access Level</th>
                                                        <th>Manage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $ret = "SELECT * FROM login 
                                                    WHERE login_rank = 'Administrator'";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($admins = $res->fetch_object()) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $admins->login_email; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $admins->login_rank; ?>
                                                            </td>
                                                            <td>
                                                                <a data-toggle="modal" href="#update_<?php echo $admins->login_id; ?>" class="badge  badge-pill badge-warning"><em class="fas fa-user-edit"></em> Edit</a>
                                                                <a data-toggle="modal" href="#delete_<?php echo $admins->login_id; ?>" class="badge  badge-pill badge-danger"><em class="fas fa-trash"></em> Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        /* Manage Admin Modals */
                                                        include('../app/modals/administrators.php');
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>

                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php require_once('../app/partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>