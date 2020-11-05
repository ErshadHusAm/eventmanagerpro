<h4>Decoration Services</h4><hr>
<div class="tab-content">
    <form id="frm_decoration" data-parsley-validate class="form-horizontal form-label-left">
        <div class="row">
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="decoration_name">Decoration Title <i class="fa fa-asterisk required"></i></label>
                        <input type="text" class="form-control" id="decoration_name" name="decoration_name">
                        <p class="error_input" id="label_error_decoration_name"></p>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="decoration_img">Decoration Image <i class="fa fa-asterisk required"></i></label>
                        <!-- <input type="text" class="form-control" id="decoration_img" name="decoration_img"> -->

                        <input class="form-control" type="file" id="decoration_img"  name="decoration_img">
                        <p class="error_input" id="label_error_decoration_img"></p>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="decoration_price">Decoration Price <i class="fa fa-asterisk required"></i></label>
                        <input type="text" class="form-control" id="decoration_price" name="decoration_price">
                        <p class="error_input" id="label_error_decoration_price"></p>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="decoration_description">Decoration Description <i class="fa fa-asterisk required"></i></label>
                        <textarea name="decoration_description" id="decoration_description" class="form-control" id="msg" cols="50" rows="6" spellcheck="false"></textarea>
                        <p class="error_input" id="label_error_decoration_description"></p>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="button" id="btn_save_decoration"  class="btn btn-success btn_save_decoration pull-right" >
                            <i style="display:none" class="fa loader_icon fa-spinner fa-spin"></i> <i class="fa fa-save"></i> Create Decoration
                        </button>


                        <!-- <input type="button" value="" id="btn_save_decoration" class="btn float-right btn-success btn-lg btn_save_decoration"> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="tab-content">
    <hr><h4>View all Decoration Services</h4><hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="20%">Title </th>
                    <th width="40%">Description</th>
                    <th width="10%">Image</th>
                    <th width="10%">Price</th>
                    <th class="text-center" width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($decoration_list)){
                foreach ($decoration_list as $key => $decoration) {
                    ?>
                    <tr>
                        <td><?php echo $decoration->decoration_name ? $decoration->decoration_name : " "?></td>
                        <td><?php echo $decoration->decoration_description ? $decoration->decoration_description : " "?></td>
                        <td><img src="<?php echo base_url(); ?><?php echo $decoration->decoration_img ? $decoration->decoration_img : " "?>" width="80" height="80"></td>
                        <td><?php echo $decoration->decoration_price ? $decoration->decoration_price : " "?> ৳</td>
                        <td class="text-center">
                            <span class="edit_decoration_info btn-warning btn-sm" style="cursor: pointer" title="Edit Decoration Info" data-doc-id="<?php echo $decoration->decoration_id ? $decoration->decoration_id : " "?>">
                                <i style="display: none" class="fa fa-spin fa-spinner loader_icon"></i>
                                Edit
                            </span>
                            <span class="delete_decoration_info btn-danger btn-sm" style="cursor: pointer" title="Delete Decoration Info" data-doc-id="<?php echo $decoration->decoration_id ? $decoration->decoration_id : " "?>">
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
<?php include "support_modal/modal_update_decoration.php"; ?>
