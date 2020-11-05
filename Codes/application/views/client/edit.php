<div class="row">
    <div class="col-md-6">
        <div class="custom_card card" >
            <h5 class="card-header card-title">My Profile Details</h5>
            <div class="card-body">
                <small class="table-responsive ">
                    <table class="table table-striped card-text">
                        <thead>
                            <th>
                                <?php if ($client_details->image == null && empty($client_details->image)){?>
                                <img src="<?php echo base_url(); ?>assets/img/user.png" width="90" height="80">
                                <?php }else{?>
                                <img src="<?php echo base_url(); ?><?php echo $client_details->image ? $client_details->image : ""?>" width="80" height="80">
                                <?php } ?>
                            </th>
                            <th></th>
                            <th class="card_fa ">
                                <a class="btn_edit_profile" title="Edit Profile Info" style="cursor: pointer" data-client-id="<?php echo $client_details->client_id ? $client_details->client_id : " "?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    <i class="fas fa-edit float-right "></i>
                                </a>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>First Name </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($client_details->first_name) ? $client_details->first_name : ""?></td>
                            </tr>
                            <tr>
                                <th>Last Name </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($client_details->last_name) ? $client_details->last_name : ""?></td>
                            </tr>
                            <tr>
                                <th>Gender </th>
                                <td><b> : </b></td>
                                <td>
                                    <?php if($client_details->gender == 1){ ?>
                                        <b>Male</b>
                                    <?php }elseif ($client_details->gender == 2) {?>
                                        <b>Female</b>
                                    <?php }else{ ?>
                                        <b>Not specified</b>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Email </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($client_details->email) ? $client_details->email : ""?></td>
                            </tr>
                            <tr>
                                <th>Mobile No </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($client_details->phn_number) ? $client_details->phn_number : ""?></td>
                            </tr>
                            <tr>
                                <th>Full Address </th>
                                <td><b> : </b></td>
                                <td><?php echo isset($client_details->address) ? $client_details->address : ""?></td>
                            </tr>
                        </tbody>
                    </table>
                </small>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>
<?php include "support_modal/modal_update_profile.php"; ?>
