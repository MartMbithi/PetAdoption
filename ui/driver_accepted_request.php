<?php
/*
 *   Crafted On Tue Jul 19 2022
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
require_once('../app/helpers/bookings.php');
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
    $ret = "SELECT * FROM accepted_requests ar
    INNER JOIN request r ON r.request_id = ar.accepted_request_request_id
    INNER JOIN driver d ON d.driver_id = ar.accepted_request_driver_id 
    INNER JOIN car c ON c.car_id  = r.request_car_id
    INNER JOIN driving_classes dc ON dc.driving_class_id = d.driver_driving_class_id
    INNER JOIN customer cus ON cus.customer_id = c.car_customer_id
    WHERE ar.accepted_request_id = '{$view}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($req = $res->fetch_object()) {
    ?>
        <section class="content profile-page">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-7">
                            <h2>Accepted Request <?php echo $req->request_ref; ?> Details</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="driver_dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="driver_accepted_requests">Accepted Requests</a></li>
                                <li class="breadcrumb-item active"><?php echo $req->request_ref; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="boxs-simple">
                            <div class="profile-header" style="background: transparent url('../assets/upload/profile-bg.jpg') repeat scroll center center/cover;">
                                <div class="profile_info">
                                    <div class="img-fluid">
                                        <img class="rounded rounded-lg" src="../assets/upload/car/<?php echo $req->car_image; ?>" width="70%" alt="">
                                    </div>
                                    <hr>
                                </div>
                                <table class="table table-bordered table-striped table-hover text-left">
                                    <thead>
                                        <tr>
                                            <th>Vehicle Details</th>
                                            <th>Owner Details</th>
                                            <th>Request Details</th>
                                            <th>Accepted Driver Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <b>Reg No : </b> <?php echo $req->car_reg_no; ?><br>
                                                <b>Model : </b> <?php echo $req->car_model; ?><br>
                                                <b>Color : </b> <?php echo $req->car_color; ?> <br>
                                                <b>Type : </b> <?php echo $req->car_type; ?>
                                            </td>
                                            <td>
                                                <b> Names : </b><?php echo $req->customer_first_name . ' ' . $req->customer_other_names; ?><br>
                                                <b>Email : </b> <?php echo $req->customer_email; ?><br>
                                                <b> Contacts : </b> <?php echo $req->customer_mobile_no; ?>
                                            </td>
                                            <td>
                                                <b> Departure Location : </b><?php echo $req->request_source_coodinates; ?><br>
                                                <b> Destination Location : </b> <?php echo $req->request_destination_coodinates; ?><br>
                                                <b> Date : </b> <?php echo date('d M Y g:ia', strtotime($req->request_date . $req->request_time)); ?> <br>
                                                <b> Budget : </b> Ksh <?php echo number_format($req->request_total_amount, 2); ?> <br>
                                                <b> Request Status : </b> <?php if ($req->request_status == 'Accepted') { ?>
                                                    <span class="text-success">Accepted</span>
                                                <?php } else { ?>
                                                    <span class="text-danger">Pending</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <b>Name: </b> <?php echo $req->driver_first_name . ' ' . $req->driver_other_names; ?> <br>
                                                <b>Contacts: </b><?php echo $req->driver_mobile_no; ?> <br>
                                                <b>Licensed Driving Class: </b> <?php echo $req->driving_class_name; ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
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
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile_settings">Update Accepted Request</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#delete_account">Cancel Request</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="profile_settings">
                                        <div class="wrap-reset">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row clearfix">
                                                        <div class="col-sm-12" style="display: none;">
                                                            <div class="form-group">
                                                                <label>Driver Details</label>
                                                                <div class="form-line">
                                                                    <select class="form-control show-tick" name="accepted_request_driver_id">
                                                                        <option value="<?php echo $req->driver_id; ?>">
                                                                            <?php echo $req->driver_first_name . ' ' . $req->driver_other_names; ?>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Location</label>
                                                                <div class="form-line">
                                                                    <input type="hidden" value="<?php echo $req->accepted_request_id; ?>" name="accepted_request_id" required class="form-control" />
                                                                    <input type="text" value="<?php echo $req->accepted_request_coodinates; ?>" name="accepted_request_coodinates" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Date</label>
                                                                <div class="form-line">
                                                                    <input type="date" value="<?php echo $req->accepted_request_date; ?>" name="accepted_request_date" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Time</label>
                                                                <div class="form-line">
                                                                    <input type="time" value="<?php echo $req->accepted_request_time; ?>" name="accepted_request_time" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="Update_Accepted_Request" class="btn btn-link waves-effect">UPDATE REQUEST</button>
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
                                                        Heads Up!, you are about to cancel this accepted request.
                                                        This action is reversible, the system will permanently cancel this acceptance request records and any other related records too.
                                                    </h2>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete_modal">CANCEL</button>
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
                            <h4>Cancel?</h4>
                            <br>
                            <p>Heads Up, You are about to cancel this accepted booking record. This action is irrevisble.</p>
                            <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                            <input type="hidden" name="accepted_request_id" value="<?php echo $req->accepted_request_id; ?>">
                            <input type="hidden" name="accepted_request_request_id" value="<?php echo $req->accepted_request_request_id; ?>">
                            <input type='submit' name="Cancel_Accepted_Request" class="text-center btn btn-danger" value="Yes, Cancel" />
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