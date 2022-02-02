<form id="add_user_form" method="post" action="{{ route('add-user') }}" data-form="user_form">
    <div class="modal" id="addusermodal" tabindex="-1" aria-labelledby="addusermodalLable" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addusermodalLable">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Enter your name">
                        <input id="recordid" name="id" type="hidden" value="">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Enter your email address">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Mobile number</label>
                        <input id="mobileno" type="text" class="form-control" name="mobileno" placeholder="Enter your mobile number">
                        <span class="text-danger error-text mobileno_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Upload profile picture</label>
                        <input id="profilepic" class="form-control" type="file" name="profilepic">
                        <span class="text-danger error-text profilepic_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select id="status" class="form-control" name="status">
                            <option selected value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                        <span class="text-danger error-text status_error"></span>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>