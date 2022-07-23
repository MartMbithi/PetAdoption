<?php
/*
* Crafted On Mon Jul 18 2022
*
*
* https://bit.ly/MartMbithi
* martdevelopers254@gmail.com
*
*
* The MartDevelopers End User License Agreement
* Copyright (c) 2022 MartDevelopers
*
*
* 1. GRANT OF LICENSE
* MartDevelopers hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
* install and activate this system on two separated computers solely for your personal and non-commercial use,
* unless you have purchased a commercial license from MartDevelopers. Sharing this Software with other individuals,
* or allowing other individuals to view the contents of this Software, is in violation of this license.
* You may not make the Software available on a network, or in any way provide the Software to multiple users
* unless you have first purchased at least a multi-user license from MartDevelopers.
*
* 2. COPYRIGHT
* The Software is owned by MartDevelopers and protected by copyright law and international copyright treaties.
* You may not remove or conceal any proprietary notices, labels or marks from the Software.
*
*
* 3. RESTRICTIONS ON USE
* You may not, and you may not permit others to
* (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
* (b) modify, distribute, or create derivative works of the Software;
* (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or
* otherwise exploit the Software.
*
*
* 4. TERM
* This License is effective until terminated.
* You may terminate it at any time by destroying the Software, together with all copies thereof.
* This License will also terminate if you fail to comply with any term or condition of this Agreement.
* Upon such termination, you agree to destroy the Software, together with all copies thereof.
*
*
* 5. NO OTHER WARRANTIES.
* MARTDEVELOPERS DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE.
* MARTDEVELOPERS SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE,
* EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS.
* SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
* ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF
* INCIDENTAL OR CONSEQUENTIAL DAMAGES,
* SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU.
* THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO
* HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
*
*
* 6. SEVERABILITY
* In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
* affect the validity of the remaining portions of this license.
*
*
* 7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL MARTDEVELOPERS OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
* CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR
* USE OF THE SOFTWARE, EVEN IF MARTDEVELOPERS HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
* IN NO EVENT WILL MARTDEVELOPERS LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT
* TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
*
*/

/* Add Admin */
if (isset($_POST['Add_Admin'])) {
    $login_id = mysqli_real_escape_string($mysqli, $sys_gen_id);
    $login_user_name = mysqli_real_escape_string($mysqli, $_POST['login_user_name']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    $login_rank = mysqli_real_escape_string($mysqli, 'Administrator');

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Remove Duplicates */
        $sql = "SELECT * FROM login WHERE login_user_name ='{$login_user_name}'  AND login_rank = '{$login_rank}' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $login_rank == $row['login_rank'] ||
                $login_user_name == $row['login_user_name']
            ) {
                $err = 'Admin Details Already Exists';
            }
        } else {
            /* Persist */
            $sql  = "INSERT INTO login (login_id, login_user_name, login_password, login_rank)
            VALUES('{$login_id}', '{$login_user_name}', '{$confirm_password}', '{$login_rank}')";

            /* Prepare */
            if (mysqli_query($mysqli, $sql)) {
                $success = "Admin Account Added";
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    }
}

/* Update Admin */
if (isset($_POST['Update_Admin'])) {
    $login_id = mysqli_real_escape_string($mysqli, $sys_gen_id);
    $login_user_name = mysqli_real_escape_string($mysqli, $_POST['login_user_name']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {

        /* Persist */
        $sql = "UPDATE login SET login_user_name = '{$login_user_name}', login_password = '{$confirm_password}'
        WHERE login_id = '{$login_id}'";

        /* Prepare */
        if (mysqli_query($mysqli, $sql)) {
            $success = "Admin Account Updated";
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}

/* Delete Admin */
if (isset($_POST['Delete_Admin'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);

    /* Persist */
    $sql  = "DELETE FROM login WHERE login_id = '{$login_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $_SESSION['success'] = 'Admin Account Deleted';
        header('Location: administrators');
        exit;
    } else {
        $err = "Failed!, Please Try Again";
    }
}


/* Add Customer */
if (isset($_POST['Register_Customer'])) {
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
                $success = "$customer_first_name Account Created";
            } else {
                $err = "Failed!, Please Try Again Or Later";
            }
        }
    }
}

