<?php
/*
 *   Crafted On Fri Jul 29 2022
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


/* Add Pet */
if (isset($_POST['Add_Pet'])) {
    $pet_name = mysqli_real_escape_string($mysqli, $_POST['pet_name']);
    $pet_breed = mysqli_real_escape_string($mysqli, $_POST['pet_breed']);
    $pet_age = mysqli_real_escape_string($mysqli, $_POST['pet_age']);
    $pet_health_status = mysqli_real_escape_string($mysqli, $_POST['pet_health_status']);
    $pet_pet_owner = mysqli_real_escape_string($mysqli, $_POST['pet_pet_owner']);

    /* Persist */
    $sql = "INSERT INTO pets (pet_name, pet_breed, pet_age, pet_health_status, pet_pet_owner)
    VALUES('{$pet_name}', '{$pet_breed}', '{$pet_age}', '{$pet_health_status}', '{$pet_pet_owner}')";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Pet Registered";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Update Pet */
if (isset($_POST['Update_Pet'])) {
    $pet_id = mysqli_real_escape_string($mysqli, $_POST['pet_id']);
    $pet_name = mysqli_real_escape_string($mysqli, $_POST['pet_name']);
    $pet_breed = mysqli_real_escape_string($mysqli, $_POST['pet_breed']);
    $pet_age = mysqli_real_escape_string($mysqli, $_POST['pet_age']);
    $pet_health_status = mysqli_real_escape_string($mysqli, $_POST['pet_health_status']);

    /* Persist */
    $sql = "UPDATE pets SET pet_name = '{$pet_name}', pet_breed = '{$pet_breed}', pet_age = '{$pet_age}',
    pet_health_status = '{$pet_health_status}' WHERE pet_id = '{$pet_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Pet Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Delete Pet */
if (isset($_POST['Delete_Pet'])) {
    $pet_id =  mysqli_real_escape_string($mysqli, $_POST['pet_id']);

    /* Persist */
    $sql = "DELETE FROM pets WHERE pet_id = '{$pet_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Pet Deleted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}


/* Adopt Pet */
if (isset($_POST['Adopt_Pet'])) {
    $pet_adoption_pet_id = mysqli_real_escape_string($mysqli, $_POST['pet_adoption_pet_id']);
    $pet_adoption_adopter_id = mysqli_real_escape_string($mysqli, $_POST['pet_adoption_adopter_id']);
    $pet_adoption_date_adopted = date('m/d/Y', strtotime(mysqli_real_escape_string($mysqli, $_POST['pet_adoption_date_adopted'])));

    /* Avoid Double Adoptions */
    $sql = "SELECT * FROM  pet_adoption   WHERE pet_adoption_pet_id ='{$pet_adoption_pet_id}'  ";
    $res = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (
            $pet_adoption_pet_id == $row['pet_adoption_pet_id'] ||
            $pet_adoption_adopter_id == $row['pet_adoption_adopter_id']
        ) {
            $info  = ' Pet Already Adopted';
        }
    } else {

        /* Persist */
        $sql = "INSERT INTO pet_adoption (pet_adoption_pet_id, pet_adoption_adopter_id, pet_adoption_date_adopted)
        VALUES('{$pet_adoption_pet_id}', '{$pet_adoption_adopter_id}', '{$pet_adoption_date_adopted}')";

        $update = "UPDATE pets SET pet_adoption_status = 'Adopted' WHERE pet_id = '{$pet_adoption_pet_id}'";

        /* Prepare */
        if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $update)) {
            $_SESSION['success'] = "Pet Adopted, Proceed To Contacting The Owner";
            header('Location: pet_adoptions');
            exit;
        } else {
            $err = "Failed!, Please Try Again";
        }
    }
}


/* Update Pet Adoption */
if (isset($_POST['Update_Pet_Adoption'])) {
    $pet_adoption_id = mysqli_real_escape_string($mysqli, $_POST['pet_adoption_id']);
    $pet_adoption_adopter_id = mysqli_real_escape_string($mysqli, $_POST['pet_adoption_adopter_id']);
    $pet_adoption_date_adopted = date('m/d/Y', strtotime(mysqli_real_escape_string($mysqli, $_POST['pet_adoption_date_adopted'])));


    /* Persit */
    $sql = "UPDATE pet_adoption SET pet_adoption_adopter_id = '{$pet_adoption_adopter_id}', pet_adoption_date_adopted = '{$pet_adoption_date_adopted}'
    WHERE pet_adoption_id = '{$pet_adoption_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql)) {
        $success = "Pet Adoption Updated";
    } else {
        $err = "Failed!, Please Try Again";
    }
}

/* Delete Pet Adoption */
if (isset($_POST['Delete_Pet_Adoption'])) {
    $pet_adoption_id = mysqli_real_escape_string($mysqli, $_POST['pet_adoption_id']);
    $pet_id = mysqli_real_escape_string($mysqli, $_POST['pet_id']);

    /* Persist */
    $sql = "DELETE FROM pet_adoption WHERE pet_adoption_id = '{$pet_adoption_id}'";
    $update = "UPDATE pets SET pet_adoption_status = 'Pending' WHERE pet_id = '{$pet_id}'";

    /* Prepare */
    if (mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $update)) {
        $success = "Pet Adoption Deleted";
    } else {
        $err = "Failed!, Please Try Again";
    }
}
