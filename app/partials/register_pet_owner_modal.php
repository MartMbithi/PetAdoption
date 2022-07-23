<!-- Register Modal -->
<div class="modal fade" id="pet_owner" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg mt-6" role="document">
        <div class="modal-content border-0">
            <div class="modal-header px-5 text-white position-relative modal-shape-header">
                <div class="position-relative z-index-1">
                    <div>
                        <h4 class="mb-0 text-white" id="authentication-modal-label">Register Pet Owner Account</h4>
                        <p class="fs--1 mb-0">Fill all required values</p>
                    </div>
                </div><button class="close text-white position-absolute t-0 r-0 mt-1 mr-1" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body py-4 px-5">
                <form method="POST">
                    <div class="form-row">

                        <div class="form-group col-12">
                            <label for="modal-auth-name">Name</label>
                            <input class="form-control" name="user_full_name" required type="text" />
                        </div>
                        <div class="form-group col-6">
                            <label for="modal-auth-name">National ID Number</label>
                            <input class="form-control" name="user_nationalID" required type="text" />
                        </div>
                        <div class="form-group col-6">
                            <label for="modal-auth-name">KRA PIN Number</label>
                            <input class="form-control" name="user_KRA_Pin" required type="text" />
                        </div>
                        <div class="form-group col-6">
                            <label for="modal-auth-name">Phone Number</label>
                            <input class="form-control" name="user_phone" required type="text" />
                        </div>
                        <div class="form-group">
                            <label for="modal-auth-email">Email Address</label>
                            <input class="form-control" type="email" name="user_email" id="modal-auth-email" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="modal-auth-password">
                                Password
                            </label>
                            <input class="form-control" name="new_password" type="password" />
                        </div>
                        <div class="form-group col-6">
                            <label for="modal-auth-confirm-password">Confirm Password</label>
                            <input class="form-control" type="password" name="confirm_password" />
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary mt-3" type="submit" name="register">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Woohoo, you're reading this text in a modal!</p>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button><button class="btn btn-primary btn-sm" type="button">Save changes</button></div>
        </div>
    </div>
</div>