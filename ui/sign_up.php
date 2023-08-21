<?php
session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/codeGen.php');
require_once('../app/helpers/auth.php');
require_once('../app/partials/head.php');
?>

<body class="hold-transition login-page" style="background-image: url('../assets/app_data/bg_1.jpg'); background-size: cover;">
    <div class="col-6">
        <!-- /.login-logo -->
        <?php
        $user = mysqli_real_escape_string($mysqli, $_GET['user']);
        if ($user == 'PetAdopter') {
        ?>
            <div class="card border border-primary">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign Up As Pet Adopter</p>
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Full Names</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" required type="text" name="adopter_full_name">
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
                                    <input class="form-control" required type="text" name="adoper_contacts">
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
                                    <input class="form-control" required type="text" name="adopter_email">
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
                                    <input class="form-control" required type="text" name="adopter_location">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="text-primary fas fa-map-marker-alt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Login Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" required type="password" name="new_password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="text-primary fas fa-user-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" required type="password" name="confirm_password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="text-primary fas fa-user-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-auto">
                            </div>
                            <div class="col-auto"><a class="fs--1" href="../">Already Has Account?</a></div>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-outline-primary mt-3 " type="submit" name="Register_PetAdopter" name="submit">
                                <i class="fas fa-user-plus"></i> Sign Up
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        <?php
        } else { ?>
            <div class="card border border-primary">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign Up As Pet Owner</p>
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label>Full Names</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" required type="text" name="pet_owner_full_name">
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
                                    <input class="form-control" required type="text" name="pet_owner_contacts">
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
                                    <input class="form-control" required type="text" name="pet_owner_email">
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
                                    <input class="form-control" required type="text" name="pet_owner_address">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="text-primary fas fa-map-marker-alt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Login Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" required type="password" name="new_password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="text-primary fas fa-user-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" required type="password" name="confirm_password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="text-primary fas fa-user-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-auto">
                            </div>
                            <div class="col-auto"><a class="fs--1" href="../">Already Has Account?</a></div>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-outline-primary mt-3" type="submit" name="Register_PetOwner" name="submit">
                                <i class="fas fa-user-plus"></i> Sign Up
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        <?php } ?>
    </div>
    <!-- /.login-box -->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>