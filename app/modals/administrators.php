<!-- Manage Farmer Modals -->
<div class="modal fade" id="update_<?php echo $admins->login_id; ?>">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Administrator Account - Fill All Required Fields </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Login Email</label>
                            <input type="hidden" value="<?php echo $admins->login_id; ?>" name="login_id" required class="form-control">
                            <input type="email" value="<?php echo $admins->login_email; ?>" name="login_email" required class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>New Password</label>
                            <input type="text" name="new_password" required class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" required class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="text-right">
                        <button name="Update_Administrator" class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $admins->login_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body text-center ">
                    <h4 class="text-danger">
                        Delete <?php echo  $admins->login_email; ?> Account?
                    </h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="login_id" value="<?php echo $admins->login_id; ?>">
                    <button type="button" class="text-center btn btn-success" data-dismiss="modal"><i class="fas fa-check"></i> No</button>
                    <button type="submit" class="text-center btn btn-danger" name="Delete_Administrator"><i class="fas fa-trash"></i> Yes Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>