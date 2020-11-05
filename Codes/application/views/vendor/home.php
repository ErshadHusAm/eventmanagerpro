<div class="row">
    <div class="col-md-6">
        <div class="custom_card card" >
            <h5 class="card-header card-title">Company Details</h5>
            <div class="card-body">
                <small class="table-responsive ">
                    <table class="table table-striped card-text">
                        <thead>
                            <th>
                                <?php if ($vendor_details->image == null && empty($vendor_details->image)){?>
                                    <img src="<?php echo base_url(); ?>assets/img/company.png" width="90" height="80">
                                <?php }else{?>
                                    <img src="<?php echo base_url(); ?><?php echo $vendor_details->image ? $vendor_details->image : ""?>" width="80" height="80">
                                <?php } ?>
                            </th>
                            <th></th>
                            <th class="card_fa ">
                                <a class="btn_edit_company" title="Edit Company Info" style="cursor: pointer" data-vendor-id="<?php echo $vendor_details->vendor_id ? $vendor_details->vendor_id : " "?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fas fa-edit float-right "></i>
                                </a>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Company Name </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($vendor_details->company_name) ? $vendor_details->company_name : ""?></td>
                            </tr>
                            <tr>
                                <th>Company Type </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($vendor_details->vendor_name) ? $vendor_details->vendor_name : ""?></td>
                            </tr>
                            <tr>
                                <th>Email </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($vendor_details->email) ? $vendor_details->email : ""?></td>
                            </tr>
                            <tr>
                                <th>Phn No. </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($vendor_details->phn_num) ? $vendor_details->phn_num : ""?></td>
                            </tr>
                            <tr>
                                <th>City </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($vendor_details->city) ? $vendor_details->city : ""?></td>
                            </tr>
                            <tr>
                                <th>Full Address </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($vendor_details->address) ? $vendor_details->address : ""?></td>
                            </tr>
                            <tr class="bg-success">
                                <th>Successfull Event </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($vendor_details->sucessful_event) ? $vendor_details->sucessful_event : "0"?></td>
                            </tr>
                        </tbody>
                    </table>
                </small>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="custom_card card" >
            <h5 class="card-header card-title">Vendor Service Request</h5>
            <div class="card-body">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                foreach ($notification_details as $key => $notification) {
                                    if ($notification->flag == 1) {
                                        $alert_msg = 'alert-success';
                                        $msg = 'Congts! ';
                                    } elseif($notification->flag == 2) {
                                        $alert_msg = 'alert-danger';
                                        $msg = 'Sorry! ';
                                    } elseif($notification->flag == 3) {
                                        $alert_msg = 'alert-warning';
                                    } elseif($notification->flag == 4) {
                                        $alert_msg = 'alert-info';
                                    }

                            ?>
                            <div class="alert <?php echo $alert_msg; ?>">
                                <a href="<?php echo base_url(); ?>vendor/service_request/event_details/<?php echo $notification->event_id; ?>">
                                    <strong class="default"><?php echo $msg ;?></strong> <?php echo isset($notification->message) ? $notification->message : ""?>
                                </a>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "support_modal/modal_update_company.php"; ?>

<div class="row">
    <div class="col-md-4">
        <div class="custom_card card text-white bg-success mb-3" style="max-width: 18rem;">
            <h5 class="card-header card-title">Create event</h5>
            <div class="card-body">
                <small>
                    <p class="card-text">Create your upcoming event in few simple steps.</p>
                </small>
                <div class="card_fa"><a href=""><i class="fas fa-calendar-plus float-right"></i></a></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="custom_card card text-white bg-primary mb-3" style="max-width: 18rem;">
            <h5 class="card-header card-title">Manage events</h5>
            <div class="card-body">
                <small>
                    <p class="card-text">Create your upcoming event in few simple steps.</p>
                </small>
                <div class="card_fa"><a href=""><i class="fas fa-tasks float-right"></i></a></div>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="custom_card card text-white bg-danger mb-3" style="max-width: 18rem;">
            <h5 class="card-header card-title">Edit profile</h5>
            <div class="card-body">
                <small>
                    <p class="card-text">Create your upcoming event in few simple steps.</p>
                </small>
                <div class="card_fa"><a href=""><i class="fas fa-edit float-right"></i></a></div>
            </div>
        </div>
    </div>
</div>
