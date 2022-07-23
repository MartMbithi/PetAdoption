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
                        <h2>Accepted Driving Requests Ratings </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="driver_dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Ratings</li>
                        </ul>
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
                                    <th>Request Ref</th>
                                    <th>Accepted Request Details</th>
                                    <th>Driver Details</th>
                                    <th>Vehicle Details</th>
                                    <th>Rating Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = "SELECT * FROM rating ra 
                                INNER JOIN  accepted_requests ar ON ar.accepted_request_id  = ra.rating_accepted_requested_id
                                INNER JOIN request r ON r.request_id = ar.accepted_request_request_id
                                INNER JOIN driver d ON d.driver_id = ar.accepted_request_driver_id 
                                INNER JOIN car c ON c.car_id  = r.request_car_id
                                WHERE d.driver_id = '{$driver_id}'";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($rate = $res->fetch_object()) {
                                ?>
                                    <tr>
                                        <td>
                                            <a href="driver_rating?view=<?php echo $rate->rating_id; ?>">
                                                <?php echo $rate->request_ref; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <b>Departure: </b><?php echo $rate->accepted_request_coodinates; ?> <br>
                                            <b>Date: </b><?php echo date('d M Y g:ia', strtotime($rate->accepted_request_date . $rate->accepted_request_time)); ?>
                                        </td>
                                        <td>
                                            <b>Name: </b> <?php echo $rate->driver_first_name . ' ' . $rate->driver_other_names; ?> <br>
                                            <b>Contacts: </b><?php echo $rate->driver_mobile_no; ?> <br>
                                        </td>
                                        <td>
                                            <b>Reg No: </b> <?php echo $rate->car_reg_no; ?> <br>
                                            <b>Color: </b> <?php echo $rate->car_color; ?> <br>
                                            <b>Model: </b> <?php echo $rate->car_model; ?> <br>
                                            <b>Type: </b> <?php echo $rate->car_type; ?>
                                        </td>
                                        <td>
                                            <span class="text-warning text-center">
                                                <?php include('../app/functions/rating_stars.php'); ?>
                                            </span>
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

    <!-- Scripts -->
    <?php
    require_once('../app/partials/footer.php');
    require_once('../app/partials/scripts.php');
    ?>
</body>

</html>