<div class="tab-content">
    <hr><h4>View all accepted Vendor Services</h4><hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="30%">Event Name </th>
                    <th width="30%">Service Name </th>
                    <th width="5%">Service Price </th>
                    <th width="20%">Payment Method</th>
                    <th class="text-center" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($payment_details)){
                foreach ($payment_details as $key => $payment) {
                    ?>
                    <tr>
                        <td><?php echo $payment->event_name ? $payment->event_name : " "?></td>
                        <td><?php echo $payment->service_name ? $payment->service_name : " "?></td>
                        <td><?php echo $payment->service_price ? $payment->service_price : " "?></td>
                        <?php
                            if ($payment->payment_status == 0) {
                        ?>
                        <form id="frm_payment_service_<?php echo $payment->booking_service_id?>" data-parsley-validate class="form-horizontal form-label-left">
                            <td>
                                <select name="payment_method" class="form-control event col-md-8" id="payment_method">
                                    <option value="">Please Select</option>
                                    <option value="1">Hand Cash</option>
                                    <option value="2">Online</option>
                                </select>
                                <p class="error_input" id="label_error_payment_method"></p>
                            </td>
                            <td><button type="button" id="btn_make_paymet"
                                class="btn btn-success btn_make_paymet btn-sm"
                                data-event-id="<?php echo $payment->event_id?>"
                                data-vendor-id="<?php echo $payment->vendor_id?>"
                                data-client-id="<?php echo $payment->client_id?>"
                                data-booking-service-id="<?php echo $payment->booking_service_id?>"

                                >
                                <i style="display:none" class="fa loader_icon fa-spinner fa-spin"></i>
                                <i class="fa fa-paper-plane"></i> Send Money
                                </button>
                            </td>
                        </form>
                        <?php
                            } else {
                        ?>
                        <td colspan="2">
                            <?php
                                if ($payment->payment_method == 1) {
                                    echo "Hand Cash Payment";
                                } elseif ($payment->payment_method == 2) {
                                    echo "Online Payment";
                                }
                            ?>
                        </td>
                        <?php
                            }
                        ?>
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
