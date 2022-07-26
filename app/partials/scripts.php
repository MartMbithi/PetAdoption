<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.js"></script>

<!-- PAGE SCRIPTS -->
<script src="../assets/js/pages/dashboard2.js"></script>
<!-- SweetAlert2 -->
<script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>
<!-- Init Sweet Alerts -->
<?php if (isset($success)) { ?>
    <!-- Pop Success Alert -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-left',
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