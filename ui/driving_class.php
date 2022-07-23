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
require_once('../app/helpers/driving_classes.php');
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
    $view = mysqli_real_escape_string($mysqli, $_GET['view']);
    $ret = "SELECT * FROM driving_classes WHERE driving_class_id = '{$view}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($class = $res->fetch_object()) {
    ?>
        <section class="content profile-page">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-7">
                            <h2><?php echo $class->driving_class_name; ?></h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Drivers</a></li>
                                <li class="breadcrumb-item"><a href="driving_classes">Classes</a></li>
                                <li class="breadcrumb-item active"><?php echo $class->driving_class_name; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="boxs-simple">
                            <div class="profile-header" style="background: transparent url('../assets/upload/profile-bg.jpg') repeat scroll center center/cover;">
                                <div class="profile_info">
                                    <div class="profile-image"> <img src="../assets/upload/vehicles.png" alt=""> </div>
                                    <h4 class="mb-0"><strong><?php echo $class->driving_class_name; ?></strong></h4><br>
                                    <span class=""><strong><u>Driving Class Details</u></strong>
                                        <br>
                                        <?php echo $class->driving_class_desc; ?></span>
                                    <br>
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
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile_settings">Update Driving Class</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#delete_account">Delete Driving Class</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="profile_settings">
                                        <div class="wrap-reset">
                                            <form method="post">
                                                <div class="modal-body">
                                                    <div class="row clearfix">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Class Name</label>
                                                                <div class="form-line">
                                                                    <input type="hidden" name="driving_class_id" value="<?php echo $class->driving_class_id; ?>" required class="form-control" />
                                                                    <input type="text" name="driving_class_name" value="<?php echo $class->driving_class_name; ?>" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Class Details</label>
                                                                <textarea rows="10" id="editor" type="text" name="driving_class_desc" required class="form-control"><?php echo $class->driving_class_desc; ?></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="Update_Class" class="btn btn-link waves-effect">UPDATE DRIVING CLASS</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="delete_account">
                                        <div class="row clearfix">
                                            <div class="modal-body">
                                                <div class="row clearfix">
                                                    <br>
                                                    <h2 class="card-inside-title  text-danger text-center">
                                                        Heads Up!, you are about to delete <b><?php echo $class->driving_class_name; ?></b> details.
                                                        This action is reversible, the system will permanently delete <b><?php echo $class->driving_class_name; ?></b>
                                                        records and any other related records too.
                                                    </h2>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete_modal">DELETE DRIVING CLASS</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Delete Account Modal -->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body text-center text-danger">
                            <h4>Delete <?php echo $class->driving_class_name; ?> ?</h4>
                            <br>
                            <p>Heads Up, You are about to delete <?php echo $class->driving_class_name; ?>. This action is irrevisble.</p>
                            <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                            <input type="hidden" name="driving_class_id" value="<?php echo $class->driving_class_id; ?>">
                            <input type='submit' name="Delete_Class" class="text-center btn btn-danger" value="Yes, Delete" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Scripts -->
    <?php
    }
    require_once('../app/partials/footer.php');
    require_once('../app/partials/scripts.php');
    ?>
</body>

</html>