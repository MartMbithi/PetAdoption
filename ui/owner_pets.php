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
                                <li class="breadcrumb-item"><a href="owner_home">Home</a></li>
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
                            <div class="card-header p-2">
                                <h3 class="text-right">
                                    <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-outline-primary">
                                        <i class="fas fa-cat"></i> Register New Pet
                                    </button>
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="modal fade" id="add_modal">
                                <div class="modal-dialog modal-dialog-centered  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Register New Pet - Fill All Required Fields </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                                <div class="form-row">
                                                    <div class="form-group col-8">
                                                        <label>Name</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" required type="hidden" value="<?php echo $owner_id; ?>" name="pet_pet_owner">
                                                            <input class="form-control" required type="text" name="pet_name">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="text-primary fas fa-paw"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label>Age</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" required type="text" name="pet_age">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="text-primary fas fa-calendar"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Breed</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" required type="text" name="pet_breed">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="text-primary fas fa-venus-mars"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Health Status</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" required type="text" name="pet_health_status">
                                                                <option>Healthy</option>
                                                                <option>Ill</option>
                                                            </select>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="text-primary fas fa-capsules"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group text-right">
                                                    <button class="btn btn-outline-primary mt-3" type="submit" name="Add_Pet" name="submit">
                                                        <i class="fas fa-cat"></i> Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                    WHERE po.pet_owner_id = '{$owner_id}'";
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
                                                                <a data-toggle="modal" href="#update_<?php echo $pets->pet_id; ?>" class="badge  badge-pill badge-warning"><em class="fas fa-user-edit"></em> Edit</a>
                                                                <a data-toggle="modal" href="#delete_<?php echo $pets->pet_id; ?>" class="badge  badge-pill badge-danger"><em class="fas fa-trash"></em> Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        /* Manage  Modals */
                                                        include('../app/modals/pets.php');
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