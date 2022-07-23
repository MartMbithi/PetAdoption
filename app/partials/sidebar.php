<?php
/*
 *   Crafted On Sun Jul 17 2022
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

/* Login Sessions */
$login_rank = mysqli_real_escape_string($mysqli, $_SESSION['login_rank']);
$login_id = mysqli_real_escape_string($mysqli, $_SESSION['login_id']);
if ($login_rank == 'Administrator') {
    $ret = "SELECT * FROM login WHERE login_id = '{$login_id}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($admin = $res->fetch_object()) {
?>
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image"> <img src="../assets/upload/no-profile.png" width="48" height="48" alt="User" /> </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown"><?php echo $admin->login_rank; ?></div>
                    <div class="email"><?php echo $admin->login_user_name; ?></div>
                    <div class="btn-group user-helper-dropdown"> <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="administrator?view=<?php echo $admin->login_id; ?>"><i class="material-icons">person</i>Profile</a></li>
                            <li class="divider"></li>
                            <li class="divider"></li>
                            <li><a data-toggle="modal" data-target="#logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Main Navigation</li>
                    <li> <a href="dashboard"><i class="zmdi zmdi-home"></i><span>Dashboard</span> </a> </li>
                    <li> <a href="administrators"><i class="zmdi zmdi-account-o"></i><span>Administrators</span> </a> </li>
                    <li> <a href="customers"><i class="zmdi zmdi-account-o"></i><span>Customers</span> </a> </li>
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-calendar"></i><span>Drivers</span> </a>
                        <ul class="ml-menu">
                            <li><a href="driving_classes">Classes</a> </li>
                            <li><a href="drivers">Drivers</a> </li>
                        </ul>
                    </li>
                    <li> <a href="cars"><i class="zmdi zmdi-car"></i><span>Vehicles</span> </a> </li>
                    <li> <a href="requests"><i class="zmdi zmdi-calendar"></i><span>Requests</span> </a> </li>
                    <li> <a href="accepted_requests"><i class="zmdi zmdi-calendar-check"></i><span>Accepted Requests</span> </a> </li>
                    <li> <a href="ratings"><i class="zmdi zmdi-star"></i><span>Ratings</span> </a> </li>
                    <li> <a href="payments"><i class="zmdi zmdi-money"></i><span>Payments</span> </a> </li>
                    <li class="header">System Reports</li>
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-file"></i><span>Reports</span> </a>
                        <ul class="ml-menu">
                            <li><a href="report_customers">Customers</a> </li>
                            <li><a href="report_drivers">Drivers</a> </li>
                            <li><a href="report_cars">Cars</a> </li>
                            <li><a href="report_requests">Requests</a> </li>
                            <li><a href="report_accepted_requests">Accepted Requests</a> </li>
                            <li><a href="report_payments">Payments</a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
    <?php
    }
} else if ($login_rank == 'Driver') {
    $ret = "SELECT * FROM driver WHERE driver_login_id = '{$login_id}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($driv = $res->fetch_object()) {
        $driver_id = $driv->driver_id;
        global $driver_id;
    ?>
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image"> <img src="../assets/upload/driver/<?php echo $driv->driver_image; ?>" width="48" height="48" alt="User" /> </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown"><?php echo $driv->driver_first_name . ' ' . $driv->driver_other_names; ?></div>
                    <div class="email"><?php echo $driv->driver_email; ?></div>
                    <div class="btn-group user-helper-dropdown"> <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="driver_profile_settings"><i class="material-icons">person</i>Profile</a></li>
                            <li class="divider"></li>
                            <li class="divider"></li>
                            <li><a data-toggle="modal" data-target="#logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Main Navigation</li>
                    <li> <a href="driver_dashboard"><i class="zmdi zmdi-home"></i><span>Dashboard</span> </a> </li>
                    <li> <a href="driver_requests"><i class="zmdi zmdi-calendar"></i><span>Requests</span> </a> </li>
                    <li> <a href="driver_accepted_requests"><i class="zmdi zmdi-calendar-check"></i><span>Accepted Requests</span> </a> </li>
                    <li> <a href="driver_ratings"><i class="zmdi zmdi-star"></i><span>Ratings</span> </a> </li>
                    <li> <a href="driver_payments"><i class="zmdi zmdi-money"></i><span>Payments</span> </a> </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
    <?php }
} else {
    $ret = "SELECT * FROM customer WHERE customer_login_id = '{$login_id}'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($cus = $res->fetch_object()) {
        $customer_id = $cus->customer_id;
        global $customer_id;
    ?>
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image"> <img src="../assets/upload/no-profile.png" width="48" height="48" alt="User" /> </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown"><?php echo $cus->customer_first_name . ' ' . $cus->customer_other_names; ?></div>
                    <div class="email"><?php echo $cus->customer_email; ?></div>
                    <div class="btn-group user-helper-dropdown"> <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="my_profile_settings"><i class="material-icons">person</i>Profile</a></li>
                            <li class="divider"></li>
                            <li class="divider"></li>
                            <li><a data-toggle="modal" data-target="#logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Main Navigation</li>
                    <li> <a href="my_home"><i class="zmdi zmdi-home"></i><span>Home</span> </a> </li>
                    <li> <a href="my_cars"><i class="zmdi zmdi-car"></i><span>Vehicles</span> </a> </li>
                    <li> <a href="my_requests"><i class="zmdi zmdi-calendar"></i><span>Requests</span> </a> </li>
                    <li> <a href="my_accepted_requests"><i class="zmdi zmdi-calendar-check"></i><span>Accepted Requests</span> </a> </li>
                    <li> <a href="my_ratings"><i class="zmdi zmdi-star"></i><span>Ratings</span> </a> </li>
                    <li> <a href="my_payments"><i class="zmdi zmdi-money"></i><span>Payments</span> </a> </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
<?php
    }
}   ?>