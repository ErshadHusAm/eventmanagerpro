<!--start Management registration modal-->
<div class="modal fade" id="managementmodal" tabindex="-1" role="dialog" aria-labelledby="managementmodallabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Top Management - Log in
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php echo base_url(); ?>assets/img/managmentregisterimg.png" class="img-fluid" style="padding: 10% 5%;" alt="img">
                    </div>
                    <div class="col-md-6">
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="login">
                                <form id="frm_admin_login">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="admin_email" name="admin_email" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_admin_email"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="admin_password" name="admin_password">
                                        <p class="error_input" id="label_error_admin_password"></p>
                                    </div>
                                    <button type="button" id="btn_admin_login" class="btn btn-primary float-right">
                                        <i style="display:none" class="fa loader_signup fa-spinner fa-spin"></i> Log in
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end Management registration modal-->
<!--start client registration modal-->
<div class="modal fade" id="clientmodal" tabindex="-1" role="dialog" aria-labelledby="clientmodallabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item btn">
                        <a class="nav-link active" href="#login" role="tab" data-toggle="tab">Log in</a>
                    </li>
                    <li class="nav-item  btn">
                        <a class="nav-link " href="#register" role="tab" data-toggle="tab">New user? Register</a>
                    </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php echo base_url(); ?>assets/img/clientregisterimg.png" class="img-fluid" style="padding: 10% 5%;" alt="img">
                    </div>
                    <div class="col-md-6">
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="login">
                                <form id="frm_client_login">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="client_email" name="client_email" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_client_email"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="client_password" name="client_password">
                                        <p class="error_input" id="label_error_client_password"></p>
                                    </div>
                                    <button type="button" id="btn_user_login" class="btn btn-primary float-right">
                                        <i style="display:none" class="fa loader_signup fa-spinner fa-spin"></i> Log in
                                    </button>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" id="register">
                                <form id="frm_client_registration">
                                    <div class="form-group">
                                        <label for="inputname">First Name <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Type your First Name" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_first_name"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputname">Last Name <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Type your Last Name" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_last_name"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputname">Mobile No. <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="text" class="form-control" id="phn_number"name="phn_number" placeholder="Type your Mobile Number" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_phn_number"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputname">Full Address <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Type your Full Address" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_address"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputemail">Email Address <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Type your Email Address" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_email"></p>
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputpass">Password <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Type your Password">
                                        <p class="error_input" id="label_error_password"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputcpass">Confirm password <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Password Type Again">
                                        <p class="error_input" id="label_error_con_password"></p>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label" for="policy_agreed">
                                                <input class="form-check-input" value="1" type="checkbox" id="policy_agreed" name="policy_agreed"> I agree that I have read and accepted the <a href="#"> Terms & Conditions</a>
                                            </label>
                                        </div>
                                        <p class="error_input" id="label_error_policy_agreed"></p>
                                    </div>
                                    <button type="button" id="btn_user_register" class="btn btn-primary float-right">
                                        <i style="display:none" class="fa loader_signup fa-spinner fa-spin"></i> Register
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end client registration modal-->
<!--start vendor registration modal-->
<div class="modal fade" id="vendormodal" tabindex="-1" role="dialog" aria-labelledby="vendormodallabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs">
                    <li class="nav-item btn">
                        <a class="nav-link" href="#vlogin" role="tab" data-toggle="tab">Log in</a>
                    </li>
                    <li class="nav-item  btn">
                        <a class="nav-link active" href="#vregister" role="tab" data-toggle="tab">Register as Vendor</a>
                    </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php echo base_url(); ?>assets/img/vendorregisterimg.png" class="img-fluid" style="padding: 10% 5%;" alt="img">
                    </div>
                    <div class="col-md-6">
                        <div class="tab-content">
                            <div class="tab-pane" role="tabpanel" id="vlogin">
                                <form id="frm_vendor_login">
                                    <div class="form-group">
                                        <label for="vendor_email">Email address</label>
                                        <input type="email" class="form-control" id="vendor_email" name="vendor_email" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_vendor_email"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_password">Password</label>
                                        <input type="password" class="form-control" id="vendor_password" name="vendor_password">
                                        <p class="error_input" id="label_error_vendor_password"></p>
                                    </div>

                                    <button type="button" id="btn_vendor_login" class="btn btn-primary float-right">
                                        <i style="display:none" class="fa loader_signup fa-spinner fa-spin"></i> Log in
                                    </button>
                                </form>
                            </div>
                            <div class="tab-pane active" role="tabpanel" id="vregister">
                                <form id="frm_vendor_registration">
                                    <div class="form-group">
                                        <label for="inputcname">Company Name <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="text" class="form-control" name="vendor_name" id="vendor_name" placeholder="Type your Company Name" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_vendor_name"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputvtype">Company Type <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <select name="vendor_type" class="form-control vendor_type" id="vendor_type">
                                            <option value="">Please Select</option>
                                            <?php
                                            foreach($vendor_type_list as $vendor_type){
                                                echo "<option value='".$vendor_type->vendor_type_id."'>".$vendor_type->vendor_name."</option>";
                                            }
                                            ?>
                                        </select>
                                        <p class="error_input" id="label_error_vendor_type"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="venorMobile">Mobile No. <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="text" class="form-control" id="phn_number"name="phn_number" placeholder="Type your Mobile Number" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_vendor_phn_number"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputVemail">Email Address <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Type your Email Address" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_email_vendor"></p>
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputVadress">Company Address <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="text" class="form-control" id="vendor_address" name="vendor_address" placeholder="Type your Full Address" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_vendor_address"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputvarea">Area<i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="text" class="form-control" id="vendor_area" name="vendor_area" placeholder="Type your Full Address" aria-describedby="emailHelp">
                                        <p class="error_input" id="label_error_vendor_area"></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="vpassword">Password <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Type your Password">
                                        <p class="error_input" id="label_error_vendor_password"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="vcon_password">Confirm password <i class="fa fa-asterisk required" aria-hidden="true"></i></label>
                                        <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Password Type Again">
                                        <p class="error_input" id="label_error_vendor_con_password"></p>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label" for="policy_agreed">
                                                <input class="form-check-input" value="1" type="checkbox" id="policy_agreed" name="policy_agreed"> I agree that I have read and accepted the <a href="#"> Terms & Conditions</a>
                                            </label>
                                        </div>
                                        <p class="error_input" id="label_error_vendor_policy_agreed"></p>
                                    </div>
                                    <button type="button" id="btn_vendor_register" class="btn btn-primary float-right">
                                        <i style="display:none" class="fa loader_signup fa-spinner fa-spin"></i> Register
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end vendor registration modal-->
