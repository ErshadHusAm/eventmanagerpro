<!-- The Modal -->
<div class="modal" id="update_event_info_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Event Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <!-- Modal body -->
            <div class="modal-body" id="update_event_info_modal_content">
                <form id="frm_upd_event_details" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_event_name">Event Name <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_event_name" name="event_name">
                                    <p class="error_input" id="label_error_upd_event_name"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="ddl_upd_event_category">Event Category <i class="fa fa-asterisk required"></i></label>
                                    <select name="event_category" class="form-control is_required" id="ddl_upd_event_category">
                                        <option value=""  >Select category here..</option>
                                        <?php
                                        foreach($event_category_list as $event_category){
                                            echo "<option value='".$event_category->event_category_id."'>".$event_category->event_category."</option>";
                                        }
                                        ?>
                                    </select>
                                    <p class="error_input" id="label_error_upd_event_category"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="ddl_upd_event_type">Event Type <i class="fa fa-asterisk required"></i></label>
                                    <select name="event_type" class="form-control is_required" id="ddl_upd_event_type">
                                        <option value="" >Select type here..</option>
                                        <?php
                                        foreach($event_type_list as $event_type){
                                            echo "<option value='".$event_type->event_type_id."'>".$event_type->event_type."</option>";
                                        }
                                        ?>
                                    </select>
                                    <p class="error_input" id="label_error_upd_event_type"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="ddl_upd_event_loc">Event Location <i class="fa fa-asterisk required"></i></label>
                                    <select name="event_loc" class="form-control is_required" id="ddl_upd_event_loc">
                                        <option value="" >Select location here..</option>
                                        <?php
                                        foreach($staff_loc_list as $staff_loc){
                                            echo "<option value='".$staff_loc->staff_loc_id."'>".$staff_loc->staff_loc."</option>";
                                        }
                                        ?>
                                    </select>
                                    <p class="error_input" id="label_error_upd_event_loc"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_event_city">Event City<i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_event_city" name="event_city">
                                    <p class="error_input" id="label_error_upd_event_city"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_event_budget">Event Budget <i class="fa fa-asterisk required"></i></label>
                                    <input type="text" class="form-control" id="txt_upd_event_budget" name="event_budget">
                                    <p class="error_input" id="label_error_upd_event_budget"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="txt_upd_event_date">Event date <i class="fa fa-asterisk required"></i></label>
                                    <input type="date" class="form-control" id="txt_upd_event_date" name="event_date" placeholder="Event date here" required="">
                                    <p class="error_input" id="label_error_upd_event_date"></p>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" id="btn_update_event_details"  class="btn btn-warning btn_update_event_details float-right" >
                                        <i style="display:none" class="fa loader_faq fa-spinner fa-spin"></i> Update
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
