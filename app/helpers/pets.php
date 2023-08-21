<?php



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
            $success = "Pet Adopted, Proceed To Contacting The Owner";
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


/* Add Adoption Feedback */
if (isset($_POST['Add_Feedback'])) {
    $feedback_pet_adoption_id = mysqli_real_escape_string($mysqli, $_POST['feedback_pet_adoption_id']);
    $feedback_title = mysqli_real_escape_string($mysqli, $_POST['feedback_title']);
    $feedback_details = mysqli_real_escape_string($mysqli, $_POST['feedback_details']);


    /* Add Feedback */
    $add_sql = "INSERT INTO pet_adoption_feedback(feedback_pet_adoption_id, feedback_title, feedback_details) VALUES('{$feedback_pet_adoption_id}', '{$feedback_title}', '{$feedback_details}')";

    if (mysqli_query($mysqli, $add_sql)) {
        $success = "Feedback submitted";
    } else {
        $err = "Failed, please try again";
    }
}
