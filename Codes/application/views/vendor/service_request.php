
<div class="tab-content">
    <hr><h4>View all Vendor Services Request</h4><hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="40%">Service Name </th>
                    <th width="10%">Client Name </th>
                    <th width="10%">Booking Date</th>
                    <th width="10%">Event Details</th>
                    <th width="10%">Payment Status</th>
                    <th class="text-center" width="10%">Payment Method</th>
                    <th class="text-center" width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($service_request_list)){
                foreach ($service_request_list as $key => $service_request) {
                    ?>
                    <tr>
                        <td><?php echo $service_request->service_name ? $service_request->service_name : " "?></td>
                        <td>
                            <?php echo $service_request->first_name ? $service_request->first_name : " "?>
                            <?php echo $service_request->last_name ? $service_request->last_name : " "?>
                        </td>
                        <td><?php echo $service_request->event_date ? $service_request->event_date : " "?></td>
                        <td>
                            <a class="edit_service_info btn-info btn-sm" href="<?php echo base_url(); ?>vendor/service_request/event_details/<?php echo $service_request->event_id; ?>" style="cursor: pointer" title="View event Info" >
                                <i class="fa fa-eye "></i>
                                View
                            </a>
                        </td>
                        <td>
                            <?php
                                if($service_request->status == 0){
                            ?>
                                    <span  class="text-warning">Booking Not confirm yet</span>
                            <?php
                                } elseif ($service_request->status == 2){
                            ?>
                                    <span  class="text-danger">Request Cancel</span>
                            <?php
                                }else{
                                    if ($service_request->payment_status == 0) {
                            ?>
                                    <span class="text-danger">Payment Not Yet</span>
                            <?php
                                    } else {
                            ?>
                                    <span class="text-success">Payment Done</span>
                            <?php
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if($service_request->status == 0){ ?>
                                    <span  class="text-warning">Booking Not confirm yet</span>
                            <?php
                                } elseif ($service_request->status == 2){ ?>
                                    <span  class="text-danger">Request Cancel</span>
                            <?php
                                } else {
                                    if ($service_request->payment_method == 1) {
                            ?>
                                        <span  class="text-success">Hand cash</span>
                            <?php
                                    } elseif ($service_request->payment_method == 2) {
                            ?>
                                    <span  class="text-success">Online Payment</span>
                            <?php
                                    }else {
                            ?>
                                    <span  class="text-info">Payment Method not select yet</span>
                            <?php
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php if($service_request->status == 0){ ?>
                                <span class="btn_accepted_request btn-success btn-sm" style="cursor: pointer" title="Accepted this event requested" data-status-id="1"
                                data-booking-id="<?php echo $service_request->booking_service_id;?>"
                                data-event-id="<?php echo $service_request->event_id;?>"
                                data-client-id="<?php echo $service_request->client_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fa fa-check-circle"></i>
                                </span>
                                <span class="btn_accepted_request btn-danger btn-sm" style="cursor: pointer" title="Rejected this event requested" data-status-id="2"
                                data-booking-id="<?php echo $service_request->booking_service_id;?>"
                                data-event-id="<?php echo $service_request->event_id;?>"
                                data-client-id="<?php echo $service_request->client_id;?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fa fa-ban"></i>
                                </span>
                            <?php }elseif ($service_request->status == 1) {?>
                                <span  class="text-success">
                                    Already Accepted
                                </span>
                            <?php }elseif ($service_request->status == 2) {?>
                                <span  class="text-danger">
                                    Already Rejected
                                </span>
                            <?php }?>
                        </td>
                    </tr>
                    <?php
                    }
                } else{
                ?>
                    <tr><td colspan="5">No Result Found</td></tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
