<footer class="main-footer text-center">
    <strong>Copyright &copy; 2021 - <?php echo date('Y'); ?>. Pet Adoption System.
        All rights reserved.
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
                <button type="button" class="text-center btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-check"></i> No</button>
                <a class="text-center btn btn-outline-danger" href="logout"><i class="fas fa-power-off"></i> Yes, Log Out</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->