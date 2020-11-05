
<div class="portfolio-modal modal fade" id="vendorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h4 id="labelServiceName" class="text-uppercase"></h4>
                            <p class="item-intro text-muted"></p>
                            <!-- <img class="img-fluid d-block mx-auto"  src="<?php echo base_url(); ?><?php echo $vendor->service_img ? $vendor->service_img : " "?>" alt=""> -->
                            <p id ="labelServiceDesc"></p>
                            <ul class="list-inline">
                                <li><b>Vendor Type : </b><span id="labelVendorType"></span></li>
                                <li><b>Event Type : </b><span id="labelEventType"></span></li>
                                <li ><b>Price : </b><span id="labelServicePrice"></span> ৳</li>
                            </ul>
                            <?php if($user_type == 1){?>
                            <div class="">
                                <h6 class="text-warning">Budget Status </h6><hr>
                                <?php
                                    foreach ($event_list_budget as $key => $value) {
                                ?>
                                    <strong>
                                        <?php echo $value->event_category;?> -
                                        <?php echo $value->event_type;?> -
                                        <?php echo $value->event_name;?> -
                                        <?php echo (($value->event_budget)-($value->service_amount));?> ৳ <span class="text-danger">(Budget Left)</span>
                                    </strong><br>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="">
                                <hr><h5 class="text-success">Book This Vendor for Your Event</h5><hr>
                                <form id="frm_client_book_service" data-parsley-validate class="form-horizontal form-label-left">
                                    <div class="form-row">
                                        <?php
                                            if (empty($event_list) || $event_list == null) {
                                                echo "Sorry user! You must add a event to book this vendor";
                                            }else{
                                        ?>
                                        <label for="event" class="form-contro col-md-4">Select Event <i class="fa fa-asterisk required"></i></label>
                                        <select name="event_id" class="form-control event col-md-8" id="event">
                                            <option value="">Please Select</option>
                                            <?php
                                            foreach($event_list as $event){
                                               echo "<option value='".$event->event_id."'>".$event->event_category." - ".$event->event_type." - ".$event->event_name."</option>";
                                            }
                                            ?>
                                        </select>
                                        <p class="error_input" id="label_error_event"></p>
                                        <?php } ?>
                                    </div>
                                    <br>
                                    <div class="form-row float-right" >
                                        <?php
                                            if (!empty($event_list) || $event_list != null) {
                                        ?>
                                        <button type="button" id="btn_add_event_service"  class="btn btn-success btn_add_event_service pull-right"
                                        data-vendor-id ="<?php echo $vendor->vendor_id ? $vendor->vendor_id : " "?>" data-service-id ="<?php echo $vendor->id ? $vendor->id : " "?>">
                                            <i style="display:none" class="fa loader_icon fa-spinner fa-spin"></i> <i class="fa fa-save"></i> Create Service
                                        </button>
                                        <?php }?>
                                    </div>
                                </form>
                            </div>
                            <?php } ?>
                            <button class="btn btn-primary" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i>
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
