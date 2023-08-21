<?php
session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/helpers/pets.php');
require_once('../app/helpers/analytics.php');
require_once('../app/partials/head.php');
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../app/partials/aside.php'); ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> Pets </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="adopter_home">Home</a></li>
                                <li class="breadcrumb-item active">Pets</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered text-truncate" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Breed</th>
                                                        <th>Age</th>
                                                        <th>Health Status</th>
                                                        <th>Manage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $ret = "SELECT * FROM pets p
                                                    INNER JOIN pet_owner po ON p.pet_pet_owner = po.pet_owner_id
                                                    WHERE p.pet_adoption_status = 'Pending'";
                                                    $stmt = $mysqli->prepare($ret);
                                                    $stmt->execute(); //ok
                                                    $res = $stmt->get_result();
                                                    while ($pets = $res->fetch_object()) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $pets->pet_name;
                                                                if ($pets->pet_adoption_status == 'Adopted') {
                                                                ?>
                                                                    <br>
                                                                    <span class="badge bg-success"><i class="fas fa-check"></i> Adopted</span>
                                                                <?php
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $pets->pet_breed; ?>
                                                            </td>
                                                            <td><?php echo $pets->pet_age; ?></td>
                                                            <td><?php echo $pets->pet_health_status; ?></td>
                                                            <td>
                                                                <?php
                                                                if ($pets->pet_adoption_status != 'Adopted') {
                                                                ?>
                                                                    <a data-toggle="modal" href="#adopt_<?php echo $pets->pet_id; ?>" class="badge  badge-pill badge-success"><em class="fas fa-dog"></em> Adopt</a>
                                                                <?php
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        /* Manage  Modals */
                                                        include('../app/modals/adopter_pets.php');
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>

                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php require_once('../app/partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>


</html>