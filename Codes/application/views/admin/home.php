<?php
if ($active_users->active_client_count > 0) {
    $active_client = round(($active_users->active_client_count*100)/$count_client);
} else {
    $active_client = 0;
}

if ($active_users->active_vendor_count > 0) {
    $active_vendor = round(($active_users->active_vendor_count*100)/$count_vendor);
} else {
    $active_vendor = 0;
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="progress">
            <div class="progress-bar progress-bar-striped active bg-warning" role="progressbar" aria-valuenow="<?php echo $active_client ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $active_client ?>%">
                Active Client's <?php echo $active_client ?> %
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="progress ">
            <div class="progress-bar progress-bar-striped active bg-success" role="progressbar" aria-valuenow="<?php echo $active_vendor ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $active_vendor ?>%">
                Active Vendor's <?php echo $active_vendor ?> %
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="alert alert-info col-md-12">
            <h4 class="text-center"><?php echo $count_client;?></h4>
            <center><small >Total Client</small></center>
        </div>
        <div class="alert alert-warning col-md-12">
            <h4 class="text-center"><?php echo $count_vendor;?></h4>
            <center><small >Total Vendor</small></center>
        </div>
        <div class="alert alert-primary col-md-12">
            <h4 class="text-center"><?php echo $count_event;?></h4>
            <center><small >Total Event</small></center>
        </div>
        <div class="alert alert-danger col-md-12">
            <h4 class="text-center"><?php echo $count_vendor_service;?></h4>
            <center><small >Total Vendor Service</small></center>
        </div>
        <div class="alert alert-success col-md-12">
            <h4 class="text-center"><?php echo $count_staff;?></h4>
            <center><small >Total Staff</small></center>
        </div>
    </div>
    <div class="col-md-9 row">
        <div class="alert col-md-6">
            <center><strong>Percentage of Event Category</strong></center><hr>
            <canvas id="chartEventCategory" ></canvas>
        </div>
        <div class="alert col-md-6">
            <center><strong>Percentage of Event Type</strong></center><hr>
            <canvas id="chartEventType" ></canvas>
        </div>
    </div>
</div>
<script>
    var CORPORATE_COUNT = "<?php echo $count_event_category->coporate_count; ?>";
    var PRIVATE_COUNT = "<?php echo $count_event_category->private_count; ?>";
    var SOCIAL_COUNT = "<?php echo $count_event_category->social_count; ?>";

    var WEEDING_COUNT = "<?php echo $count_event_type->weeding_count; ?>";
    var HAALDI_COUNT = "<?php echo $count_event_type->haldi_count; ?>";
    var RECEPTION_COUNT = "<?php echo $count_event_type->reception_count; ?>";
    var BIRTHDAY_COUNT = "<?php echo $count_event_type->birthday_count; ?>";
    var ENGAGEMENT_COUNT = "<?php echo $count_event_type->engagment_count; ?>";
</script>
