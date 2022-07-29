<!-- Modals -->
<div class="modal fade" id="update_<?php echo $adopters->adopter_id; ?>">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Pet Owner Account - Fill All Required Fields </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label>Full Names</label>
                            <div class="input-group mb-3">
                                <input class="form-control" value="<?php echo $adopters->adopter_id; ?>" required type="hidden" name="adopter_id">
                                <input class="form-control" value="<?php echo $adopters->adopter_full_name; ?>" required type="text" name="adopter_full_name">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-user-tag"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Contacts</label>
                            <div class="input-group mb-3">
                                <input class="form-control" value="<?php echo $adopters->adoper_contacts; ?>" required type="text" name="adoper_contacts">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-phone"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Email Address</label>
                            <div class="input-group mb-3">
                                <input class="form-control" value="<?php echo $adopters->adopter_email; ?>" required type="text" name="adopter_email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label>Address</label>
                            <div class="input-group mb-3">
                                <input class="form-control" value="<?php echo $adopters->adopter_location; ?>" required type="text" name="adopter_location">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-map-marker-alt"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline-primary mt-3 " type="submit" name="Update_Pet_Adopter" name="submit">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $adopters->adopter_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        Delete <?php echo  $adopters->adopter_full_name; ?> Account?
                    </h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="pet_owner_login_id" value="<?php echo $adopters->pet_owner_login_id; ?>">
                    <button type="button" class="text-center btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-check"></i> No</button>
                    <button type="submit" class="text-center btn btn-outline-danger" name="Delete_Pet_Owner"><i class="fas fa-trash"></i> Yes Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>