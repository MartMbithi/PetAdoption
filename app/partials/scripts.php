<script src="../assets/app_js/jquery.min.js"></script>
<script src="../assets/app_js/popper.min.js"></script>
<script src="../assets/app_js/bootstrap.js"></script>
<script src="../assets/app_js/plugins.js"></script>
<script src="../assets/plugins/stickyfilljs/stickyfill.min.js"></script>
<script src="../assets/plugins/sticky-kit/sticky-kit.min.js"></script>
<script src="../assets/plugins/is_js/is.min.js"></script>
<script src="../assets/app_js/theme.js"></script>
<!-- Load Alerts -->
<script src="../assets/plugins/sweetalerts/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>
<!-- Init Sweet Alerts -->
<?php if (isset($success)) { ?>
    <!-- Pop Success Alert -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            type: 'success',
            title: '<?php echo $success; ?>',
        })
    </script>

<?php }
if (isset($err)) { ?>
    <script>
        /* Pop Error Message */
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            type: 'error',
            title: '<?php echo $err; ?>',
        })
    </script>

<?php }
if (isset($info)) { ?>
    <script>
        /* Pop Warning  */
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            type: 'info',
            title: '<?php echo $info; ?>',
        })
    </script>

<?php }
?>
<script>
    /* Stop Double Resubmission */
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>