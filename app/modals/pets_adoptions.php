<!-- Modals -->
<div class="modal fade" id="update_<?php echo $adoption->pet_adoption_id; ?>">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Pet Adoptions - Fill All Required Fields </h4>
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
                                    <option value="<?php echo $adoption->adopter_id; ?>"><?php echo $adoption->adopter_full_name; ?></option>
                                    <?php
                                    $adopter_ret = "SELECT * FROM  adopter";
                                    $adopter_stmt = $mysqli->prepare($adopter_ret);
                                    $adopter_stmt->execute(); //ok
                                    $adopter_res = $adopter_stmt->get_result();
                                    while ($adopters = $adopter_res->fetch_object()) {
                                    ?>
                                        <option value="<?php echo $adopters->adopter_id; ?>"><?php echo $adopters->adopter_full_name; ?></option>
                                    <?php
                                    } ?>
                                </select>
                                <input class="form-control" value="<?php echo $adoption->pet_adoption_id; ?>" required type="hidden" name="pet_adoption_id">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-user-md"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-4">
                            <label>Date Adopted</label>
                            <div class="input-group mb-3">
                                <input class="form-control" value="<?php echo date('d M Y', strtotime($adoption->pet_adoption_date_adopted)); ?>" required type="text" name="pet_adoption_date_adopted">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="text-primary fas fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline-primary mt-3" type="submit" name="Update_Pet_Adoption" name="submit">
                            <i class="fas fa-cat"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="feedback_<?php echo $adoption->pet_adoption_id; ?>">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adoption Feedback</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $fetch_records_sql = mysqli_query(
                    $mysqli,
                    "SELECT * FROM pet_adoption_feedback  af
                    INNER JOIN pet_adoption pa ON pa.pet_adoption_id = af.feedback_pet_adoption_id
                    INNER JOIN pets p ON p.pet_id = pa.pet_adoption_pet_id
                    INNER JOIN pet_owner po ON po.pet_owner_id = p.pet_pet_owner
                    INNER JOIN adopter a ON a.adopter_id = pa.pet_adoption_adopter_id
                    WHERE af.feedback_pet_adoption_id = '{$adoption->pet_adoption_id}'"
                );
                if (mysqli_num_rows($fetch_records_sql) > 0) {
                    $cnt =  1;
                    while ($rows = mysqli_fetch_array($fetch_records_sql)) {
                ?>
                        <h5 class="text-primary"><?php echo $rows['feedback_title']; ?></h5>
                        <p>
                            <?php echo $rows['feedback_details']; ?>
                            <br>
                            <small>Posted on <?php echo date('d M Y g:ia', strtotime($rows['feedback_date'])); ?></small>
                        </p>

                    <?php }
                } else { ?>
                    <h5 class="text-center text-danger"> Oops!, there is no feedback available for this adoption record.</h5>
                <?php } ?>
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
                    <input type="hidden" name="pet_id" value="<?php echo $adoption->pet_adoption_pet_id; ?>">
                    <button type="button" class="text-center btn btn-outline-primary" data-dismiss="modal"><i class="fas fa-check"></i> No</button>
                    <button type="submit" class="text-center btn btn-outline-danger" name="Delete_Pet_Adoption"><i class="fas fa-trash"></i> Yes Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>