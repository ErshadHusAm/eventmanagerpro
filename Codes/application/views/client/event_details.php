<!-- <div class="row"> -->
    <!-- <div class="col-md-12"> -->
        <div class="custom_card card" >
            <h5 class="card-header card-title">Event Details</h5>
            <div class="card-body">
                <small class="table-responsive ">
                    <table class="table table-striped card-text">
                        <thead>
                            <tr>
                                <th>
                                    Full Name : <?php echo isset($event_details->first_name) ? $event_details->first_name : ""?>
                                     <?php echo isset($event_details->last_name) ? $event_details->last_name : ""?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Event Name : <?php echo isset($event_details->event_name) ? $event_details->event_name : ""?></td>
                                <td>Event Category : <?php echo isset($event_details->event_category) ? $event_details->event_category : ""?></td>
                                <td>Event Type : <?php echo isset($event_details->event_type) ? $event_details->event_type : ""?></td>
                            </tr>
                            <tr>
                                <td>Event Address : <?php echo isset($event_details->event_city) ? $event_details->event_city : ""?></td>
                                <td>Event Loacation : <?php echo isset($event_details->staff_loc) ? $event_details->staff_loc : ""?></td>
                                <td>Event Date : <?php echo isset($event_details->event_date) ? $event_details->event_date : ""?></td>
                            </tr>
                            <tr>
                                <td>Event Budget : <?php echo isset($event_details->event_budget) ? $event_details->event_budget : ""?></td>
                            </tr>
                        </tbody>
                    </table>
                </small>
            </div>
        </div>
    <!-- </div> -->
<!-- </div> -->
