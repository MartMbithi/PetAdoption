<?php

if ($_SESSION['login_rank'] == 'Administrator') {

    /* Pet Adopters */
    $query = "SELECT COUNT(*)  FROM adopter";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($adopters);
    $stmt->fetch();
    $stmt->close();


    /* Pet Owners */
    $query = "SELECT COUNT(*)  FROM pet_owner";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($pet_owner);
    $stmt->fetch();
    $stmt->close();

    /* Pets */
    $query = "SELECT COUNT(*)  FROM pets";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($pets);
    $stmt->fetch();
    $stmt->close();

    /* Adopts */
    $query = "SELECT COUNT(*)  FROM pet_adoption";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($pet_adoption);
    $stmt->fetch();
    $stmt->close();
} else if ($_SESSION['login_rank'] == 'Pet Owner') {
    /* Pet Owner ID */
    $login_id = mysqli_real_escape_string($mysqli, $_SESSION['login_id']);
    $ret = "SELECT * FROM pet_owner WHERE pet_owner_login_id = '{$login_id}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($user = $res->fetch_object()) {
        $owner_id = $user->pet_owner_id;
        global $owner_id;

        /* Pets */
        $query = "SELECT COUNT(*)  FROM pets  WHERE pet_pet_owner = '{$owner_id}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($pets);
        $stmt->fetch();
        $stmt->close();

        /* Adopts */
        $query = "SELECT COUNT(*)  FROM pet_adoption pa
        INNER JOIN pets p ON p.pet_id = pa.pet_adoption_pet_id
        WHERE p.pet_pet_owner = '{$owner_id}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($pet_adoption);
        $stmt->fetch();
        $stmt->close();
    }
} else {
    /* Pet adopter ID */
    $login_id = mysqli_real_escape_string($mysqli, $_SESSION['login_id']);
    $ret = "SELECT * FROM adopter WHERE adopter_login_id = '{$login_id}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($user = $res->fetch_object()) {
        $adopter_id = $user->adopter_id;
        global $owner_id;

        /* Pets */
        $query = "SELECT COUNT(*)  FROM pets  WHERE pet_adoption_status = 'Pending'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($pets);
        $stmt->fetch();
        $stmt->close();

        /* Adopts */
        $query = "SELECT COUNT(*)  FROM pet_adoption pa
        INNER JOIN pets p ON p.pet_id = pa.pet_adoption_pet_id
        WHERE pa.pet_adoption_adopter_id = '{$adopter_id}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($pet_adoption);
        $stmt->fetch();
        $stmt->close();
    }
}
