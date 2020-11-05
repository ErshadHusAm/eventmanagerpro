<!-- The Modal -->
<div class="modal" id="update_service_info_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update your service Informations</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <!-- Modal body -->
            <div class="modal-body" id="update_service_info_modal_content">
                <form id="frm_upd_service" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_service_name">Service Title <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_service_name" name="service_name">
                                    <p class="error_input" id="label_error_upd_service_name"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label  for="policy_agreed"  class="form-control btn-danger">
                                        <input class="form-check-input " value="1" type="checkbox" id="chk_img" name="chk_img"> Change Current Image
                                    </label>
                                    <label for="service_img" >Service Image </label>
                                    <input class="form-control" type="file" id="service_img"  name="service_img">
                                    <p class="error_input" id="label_error_upd_service_img"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_service_price">Service Price <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_service_price" name="service_price">
                                    <p class="error_input" id="label_error_upd_service_price"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_service_desc">Service Description <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_service_desc" name="service_desc">
                                    <p class="error_input" id="label_error_upd_service_description"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" id="btn_update_service"  class="btn btn-warning btn_update_service pull-right" >
                                        <i style="display:none" class="fa loader_faq fa-spinner fa-spin"></i> UPDATE
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
