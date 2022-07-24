<?php
/*
 *   Crafted On Sat Jul 23 2022
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
require_once('../app/settings/config.php');
require_once('../app/partials/head.php');
?>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top" style="background-image: url('../assets/app_data/backgrounds/bg_1.jpg'); background-size: cover;">

        <div class="container">
            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <a class="d-block text-center mb-4" href=".">
                        <img class="mr-2" src="../assets/app_data/illustrations/falcon.png" alt="" width="58" />
                        <span class="text-sans-serif font-weight-extra-bold fs-5 d-inline-block">Pet Adoption</span>
                    </a>
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="row text-left justify-content-between">
                                <div class="col-auto">
                                    <h5>Sign In</h5>
                                </div>
                            </div>
                            <form method="POST">
                                <div class="form-group">
                                    <input class="form-control" type="email" required name="login_email" placeholder="Email address" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="login_password" required placeholder="Password" />
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input" id="customCheckRemember" type="checkbox" /><label class="custom-control-label" for="customCheckRemember">Remember me</label></div>
                                    </div>
                                    <div class="col-auto"><a class="fs--1" href="reset_password">Forgot Password?</a></div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block mt-3" type="submit" name="login" name="submit">Log in</button>
                                </div>
                                <div class="w-100 position-relative text-center mt-4">
                                    <hr class="text-300" />
                                    <div class="position-absolute absolute-centered t-0 px-3 bg-white text-sans-serif fs--1 text-500 text-nowrap">Or Sign Up As</div>
                                </div>
                            </form>
                            <div class="form-group mb-0">
                                <div class="row no-gutters">
                                    <div class="col-sm-6 pr-sm-1">
                                        <button data-toggle="modal" class="btn btn-outline-google-plus btn-sm btn-block mt-2" data-target="#pet_owner">
                                            Pet Owner
                                        </button>
                                    </div>
                                    <div class="col-sm-6 pl-sm-1">
                                        <button data-toggle="modal" class="btn btn-outline-facebook btn-sm btn-block mt-2" data-target="#pet_adopter">
                                            Pet Adopter
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    <!-- Register Modal -->
    <div class="modal fade" id="pet_adopter" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg mt-6" role="document">
            <div class="modal-content border-0">
                <div class="modal-header px-5 text-white position-relative modal-shape-header">
                    <div class="position-relative z-index-1">
                        <div>
                            <h4 class="mb-0 text-white" id="authentication-modal-label">Sign Up As Pet Adopter</h4>
                            <p class="fs--1 mb-0">Fill all required values</p>
                        </div>
                    </div><button class="close text-white position-absolute t-0 r-0 mt-1 mr-1" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body py-4 px-5">
                    <form method="POST">
                        <div class="form-row">

                            <div class="form-group col-12">
                                <label for="modal-auth-name">Name</label>
                                <input class="form-control" name="user_full_name" required type="text" />
                            </div>
                            <div class="form-group col-6">
                                <label for="modal-auth-name">National ID Number</label>
                                <input class="form-control" name="user_nationalID" required type="text" />
                            </div>
                            <div class="form-group col-6">
                                <label for="modal-auth-name">KRA PIN Number</label>
                                <input class="form-control" name="user_KRA_Pin" required type="text" />
                            </div>
                            <div class="form-group col-6">
                                <label for="modal-auth-name">Phone Number</label>
                                <input class="form-control" name="user_phone" required type="text" />
                            </div>
                            <div class="form-group">
                                <label for="modal-auth-email">Email Address</label>
                                <input class="form-control" type="email" name="user_email" id="modal-auth-email" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="modal-auth-password">
                                    Password
                                </label>
                                <input class="form-control" name="new_password" type="password" />
                            </div>
                            <div class="form-group col-6">
                                <label for="modal-auth-confirm-password">Confirm Password</label>
                                <input class="form-control" type="password" name="confirm_password" />
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary mt-3" type="submit" name="register">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php require_once('../app/partials/scripts.php'); ?>
</body>


</html>