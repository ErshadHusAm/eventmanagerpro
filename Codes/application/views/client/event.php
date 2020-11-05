<div class="row">
    <div class="col-md-12">
        <h4>Create your Special Event</h4><hr>
        <form id="frm_event" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="event_name">Event Name <i class="fa fa-asterisk required"></i></label>
                    <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Event name here" required="">
                    <p class="error_input" id="label_error_event_name"></p>
                </div>
                <div class="form-group col-md-6">
                    <label for="event_budget">Event budget <i class="fa fa-asterisk required"></i></label>
                    <input type="text" class="form-control" id="event_budget" name="event_budget" placeholder="Event budget here" required="">
                    <p class="error_input" id="label_error_event_budget"></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="event_category">Event Category <i class="fa fa-asterisk required"></i></label>
                    <select id="event_category" class="form-control" required="" name="event_category">
                        <option value=""  >Select category here..</option>
                        <?php
                        foreach($event_category_list as $event_category){
                            echo "<option value='".$event_category->event_category_id."'>".$event_category->event_category."</option>";
                        }
                        ?>
                    </select>
                    <p class="error_input" id="label_error_event_category"></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="event_type">Event type <i class="fa fa-asterisk required"></i></label>
                    <select id="event_type" class="form-control" required="" name="event_type">
                        <option value="" >Select type here..</option>
                        <?php
                        foreach($event_type_list as $event_type){
                            echo "<option value='".$event_type->event_type_id."'>".$event_type->event_type."</option>";
                        }
                        ?>
                    </select>
                    <p class="error_input" id="label_error_event_type"></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="event_loc">Event location <i class="fa fa-asterisk required"></i></label>
                    <select id="event_loc" class="form-control " required="" name="event_loc">
                        <option value="" >Select location here..</option>
                        <?php
                        foreach($staff_loc_list as $staff_loc){
                            echo "<option value='".$staff_loc->staff_loc_id."'>".$staff_loc->staff_loc."</option>";
                        }
                        ?>
                    </select>
                    <p class="error_input" id="label_error_event_loc"></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="event_city">Event city <i class="fa fa-asterisk required"></i></label>
                    <input type="text" class="form-control" id="event_city" name="event_city" placeholder="Event city here" required="">
                    <p class="error_input" id="label_error_event_city"></p>
                </div>
                <div class="form-group col-md-6">
                    <label for="event_date">Event date <i class="fa fa-asterisk required"></i></label>
                    <input type="date" class="form-control" id="event_date" name="event_date" placeholder="Event date here" required="">
                    <p class="error_input" id="label_error_event_date"></p>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label  for="policy_agreed"  >
                        <input class="form-check-input " value="1" type="checkbox" id="chk" name="chk">
                        I agree that I have read and accepted the <a href="#"> Terms of use</a>
                    </label>
                    <p class="error_input" id="label_error_policy_agreed"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" id="btn_save_event"  class="btn btn-success btn_save_event float-right" >
                        <i style="display:none" class="fa loader_icon fa-spinner fa-spin"></i> <i class="fa fa-save"></i> Create Event
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <hr><h4>View all events</h4><hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="15%">Event Name</th>
                        <th width="8%">Category</th>
                        <th width="9%">Type</th>
                        <th width="10%">City</th>
                        <th width="10%">Location</th>
                        <th width="10%">Budget</th>
                        <th width="13%">Date</th>
                        <th width="10%">Status</th>
                        <th class="text-center" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($event_list as $key => $event) {

                    ?>
                    <tr>
                        <td><?php echo $event->event_name ? $event->event_name : " "?></td>
                        <td><?php echo $event->event_category ? $event->event_category : " "?></td>
                        <td><?php echo $event->event_type ? $event->event_type : " "?></td>
                        <td><?php echo $event->event_city ? $event->event_city : " "?></td>
                        <td><?php echo $event->staff_loc ? $event->staff_loc : " "?></td>
                        <td><?php echo $event->event_budget ? $event->event_budget : " "?> ৳</td>
                        <td><?php echo $event->event_date ? $event->event_date : " "?></td>
                        <td>
                            <?php if($event->status == 0){ ?>
                                <b class="text-success">Running</b>
                            <?php }elseif ($event->status == 1) {?>
                                <b class="text-danger">Closed</b>
                            <?php }elseif ($event->status == 2) {?>
                                <b class="text-info">Pending</b>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php if($event->status == 0){ ?>
                                <span class="btn_change_status btn-info btn-sm" style="cursor: pointer" title="Pending this event"
                                data-status-id="2" data-event-id="<?php echo $event->event_id;?>" data-client-id="<?php echo $event->client_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fa fa-ban"></i>
                                </span>
                                <span class="btn_delete_event btn-danger btn-sm" style="cursor: pointer" title="Delete event"
                                data-event-id="<?php echo $event->event_id;?>" data-client-id="<?php echo $event->client_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fa fa-trash"></i>
                                </span>
                                <span class="btn_change_status btn-warning btn-sm" style="cursor: pointer" title="Close event"
                                data-status-id="1" data-event-id="<?php echo $event->event_id;?>" data-client-id="<?php echo $event->client_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fa fa-arrow-left"></i>
                                </span>
                            <?php }elseif ($event->status == 1) {?>
                                <span class="btn_delete_event btn-danger btn-sm" style="cursor: pointer" title="Delete event"
                                data-event-id="<?php echo $event->event_id;?>" data-client-id="<?php echo $event->client_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fa fa-trash"></i>
                                </span>
                            <?php }elseif ($event->status == 2) {?>
                                <span class="btn_change_status btn-success btn-sm" style="cursor: pointer" title="Make running event"
                                data-status-id="0" data-event-id="<?php echo $event->event_id;?>" data-client-id="<?php echo $event->client_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="btn_edit_event btn-warning btn-sm" style="cursor: pointer" title="Edit event"
                                data-event-id="<?php echo $event->event_id;?>" data-client-id="<?php echo $event->client_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fa fa-edit"></i>
                                </span>
                            <?php } ?>

                        </td>
                    </tr>
                    <?php
                    }?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php include "support_modal/modal_update_event.php"; ?>
