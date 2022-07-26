<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Pet Adoption System</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/app_data/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/app_data/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/app_data/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/app_data/favicons/favicon.ico">
    <link rel="manifest" href="../assets/app_data/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../assets/app_data/favicons/mstile-150x150.png">
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="../assets/css/theme.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/lib/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <?php
    /* Alert Sesion Via Alerts */
    if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
    }
    ?>
</head>