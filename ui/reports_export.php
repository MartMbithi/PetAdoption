<?php
/*
 *   Crafted On Wed Aug 03 2022
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
if ($report == '') {
}

/* 3. Pet Owners */
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

/* 4. Pet Adopters */

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
