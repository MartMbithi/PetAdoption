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


/* Add Booking */
if (isset($_POST['Add_Request'])) {
    $request_ref  = mysqli_real_escape_string($mysqli, $rc);
    $request_car_id = mysqli_real_escape_string($mysqli, $_POST['request_car_id']);
    $request_source_coodinates = mysqli_real_escape_string($mysqli, $_POST['request_source_coodinates']);
    $request_destination_coodinates = mysqli_real_escape_string($mysqli, $_POST['request_destination_coodinates']);
    $request_date  = mysqli_real_escape_string($mysqli, $_POST['request_date']);
    $request_time = mysqli_real_escape_string($mysqli, $_POST['request_time']);
    $request_total_amount = mysqli_real_escape_string($mysqli, $_POST['request_total_amount']);

    /* Persist */
    $sql = "INSERT INTO request(request_ref, request_car_id, request_source_coodinates, request_destination_coodinates, 
    request_date, request_time, request_total_amount)
    VALUES('{$request_ref}', '{$request_car_id}', '{$request_source_coodinates}', '{$request_destination_coodinates}',
    '{$request_date}', '{$request_time}', '{$request_total_amount}')";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Request Ref #: $request_ref Added";
    } else {
        $err = "Failed!, Please Try Again Later";
    }
}
/* Update Booking */
if (isset($_POST['Update_Request'])) {
    $request_id  = mysqli_real_escape_string($mysqli, $_POST['request_id']);
    $request_source_coodinates = mysqli_real_escape_string($mysqli, $_POST['request_source_coodinates']);
    $request_destination_coodinates = mysqli_real_escape_string($mysqli, $_POST['request_destination_coodinates']);
    $request_date  = mysqli_real_escape_string($mysqli, $_POST['request_date']);
    $request_time = mysqli_real_escape_string($mysqli, $_POST['request_time']);
    $request_total_amount = mysqli_real_escape_string($mysqli, $_POST['request_total_amount']);

    /* Persist */
    $sql = "UPDATE request SET request_source_coodinates = '{$request_source_coodinates}', request_destination_coodinates = '{$request_destination_coodinates}',
    request_date = '{$request_date}',  request_time = '{$request_time}', request_total_amount = '{$request_total_amount}' WHERE  request_id = '{$request_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Request Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}


/* Delete Booking */
if (isset($_POST['Delete_Request'])) {
    $request_id  = mysqli_real_escape_string($mysqli, $_POST['request_id']);

    /* Persist */
    $sql = "DELETE FROM request WHERE request_id = '{$request_id}'";

    /* Preapre */
    if (mysqli_query($mysqli, $sql)) {
        $_SESSION['success'] = 'Request Cancelled';
        header('Location: requests');
        exit;
    } else {
        $err = "Failed!, Please Try Again";
    }
}

if (isset($_POST['Delete_My_Request'])) {
    $request_id  = mysqli_real_escape_string($mysqli, $_POST['request_id']);

    /* Persist */
    $sql = "DELETE FROM request WHERE request_id = '{$request_id}'";

    /* Preapre */
    if (mysqli_query($mysqli, $sql)) {
        $_SESSION['success'] = 'Request Cancelled';
        header('Location: my_requests');
        exit;
    } else {
        $err = "Failed!, Please Try Again";
    }
}



/* Accept Request */
if (isset($_POST['Accept_Request'])) {
    $accepted_request_request_id = mysqli_real_escape_string($mysqli, $_GET['view']);
    $accepted_request_driver_id = mysqli_real_escape_string($mysqli, $_POST['accepted_request_driver_id']);
    $accepted_request_date = mysqli_real_escape_string($mysqli, $_POST['accepted_request_date']);
    $accepted_request_time = mysqli_real_escape_string($mysqli, $_POST['accepted_request_time']);
    $accepted_request_coodinates = mysqli_real_escape_string($mysqli, $_POST['accepted_request_coodinates']);
    $request_status  = mysqli_real_escape_string($mysqli, 'Accepted');

    /* Persist */
    $sql = "INSERT INTO accepted_requests(accepted_request_request_id, accepted_request_driver_id, accepted_request_date, accepted_request_time, accepted_request_coodinates) 
    VALUES('{$accepted_request_request_id}', '{$accepted_request_driver_id}', '{$accepted_request_date}', '{$accepted_request_time}', '{$accepted_request_coodinates}')";

    $status_sql = "UPDATE request SET  request_status = '{$request_status}' WHERE request_id = '{$accepted_request_request_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $status_sql)) {
        $success  = "Booking Accepted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}


/* Update Accepted Request */
if (isset($_POST['Update_Accepted_Request'])) {
    $accepted_request_id = mysqli_real_escape_string($mysqli, $_POST['accepted_request_id']);
    $accepted_request_date = mysqli_real_escape_string($mysqli, $_POST['accepted_request_date']);
    $accepted_request_time = mysqli_real_escape_string($mysqli, $_POST['accepted_request_time']);
    $accepted_request_coodinates = mysqli_real_escape_string($mysqli, $_POST['accepted_request_coodinates']);
    $accepted_request_driver_id = mysqli_real_escape_string($mysqli, $_POST['accepted_request_driver_id']);

    /* Persist */
    $sql = "UPDATE accepted_requests SET accepted_request_date = '{$accepted_request_date}', accepted_request_time = '{$accepted_request_time}',
    accepted_request_coodinates = '{$accepted_request_coodinates}', accepted_request_driver_id = '{$accepted_request_driver_id}' WHERE accepted_request_id = '{$accepted_request_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success  = "Booking Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}


/* Delete Request */
if (isset($_POST['Delete_Accepted_Request'])) {
    $accepted_request_id = mysqli_real_escape_string($mysqli, $_POST['accepted_request_id']);
    $accepted_request_request_id = mysqli_real_escape_string($mysqli, $_POST['accepted_request_request_id']);
    $request_status = mysqli_real_escape_string($mysqli, 'Pending');


    /* Persist */
    $sql = "DELETE FROM accepted_requests  WHERE  accepted_request_id = '{$accepted_request_id}'";
    $status_sql = "UPDATE request SET  request_status = '{$request_status}' WHERE request_id = '{$accepted_request_request_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $status_sql)) {
        $_SESSION['success'] = 'Request Deleted';
        header('Location: accepted_requests');
        exit;
    }
}

if (isset($_POST['Cancel_Accepted_Request'])) {
    $accepted_request_id = mysqli_real_escape_string($mysqli, $_POST['accepted_request_id']);
    $accepted_request_request_id = mysqli_real_escape_string($mysqli, $_POST['accepted_request_request_id']);
    $request_status = mysqli_real_escape_string($mysqli, 'Pending');


    /* Persist */
    $sql = "DELETE FROM accepted_requests  WHERE  accepted_request_id = '{$accepted_request_id}'";
    $status_sql = "UPDATE request SET  request_status = '{$request_status}' WHERE request_id = '{$accepted_request_request_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $status_sql)) {
        $_SESSION['success'] = 'Request Cancelled';
        header('Location: driver_accepted_requests');
        exit;
    }
}

/* Add Rating */
if (isset($_POST['Add_Rating'])) {
    $rating_stars = mysqli_real_escape_string($mysqli, $_POST['rating_stars']);
    $rating_description = mysqli_real_escape_string($mysqli, $_POST['rating_description']);
    $rating_accepted_requested_id = mysqli_real_escape_string($mysqli, $_POST['rating_accepted_requested_id']);

    /* Prevent Duplication Of Rates */
    $sql = "SELECT * FROM rating WHERE rating_accepted_requested_id = '{$rating_accepted_requested_id}' ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($rating_accepted_requested_id == $row['rating_accepted_requested_id']) {
            $err = 'Rating Already Submitted';
        }
    } else {
        /* Persist */
        $rate_sql = "INSERT INTO rating (rating_stars, rating_description, rating_accepted_requested_id)
        VALUES('{$rating_stars}', '{$rating_description}', '{$rating_accepted_requested_id}')";

        /* Prepare */
        if (mysqli_query($mysqli, $rate_sql)) {
            $_SESSION['success'] = 'Rating Posted';
            header('Location: ratings');
            exit;
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}

if (isset($_POST['Add_My_Rating'])) {
    $rating_stars = mysqli_real_escape_string($mysqli, $_POST['rating_stars']);
    $rating_description = mysqli_real_escape_string($mysqli, $_POST['rating_description']);
    $rating_accepted_requested_id = mysqli_real_escape_string($mysqli, $_POST['rating_accepted_requested_id']);

    /* Prevent Duplication Of Rates */
    $sql = "SELECT * FROM rating WHERE rating_accepted_requested_id = '{$rating_accepted_requested_id}' ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($rating_accepted_requested_id == $row['rating_accepted_requested_id']) {
            $err = 'Rating Already Submitted';
        }
    } else {
        /* Persist */
        $rate_sql = "INSERT INTO rating (rating_stars, rating_description, rating_accepted_requested_id)
        VALUES('{$rating_stars}', '{$rating_description}', '{$rating_accepted_requested_id}')";

        /* Prepare */
        if (mysqli_query($mysqli, $rate_sql)) {
            $_SESSION['success'] = 'Rating Posted';
            header('Location: my_ratings');
            exit;
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}


/* Add Payment */
if (isset($_POST['Add_Payment'])) {
    $payment_amount = mysqli_real_escape_string($mysqli, $_POST['payment_amount']);
    $payment_ref = mysqli_real_escape_string($mysqli, $paycode);
    $payment_mode = mysqli_real_escape_string($mysqli, $_POST['payment_mode']);
    $payment_accepted_request_id = mysqli_real_escape_string($mysqli, $_GET['view']);

    /* Refactor Duobles */
    $sql = "SELECT * FROM payment WHERE  payment_accepted_request_id = '{$payment_accepted_request_id}' ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($payment_accepted_request_id == $row['payment_accepted_request_id']) {
            $err = 'Booking Requested Already Paid';
        }
    } else {
        /* Persist */
        $sql = "INSERT INTO payment (payment_amount, payment_ref, payment_mode, payment_accepted_request_id)
        VALUES('{$payment_amount}', '{$payment_ref}', '{$payment_mode}', '{$payment_accepted_request_id}')";

        /* Prepare */
        if (mysqli_query($mysqli, $sql)) {
            $success = "$payment_ref Confirmed";
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}

if (isset($_POST['Add_My_Payment'])) {
    $payment_amount = mysqli_real_escape_string($mysqli, $_POST['payment_amount']);
    $payment_ref = mysqli_real_escape_string($mysqli, $paycode);
    $payment_mode = mysqli_real_escape_string($mysqli, $_POST['payment_mode']);
    $payment_accepted_request_id = mysqli_real_escape_string($mysqli, $_GET['view']);

    /* Refactor Duobles */
    $sql = "SELECT * FROM payment WHERE  payment_accepted_request_id = '{$payment_accepted_request_id}' ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($payment_accepted_request_id == $row['payment_accepted_request_id']) {
            $err = 'Booking Requested Already Paid';
        }
    } else {
        /* Persist */
        $sql = "INSERT INTO payment (payment_amount, payment_ref, payment_mode, payment_accepted_request_id)
        VALUES('{$payment_amount}', '{$payment_ref}', '{$payment_mode}', '{$payment_accepted_request_id}')";

        /* Prepare */
        if (mysqli_query($mysqli, $sql)) {
            $_SESSION['success'] = "$payment_ref Confirmed";
            header('Location: my_payments');
            exit;
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}
