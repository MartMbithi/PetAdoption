<?php
session_start();
require_once('../app/settings/config.php');
require_once('../app/settings/codeGen.php');
require_once('../app/settings/checklogin.php');
check_login();
require_once('../vendor/autoload.php');
/* Global Variables */

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$type = mysqli_real_escape_string($mysqli, $_GET['type']);
$report = mysqli_real_escape_string($mysqli, $_GET['report']);


/* 1. Pet Adoptions */
if ($report == 'adoptions') {
    /* Dates */
    $start = mysqli_real_escape_string($mysqli, $_GET['start']);
    $end = mysqli_real_escape_string($mysqli, $_GET['end']);

    /* Stripped Dates */
    $formal_start_date = date('d M Y', strtotime($start));
    $formal_end_date  = date('d M Y', strtotime($end));

    /* Dump Reports To XLS File */
    if ($type == 'excel') {
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Pet Adoptions Between" . $start . " And " . $end . ".xls";

        /* Excel Column Name */
        $header = array("Pet Adoptions Reports From " . $start . " To " . $end);
        $fields = array('Pet Details', 'Pet Owner Details', 'Adopted By', 'Date Adopted');


        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM pet_adoption pa
        INNER JOIN pets p ON p.pet_id = pa.pet_adoption_pet_id
        INNER JOIN pet_owner po ON po.pet_owner_id = p.pet_pet_owner
        INNER JOIN adopter a ON a.adopter_id = pa.pet_adoption_adopter_id
        WHERE pa.pet_adoption_date_adopted BETWEEN '{$start}' AND '{$end}'");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($row['pet_name'], $row['pet_owner_full_name'], $row['adopter_full_name'], $row['pet_adoption_date_adopted']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'No Pet Adoptions Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;

        exit;
    } else if ($type == 'PDF') {
        /* Dump To PDF */
        $html = '
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
            <div class="list_header" align="center">
                <h3>
                    Pet Adoption System
                </h3>
                <hr style="width:100%" , color=black>
                <h5>Pet Adoptions From ' . $formal_start_date . ' To ' . $formal_end_date . '</h5>
            </div>
            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:10%">#</th>
                        <th style="width:100%">Pet Details</th>
                        <th style="width:100%">Pet Owner Details</th>
                        <th style="width:100%">Adopted By</th>
                        <th style="width:100%">Date Adopted</th>
                    </tr>
                </thead>
                <tbody>
                ';
        $ret = "SELECT * FROM pet_adoption pa
        INNER JOIN pets p ON p.pet_id = pa.pet_adoption_pet_id
        INNER JOIN pet_owner po ON po.pet_owner_id = p.pet_pet_owner
        INNER JOIN adopter a ON a.adopter_id = pa.pet_adoption_adopter_id
        WHERE pa.pet_adoption_date_adopted BETWEEN '{$start}' AND '{$end}'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $cnt = 1;
        while ($adoption = $res->fetch_object()) {
            $html .=
                '
                        <tr>
                            <td>' . $cnt . '</td>
                            <td>
                               <b>' . $adoption->pet_name . '</b> <br>
                                Breed:' . $adoption->pet_breed . ' <br>
                                Age: ' . $adoption->pet_age . '
                            </td>
                            <td>
                                <b>' . $adoption->pet_owner_full_name . '</b> <br>
                                Email:' . $adoption->pet_owner_email . ' <br>
                                Contacts: ' . $adoption->pet_owner_contacts . '
                            </td>
                            <td>
                                <b>' . $adoption->adopter_full_name . '</b> <br>
                                Email: ' . $adoption->adopter_email . ' <br>
                                Contacts: ' . $adoption->adoper_contacts . '
                            </td>
                            <td>' . date('d M Y', strtotime($adoption->pet_adoption_date_adopted)) . '</td>
                        </tr>
                    ';
            $cnt = $cnt + 1;
        }
        $html .= '
                </tbody>
            </table>
        ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Pet Adoptions Between ' . $formal_start_date . ' And ' . $formal_end_date, array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } else {
        $_SESSION['error'] = 'Specify Report Type';
        header('Location: pet_adoptions_reports');
        exit;
    }
}

