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
require_once('../app/helpers/ratings.php');
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
    $ret = "SELECT * FROM rating ra 
    INNER JOIN  accepted_requests ar ON ar.accepted_request_id  = ra.rating_accepted_requested_id
    INNER JOIN request r ON r.request_id = ar.accepted_request_request_id
    INNER JOIN driver d ON d.driver_id = ar.accepted_request_driver_id 
    INNER JOIN car c ON c.car_id  = r.request_car_id
    INNER JOIN customer cus ON cus.customer_id = c.car_customer_id
    WHERE ra.rating_id = '{$view}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($rate = $res->fetch_object()) {
    ?>
        <section class="content profile-page">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-7">
                            <h2><?php echo $rate->driver_first_name . ' ' . $rate->driver_other_names; ?> Rating</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="my_home">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="my_ratings">Ratings</a></li>
                                <li class="breadcrumb-item active">Driver Rating</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="boxs-simple">
                            <div class="profile-header" style="background: transparent url('../assets/upload/profile-bg.jpg') repeat scroll center center/cover;">
                                <div class="profile_info">
                                    <div class="profile-image"> <img src="../assets/upload/driver/<?php echo $rate->driver_image; ?>" alt=""> </div>
                                    <h4 class="mb-0"><strong><?php echo $rate->driver_first_name . ' ' . $rate->driver_other_names; ?></strong></h4>
                                    <span class="">Email: <?php echo $rate->driver_email; ?></span><br>
                                    <span class="">Contacts: <?php echo $rate->driver_mobile_no; ?></span><br>
                                    <span class="text-warning text-center">
                                        <?php include('../app/functions/rating_stars.php'); ?>
                                    </span><br>
                                    <span class="text-center"><strong>Rating Details</strong> </span> <br>
                                    <span>
                                        <i><?php echo $rate->rating_description; ?></i>
                                    </span>
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
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile_settings">Update Rating</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#delete_account">Delete Driver Rating</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="profile_settings">
                                        <div class="wrap-reset">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row clearfix">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Rating Stars</label>
                                                                <div class="form-line">
                                                                    <select type="text" name="rating_stars" required class="form-control show-tick">
                                                                        <option value="<?php echo $rate->rating_stars; ?>"><?php echo $rate->rating_stars; ?></option>
                                                                        <option value="1">1 Star</option>
                                                                        <option value="2">2 Stars</option>
                                                                        <option value="3">3 Stars</option>
                                                                        <option value="4">4 Stars</option>
                                                                        <option value="5">5 Stars</option>
                                                                    </select>
                                                                    <input type="hidden" value="<?php echo $rate->rating_id; ?>" name="rating_id" required class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Rating Details</label>
                                                                <div class="form-line">
                                                                    <textarea rows="5" id="editor" type="text" name="rating_description" required class="form-control"><?php echo $rate->rating_description; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="Update_My_Rating" class="btn btn-link waves-effect">UPDATE RATING</button>
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
                                                        Heads Up!, you are about to delete <b><?php echo $rate->driver_first_name . ' ' . $rate->driver_other_names; ?></b> rating.
                                                        This action is reversible, the system will permanently delete <b><?php echo $rate->driver_first_name . ' ' . $rate->driver_other_names; ?></b> rating
                                                        records and any other related records too.
                                                    </h2>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete_modal">DELETE RATING</button>
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
                            <h4>Delete <?php echo $rate->driver_first_name . ' ' . $rate->driver_other_names; ?> Rating ?</h4>
                            <br>
                            <p>Heads Up, You are about to delete <?php echo $rate->driver_first_name . ' ' . $rate->driver_other_names; ?>. This action is irrevisble.</p>
                            <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                            <input type="hidden" name="rating_id" value="<?php echo $rate->rating_id; ?>">
                            <input type='submit' name="Delete_My_Rating" class="text-center btn btn-danger" value="Yes, Delete" />
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