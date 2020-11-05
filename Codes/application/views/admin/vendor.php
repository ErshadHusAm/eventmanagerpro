
<div class="tab-content">
<h4>View all Vendor</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="10%">Company Name </th>
                    <th width="10%">Type </th>
                    <th width="15%">Email </th>
                    <th width="10%">City</th>
                    <th width="5%">Image</th>
                    <th width="10%" >Success Event</th>
                    <th width="5%">Status</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($vendor_list)){
                foreach ($vendor_list as $key => $vendor) {
                    ?>
                    <tr>
                        <td><?php echo $vendor->company_name ? $vendor->company_name : " "?></td>
                        <td><?php echo $vendor->vendor_name ? $vendor->vendor_name : " "?></td>
                        <td><?php echo $vendor->email ? $vendor->email : " "?></td>
                        <td><?php echo $vendor->city ? $vendor->city : " "?></td>
                        <td>
                            <?php if ($vendor->image == null && empty($vendor->image)){?>
                            <img src="<?php echo base_url(); ?>assets/img/company.png" width="50" height="50">
                            <?php }else{?>
                            <img src="<?php echo base_url(); ?><?php echo $vendor->image ? $vendor->image : ""?>" width="80" height="80">
                            <?php } ?>
                        </td>
                        <td class="text-center"><b><?php echo $vendor->sucessful_event ? $vendor->sucessful_event : "0"?></b></td>
                        <td>
                            <?php if($vendor->User_status == 1){ ?>
                                <b class="text-success">Active</b>
                            <?php }elseif ($vendor->User_status == 2) {?>
                                <b class="text-danger">Deactive</b>
                            <?php }else{ ?>
                                <b class="text-info">Created</b>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php if($vendor->User_status == 1){ ?>
                                <span class="btn_vendor_update_status btn-danger btn-sm" style="cursor: pointer" title="Unblock this user" data-status-id="2" data-user-id="<?php echo $vendor->user_id ? $vendor->user_id : " "?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    Block
                                </span>
                            <?php }elseif ($vendor->User_status == 2) {?>
                                <span class="btn_vendor_update_status btn-info btn-sm" style="cursor: pointer" title="Block this user" data-status-id="1"data-user-id="<?php echo $vendor->user_id ? $vendor->user_id : " "?>">
                                    <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                    Unblock
                                </span>
                            <?php }elseif ($vendor->User_status == 0) {?>
                                <span class="btn_vendor_update_status btn-success btn-sm" style="cursor: pointer" title="Approved this user" data-status-id="1" data-user-id="<?php echo $vendor->user_id ? $vendor->user_id : " "?>">
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
