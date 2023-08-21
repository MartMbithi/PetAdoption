<?php

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
