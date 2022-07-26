<footer class="main-footer">
    <strong>Copyright &copy; 2021 - <?php echo date('Y'); ?>. Pet Adoption System
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
</footer>

<!-- End Session Modal -->
<div class="modal fade" id="logout_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CONFIRM SESSION TERMINATION</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center ">
                <h4 class="text-danger">
                    Ready To Terminate Current Session And Logout ?
                </h4>
                <br>
                <button type="button" class="text-center btn btn-success" data-dismiss="modal"> No</button>
                <a class="text-center btn btn-danger" href="logout"> Yes, Log Out</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->