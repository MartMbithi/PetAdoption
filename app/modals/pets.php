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
                    <div class="form-row">
                        <div class="form-group col-8">
                            <label>Select Pet Adopter</label>
                            <div class="input-group mb-3">
                                <select class="form-control" required type="text" name="pet_adoption_adopter_id">
                                    <option>Select New Pet Owner</option>
                                    <?php
                                    $adopter_ret = "SELECT * FROM  adopter";
                                    $adopter_stmt = $mysqli->prepare($adopter_ret);
                                    $adopter_stmt->execute(); //ok
                                    $adopter_res = $adopter_stmt->get_result();
                                    while ($adopters = $adopter_res->fetch_object()) {
                                    ?>
                                        <option><?php echo $adopters->adopter_full_name; ?></option>
                                    <?php
                                    } ?>
                                </select>
                                <input class="form-control" value="<?php echo $pets->pet_id; ?>" required type="hidden" name="pet_adoption_pet_id">
                                <input class="form-control" value="<?php echo $pets->pet_id; ?>" required type="hidden" name="pet_adoption_pet_id">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-user-md"></span>
                                    </div>
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


<!-- Modals -->
<div class="modal fade" id="update_<?php echo $pets->pet_id; ?>">
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
                        <div class="form-group col-8">
                            <label>Name</label>
                            <div class="input-group mb-3">
                                <input class="form-control" value="<?php echo $pets->pet_name; ?>" required type="text" name="pet_name">
                                <input class="form-control" value="<?php echo $pets->pet_id; ?>" required type="hidden" name="pet_id">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-paw"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label>Age</label>
                            <div class="input-group mb-3">
                                <input class="form-control" required value="<?php echo $pets->pet_age; ?>" type="text" name="pet_age">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Breed</label>
                            <div class="input-group mb-3">
                                <input class="form-control" value="<?php echo $pets->pet_breed; ?>" required type="text" name="pet_breed">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-venus-mars"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Health Status</label>
                            <div class="input-group mb-3">
                                <select class="form-control" required type="text" name="pet_health_status">
                                    <?php if ($pets->pet_health_status == 'Healthy') { ?>
                                        <option>Healthy</option>
                                        <option>Ill</option>
                                    <?php } else { ?>
                                        <option>Ill</option>
                                        <option>Healthy</option>
                                    <?php } ?>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-capsules"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline-primary mt-3" type="submit" name="Update_Pet" name="submit">
                            <i class="fas fa-cat"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $pets->pet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        Delete <?php echo  $pets->pet_name; ?> Details
                    </h4>
                    <br>
                    <!-- Hide This -->
                    <input type="hidden" name="pet_id" value="<?php echo $pets->pet_id; ?>">
                    <button type="button" class="text-center btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-check"></i> No</button>
                    <button type="submit" class="text-center btn btn-outline-danger" name="Delete_Pet"><i class="fas fa-trash"></i> Yes Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>