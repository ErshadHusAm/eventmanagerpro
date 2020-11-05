<div class="tab-content">
    <hr><h4>View all guest lists</h4><hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="40%">Guest email list</th>
                    <th class="text-center" width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($email_list)){
                foreach ($email_list as $key => $email) {
                    ?>
                    <tr>
                        <td><?php echo $email->email_address ? $email->email_address : " "?></td>

                        <td class="text-center">
                            <span class="edit_service_info btn-warning btn-sm" style="cursor: pointer" title="Edit Service Info" data-service-id="<?php echo $service->id ? $service->id : " "?>">
                                <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                Edit
                            </span>
                            <span class="delete_service_info btn-danger btn-sm" style="cursor: pointer" title="Delete Service Info" data-service-id="<?php echo $service->id ? $service->id : " "?>">
                                <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                Delete
                            </span>
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