/* 2. Pets */
if ($report == 'pets') {
    /* Dump Reports To XLS File */
    if ($type == 'excel') {
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Pets Reports.xls";

        /* Excel Column Name */
        $header = array("Pets Reports");
        $fields = array('Name', 'Status', 'Breed', 'Age', 'Health Status', 'Owner');


        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM pets p
        INNER JOIN pet_owner po ON p.pet_pet_owner = po.pet_owner_id");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($row['pet_name'], $row['pet_adoption_status'], $row['pet_breed'], $row['pet_age'], $row['pet_health_status'], $row['pet_owner_full_name']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'No Pet Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;

        exit;
    } else if ($type == 'PDF') {
        /* Dump To PDF */
        $html = '
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
            <div class="list_header" align="center">
                <h3>
                    Pet Adoption System
                </h3>
                <hr style="width:100%" , color=black>
                <h5>Pet Owners Reports</h5>
            </div>
            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:10%">#</th>
                        <th style="width:50%">Name</th>
                        <th style="width:30%">Breed</th>
                        <th style="width:30%">Age</th>
                        <th style="width:20%">Status</th>
                        <th style="width:50%">Health Status</th>
                        <th style="width:100%">Owner</th>
                    </tr>
                </thead>
                <tbody>
                ';
        $ret = "SELECT * FROM pets p
        INNER JOIN pet_owner po ON p.pet_pet_owner = po.pet_owner_id";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $cnt = 1;
        while ($pets = $res->fetch_object()) {
            $html .=
                '
                        <tr>
                            <td>' . $cnt . '</td>
                            <td>
                               ' . $pets->pet_name . '
                            </td>
                            <td>
                            ' . $pets->pet_breed . '
                            </td>
                            <td>
                               ' . $pets->pet_age . '
                            </td>
                            <td>
                               ' . $pets->pet_adoption_status . '
                            </td>
                            <td>
                               ' . $pets->pet_health_status . '
                            </td>
                            <td>
                               ' . $pets->pet_owner_full_name . '<br>
                               Email: ' . $pets->pet_owner_email . '<br>
                               Contacts: ' . $pets->pet_owner_contacts . '
                            </td>
                        </tr>
                    ';
            $cnt = $cnt + 1;
        }
        $html .= '
                </tbody>
            </table>
        ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Pets Reports', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } else {
        $_SESSION['error'] = 'Specify Report Type';
        header('Location: pets');
        exit;
    }
}

/* 3. Pet Owners */
if ($report == 'owners') {
    /* Dump Reports To XLS File */
    if ($type == 'excel') {
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Pet Owners Reports.xls";

        /* Excel Column Name */
        $header = array("Pet Owners Reports");
        $fields = array('Full Names', 'Email', 'Contacts', 'Address');


        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM pet_owner ");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($row['pet_owner_full_name'], $row['pet_owner_contacts'], $row['pet_owner_email'], $row['pet_owner_address']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'No Pet Owners Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;

        exit;
    } else if ($type == 'PDF') {
        /* Dump To PDF */
        $html = '
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
            <div class="list_header" align="center">
                <h3>
                    Pet Adoption System
                </h3>
                <hr style="width:100%" , color=black>
                <h5>Pet Owners Reports</h5>
            </div>
            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:10%">#</th>
                        <th style="width:100%">Full Names</th>
                        <th style="width:100%">Email</th>
                        <th style="width:100%">Contacts</th>
                        <th style="width:100%">Address</th>
                    </tr>
                </thead>
                <tbody>
                ';
        $ret = "SELECT * FROM pet_owner";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $cnt = 1;
        while ($pet_owner = $res->fetch_object()) {
            $html .=
                '
                        <tr>
                            <td>' . $cnt . '</td>
                            <td>
                               ' . $pet_owner->pet_owner_full_name . '
                            </td>
                            <td>
                            ' . $pet_owner->pet_owner_email . '
                             </td>
                            <td>
                               ' . $pet_owner->pet_owner_contacts . '
                            </td>
                           
                            <td>
                               ' . $pet_owner->pet_owner_address . '
                            </td>
                        </tr>
                    ';
            $cnt = $cnt + 1;
        }
        $html .= '
                </tbody>
            </table>
        ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Pet Owners Reports', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } else {
        $_SESSION['error'] = 'Specify Report Type';
        header('Location: pet_owners');
        exit;
    }
}

