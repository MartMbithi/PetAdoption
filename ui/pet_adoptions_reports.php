<?php
/*
 *   Crafted On Fri Jul 29 2022
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
require_once('../app/settings/codeGen.php');
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/helpers/pets.php');
require_once('../app/partials/head.php');
?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once('../app/partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once('../app/partials/aside.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Pets Adoptions Reports</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pets Adoptions</li>
                            </ol>
                        </div><!-- /.col -->
                        <hr>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->



            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <form class="form-inline" method="POST">
                            <div class="input-group mx-sm-3 mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt text-primary"></i>
                                    </span>
                                </div>
                                <input type="text" name="date_range" class="form-control float-right" id="range">
                            </div>
                            <button type="submit" name="filter" class="btn btn-primary mb-2">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (isset($_POST['filter'])) {
                                $date_range = mysqli_real_escape_string($mysqli, $_POST['date_range']);
                                /* Split This */
                                $dates = explode(' - ', $date_range);

                                $from_date = date('d M Y', strtotime($dates[0]));
                                $to_date = date('d M Y', strtotime($dates[1]));

                            ?>
                                <hr>
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h5 class="text-center">Pet Adoptions From <?php echo $from_date; ?> To <?php echo $to_date; ?> </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered text-truncate" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Pet Details</th>
                                                            <th>Pet Owner Details</th>
                                                            <th>Adopted By</th>
                                                            <th>Date Adopted</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $ret = "SELECT * FROM pet_adoption pa
                                                        INNER JOIN pets p ON p.pet_id = pa.pet_adoption_pet_id
                                                        INNER JOIN pet_owner po ON po.pet_owner_id = p.pet_pet_owner
                                                        INNER JOIN adopter a ON a.adopter_id = pa.pet_adoption_adopter_id
                                                        WHERE pa.pet_adoption_date_adopted BETWEEN  '{$from_date}' AND '{$to_date}'  ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        while ($adoption = $res->fetch_object()) {
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $adoption->pet_name; ?><br>
                                                                    <b>Breed: </b> <?php echo $adoption->pet_breed; ?><br>
                                                                    <b>Age: </b> <?php echo $adoption->pet_age; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $adoption->pet_owner_full_name; ?><br>
                                                                    <b>Email: </b><?php echo $adoption->pet_owner_email; ?><br>
                                                                    <b>Contacts:</b> <?php echo $adoption->pet_owner_contacts; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $adoption->adopter_full_name; ?><br>
                                                                    <b>Email: </b> <?php echo $adoption->adopter_email; ?><br>
                                                                    <b>Contacts: </b> <?php echo $adoption->adoper_contacts; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo date('d M Y', strtotime($adoption->pet_adoption_date_adopted)); ?>
                                                                </td>

                                                            </tr>
                                                        <?php
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                            <?php
                            } ?>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php require_once('../app/partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>