/* Update Customer */
if (isset($_POST['Update_Customer'])) {
    $customer_first_name = mysqli_real_escape_string($mysqli, $_POST['customer_first_name']);
    $customer_other_names = mysqli_real_escape_string($mysqli, $_POST['customer_other_names']);
    $customer_email = mysqli_real_escape_string($mysqli, $_POST['customer_email']);
    $customer_mobile_no = mysqli_real_escape_string($mysqli, $_POST['customer_mobile_no']);
    $customer_id = mysqli_real_escape_string($mysqli, $_POST['customer_id']);

    /* Perist */
    $sql = "UPDATE customer SET customer_first_name = '{$customer_first_name}', customer_other_names = '{$customer_other_names}',
    customer_email = '{$customer_email}', customer_mobile_no = '{$customer_mobile_no}' WHERE customer_id = '{$customer_id}'";
    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Customer Profile Details Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}



/* Delete Customer */
if (isset($_POST['Delete_Customer'])) {
    $customer_login_id = mysqli_real_escape_string($mysqli, $_POST['customer_login_id']);

    /* Persist */
    $sql = "DELETE FROM login WHERE login_id = '{$customer_login_id}'";
    if (mysqli_query($mysqli, $sql)) {
        $_SESSION['success'] = 'Customer Account Deleted';
        header('Location: customers');
        exit;
    } else {
        $err = "Failed!, Please Try Again";
    }
}


/* Change Customer Login Details */
if (isset($_POST['Update_Customer_Password'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err =  "Passwords Does Not Match";
    } else {
        /* Persist */
        $sql = "UPDATE login SET login_password = '{$confirm_password}' WHERE login_id = '{$login_id}'";
        /* Prepare */
        if (mysqli_query($mysqli, $sql)) {
            $success = "Password Updated";
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}

/* Add Driver */

if (isset($_POST['Add_Driver'])) {
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
                $success = "Driver Account Registered";
            } else {
                $err = "Failed!, Please Try Again Or Later";
            }
        }
    }
}


/* Update Driver */
if (isset($_POST['Update_Driver'])) {
    $driver_first_name = mysqli_real_escape_string($mysqli, $_POST['driver_first_name']);
    $driver_other_names = mysqli_real_escape_string($mysqli, $_POST['driver_other_names']);
    $driver_email = mysqli_real_escape_string($mysqli, $_POST['driver_email']);
    $driver_mobile_no = mysqli_real_escape_string($mysqli, $_POST['driver_mobile_no']);
    $driver_id = mysqli_real_escape_string($mysqli, $_POST['driver_id']);
    $driver_driving_class_id = mysqli_real_escape_string($mysqli, $_POST['driver_driving_class_id']);

    /* Persist */
    $sql = "UPDATE driver SET driver_first_name = '{$driver_first_name}', driver_other_names = '{$driver_other_names}',
    driver_email = '{$driver_email}', driver_mobile_no = '{$driver_mobile_no}', driver_driving_class_id = '{$driver_driving_class_id}'
    WHERE driver_id = '{$driver_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Driver Account Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Driver Login Password */
if (isset($_POST['Update_Driver_Password'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Persist */
        $sql  = "UPDATE login SET login_password = '{$confirm_password}' WHERE login_id = '{$login_id}'";
        /* Prepare */
        if (mysqli_query($mysqli, $sql)) {
            $success = "Login Passwords Updated";
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}


/* Update Driver Image */
if (isset($_POST['Update_Driver_Passport'])) {
    $driver_id = mysqli_real_escape_string($mysqli, $_POST['driver_id']);
    $driver_image = mysqli_real_escape_string($mysqli, $_FILES['driver_image']['name']);
    $new_driver_image = explode(".", $driver_image);
    /* Give New File Names */
    $encoded_driver_image = $a . $b . '.' . end($new_driver_image);
    /* Move Uploaded Images */
    move_uploaded_file($_FILES["driver_image"]["tmp_name"], "../assets/upload/driver/" . $encoded_driver_image);

    /* Persist */
    $sql = "UPDATE driver SET driver_image = '{$encoded_driver_image}' WHERE driver_id = '{$driver_id}' ";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Driver Passport Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}


/* Delete Driver */
if (isset($_POST['Delete_Driver'])) {
    $driver_login_id = mysqli_real_escape_string($mysqli, $_POST['driver_login_id']);

    /* Persist */
    $sql = "DELETE FROM login WHERE login_id = '{$driver_login_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $_SESSION['success'] = 'Driver Account Deleted';
        header('Location: drivers');
        exit;
    }
}
