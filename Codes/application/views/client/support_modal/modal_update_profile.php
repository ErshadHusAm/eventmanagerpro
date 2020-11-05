<!-- The Modal -->
<div class="modal" id="update_profile_info_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Profile Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <!-- Modal body -->
            <div class="modal-body" id="update_profile_info_modal_content">
                <form id="frm_upd_profile" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_first_name">First Name <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_first_name" name="first_name">
                                    <p class="error_input" id="label_error_upd_first_name"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_last_name">Last Name <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_last_name" name="last_name">
                                    <p class="error_input" id="label_error_upd_last_name"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label  for="txt_upd_image"  class="form-control btn-danger">
                                        <input class="form-check-input " value="1" type="checkbox" id="chk_img" name="chk_img"> Change Current Profile Picture
                                    </label>
                                    <label for="txt_upd_image" >Profile Picture</label>
                                    <input class="form-control" type="file" id="img"  name="image">
                                    <p class="error_input" id="label_error_upd_img"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="ddl_upd_gender">Gender <i class="fa fa-asterisk required"></i></label>
                                    <select name="gender" class="form-control is_required" id="ddl_upd_gender">
                                        <option value="">Please Select</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                    <p class="error_input" id="label_error_upd_gender"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_phn_number">Mobile No <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_phn_number" name="phn_number">
                                    <p class="error_input" id="label_error_upd_phn_number"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_address">Full Address <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_address" name="address">
                                    <p class="error_input" id="label_error_upd_address"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" id="btn_update_profile"  class="btn btn-warning btn_update_profile pull-right" >
                                        <i style="display:none" class="fa loader_faq fa-spinner fa-spin"></i> Update Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
