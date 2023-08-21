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
                <p class="login-box-msg">Sign In To Start Your Session</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" required name="login_email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="text-primary fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" required name="login_password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="text-primary fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a href="reset_password">Forgot Password</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="Login" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in"></i> Sign In
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <hr>
                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="sign_up?user=PetOwner" class="btn btn-block btn-outline-primary">
                        <i class="fas fa-user"></i> Sign Up As Pet Owner
                    </a>
                    <a href="sign_up?user=PetAdopter" class="btn btn-block btn-outline-danger">
                        <i class="fas fa-user-md"></i> Sign Up As Adopter
                    </a>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>