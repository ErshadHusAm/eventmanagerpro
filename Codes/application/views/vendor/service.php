<h4>Vendor Services</h4><hr>
<div class="tab-content">
    <form id="frm_vendor_service" data-parsley-validate class="form-horizontal form-label-left">
        <div class="row">
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="service_name">Service Name<i class="fa fa-asterisk required"></i></label>
                        <input type="text" class="form-control" id="service_name" name="service_name">
                        <p class="error_input" id="label_error_service_name"></p>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="service_img">Service Image <i class="fa fa-asterisk required"></i></label>

                        <input class="form-control" type="file" id="service_img"  name="service_img">
                        <p class="error_input" id="label_error_service_img"></p>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="service_price">Service Price <i class="fa fa-asterisk required"></i></label>
                        <input type="text" class="form-control" id="service_price" name="service_price">
                        <p class="error_input" id="label_error_service_price"></p>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="event_category">Event Category <i class="fa fa-asterisk required"></i></label>
                        <select name="event_category" class="form-control info_category_id" id="event_category">
                            <option value="">Please Select</option>
                            <?php
                            foreach($category_list as $category){
                                echo "<option value='".$category->event_category_id."'>".$category->event_category."</option>";
                            }
                            ?>
                        </select>
                        <p class="error_input" id="label_error_event_category"></p>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="service_desc">Service Description <i class="fa fa-asterisk required"></i></label>
                        <textarea name="service_desc" id="service_desc" class="form-control" id="msg" cols="50" rows="4" spellcheck="false"></textarea>
                        <p class="error_input" id="label_error_service_desc"></p>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="button" id="btn_save_service"  class="btn btn-success btn_save_service pull-right" >
                            <i style="display:none" class="fa loader_icon fa-spinner fa-spin"></i> <i class="fa fa-save"></i> Create Service
                        </button>


                        <!-- <input type="button" value="" id="btn_save_decoration" class="btn float-right btn-success btn-lg btn_save_decoration"> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="tab-content">
    <hr><h4>View all Vendor Services</h4><hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="10%">Name </th>
                    <th width="10%">Category </th>
                    <th width="40%">Description</th>
                    <th width="5%">Image</th>
                    <th width="10%">Price</th>
                    <th width="5%">Status</th>
                    <th class="text-center" width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($service_list)){
                foreach ($service_list as $key => $service) {
                    ?>
                    <tr>
                        <td><?php echo $service->service_name ? $service->service_name : " "?></td>
                        <td><?php echo $service->event_category ? $service->event_category : " "?></td>
                        <td><?php echo $service->service_desc ? $service->service_desc : " "?></td>
                        <td><img src="<?php echo base_url(); ?><?php echo $service->service_img ? $service->service_img : " "?>" width="80" height="80"></td>
                        <td><?php echo $service->service_price ? $service->service_price : " "?> ৳</td>
                        <td>
                            <?php if($service->status == 0){ ?>
                                <b class="text-success">Running</b>
                            <?php }elseif ($service->status == 1) {?>
                                <b class="text-danger">Closed</b>
                            <?php }elseif ($service->status == 2) {?>
                                <b class="text-info">Pending</b>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <span class="edit_service_info btn-warning btn-sm" style="cursor: pointer" title="Edit Service Info" data-service-id="<?php echo $service->id ? $service->id : " "?>">
                                <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                <i class="fa fa-edit"></i>
                            </span>
                            <span class="delete_service_info btn-danger btn-sm" style="cursor: pointer" title="Delete Service Info" data-service-id="<?php echo $service->id ? $service->id : " "?>">
                                <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                <i class="fa fa-trash"></i>
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
<?php include "support_modal/modal_update_service.php"; ?>
