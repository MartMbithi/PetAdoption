<?php
/*
 *   Crafted On Sun Aug 14 2022
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
if ($_SESSION['login_rank'] == 'Administrator') {
?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="dashboard" class="brand-link">
            <img src="../assets/app_data/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-bold">Pet Adoption</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2" id="app_sidebar">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item" id="dashboard">
                        <a href="dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" id="admins">
                        <a href="admins" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Administrators
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" id="pet_owners">
                        <a href="pet_owners" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Pet Owners
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" id="pet_owners">
                        <a href="pet_adopters" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                Adopters
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" id="pets">
                        <a href="pets" class="nav-link">
                            <i class="nav-icon fas fa-cat"></i>
                            <p>
                                Pets
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" id="pet_adoptions">
                        <a href="pet_adoptions" class="nav-link">
                            <i class="nav-icon fas fa-check"></i>
                            <p>
                                Pet Adoptions
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Reports</li>
                    <li class="nav-item" id="pet_adoptions_reports">
                        <a href="pet_adoptions_reports" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Adoptions Reports
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->

    </aside>
<?php
} else if ($_SESSION['login_rank'] == 'Pet Owner') { ?>
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
        <div class="container">
            <a href="owner_home" class="navbar-brand">
                <img src="../assets/app_data/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Pet Adoption</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="owner_home" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="owner_pets" class="nav-link">My Pets</a>
                        </li>
                        <li class="nav-item">
                            <a href="owner_adoptions" class="nav-link">Adoptions</a>
                        </li>
                    </ul>
                    <li class="nav-item">
                        <a data-toggle="tooltip" data-placement="top" title="Profile Settings" class="nav-link text-primary" href="profile"><i class="fas fa-user-edit"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" data-placement="top" title="Sign Out" data-toggle="modal" href="#logout_modal"><i class="fas fa-power-off"></i></a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
<?php } else { ?>
<?php } ?>