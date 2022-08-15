<?php
/*
 *   Crafted On Mon Jul 25 2022
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


/* Login */
if (isset($_POST['Login'])) {
    $login_email = mysqli_real_escape_string($mysqli, $_POST['login_email']);
    $login_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['login_password'])));

    /* Persist*/
    $stmt = $mysqli->prepare("SELECT login_id, login_email, login_rank, login_password FROM login
    WHERE login_email = '{$login_email}' AND login_password = '{$login_password}'");
    $stmt->execute();
    $stmt->bind_result($login_id, $login_email, $login_rank, $login_password);
    $rs = $stmt->fetch();
    /* Persist Sessions */
    $_SESSION['login_id'] = $login_id;
    $_SESSION['login_rank'] = $login_rank;

    /* Determiner Where To Redirect Based On Access Leveles */
    if ($rs && $login_rank == 'Administrator') {
        $_SESSION['success'] = "Logged In With Administrator Access Level";
        header('Location: dashboard');
        exit;
    } else if ($rs && $login_rank == 'Pet Owner') {
        $_SESSION['success'] = 'Login Successfully';
        header('Location: owner_home');
        exit;
    } else if ($rs && $login_rank == 'Pet Adopter') {
        $_SESSION['success'] = 'Logged In As Pet Adopter';
        header('Location: adopter_home');
        exit;
    } else {
        $err = "Failed!, Incorrect Login Credentials";
    }
}

/* Register  As Pet Owner*/
if (isset($_POST['Register_PetOwner'])) {
    $pet_owner_full_name = mysqli_real_escape_string($mysqli, $_POST['pet_owner_full_name']);
    $pet_owner_email  = mysqli_real_escape_string($mysqli, $_POST['pet_owner_email']);
    $pet_owner_contacts = mysqli_real_escape_string($mysqli, $_POST['pet_owner_contacts']);
    $pet_owner_address  = mysqli_real_escape_string($mysqli, $_POST['pet_owner_address']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    $login_rank = mysqli_real_escape_string($mysqli, 'Pet Owner');
    $login_id = mysqli_real_escape_string($mysqli, $sys_gen_alt_id);

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Avoid Duplications */
        $sql = "SELECT * FROM  pet_owner   WHERE pet_owner_contacts ='{$pet_owner_contacts}' || pet_owner_email = '{$pet_owner_email}' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $pet_owner_email == $row['pet_owner_email'] ||
                $pet_owner_contacts == $row['pet_owner_contacts']
            ) {
                $err = 'Pet Owner Contacts Or Email Already Exists';
            }
        } else {
            $adopter_sql = "INSERT INTO pet_owner (pet_owner_full_name, pet_owner_email, pet_owner_contacts, pet_owner_address, pet_owner_login_id)
            VALUES('{$pet_owner_full_name}', '{$pet_owner_email}', '{$pet_owner_contacts}', '{$pet_owner_address}', '{$login_id}')";
            $auth_sql = "INSERT INTO login (login_id, login_email, login_password, login_rank)
            VALUES('{$login_id}', '{$pet_owner_email}', '{$new_password}', '{$login_rank}')";

            /* Prepare */
            if (mysqli_query($mysqli, $auth_sql) && mysqli_query($mysqli, $adopter_sql)) {
                $_SESSION['success'] = "Pet Owner Account Created, Proceed To Log In";
                header('Location: ../');
                exit;
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    }
}

/* Register As Pet Adopter */
if (isset($_POST['Register_PetAdopter'])) {
    $adopter_full_name = mysqli_real_escape_string($mysqli, $_POST['adopter_full_name']);
    $adoper_contacts  = mysqli_real_escape_string($mysqli, $_POST['adoper_contacts']);
    $adopter_email = mysqli_real_escape_string($mysqli, $_POST['adopter_email']);
    $adopter_location  = mysqli_real_escape_string($mysqli, $_POST['adopter_location']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    $login_rank = mysqli_real_escape_string($mysqli, 'Pet Adopter');
    $login_id = mysqli_real_escape_string($mysqli, $sys_gen_id);

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Avoid Duplications */
        $sql = "SELECT * FROM  adopter   WHERE adoper_contacts ='{$adoper_contacts}' || adopter_email = '{$adopter_email}' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $adopter_email == $row['adopter_email'] ||
                $adoper_contacts == $row['adoper_contacts']
            ) {
                $err = 'Adopter Contacts Or Email Already Exists';
            }
        } else {
            $adopter_sql = "INSERT INTO adopter (adopter_full_name, adoper_contacts, adopter_email, adopter_login_id, adopter_location)
            VALUES('{$adopter_full_name}', '{$adoper_contacts}', '{$adopter_email}', '{$login_id}', '{$adopter_location}')";
            $auth_sql = "INSERT INTO login (login_id, login_email, login_password, login_rank)
            VALUES('{$login_id}', '{$adopter_email}', '{$new_password}', '{$login_rank}')";

            /* Prepare */
            if (mysqli_query($mysqli, $auth_sql) && mysqli_query($mysqli, $adopter_sql)) {
                $_SESSION['success'] = "Pet Adopter Account Created, Proceed To Log In";
                header('Location: ../');
                exit;
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    }
}


/* Reset Password Step 1 */
if (isset($_POST['Reset_Password'])) {
    $login_email = mysqli_real_escape_string($mysqli, $_POST['login_email']);
    $sql = "SELECT * FROM  login WHERE login_email = '{$login_email}'";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        /* Redirect User To Confirm Password */
        $_SESSION['success'] = 'Proceed To Confirm Password';
        $_SESSION['login_email'] = $login_email;
        header('Location: confirm_password');
        exit;
    } else {
        $err = "Email Address  Does Not Exist";
    }
}

/* Reset Password Step 2 */
if (isset($_POST['Confirm_Password'])) {
    $login_email = mysqli_real_escape_string($mysqli, $_SESSION['login_email']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Persist */
        $sql = "UPDATE login SET login_password = '{$confirm_password}' WHERE login_email = '{$login_email}'";
        $prepare = mysqli_query($mysqli, $sql);
        if ($prepare) {
            /* Redirect User To Confirm Password */
            $_SESSION['success'] = 'Password Reset Successfully, Proceed To Login';
            header('Location: ../');
            exit;
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}
