<!-- team -->
<section class="page-section" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">Join our team</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="frm_staff_registration" name="sentMessage" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="full_name" class="form-control" id="fullname" type="text" placeholder="Your Name *">
                                <p class="error_input" id="label_error_full_name"></p>
                            </div>
                            <div class="form-group">
                                <input name="staff_email" class="form-control" id="staff_email" type="email" placeholder="Your Email *">
                                <p class="error_input" id="label_error_staff_email"></p>
                            </div>
                            <div class="form-group">
                                <input name="phn_num" class="form-control" id="phn_num" type="tel" placeholder="Your Phone *">
                                <p class="error_input" id="label_error_phn_num"></p>
                            </div>
                            <div class="form-group">
                                <select name="gender" class="form-control staff_loc" id="gender">
                                    <option value="">Your Gender*</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                                <p class="error_input" id="label_error_gender"></p>
                            </div>
                            <div class="form-group">
                                <select name="staff_loc" class="form-control staff_loc" id="staff_loc">
                                    <option value="">Your Location*</option>
                                    <?php
                                    foreach($staff_loc_list as $staff_loc){
                                        echo "<option value='".$staff_loc->staff_loc_id."'>".$staff_loc->staff_loc."</option>";
                                    }
                                    ?>
                                </select>
                                <p class="error_input" id="label_error_staff_loc"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="staff_type" class="form-control staff_loc" id="staff_type">
                                    <option value="">Your experience*</option>
                                    <option value="1">Fresher</option>
                                    <option value="2">Experienced</option>
                                </select>
                                <p class="error_input" id="label_error_staff_type"></p>
                            </div>
                            <div class="form-group">
                                <input name="expected_salary" class="form-control" id="salary" type="number" placeholder="Your expected wages (per shift / BDT)" >
                                <p class="error_input" id="label_error_expected_salary"></p>
                            </div>
                            <div class="form-group">
                                <!-- <input name="expected_salary" class="form-control" id="salary" type="number" placeholder="Your expected wages (per shift / BDT)" > -->
                                <input class="form-control" type="file" id="image"  name="image" >
                                <p class="error_input" id="label_error_image"></p>
                            </div>
                            <div class="form-group">
                                <textarea name="experience" id="experience" style="padding: 10px;" class="form-control" placeholder="Please Write about yourself" rows="4" cols="40"></textarea>
                                <p class="error_input" id="label_error_experience"></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success"></div>
                            <button id="btn_staff_register"style="margin-top: 15px;" class="btn btn-primary btn-xl text-uppercase" type="button">
                                <i style="display:none" class="fa loader_signup fa-spinner fa-spin"></i> Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
