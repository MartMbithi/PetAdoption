 <!-- Driver Register Modals -->
 <div class="modal fade" id="driver_modal" tabindex="-1" role="dialog">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="largeModalLabel">Create Driver Account</h4>
             </div>

             <form method="post" enctype="multipart/form-data">
                 <div class="modal-body">
                     <fieldset class="border border-primary p-2">
                         <legend class="w-auto text-primary font-weight-light"> Fill All Required Fields</legend>
                         <div class="row clearfix">
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Full Name</label>
                                     <div class="form-line">
                                         <input type="text" name="driver_first_name" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Last Name</label>
                                     <div class="form-line">
                                         <input type="text" name="driver_other_names" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Phone Number</label>
                                     <div class="form-line">
                                         <input type="text" name="driver_mobile_no" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Email</label>
                                     <div class="form-line">
                                         <input type="text" name="driver_email" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label>Vehicle Class Specialized</label>
                                     <div class="form-line">
                                         <select class="form-control show-tick" name="driver_driving_class_id">
                                             <option>Select Vehicle Class</option>
                                             <?php
                                                $ret = "SELECT * FROM driving_classes";
                                                $stmt = $mysqli->prepare($ret);
                                                $stmt->execute(); //ok
                                                $res = $stmt->get_result();
                                                while ($class = $res->fetch_object()) {
                                                ?>
                                                 <option value="<?php echo $class->driving_class_id; ?>"><?php echo $class->driving_class_name; ?></option>
                                             <?php
                                                } ?>
                                         </select>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label>Login Password</label>
                                     <div class="form-line">
                                         <input type="password" name="new_password" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label>Confirm Login Password</label>
                                     <div class="form-line">
                                         <input type="password" name="confirm_password" required class="form-control" />
                                     </div>
                                 </div>
                             </div>

                             <div class="col-sm-12">
                                 <div class="form-group">
                                     <label>Passport Sized Image</label>
                                     <div class="input-group">
                                         <div class="custom-file">
                                             <input type="file" required name="driver_image" accept=".png, .jpeg, .jpg" class="custom-file-input" id="exampleInputFile">
                                             <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </fieldset>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" name="Driver_Sign_In" class="btn btn-link waves-effect">CREATE ACCOUNT</button>
                     <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- End Modal -->

 <!-- Customer Register Modals -->
 <div class="modal fade" id="customer_modal" tabindex="-1" role="dialog">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="largeModalLabel">Create Customer Account</h4>
             </div>

             <form method="post">
                 <div class="modal-body">
                     <fieldset class="border border-primary p-2">
                         <legend class="w-auto text-primary font-weight-light"> Fill All Required Fields</legend>
                         <div class="row clearfix">
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Full Name</label>
                                     <div class="form-line">
                                         <input type="text" name="customer_first_name" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Last Name</label>
                                     <div class="form-line">
                                         <input type="text" name="customer_other_names" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Phone Number</label>
                                     <div class="form-line">
                                         <input type="text" name="customer_mobile_no" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Email</label>
                                     <div class="form-line">
                                         <input type="text" name="customer_email" required class="form-control" />
                                     </div>
                                 </div>
                             </div>

                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Login Password</label>
                                     <div class="form-line">
                                         <input type="password" name="new_password" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                     <label>Confirm Login Password</label>
                                     <div class="form-line">
                                         <input type="password" name="confirm_password" required class="form-control" />
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </fieldset>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" name="Customer_Sign_In" class="btn btn-link waves-effect">CREATE ACCOUNT</button>
                     <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- End Modal -->