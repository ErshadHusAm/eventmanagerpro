<div class="row">

    <div class="col-md-12">
        <h4>Add your guestlist</h4><hr>
        <?php
        if (empty($event_list) || $event_list == null) {
            ?>
            <center><span class="text-danger"><i>Sorry user! </i> You must add a event </span></center>
            <?php
        }else{
            ?>
            <form id="frm_invitation" method="post" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="event_category">Choose event <i class="fa fa-asterisk required"></i></label>
                    </div>
                    <div class="form-group col-md-3">
                        <select id="event_category" class="form-control"  name="event_category">
                            <option value="">Please Select</option>
                            <?php
                            foreach($event_list as $event){
                                echo "<option value='".$event->event_id."'>".$event->event_category." - ".$event->event_type." - ".$event->event_name."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="float-right" for="event_email_list_file">Upload guest list <i class="fa fa-asterisk required"></i><small> only .xls, .xlxs, .csv files</small></label>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="file" class="form-control" id="event_email_list_file" name="event_email_list_file" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <a class="text-warning" href="<?php echo base_url(); ?>uploads/file_format/file.csv">Download - File Formet</a>
                    </div>
                    <div class="col-md-5">
                        <label  for="policy_agreed" class="float-right"  >
                            <input class="form-check-input " value="1" type="checkbox" id="chk" name="chk">
                            I agree that I have read and accepted the <a href="#"> Terms of use</a>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="btn_upload_guest" class="btn btn-success btn_upload_guest float-right">
                            <i class="fa fa-spin fa-spinner" style="display: none"></i>
                            Upload
                        </button>
                    </div>
                </div>
            </form>
            <?php
        }
        ?>
        <div class="tab-content">
            <hr><h4>View all guest lists</h4><hr>
            <div class="table-responsive">
                <?php
                foreach ($event_list as $key => $event) {
                    echo "<h2>$event->event_name</h2>";
                    ?>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="40%">Guest email list</th>
                                <th class="text-center" width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($event->emails)){
                                foreach ($event->emails as $key => $email) {
                                    ?>
                                    <tr>
                                        <td><?php echo $email->email_address ? $email->email_address : " "?></td>
                                    </tr>
                                    <?php
                                }
                            } else{
                                ?>
                                <tr><td colspan="5">No Result Found</td></tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td>
                                    <button type="button" id="btn_send_guest" data-event-id="<?php echo $event->event_id; ?>" class="btn btn-success btn_send_guest float-right">
                                        <i class="fa fa-spin fa-spinner" style="display: none"></i>
                                        Send QR
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>
