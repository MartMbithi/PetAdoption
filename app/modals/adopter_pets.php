<!-- Adopt Pet -->
<div class="modal fade" id="adopt_<?php echo $pets->pet_id; ?>">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adopt <?php echo $pets->pet_name; ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group col-12">
                        <label>Date Adopted</label>
                        <div class="input-group mb-3">
                            <input class="form-control" value="<?php echo $adopter_id; ?>" required type="hidden" name="pet_adoption_adopter_id">
                            <input class="form-control" value="<?php echo $pets->pet_id; ?>" required type="hidden" name="pet_adoption_pet_id">
                            <input class="form-control" required type="date" name="pet_adoption_date_adopted">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="text-primary fas fa-calendar"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline-primary mt-3" type="submit" name="Adopt_Pet" name="submit">
                            <i class="fas fa-cat"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>