/* 4. Pet Adopters */
if ($report == 'adopters') {
    /* Dump Reports To XLS File */
    if ($type == 'excel') {
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Pet Adopters Reports.xls";

        /* Excel Column Name */
        $header = array("Pet Owners Reports");
        $fields = array('Full Names', 'Email', 'Contacts', 'Address');


        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM adopter ");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($row['adopter_full_name'], $row['adopter_email'], $row['adoper_contacts'], $row['adopter_location']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'No Pet Adopters Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;

        exit;
    } else if ($type == 'PDF') {
        /* Dump To PDF */
        $html = '
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
            <div class="list_header" align="center">
                <h3>
                    Pet Adoption System
                </h3>
                <hr style="width:100%" , color=black>
                <h5>Pet Adopters Reports</h5>
            </div>
            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:10%">#</th>
                        <th style="width:100%">Full Names</th>
                        <th style="width:100%">Email</th>
                        <th style="width:100%">Contacts</th>
                        <th style="width:100%">Address</th>
                    </tr>
                </thead>
                <tbody>
                ';
        $ret = "SELECT * FROM adopter";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $cnt = 1;
        while ($adopter = $res->fetch_object()) {
            $html .=
                '
                        <tr>
                            <td>' . $cnt . '</td>
                            <td>
                               ' . $adopter->adopter_full_name . '
                            </td>
                            <td>
                            ' . $adopter->adopter_email . '
                            </td>
                            <td>
                               ' . $adopter->adoper_contacts . '
                            </td>
                           
                            <td>
                               ' . $adopter->adopter_location . '
                            </td>
                        </tr>
                    ';
            $cnt = $cnt + 1;
        }
        $html .= '
                </tbody>
            </table>
        ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Pet Adopters Reports', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } else {
        $_SESSION['error'] = 'Specify Report Type';
        header('Location: pet_adopters');
        exit;
    }
}
/* 5. Admin Reports */
if ($report == 'admins') {
    /* Dump Reports To XLS File */
    if ($type == 'excel') {
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Administrators Reports.xls";

        /* Excel Column Name */
        $header = array("Administrators Reports");
        $fields = array('Email Address', 'Access Level');


        /* Implode Excel Data */
        $excelDataHeader = implode("\t\t\t", array_values($header)) . "\n\n";
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM login 
        WHERE login_rank = 'Administrator' ");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $lineData = array($row['login_email'], $row['login_rank']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'No Administrators Records Available...' . "\n";
        }

        /* Generate Header File Encordings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelDataHeader;
        echo $excelData;

        exit;
    } else if ($type == 'PDF') {
        /* Dump To PDF */
        $html = '
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
            <div class="list_header" align="center">
                <h3>
                    Pet Adoption System
                </h3>
                <hr style="width:100%" , color=black>
                <h5>Administrators Reports</h5>
            </div>
            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:10%">#</th>
                        <th style="width:100%">Email</th>
                        <th style="width:40%">Login Rank</th>
                    </tr>
                </thead>
                <tbody>
                ';
        $ret = "SELECT * FROM login 
        WHERE login_rank = 'Administrator'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $cnt = 1;
        while ($admin = $res->fetch_object()) {
            $html .=
                '
                        <tr>
                            <td>' . $cnt . '</td>
                            <td>
                               ' . $admin->login_email . '
                            </td>
                            <td>
                            ' . $admin->login_rank . '
                            </td>
                        </tr>
                    ';
            $cnt = $cnt + 1;
        }
        $html .= '
                </tbody>
            </table>
        ';
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Administrators Reports', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } else {
        $_SESSION['error'] = 'Specify Report Type';
        header('Location: admins');
        exit;
    }
}
