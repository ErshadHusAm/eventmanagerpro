<!-- The Modal -->
<div class="modal" id="update_decoration_info_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Decoration Services Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <!-- Modal body -->
            <div class="modal-body" id="update_decoration_info_modal_content">
                <form id="frm_upd_decoration" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_decoration_name">Decoration Title <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_decoration_name" name="decoration_name">
                                    <p class="error_input" id="label_error_upd_decoration_name"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label  for="policy_agreed"  class="form-control btn-danger">
                                        <input class="form-check-input " value="1" type="checkbox" id="chk_img" name="chk_img"> Change Current Image
                                    </label>
                                    <label for="decoration_img" >Decoration Image </label>
                                    <input class="form-control" type="file" id="decoration_img"  name="decoration_img">
                                    <p class="error_input" id="label_error_upd_decoration_img"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_decoration_price">Decoration Price <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_decoration_price" name="decoration_price">
                                    <p class="error_input" id="label_error_upd_decoration_price"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_decoration_description">Decoration Description <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_decoration_description" name="decoration_description">
                                    <p class="error_input" id="label_error_upd_decoration_description"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" id="btn_update_decoration"  class="btn btn-warning btn_update_decoration pull-right" >
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
