<div class="row">
    <div class="col-md-12 row">
        <form action="" method="post" id="frmStaffSearch" style="display: contents;">
            <div class="col">
                <select id="staff_type" class="form-control" required="" name="staff_type">
                    <option value="">Select Type</option>
                    <option value="1">Fresher</option>
                    <option value="2">Experience</option>
                </select>
            </div>
            <div class="col">
                <select id="staff_loc" class="form-control" required="" name="staff_loc">
                    <option value="">Select Location</option>
                    <?php
                    foreach($staff_loc_list as $staff_loc){
                        echo "<option value='".$staff_loc->staff_loc_id."'>".$staff_loc->staff_loc."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select id="gender" class="form-control" required="" name="gender">
                    <option value="">Select Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" !important id="my_search_input" placeholder="Type Keywords here" value="" name="search_term">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" style="width: 100%;" type="button" id="btn_search_staff">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>
    </div>

    <div class="col-md-12">
        <div class="tab-content">
            <hr><h4>View all Staff</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Full Name </th>
                            <th>Gender </th>
                            <th>Email </th>
                            <th>Phone </th>
                            <th>Location </th>
                            <th>Expected Salary </th>
                            <th class="text-center">Image </th>
                            <th>Type </th>
                            <th>About </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($search_result)){
                                foreach ($search_result as $key => $staff) {
                        ?>
                                <tr>
                                    <td><?php echo $staff->full_name;?></td>
                                    <td class="text-center">
                                        <?php if($staff->gender == 1){ ?>
                                            <b class="text-info">Male</b>
                                        <?php }elseif ($staff->gender == 2) {?>
                                            <b class="text-primary">Female</b>
                                        <?php }else{ ?>
                                            <b class="text-danger">Others</b>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $staff->staff_email;?></td>
                                    <td><?php echo $staff->phn_num;?></td>
                                    <td><?php echo $staff->staff_loc;?></td>
                                    <td><?php echo $staff->expected_salary;?> ৳</td>
                                    <td class="text-center">
                                        <?php if ($staff->image == null && empty($staff->image)){?>
                                            <img src="<?php echo base_url(); ?>assets/img/user.png" width="50" height="50">
                                        <?php }else{?>
                                            <img src="<?php echo base_url(); ?><?php echo $staff->image ? $staff->image : ""?>" width="80" height="80">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($staff->staff_type == 1){ ?>
                                            <b class="text-warning">Fresher</b>
                                        <?php }elseif ($staff->staff_type == 2) {?>
                                            <b class="text-success">Experience</b>
                                        <?php }?>
                                    </td>
                                    <td><?php echo $staff->experience;?></td>
                                </tr>
                        <?php
                                }
                            }else{
                        ?>
                            <tr><td colspan="8">No Result Found</td></tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
