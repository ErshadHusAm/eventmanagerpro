<!-- The Modal -->
<div class="modal" id="update_company_info_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Company Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <!-- Modal body -->
            <div class="modal-body" id="update_company_info_modal_content">
                <form id="frm_upd_company" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_company_name">Company Name <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_company_name" name="company_name">
                                    <p class="error_input" id="label_error_upd_company_name"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label  for="txt_upd_image"  class="form-control btn-danger">
                                        <input class="form-check-input " value="1" type="checkbox" id="chk_img" name="chk_img"> Change Current Profile Picture
                                    </label>
                                    <label for="txt_upd_image" >Company logo</label>
                                    <input class="form-control" type="file" id="img"  name="image">
                                    <p class="error_input" id="label_error_upd_img"></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_phn_num">Mobile No <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_phn_num" name="phn_num">
                                    <p class="error_input" id="label_error_upd_phn_num"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_city">City <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_city" name="city">
                                    <p class="error_input" id="label_error_upd_city"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_address">Full Address <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_address" name="address">
                                    <p class="error_input" id="label_error_upd_address"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" id="btn_update_company"  class="btn btn-warning btn_update_company pull-right" >
                                        <i style="display:none" class="fa loader_faq fa-spinner fa-spin"></i> Update Info
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
