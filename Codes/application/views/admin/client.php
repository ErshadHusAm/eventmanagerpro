
<div class="tab-content">
<h4>View all Client</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="20%">Name </th>
                    <th width="5%" class="text-center">Gender </th>
                    <th width="15%">Email </th>
                    <th width="20%">Full Address</th>
                    <th width="10%">Mobile No.</th>
                    <th width="10%">Image</th>
                    <th width="10%">Status</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($client_list)){
                foreach ($client_list as $key => $client) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $client->first_name ? $client->first_name : " "?>
                            <?php echo $client->last_name ? $client->last_name : " "?>
                        </td>
                        <td class="text-center">
                            <?php if($client->gender == 1){ ?>
                                <b>Male</b>
                            <?php }elseif ($client->gender == 2) {?>
                                <b>Female</b>
                            <?php }else{ ?>
                                <b>Others</b>
                            <?php } ?>
                        </td>
                        <td><?php echo $client->email ? $client->email : " "?></td>
                        <td><?php echo $client->address ? $client->address : " "?></td>
                        <td><?php echo $client->phn_number ? $client->phn_number : " "?></td>
                        <td>
                            <?php if ($client->image == null && empty($client->image)){?>
                            <img src="<?php echo base_url(); ?>assets/img/user.png" width="50" height="50">
                            <?php }else{?>
                            <img src="<?php echo base_url(); ?><?php echo $client->image ? $client->image : ""?>" width="80" height="80">
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($client->User_status == 1){ ?>
                                <b class="text-success">Active</b>
                            <?php }elseif ($client->User_status == 2) {?>
                                <b class="text-danger">Deactive</b>
                            <?php }else{ ?>
                                <b class="text-info">Created</b>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php if($client->User_status == 1){ ?>
                                <span class="btn_client_update_status btn-danger btn-sm" style="cursor: pointer" title="Unblock this user" data-status-id="2" data-user-id="<?php echo $client->user_id ? $client->user_id : " "?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    Block
                                </span>
                            <?php }elseif ($client->User_status == 2) {?>
                                <span class="btn_client_update_status btn-info btn-sm" style="cursor: pointer" title="Block this user" data-status-id="1"data-user-id="<?php echo $client->user_id ? $client->user_id : " "?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    Unblock
                                </span>
                            <?php }elseif ($client->User_status == 0) {?>
                                <span class="btn_client_update_status btn-success btn-sm" style="cursor: pointer" title="Approved this user" data-status-id="1" data-user-id="<?php echo $client->user_id ? $client->user_id : " "?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    Approved
                                </span>
                            <?php } ?>


                        </td>
                    </tr>
                    <?php
                    }
                } else{
                ?>
                    <tr><td colspan="8">No Result Found</td></tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
