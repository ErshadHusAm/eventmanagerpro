<div class="row">
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="custom_card card text-white bg-success mb-3" style="max-width: 18rem;">
                <h5 class="card-header card-title">Create event</h5>
                <div class="card-body">
                    <small>
                        <p class="card-text">Create your upcoming event in few simple steps.</p>
                    </small>
                    <div class="card_fa"><a href="<?php echo base_url(); ?>client/event"><i class="fas fa-calendar-plus float-right"></i></a></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="custom_card card text-white bg-primary mb-3" style="max-width: 18rem;">
                <h5 class="card-header card-title">Manage tasks</h5>
                <div class="card-body">
                    <small>
                        <p class="card-text">Create your upcoming event in few simple steps.</p>
                    </small>
                    <div class="card_fa"><a href="<?php echo base_url(); ?>client/todolist"><i class="fas fa-tasks float-right"></i></a></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="custom_card card text-white bg-danger mb-3" style="max-width: 18rem;">
                <h5 class="card-header card-title">Edit profile</h5>
                <div class="card-body">
                    <small>
                        <p class="card-text">Create your upcoming event in few simple steps.</p>
                    </small>
                    <div class="card_fa"><a href="<?php echo base_url(); ?>client/edit"><i class="fas fa-edit float-right"></i></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="custom_card card" >
            <h5 class="card-header card-title">Event Manager</h5>
            <div class="card-body">
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                foreach ($notification_details as $key => $notification) {
                                    if ($notification->flag == 1) {
                                        $alert_msg = 'alert-success';
                                        $msg = 'Congts! ';
                                    } elseif($notification->flag == 2) {
                                        $alert_msg = 'alert-danger';
                                        $msg = 'Sorry! ';
                                    } elseif($notification->flag == 3) {
                                        $alert_msg = 'alert-warning';
                                    } elseif($notification->flag == 4) {
                                        $alert_msg = 'alert-info';
                                    }

                            ?>
                            <div class="alert <?php echo $alert_msg; ?>">
                                <a href="<?php echo base_url(); ?>client_service/event_details/<?php echo $notification->event_id; ?>">
                                    <strong class="default"><?php echo $msg ;?></strong> <?php echo isset($notification->message) ? $notification->message : ""?>
                                </a>
                                <button type="button" class="close " data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
