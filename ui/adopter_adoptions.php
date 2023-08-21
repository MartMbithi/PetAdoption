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
                            <h1 class="m-0 text-dark"> Pet Adoptions </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="adopter_home">Home</a></li>
                                <li class="breadcrumb-item active">Pet Adoptions</li>
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
                                                        <th>Pet Details</th>
                                                        <th>Pet Owner Details</th>
                                                        <th>Adopted By</th>
                                                        <th>Date Adopted</th>
                                                        <th>Manage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $ret = "SELECT * FROM pet_adoption pa
                                                    INNER JOIN pets p ON p.pet_id = pa.pet_adoption_pet_id
                                                    INNER JOIN pet_owner po ON po.pet_owner_id = p.pet_pet_owner
                                                    INNER JOIN adopter a ON a.adopter_id = pa.pet_adoption_adopter_id
                                                    WHERE pa.pet_adoption_adopter_id = '{$adopter_id}'";
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
                                                            <td>
                                                                <a data-toggle="modal" href="#delete_<?php echo $adoption->pet_adoption_id; ?>" class="badge  badge-pill badge-danger"><em class="fas fa-trash"></em> Delete</a>
                                                                <a data-toggle="modal" href="#give_feedback_<?php echo $adoption->pet_adoption_id; ?>" class="badge  badge-pill badge-primary"><em class="fas fa-bullhorn"></em> Give feedback</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        include('../app/modals/pets_adoptions.php');
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