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
    $ret = "SELECT * FROM request r
    INNER JOIN car c ON c.car_id  = r.request_car_id
    INNER JOIN customer cus ON c.car_customer_id  = cus.customer_id
    WHERE r.request_id = '{$view}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($car = $res->fetch_object()) {
    ?>
        <section class="content profile-page">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-7">
                            <h2>Request <?php echo $car->request_ref; ?> Details</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="driver_dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="driver_requests">Bookings</a></li>
                                <li class="breadcrumb-item active"><?php echo $car->request_ref; ?></li>
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
                                        <img class="rounded rounded-lg" src="../assets/upload/car/<?php echo $car->car_image; ?>" width="70%" alt="">
                                    </div>
                                    <hr>
                                </div>
                                <table class="table table-bordered table-striped table-hover text-left">
                                    <thead>
                                        <tr>
                                            <th>Vehicle Details</th>
                                            <th>Owner Details</th>
                                            <th>Request Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <b>Reg No : </b> <?php echo $car->car_reg_no; ?><br>
                                                <b>Model : </b> <?php echo $car->car_model; ?><br>
                                                <b>Color : </b> <?php echo $car->car_color; ?> <br>
                                                <b>Type : </b> <?php echo $car->car_type; ?>
                                            </td>
                                            <td>
                                                <b> Names : </b><?php echo $car->customer_first_name . ' ' . $car->customer_other_names; ?><br>
                                                <b>Email : </b> <?php echo $car->customer_email; ?><br>
                                                <b> Contacts : </b> <?php echo $car->customer_mobile_no; ?>
                                            </td>
                                            <td>
                                                <b> Departure Location : </b><?php echo $car->request_source_coodinates; ?><br>
                                                <b> Destination Location : </b> <?php echo $car->request_destination_coodinates; ?><br>
                                                <b> Date : </b> <?php echo date('d M Y g:ia', strtotime($car->request_date . $car->request_time)); ?> <br>
                                                <b> Budget : </b> Ksh <?php echo number_format($car->request_total_amount, 2); ?> <br>
                                                <b> Request Status : </b> <?php if ($car->request_status == 'Accepted') { ?>
                                                    <span class="text-success">Accepted</span>
                                                <?php } else { ?>
                                                    <span class="text-danger">Pending</span>
                                                <?php } ?>
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
                                <?php if ($car->request_status != 'Accepted') { ?>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#accept_request">Accept Request</a></li>
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
                                                                            <?php
                                                                            $ret = "SELECT * FROM driver WHERE driver_id = '{$driver_id}'";
                                                                            $stmt = $mysqli->prepare($ret);
                                                                            $stmt->execute(); //ok
                                                                            $res = $stmt->get_result();
                                                                            while ($driver = $res->fetch_object()) {
                                                                            ?>
                                                                                <option value="<?php echo $driver->driver_id; ?>">
                                                                                    <?php echo $driver->driver_first_name . ' ' . $driver->driver_other_names; ?>
                                                                                </option>
                                                                            <?php
                                                                            } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Location</label>
                                                                    <div class="form-line">
                                                                        <input type="text" name="accepted_request_coodinates" required class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <div class="form-line">
                                                                        <input type="date" name="accepted_request_date" required class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Time</label>
                                                                    <div class="form-line">
                                                                        <input type="time" name="accepted_request_time" required class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="Accept_Request" class="btn btn-link waves-effect">ACCEPT REQUEST</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                <?php } else { ?>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active text-success" data-toggle="tab" href="#accept_request">Already Accepted This Booking</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane active" id="profile_settings">
                                            <div class="wrap-reset">
                                                <h2 class="card-inside-title  text-success text-center">
                                                    You have already accepted this booking, kindly proceed and contact your client to do a follow up<br>
                                                    on how you will deliver the vehicle.
                                                </h2>
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-primary" href="driver_accepted_requests">VIEW ACCEPTED REQUESTS</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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