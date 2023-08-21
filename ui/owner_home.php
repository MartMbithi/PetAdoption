<?php
session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/checklogin.php');
check_login();
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
                            <h1 class="m-0 text-dark"> Home </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="owner_home">Home</a></li>
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
                        <div class="col-12 col-sm-6 col-md-6">
                            <a href="owner_pets" class="text-dark">
                                <div class="info-box mb-3 callout callout-success">
                                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cat"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">My Pets</span>
                                        <span class="info-box-number"><?php echo $pets; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>

                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-6">
                            <a href="owner_adoptions" class="text-dark">
                                <div class="info-box mb-3 callout callout-warning">
                                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-check"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Successful Adoptions</span>
                                        <span class="info-box-number"><?php echo $pet_adoption; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title">Monthly Adoption Report</h5>
                                </div>
                                <!-- /.card-header -->
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
                                                    WHERE po.pet_owner_id = '{$owner_id}'";
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