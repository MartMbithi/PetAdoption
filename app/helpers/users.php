<?php
/*
 *   Crafted On Wed Jul 27 2022
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


/* Register Admin */
if (isset($_POST['Add_Administrator'])) {
    $login_id = mysqli_real_escape_string($mysqli, $sys_gen_id);
    $login_email = mysqli_real_escape_string($mysqli, $_POST['login_email']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Failed!, Passwords Does Not Match";
    } else {
        /* Avoid Duplication */
        $sql = "SELECT * FROM  login   WHERE  login_email='{$login_email}' AND login_rank = 'Administrator' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($login_email == $row['login_email']) {
                $err = 'Email Already Exists';
            }
        } else {
            /* Persist */
            $sql = "INSERT INTO login (login_id, login_email, login_password, login_rank)
            VALUES('{$login_id}', '{$login_email}', '{$new_password}', 'Administrator')";

            /* Prepare */
            if (mysqli_query($mysqli, $sql)) {
                $success = "Administrator Registered";
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    }
}

/* Update Admin */
if (isset($_POST['Update_Administrator'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);
    $login_email = mysqli_real_escape_string($mysqli, $_POST['login_email']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));
    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Failed!, Passwords Does Not Match";
    } else {
        /* Persist */
        $sql = "UPDATE login SET login_email = '{$login_email}', login_password = '{$confirm_password}'
        WHERE login_id  = '{$login_id}'";

        /* Prepare */
        if (mysqli_query($mysqli, $sql)) {
            $success = "Administrator Account Updated";
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}


/* Delete Admin */
if (isset($_POST['Delete_Administrator'])) {
    $login_id  = mysqli_real_escape_string($mysqli, $_POST['login_id']);

    /* Persist */
    $sql = "DELETE FROM login WHERE login_id = '{$login_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Administrator Account Deleted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Admin Profile Details */
if (isset($_POST['Update_Administrator_Profile'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);
    $login_email = mysqli_real_escape_string($mysqli, $_POST['login_email']);

    /* Persist */
    $sql = "UPDATE login SET login_email = '{$login_email}' WHERE login_id = '{$login_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Login Email Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Admin Profile Details - Password */
if (isset($_POST['Update_Administrator_Password'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);
    $old_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['old_password'])));
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords Does Not Match";
    } else {
        /* Check If Old Password Match Too */
        $sql = "SELECT * FROM  login   WHERE login_id = '{$login_id}'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($row['login_password'] != $old_password) {
                $err = "Incorrect Old Password";
            } else {

                /* Persist Password Update */
                $sql = "UPDATE login SET login_password = '{$new_password}' WHERE login_id = '{$login_id}'";

                /* Prepare */
                if (mysqli_query($mysqli, $sql)) {
                    $success = "Passwords Updated";
                } else {
                    $err = "Failed!, Please Try Again";
                }
            }
        }
    }
}


/* Add Pet Owners  */
if (isset($_POST['Register_Pet_Owner'])) {
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
                $success = "Pet Owner Account Created Successfully";
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    }
}


/* Update Pet Owners */
if (isset($_POST['Update_Pet_Owner'])) {
    $pet_owner_full_name = mysqli_real_escape_string($mysqli, $_POST['pet_owner_full_name']);
    $pet_owner_email  = mysqli_real_escape_string($mysqli, $_POST['pet_owner_email']);
    $pet_owner_contacts = mysqli_real_escape_string($mysqli, $_POST['pet_owner_contacts']);
    $pet_owner_address  = mysqli_real_escape_string($mysqli, $_POST['pet_owner_address']);
    $pet_owner_id = mysqli_real_escape_string($mysqli, $_POST['pet_owner_id']);

    /* Persist */
    $sql = "UPDATE pet_owner SET pet_owner_full_name = '{$pet_owner_full_name}', pet_owner_email = '{$pet_owner_email}',
    pet_owner_contacts = '{$pet_owner_contacts}', pet_owner_address = '{$pet_owner_address}' WHERE pet_owner_id = '{$pet_owner_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Pet Owner Details Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}


/* Delete Pet Owner */
if (isset($_POST['Delete_Pet_Owner'])) {
    $pet_owner_login_id = mysqli_real_escape_string($mysqli, $_POST['pet_owner_login_id']);

    /* Persist */
    $sql  = "DELETE FROM login WHERE login_id = '{$pet_owner_login_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Pet Owner Details Deleted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}



/* Add Adopter */
if (isset($_POST['Register_Pet_Adopter'])) {
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
                $success = "Pet Adopter Registered";
            } else {
                $err = "Failed!, Please Try Again";
            }
        }
    }
}


/* Update Adopter */
if (isset($_POST['Update_Pet_Adopter'])) {
    $adopter_full_name = mysqli_real_escape_string($mysqli, $_POST['adopter_full_name']);
    $adoper_contacts  = mysqli_real_escape_string($mysqli, $_POST['adoper_contacts']);
    $adopter_email = mysqli_real_escape_string($mysqli, $_POST['adopter_email']);
    $adopter_location  = mysqli_real_escape_string($mysqli, $_POST['adopter_location']);
    $adopter_id = mysqli_real_escape_string($mysqli, $_POST['adopter_id']);

    /* Persist */
    $sql = "UPDATE adopter SET adopter_full_name = '{$adopter_full_name}', adoper_contacts = '{$adoper_contacts}',
    adopter_email = '{$adopter_email}', adopter_location = '{$adopter_location}' WHERE adopter_id = '{$adopter_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Pet Adopter Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Delete Adopter */
if (isset($_POST['Delete_Pet_Adopter'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['adopter_login_id']);

    /* Persist */
    $sql = "DELETE FROM login WHERE login_id = '{$login_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Pet Adopter Deleted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
