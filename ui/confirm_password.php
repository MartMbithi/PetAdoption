<?php
session_start();
require_once('../app/settings/config.php');
require_once('../app/helpers/auth.php');
require_once('../app/partials/head.php');
?>


<body class="hold-transition login-page" style="background-image: url('../assets/app_data/bg_1.jpg'); background-size: cover;">
    <div class="login-box">
        <div class="login-logo">
            <h2 href="" class="text-light"><b>Pet Adoption System</b></h2>
        </div>
        <!-- /.login-logo -->
        <div class="card border border-primary">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Enter Your New Password And Confirm It</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" required name="new_password" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-primary"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" required name="confirm_password" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-primary"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" name="Confirm_Password" class="btn btn-outline-primary btn-block">
                                <i class="fas fa-lock-alt"></i> Reset
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>