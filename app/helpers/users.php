<?php


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


/* Update Pet Owner Auth */
if (isset($_POST['Update_Pet_Owner_Password'])) {
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
