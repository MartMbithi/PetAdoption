<?php
/*
 *   Crafted On Sun Jul 17 2022
 *
 * 
 *   https://bit.ly/MartMbithi
 *   martdevelopers254@gmail.com
 *
 *
 *   The MartDevelopers End User License Agreement
 *   Copyright (c) 2022 MartDevelopers
 *
 *
 *   1. GRANT OF LICENSE 
 *   MartDevelopers hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 *   install and activate this system on two separated computers solely for your personal and non-commercial use,
 *   unless you have purchased a commercial license from MartDevelopers. Sharing this Software with other individuals, 
 *   or allowing other individuals to view the contents of this Software, is in violation of this license.
 *   You may not make the Software available on a network, or in any way provide the Software to multiple users
 *   unless you have first purchased at least a multi-user license from MartDevelopers.
 *
 *   2. COPYRIGHT 
 *   The Software is owned by MartDevelopers and protected by copyright law and international copyright treaties. 
 *   You may not remove or conceal any proprietary notices, labels or marks from the Software.
 *
 *
 *   3. RESTRICTIONS ON USE
 *   You may not, and you may not permit others to
 *   (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
 *   (b) modify, distribute, or create derivative works of the Software;
 *   (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or 
 *   otherwise exploit the Software. 
 *
 *
 *   4. TERM
 *   This License is effective until terminated. 
 *   You may terminate it at any time by destroying the Software, together with all copies thereof.
 *   This License will also terminate if you fail to comply with any term or condition of this Agreement.
 *   Upon such termination, you agree to destroy the Software, together with all copies thereof.
 *
 *
 *   5. NO OTHER WARRANTIES. 
 *   MARTDEVELOPERS  DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 *   MARTDEVELOPERS SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
 *   EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, 
 *   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS. 
 *   SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
 *   ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF 
 *   INCIDENTAL OR CONSEQUENTIAL DAMAGES,
 *   SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. 
 *   THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO 
 *   HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
 *
 *
 *   6. SEVERABILITY
 *   In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
 *   affect the validity of the remaining portions of this license.
 *
 *
 *   7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL MARTDEVELOPERS OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 *   CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 *   USE OF THE SOFTWARE, EVEN IF MARTDEVELOPERS HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 *   IN NO EVENT WILL MARTDEVELOPERS  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 *   TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 *
 */
session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/checklogin.php');
require_once('../app/settings/codeGen.php');
check_login();
require_once('../app/helpers/users.php');
require_once('../app/partials/head.php');

?>

<body class="theme-red">
    <?php require_once('../app/partials/preloader.php'); ?>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Top Navigation Bar -->
    <?php require_once('../app/partials/header.php'); ?>
    <!-- Left Sidebar -->
    <?php require_once('../app/partials/sidebar.php');
    /* Load Customer Details */
    $ret = "SELECT * FROM driver d
    INNER JOIN driving_classes dc ON dc.driving_class_id = d.driver_driving_class_id
    WHERE driver_id = '{$driver_id}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($driver = $res->fetch_object()) {
    ?>
        <section class="content profile-page">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-7">
                            <h2><?php echo $driver->driver_first_name . ' ' . $driver->driver_other_names; ?> Profile</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="driver_dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="boxs-simple">
                            <div class="profile-header" style="background: transparent url('../assets/upload/profile-bg.jpg') repeat scroll center center/cover;">
                                <div class="profile_info">
                                    <div class="profile-image"> <img src="../assets/upload/driver/<?php echo $driver->driver_image; ?>" alt=""> </div>
                                    <h4 class="mb-0"><strong><?php echo $driver->driver_first_name . ' ' . $driver->driver_other_names; ?></strong></h4>
                                    <span class="">Email: <?php echo $driver->driver_email; ?></span><br>
                                    <span class="">Contacts: <?php echo $driver->driver_mobile_no; ?></span><br>
                                    <strong>Licensed Driving Category: <br>
                                        <?php echo $driver->driving_class_name; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-1">
                        <div class="card">
                            <div class="body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile_settings">Profile Settings</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile_picture">Profile Picture</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#change_password">Authentication Settings</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="profile_settings">
                                        <div class="wrap-reset">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row clearfix">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <div class="form-line">
                                                                    <input type="hidden" value="<?php echo $driver->driver_id; ?>" name="driver_id" required class="form-control" />
                                                                    <input type="text" value="<?php echo $driver->driver_first_name; ?>" name="driver_first_name" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <div class="form-line">
                                                                    <input type="text" value="<?php echo $driver->driver_other_names; ?>" name="driver_other_names" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Phone Number</label>
                                                                <div class="form-line">
                                                                    <input type="text" value="<?php echo $driver->driver_mobile_no; ?>" name="driver_mobile_no" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <div class="form-line">
                                                                    <input type="text" value="<?php echo $driver->driver_email; ?>" name="driver_email" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Vehicle Class Specialized</label>
                                                                <div class="form-line">
                                                                    <select class="form-control show-tick" name="driver_driving_class_id">
                                                                        <option value="<?php echo $driver->driving_class_id; ?>"><?php echo $driver->driving_class_name; ?></option>
                                                                        <?php
                                                                        $class_ret = "SELECT * FROM driving_classes";
                                                                        $class_stmt = $mysqli->prepare($class_ret);
                                                                        $class_stmt->execute(); //ok
                                                                        $class_res = $class_stmt->get_result();
                                                                        while ($class = $class_res->fetch_object()) {
                                                                        ?>
                                                                            <option value="<?php echo $class->driving_class_id; ?>"><?php echo $class->driving_class_name; ?></option>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="Update_Driver" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="profile_picture">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Passport Sized Image</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="hidden" value="<?php echo $driver->driver_id; ?>" name="driver_id" required class="form-control" />
                                                                    <input type="file" required name="driver_image" accept=".png, .jpeg, .jpg" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="Update_Driver_Passport" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="change_password">
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <div class="form-line">
                                                                <input type="hidden" name="login_id" value="<?php echo $driver->driver_login_id; ?>" required class="form-control" />
                                                                <input type="password" name="new_password" required class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Confirm New Password</label>
                                                            <div class="form-line">
                                                                <input type="password" name="confirm_password" required class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="Update_Driver_Password" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    require_once('../app/partials/footer.php');
    require_once('../app/partials/scripts.php');
    ?>
</body>

</html>