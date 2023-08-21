<?php
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

                                /* Sanitize For SQL Procesing */
                                $sql_date_from = $dates['0'];
                                $sql_date_to = $dates['1'];
                            ?>

                                <hr>

                                <div class="text-right">
                                    <a href="reports_export?type=PDF&report=adoptions&start=<?php echo $sql_date_from; ?>&end=<?php echo $sql_date_to; ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-file-pdf"></i> Export To PDF
                                    </a>
                                    <a href="reports_export?type=excel&report=adoptions&start=<?php echo $sql_date_from; ?>&end=<?php echo $sql_date_to; ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-file-spreadsheet"></i> Export To Excel
                                    </a>
                                </div>
                                <br>
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
                                                        WHERE pa.pet_adoption_date_adopted BETWEEN '{$sql_date_from}' AND '{$sql_date_to}'";
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