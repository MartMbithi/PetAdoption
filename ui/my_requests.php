<?php
/*
 *   Crafted On Mon Jul 18 2022
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
    <?php require_once('../app/partials/sidebar.php'); ?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-7">
                        <h2>Bookings </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="my_home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Vehicles Requests</li>
                        </ul>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal">Add Booking</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Ref #</th>
                                    <th>Vehicle Details</th>
                                    <th>Departure</th>
                                    <th>Destination</th>
                                    <th>Date</th>
                                    <th>Budget</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = "SELECT * FROM request r
                                INNER JOIN car c ON c.car_id  = r.request_car_id
                                WHERE c.car_customer_id = '{$customer_id}'";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($cars = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td>
                                            <a href="my_request?view=<?php echo $cars->request_id; ?>">
                                                <?php echo $cars->request_ref; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="my_car?view=<?php echo $cars->car_id; ?>">
                                                <?php echo $cars->car_reg_no; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $cars->request_source_coodinates; ?></td>
                                        <td><?php echo $cars->request_destination_coodinates; ?></td>
                                        <td><?php echo date('d M Y g:ia', strtotime($cars->request_date . $cars->request_time)); ?></td>
                                        <td>Ksh <?php echo number_format($cars->request_total_amount, 2); ?></td>
                                        <td>
                                            <?php if ($cars->request_status == 'Accepted') { ?>
                                                <span class="text-success">Accepted</span>
                                            <?php } else { ?>
                                                <span class="text-danger">Pending</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Add Modal -->
    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Add Booking Request</h4>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Vehicle Details</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="request_car_id">
                                            <option>Select Vehicle</option>
                                            <?php
                                            $ret = "SELECT * FROM car WHERE car_customer_id = '{$customer_id}'";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            while ($car = $res->fetch_object()) {
                                            ?>
                                                <option value="<?php echo $car->car_id; ?>">
                                                    <?php echo $car->car_reg_no; ?>
                                                </option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Departure Location</label>
                                    <div class="form-line">
                                        <input type="text" name="request_source_coodinates" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Destination Location</label>
                                    <div class="form-line">
                                        <input type="text" name="request_destination_coodinates" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div class="form-line">
                                        <input type="date" name="request_date" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Time</label>
                                    <div class="form-line">
                                        <input type="time" name="request_time" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Booking Budget (Ksh)</label>
                                    <div class="form-line">
                                        <input type="text" name="request_total_amount" required class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="Add_Request" class="btn btn-link waves-effect">ADD REQUEST</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <?php
    require_once('../app/partials/footer.php');
    require_once('../app/partials/scripts.php');
    ?>
</body>

</html>