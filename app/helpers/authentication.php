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


/* 📌 Login   */
if (isset($_POST['login'])) {
    $login_user_name = mysqli_real_escape_string($mysqli, $_POST['login_user_name']);
    $login_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['login_password'])));

    /* Persist*/
    $stmt = $mysqli->prepare("SELECT login_id, login_user_name, login_rank, login_password FROM login
    WHERE login_user_name = '{$login_user_name}' AND login_password = '{$login_password}'");
    $stmt->execute();
    $stmt->bind_result($login_id, $login_user_name, $login_rank, $login_password);
    $rs = $stmt->fetch();
    /* Persist Sessions */
    $_SESSION['login_id'] = $login_id;
    $_SESSION['login_rank'] = $login_rank;

    /* Determiner Where To Redirect Based On Access Leveles */
    if ($rs && $login_rank == 'Administrator') {
        $_SESSION['success'] = "Logged In With Administrator Access Level";
        header('Location: dashboard');
        exit;
    } else if ($rs && $login_rank == 'Customer') {
        $_SESSION['success'] = 'Login Successfully';
        header('Location: my_home');
        exit;
    } else if ($rs && $login_rank == 'Driver') {
        $_SESSION['success'] = 'Logged In As Driver';
        header('Location: driver_dashboard');
        exit;
    } else {
        $err = "Failed!, Incorrect Login Credentials";
    }
}

/* 📌 Register  Driver Account */
if (isset($_POST['Driver_Sign_In'])) {
    $driver_first_name = mysqli_real_escape_string($mysqli, $_POST['driver_first_name']);
    $driver_other_names = mysqli_real_escape_string($mysqli, $_POST['driver_other_names']);
    $driver_email = mysqli_real_escape_string($mysqli, $_POST['driver_email']);
    $driver_mobile_no = mysqli_real_escape_string($mysqli, $_POST['driver_mobile_no']);
    $driver_login_id = mysqli_real_escape_string($mysqli, $sys_gen_id);
    $driver_driving_class_id = mysqli_real_escape_string($mysqli, $_POST['driver_driving_class_id']);
    $login_rank = mysqli_real_escape_string($mysqli, 'Driver');
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    $driver_image = mysqli_real_escape_string($mysqli, $_FILES['driver_image']['name']);
    $new_driver_image = explode(".", $driver_image);
    /* Give New File Names */
    $encoded_driver_image = $a . $b . '.' . end($new_driver_image);
    /* Move Uploaded Images */
    move_uploaded_file($_FILES["driver_image"]["tmp_name"], "../assets/upload/driver/" . $encoded_driver_image);

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Prevent Duplicates */
        $sql = "SELECT * FROM driver WHERE driver_email ='{$driver_email}' || driver_mobile_no = '{$driver_mobile_no}' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $driver_mobile_no == $row['driver_mobile_no'] ||
                $driver_email == $row['driver_email']
            ) {
                $err = 'User Details Already Exists';
            }
        } else {
            /* Persist */
            $sql = "INSERT INTO driver (driver_first_name, driver_other_names, driver_email, driver_mobile_no, driver_login_id, driver_image, driver_driving_class_id)
            VALUES('{$driver_first_name}', '{$driver_other_names}', '{$driver_email}', '{$driver_mobile_no}', '{$driver_login_id}', '{$encoded_driver_image}', '{$driver_driving_class_id}')";

            $auth_sql = "INSERT INTO login (login_id, login_user_name, login_password, login_rank)
            VALUES('{$driver_login_id}', '{$driver_email}', '{$confirm_password}', '{$login_rank}')";

            /* Prepare */
            if (mysqli_query($mysqli, $auth_sql) && mysqli_query($mysqli, $sql)) {
                $success = "Driver Account Created, Proceed To Login";
            } else {
                $err = "Failed!, Please Try Again Or Later";
            }
        }
    }
}


/* 📌 Register Customer Account */
if (isset($_POST['Customer_Sign_In'])) {
    $customer_first_name = mysqli_real_escape_string($mysqli, $_POST['customer_first_name']);
    $customer_other_names = mysqli_real_escape_string($mysqli, $_POST['customer_other_names']);
    $customer_email = mysqli_real_escape_string($mysqli, $_POST['customer_email']);
    $customer_mobile_no = mysqli_real_escape_string($mysqli, $_POST['customer_mobile_no']);
    $customer_login_id = mysqli_real_escape_string($mysqli, $sys_gen_alt_id);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    $login_rank = mysqli_real_escape_string($mysqli, 'Customer');


    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Failed!, Passwords Does Not Match";
    } else {
        /* Remove Duplicates */
        $sql = "SELECT * FROM customer WHERE customer_email ='{$customer_email}' || customer_mobile_no = '{$customer_mobile_no}' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $customer_mobile_no == $row['customer_mobile_no'] ||
                $customer_email == $row['customer_email']
            ) {
                $err = 'User Details Already Exists';
            }
        } else {
            /* Persist */
            $sql = "INSERT INTO customer (customer_first_name, customer_other_names,  customer_email, customer_mobile_no,  customer_login_id)
            VALUES('{$customer_first_name}', '{$customer_other_names}', '{$customer_email}', '{$customer_mobile_no}', '{$customer_login_id}')";

            $auth_sql = "INSERT INTO login (login_id, login_user_name, login_password, login_rank)
            VALUES('{$customer_login_id}', '{$customer_email}', '{$confirm_password}', '{$login_rank}')";

            /* Prepare */
            if (mysqli_query($mysqli, $auth_sql) && mysqli_query($mysqli, $sql)) {
                $success = "Customer Account Created, Proceed To Login";
            } else {
                $err = "Failed!, Please Try Again Or Later";
            }
        }
    }
}

/* 📌 Reset Password  */
if (isset($_POST['reset_password_step_1'])) {
    $login_user_name  = mysqli_real_escape_string($mysqli, $_POST['login_user_name']);
    /* Check If This Account Exists */
    $sql = "SELECT * FROM  login WHERE login_user_name = '{$login_user_name}'";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        /* Redirect User To Confirm Password */
        $_SESSION['success'] = 'Proceed To Confirm Password';
        $_SESSION['login_user_name'] = $login_user_name;
        header('Location: confirm_password');
        exit;
    } else {
        $err = "Email Address  Does Not Exist";
    }
}

/* 📌 Confirm Password  */
if (isset($_POST['reset_password_step_2'])) {
    $login_user_name = mysqli_real_escape_string($mysqli, $_SESSION['login_user_name']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Persist */
        $sql = "UPDATE login SET login_password = '{$confirm_password}' WHERE login_user_name = '{$login_username}'";
        $prepare = mysqli_query($mysqli, $sql);
        if ($prepare) {
            /* Redirect User To Confirm Password */
            $_SESSION['success'] = 'Password Reset Successfully, Proceed To Login';
            header('Location: login');
            exit;
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}
