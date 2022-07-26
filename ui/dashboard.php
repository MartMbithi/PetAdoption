<?php
/*
 *   Crafted On Tue Jul 26 2022
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
require_once('../app/settings/checklogin.php');
check_login();
require_once('../app/partials/head.php');
?>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <div class="container">
            <nav class="navbar navbar-vertical navbar-expand-xl navbar-light navbar-glass"><a class="navbar-brand text-left" href="index-2.html">
                    <div class="d-flex align-items-center py-3"><img class="mr-2" src="assets/img/illustrations/falcon.png" alt="" width="40" /><span class="text-sans-serif">falcon</span></div>
                </a>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#home" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="home">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span>Home</span></div>
                            </a>
                            <ul class="nav collapse show" id="home" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item active"><a class="nav-link" href="index-2.html">Dashboard</a></li>
                                <li class="nav-item"><a class="nav-link" href="home/feed.html">Feed</a></li>
                                <li class="nav-item"><a class="nav-link" href="home/landing.html">Landing</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#pages" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="pages">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-copy"></span></span><span>Pages</span></div>
                            </a>
                            <ul class="nav collapse" id="pages" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="pages/activity.html">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/associations.html">Associations</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/checkout.html">Checkout</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/customer-details.html">Customer details</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/event-detail.html">Event detail</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/event-create.html">Event create</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/events.html">Events</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/faq.html">Faq</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/invoice.html">Invoice</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/invite-people.html">Invite people</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/notifications.html">Notifications</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/people.html">People</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/pricing.html">Pricing</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/pricing-alt.html">Pricing alt</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/profile.html">Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/settings.html">Settings</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/starter.html">Starter</a></li>
                                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#pages-errors" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="pages-errors">Errors</a>
                                    <ul class="nav collapse" id="pages-errors">
                                        <li class="nav-item"><a class="nav-link" href="pages/errors/404.html">404</a></li>
                                        <li class="nav-item"><a class="nav-link" href="pages/errors/500.html">500</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#email" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="email">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-envelope-open"></span></span><span>Email</span><span class="badge badge-pill ml-2 badge-soft-success">new</span></div>
                            </a>
                            <ul class="nav collapse" id="email" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="email/inbox.html">Inbox</a></li>
                                <li class="nav-item"><a class="nav-link" href="email/email-detail.html">Email detail</a></li>
                                <li class="nav-item"><a class="nav-link" href="email/compose.html">Compose</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-unlock-alt"></span></span><span>Authentication</span></div>
                            </a>
                            <ul class="nav collapse" id="authentication" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="authentication/log-in.html">Log in</a></li>
                                <li class="nav-item"><a class="nav-link" href="authentication/log-out.html">Log out</a></li>
                                <li class="nav-item"><a class="nav-link" href="authentication/register.html">Register</a></li>
                                <li class="nav-item"><a class="nav-link" href="authentication/forget-password.html">Forget password</a></li>
                                <li class="nav-item"><a class="nav-link" href="authentication/password-reset.html">Password reset</a></li>
                                <li class="nav-item"><a class="nav-link" href="authentication/confirm-mail.html">Confirm mail</a></li>
                                <li class="nav-item"><a class="nav-link" href="authentication/lock-screen.html">Lock screen</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-commerce" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-cart-plus"></span></span><span>E commerce</span><span class="badge badge-pill ml-2 badge-soft-warning">next</span></div>
                            </a>
                            <ul class="nav collapse" id="e-commerce" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="e-commerce/product-list.html">Product list</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-commerce/product-grid.html">Product grid</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-commerce/product-details.html">Product details</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-commerce/orders.html">Orders</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-commerce/order-details.html">Order details</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-commerce/customers.html">Customers</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-commerce/shopping-cart.html">Shopping cart</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-commerce/checkout.html">Checkout</a></li>
                                <li class="nav-item"><a class="nav-link" href="e-commerce/sellers.html">Sellers</a></li>
                            </ul>
                        </li>
                    </ul>
                    <hr class="border-300 my-2" />
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#layouts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="layouts">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-qrcode"></span></span><span>Layouts</span></div>
                            </a>
                            <ul class="nav collapse" id="layouts" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="layouts/standard.html">Standard</a></li>
                                <li class="nav-item"><a class="nav-link" href="layouts/fluid.html">Fluid</a></li>
                                <li class="nav-item"><a class="nav-link" href="layouts/RTL.html">RTL</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="components">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-puzzle-piece"></span></span><span>Components</span></div>
                            </a>
                            <ul class="nav collapse" id="components" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="components/alerts.html">Alerts</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/avatar.html">Avatar</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/background.html">Background</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/badges.html">Badges</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/breadcrumb.html">Breadcrumb</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/bulk-select.html">Bulk select</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/buttons.html">Buttons</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/cards.html">Cards</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/carousel.html">Carousel</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/collapse.html">Collapse</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/countup.html">Countup</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/dropdowns.html">Dropdowns</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/fancyscroll.html">Fancyscroll</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/fancytab.html">Fancytab</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/forms.html">Forms</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/hoverbox.html">Hoverbox</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/list-group.html">List group</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/modals.html">Modals</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/media-object.html">Media object</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/navs.html">Navs</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/navbar.html">Navbar</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/page-headers.html">Page headers</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/pagination.html">Pagination</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/popovers.html">Popovers</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/progress.html">Progress</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/scrollspy.html">Scrollspy</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/spinners.html">Spinners</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/tables.html">Tables</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/tabs.html">Tabs</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/toasts.html">Toasts</a></li>
                                <li class="nav-item"><a class="nav-link" href="components/tooltips.html">Tooltips</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#utilities" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="utilities">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fab fa-hotjar"></span></span><span>Utilities</span></div>
                            </a>
                            <ul class="nav collapse" id="utilities" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="utilities/borders.html">Borders</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/clearfix.html">Clearfix</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/close-icon.html">Close icon</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/colors.html">Colors</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/display.html">Display</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/embed.html">Embed</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/figures.html">Figures</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/flex.html">Flex</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/grid.html">Grid</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/sizing.html">Sizing</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/spacing.html">Spacing</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/stretched-link.html">Stretched link</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/typography.html">Typography</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/vertical-align.html">Vertical align</a></li>
                                <li class="nav-item"><a class="nav-link" href="utilities/visibility.html">Visibility</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#plugins" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="plugins">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-plug"></span></span><span>Plugins</span></div>
                            </a>
                            <ul class="nav collapse" id="plugins" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="plugins/accordion.html">Accordion</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/charts.html">Charts</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/countdown.html">Countdown</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/data-table.html">Data table</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/date-picker.html">Date picker</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/fancybox.html">Fancybox</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/fontawesome.html">Fontawesome</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/google-map.html">Google map</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/inline-player.html">Inline player</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/jqvmap.html">Jqvmap</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/lightbox.html">Lightbox</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/notifications.html">Notifications</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/owl-carousel.html">Owl carousel</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/progressbar.html">Progressbar</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/remodal.html">Remodal</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/select2.html">Select2</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/tinymce.html">Tinymce</a></li>
                                <li class="nav-item"><a class="nav-link" href="plugins/typed-text.html">Typed text</a></li>
                            </ul>
                        </li>
                    </ul>
                    <hr class="border-300 my-2" />
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#documentation" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="documentation">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-book"></span></span><span>Documentation</span></div>
                            </a>
                            <ul class="nav collapse" id="documentation" data-parent="#navbarVerticalCollapse">
                                <li class="nav-item"><a class="nav-link" href="documentation/getting-started.html">Getting started</a></li>
                                <li class="nav-item"><a class="nav-link" href="documentation/file-structure.html">File structure</a></li>
                                <li class="nav-item"><a class="nav-link" href="documentation/customization.html">Customization</a></li>
                                <li class="nav-item"><a class="nav-link" href="documentation/fluid-layout.html">Fluid layout</a></li>
                                <li class="nav-item"><a class="nav-link" href="documentation/gulp.html">Gulp</a></li>
                                <li class="nav-item"><a class="nav-link" href="documentation/RTL.html">RTL</a></li>
                                <li class="nav-item"><a class="nav-link" href="documentation/plugins.html">Plugins</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="changelog.html">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-code-branch"></span></span><span>Changelog</span><span class="badge badge-pill ml-2 badge-soft-primary">v1.5.1</span></div>
                            </a></li>
                    </ul><a class="btn btn-primary btn-sm m-3" href="https://themewagon.com/themes/falcon/" target="_blank">Purchase</a>
                </div>
            </nav>
            <div class="content">
                <nav class="navbar navbar-light navbar-glass fs--1 font-weight-semi-bold row navbar-top sticky-kit navbar-expand"><button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button><a class="navbar-brand text-left ml-3" href="index-2.html">
                        <div class="d-flex align-items-center"><img class="mr-2" src="assets/img/illustrations/falcon.png" alt="" width="40" /><span class="text-sans-serif">falcon</span></div>
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown1">
                        <ul class="navbar-nav align-items-center d-none d-lg-block">
                            <li class="nav-item">
                                <form class="form-inline search-box"><input class="form-control rounded-pill search-input" type="search" placeholder="Search..." aria-label="Search" /><span class="position-absolute fas fa-search text-400 search-box-icon"></span></form>
                            </li>
                        </ul>
                        <ul class="navbar-nav align-items-center ml-auto">
                            <li class="nav-item dropdown"><a class="nav-link unread-indicator px-0" id="navbarDropdownNotification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell fs-4" data-fa-transform="shrink-6"></span></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-card" aria-labelledby="navbarDropdownNotification">
                                    <div class="card card-notification shadow-none" style="max-width: 20rem">
                                        <div class="card-header">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <h6 class="card-header-title mb-0">Notifications</h6>
                                                </div>
                                                <div class="col-auto"><a class="card-link font-weight-normal" href="#">Mark all as read</a></div>
                                            </div>
                                        </div>
                                        <div class="list-group list-group-flush font-weight-normal fs--1">
                                            <div class="list-group-title">NEW</div>
                                            <div class="list-group-item">
                                                <a class="notification notification-flush bg-200" href="#!">
                                                    <div class="notification-avatar">
                                                        <div class="avatar avatar-2xl mr-3">
                                                            <img class="rounded-circle" src="assets/img/team/1.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="notification-body">
                                                        <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                                                        <span class="notification-time"><span class="mr-1" role="img" aria-label="Emoji">💬</span>Just now</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-group-item">
                                                <a class="notification notification-flush bg-200" href="#!">
                                                    <div class="notification-avatar">
                                                        <div class="avatar avatar-2xl mr-3">
                                                            <div class="avatar-name rounded-circle"><span>AB</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="notification-body">
                                                        <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
                                                        <span class="notification-time"><span class="mr-1 fab fa-gratipay text-danger"></span>9hr</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-group-title">EARLIER</div>
                                            <div class="list-group-item">
                                                <a class="notification notification-flush" href="#!">
                                                    <div class="notification-avatar">
                                                        <div class="avatar avatar-2xl mr-3">
                                                            <img class="rounded-circle" src="assets/img/icons/weather.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="notification-body">
                                                        <p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's weather.</p>
                                                        <span class="notification-time"><span class="mr-1" role="img" aria-label="Emoji">🌤️</span>1d</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center border-top-0"><a class="card-link d-block" href="pages/notifications.html">View all</a></div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-xl">
                                        <img class="rounded-circle" src="assets/img/team/3.jpg" alt="" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white rounded-soft py-2">
                                        <a class="dropdown-item font-weight-bold text-warning" href="#!"><span class="fas fa-crown mr-1"></span><span>Go Pro</span></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Set status</a>
                                        <a class="dropdown-item" href="pages/profile.html">Profile &amp; account</a>
                                        <a class="dropdown-item" href="#!">Feedback</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="pages/settings.html">Settings</a>
                                        <a class="dropdown-item" href="authentication/log-out.html">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="card mb-3">
                    <div class="card-body rounded-soft bg-gradient">
                        <div class="row text-white align-items-center no-gutters">
                            <div class="col">
                                <h4 class="text-white mb-0">Today $764.39</h4>
                                <p class="fs--1 font-weight-semi-bold">Yesterday <span class="text-300">$684.87</span></p>
                            </div>
                            <div class="col-auto d-none d-sm-block"><select class="custom-select custom-select-sm mb-3 shadow" id="dashboard-chart-select">
                                    <option value="all">All Payments</option>
                                    <option value="successful" selected="selected">Successful Payments</option>
                                    <option value="failed">Failed Payments</option>
                                </select></div>
                        </div><canvas class="rounded" id="chart-line" width="1618" height="375" aria-label="Line chart" role="img"></canvas>
                    </div>
                </div>
                <div class="card bg-light mb-3">
                    <div class="card-body p-3">
                        <p class="fs--1 mb-0"><a href="#!"><span class="fas fa-exchange-alt mr-2" data-fa-transform="rotate-90"></span>A payout for <strong>$921.42 </strong>was deposited 13 days ago</a>. Your next deposit is expected on <strong>Tuesday, March 13.</strong></p>
                    </div>
                </div>
                <div class="card-deck">
                    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);"></div>
                        <!--/.bg-holder-->
                        <div class="card-body position-relative">
                            <h6>Customers<span class="badge badge-soft-warning rounded-capsule ml-2">-0.23%</span></h6>
                            <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning" data-countupp='{"count":58386,"format":"alphanumeric"}'>58.39k</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#!">See all<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
                        </div>
                    </div>
                    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-2.png);"></div>
                        <!--/.bg-holder-->
                        <div class="card-body position-relative">
                            <h6>Orders<span class="badge badge-soft-info rounded-capsule ml-2">0.0%</span></h6>
                            <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info" data-countupp='{"count":23434,"format":"alphanumeric"}'>73.46k</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#!">All orders<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
                        </div>
                    </div>
                    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
                        <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-3.png);"></div>
                        <!--/.bg-holder-->
                        <div class="card-body position-relative">
                            <h6>Revenue<span class="badge badge-soft-success rounded-capsule ml-2">9.54%</span></h6>
                            <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif" data-countup='{"count":43594,"format":"comma","prefix":"$"}'>0</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#!">Statistics<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
                                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Recent Purchases</h5>
                            </div>
                            <div class="col-6 col-sm-auto ml-auto text-right pl-0">
                                <div class="d-none" id="purchases-actions">
                                    <div class="input-group input-group-sm"><select class="custom-select cus" aria-label="Bulk actions">
                                            <option selected="">Bulk actions</option>
                                            <option value="Refund">Refund</option>
                                            <option value="Delete">Delete</option>
                                            <option value="Archive">Archive</option>
                                        </select><button class="btn btn-falcon-default btn-sm ml-2" type="button">Apply</button></div>
                                </div>
                                <div id="dashboard-actions"><button class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ml-1">New</span></button><button class="btn btn-falcon-default btn-sm mx-2" type="button"><span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ml-1">Filter</span></button><button class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ml-1">Export</span></button></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0 table-dashboard fs--1">
                                <thead class="bg-200 text-900">
                                    <tr>
                                        <th>
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select" id="checkbox-bulk-purchases-select" type="checkbox" data-checkbox-body="#purchases" data-checkbox-actions="#purchases-actions" data-checkbox-replaced-element="#dashboard-actions" /><label class="custom-control-label" for="checkbox-bulk-purchases-select"></label></div>
                                        </th>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Product</th>
                                        <th class="text-center">Payment</th>
                                        <th class="text-right">Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="purchases">
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-1" /><label class="custom-control-label" for="checkbox-1"></label></div>
                                        </td>
                                        <th class="align-middle"><a href="pages/customer-details.html">Sylvia Plath</a></th>
                                        <td class="align-middle">john@gmail.com</td>
                                        <td class="align-middle">Slick - Drag & Drop Bootstrap Generator</td>
                                        <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span></td>
                                        <td class="align-middle text-right">$99</td>
                                        <td class="align-middle white-space-nowrap">
                                            <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-2" /><label class="custom-control-label" for="checkbox-2"></label></div>
                                        </td>
                                        <th class="align-middle"><a href="pages/customer-details.html">Homer</a></th>
                                        <td class="align-middle">sylvia@mail.ru</td>
                                        <td class="align-middle">Bose SoundSport Wireless Headphones</td>
                                        <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span></td>
                                        <td class="align-middle text-right">$634</td>
                                        <td class="align-middle white-space-nowrap">
                                            <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown2" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown2">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-3" /><label class="custom-control-label" for="checkbox-3"></label></div>
                                        </td>
                                        <th class="align-middle"><a href="pages/customer-details.html">Edgar Allan Poe</a></th>
                                        <td class="align-middle">edgar@yahoo.com</td>
                                        <td class="align-middle">All-New Fire HD 8 Kids Edition Tablet</td>
                                        <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-secondary">Blocked<span class="ml-1 fas fa-ban" data-fa-transform="shrink-2"></span></span></td>
                                        <td class="align-middle text-right">$199</td>
                                        <td class="align-middle white-space-nowrap">
                                            <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown3" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown3">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-4" /><label class="custom-control-label" for="checkbox-4"></label></div>
                                        </td>
                                        <th class="align-middle"><a href="pages/customer-details.html">William Butler Yeats</a></th>
                                        <td class="align-middle">william@gmail.com</td>
                                        <td class="align-middle">Apple iPhone XR (64GB)</td>
                                        <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span></td>
                                        <td class="align-middle text-right">$798</td>
                                        <td class="align-middle white-space-nowrap">
                                            <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown4" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown4">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-5" /><label class="custom-control-label" for="checkbox-5"></label></div>
                                        </td>
                                        <th class="align-middle"><a href="pages/customer-details.html">Rabindranath Tagore</a></th>
                                        <td class="align-middle">tagore@twitter.com</td>
                                        <td class="align-middle">ASUS Chromebook C202SA-YS02 11.6"</td>
                                        <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-secondary">Blocked<span class="ml-1 fas fa-ban" data-fa-transform="shrink-2"></span></span></td>
                                        <td class="align-middle text-right">$318</td>
                                        <td class="align-middle white-space-nowrap">
                                            <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown5" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown5">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-6" /><label class="custom-control-label" for="checkbox-6"></label></div>
                                        </td>
                                        <th class="align-middle"><a href="pages/customer-details.html">Emily Dickinson</a></th>
                                        <td class="align-middle">emily@gmail.com</td>
                                        <td class="align-middle">Mirari OK to Wake! Alarm Clock & Night-Light</td>
                                        <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-warning">Pending<span class="ml-1 fas fa-stream" data-fa-transform="shrink-2"></span></span></td>
                                        <td class="align-middle text-right">$11</td>
                                        <td class="align-middle white-space-nowrap">
                                            <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown6" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown6">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-7" /><label class="custom-control-label" for="checkbox-7"></label></div>
                                        </td>
                                        <th class="align-middle"><a href="pages/customer-details.html">Giovanni Boccaccio</a></th>
                                        <td class="align-middle">giovanni@outlook.com</td>
                                        <td class="align-middle">Summer Infant Contoured Changing Pad</td>
                                        <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span></td>
                                        <td class="align-middle text-right">$31</td>
                                        <td class="align-middle white-space-nowrap">
                                            <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown7" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown7">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox ml-3"><input class="custom-control-input checkbox-bulk-select-target" type="checkbox" id="checkbox-8" /><label class="custom-control-label" for="checkbox-8"></label></div>
                                        </td>
                                        <th class="align-middle"><a href="pages/customer-details.html">Oscar Wilde</a></th>
                                        <td class="align-middle">oscar@hotmail.com</td>
                                        <td class="align-middle">Munchkin 6 Piece Fork and Spoon Set</td>
                                        <td class="align-middle text-center fs-0"><span class="badge badge rounded-capsule badge-soft-success">Success<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span></td>
                                        <td class="align-middle text-right">$43</td>
                                        <td class="align-middle white-space-nowrap">
                                            <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown8" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown8">
                                                    <div class="bg-white py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Refund</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="mb-0 fs--1"><span class="d-none d-sm-inline-block mr-1">11 Items &mdash; </span><a class="font-weight-semi-bold" href="#">view all<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></span></a></p>
                            </div>
                            <div class="col-auto"><button class="btn btn-light btn-sm" type="button" disabled="disabled"><span>Previous</span></button><button class="btn btn-primary btn-sm px-4 ml-2" type="button"><span>Next</span></button></div>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-4 pr-lg-2">
                        <div class="card h-100 bg-gradient">
                            <div class="card-header bg-transparent">
                                <h5 class="text-white">Active users right now</h5>
                                <div class="real-time-user display-1 font-weight-normal text-white" data-countup='{"count":119}'>0</div>
                            </div>
                            <div class="card-body text-white fs--1">
                                <p class="border-bottom pb-2" style="border-color: rgba(255, 255, 255, 0.15) !important">Page views per second</p><canvas id="real-time-user" width="10" height="4"></canvas>
                                <div class="list-group-flush mt-4">
                                    <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1 font-weight-semi-bold border-top-0" style="border-color: rgba(255, 255, 255, 0.15)">
                                        <p class="mb-0">Top Active Pages</p>
                                        <p class="mb-0">Active Users</p>
                                    </div>
                                    <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1" style="border-color: rgba(255, 255, 255, 0.05)">
                                        <p class="mb-0">/bootstrap-themes/</p>
                                        <p class="mb-0">3</p>
                                    </div>
                                    <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1" style="border-color: rgba(255, 255, 255, 0.05)">
                                        <p class="mb-0">/tags/html5/</p>
                                        <p class="mb-0">3</p>
                                    </div>
                                    <div class="list-group-item bg-transparent d-xxl-flex justify-content-between px-0 py-1 d-none" style="border-color: rgba(255, 255, 255, 0.05)">
                                        <p class="mb-0">/</p>
                                        <p class="mb-0">2</p>
                                    </div>
                                    <div class="list-group-item bg-transparent d-xxl-flex justify-content-between px-0 py-1 d-none" style="border-color: rgba(255, 255, 255, 0.05)">
                                        <p class="mb-0">/preview/falcon/dashboard/</p>
                                        <p class="mb-0">2</p>
                                    </div>
                                    <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1" style="border-color: rgba(255, 255, 255, 0.05)">
                                        <p class="mb-0">/100-best-themes...all-time/</p>
                                        <p class="mb-0">1</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right bg-transparent border-top" style="border-color: rgba(255, 255, 255, 0.15) !important"><a class="text-white" href="#!">Real-time report<span class="fa fa-chevron-right ml-1 fs--1"></span></a></div>
                        </div>
                    </div>
                    <div class="col-lg-8 pl-lg-2">
                        <div class="card h-100 mt-3 mt-lg-0">
                            <div class="card-header bg-light d-flex justify-content-between">
                                <h5 class="mb-0">Active users</h5>
                                <div class="dropdown text-sans-serif"><button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none" type="button" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                                    <div class="dropdown-menu dropdown-menu-right border py-0">
                                        <div class="bg-white py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item" href="#!">Move</a><a class="dropdown-item" href="#!">Resize</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item text-warning" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body map-parent">
                                <div class="vmap" style="height: 1px;" data-options="{&quot;map&quot;:&quot;world_en&quot;}"></div>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="row justify-content-between">
                                    <div class="col-auto"><select class="custom-select custom-select-sm">
                                            <option value="week" selected="selected">Last 7 days</option>
                                            <option value="month">Last month</option>
                                            <option value="year">Last year</option>
                                        </select></div>
                                    <div class="col-auto"><a class="btn btn-falcon-default btn-sm" href="#!"><span class="d-none d-sm-inline-block mr-1">Location</span>overview<span class="fa fa-chevron-right ml-1 fs--1"></span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('../app/partials/footer.php'); ?>
            </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php include('../app/partials/scripts.php'); ?>
</body>

</html>