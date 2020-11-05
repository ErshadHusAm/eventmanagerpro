<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php echo base_url(); ?>">Event manager pro</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <?php
        $user_id = $this->session->userdata("user_id");
        $user_type = $this->session->userdata("user_type");
        if($user_id == NULL){
            ?>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#services">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Join Team</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#clientmodal">Log in</a>
                    </li>
                    <li>
                        <button type="button" class="btn btn-primary" data-toggle="modal" style="margin-top: 5px;" data-target="#vendormodal">
                            Join as vendor
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#managementmodal">Management</a>
                    </li>
                </ul>
            </div>
        <?php }else{ ?>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <?php if($user_type == 1){?>
                        <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>client/home">My Dashboard</a>
                    <?php }else if($user_type == 2){ ?>
                        <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>vendor/home">My Dashboard</a>
                    <?php }else if($user_type == 0){ ?>
                        <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>admin/home">Admin Panel</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?php echo base_url(); ?>home/signout">Logout</a>
                    </li>
                </ul>
            </div>
        <?php }?>
    </div>
</nav>
