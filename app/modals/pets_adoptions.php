<!-- Modals -->
<div class="modal fade" id="update_<?php echo $adoption->pet_adoption_id; ?>">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Pet Owner Account - Fill All Required Fields </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $adoption->pet_adoption_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        Delete <?php echo  $adoption->pet_name; ?> Adoption Details
                    </h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="pet_adoption_id" value="<?php echo $adoption->pet_adoption_id; ?>">
                    <button type="button" class="text-center btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-check"></i> No</button>
                    <button type="submit" class="text-center btn btn-outline-danger" name="Delete_Pet"><i class="fas fa-trash"></i> Yes Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>