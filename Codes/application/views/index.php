<?php include "inc/header.php"; ?>

<body id="page-top">
    <?php include "inc/navigation.php"; ?>
    <?php include "inc/modal.php"; ?>

    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome To Event manager pro</div>
                <div class="intro-heading text-uppercase">It's Nice To Meet You</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
            </div>
        </div>
    </header>

    <!-- Services -->
    <section class="page-section" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Event Categories</h2>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <a href="#">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-briefcase fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h4 class="service-heading">Corporate events</h4>
                    <p class="text-muted">Click here to see arrangements for different types of corporate events like seminers, conferences, business dinners, trade shows etc.</p>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-users fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h4 class="service-heading">Social events</h4>
                    <p class="text-muted">Click here to see arrangements for different types of social events like martyrs day, victory day, independence day, farewell parties, reunion parties, success celebrations, gala nights, christmas, new year etc..</p>
                </div>
                <div class="col-md-4">
                    <a href="#">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-birthday-cake fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h4 class="service-heading">Private events</h4>
                    <p class="text-muted">Click here to see arrangements for different types of social events like wedding, receptions, haldi night, birthday, anniversary, engagement party, baby shower, bridal shower etc..</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="bg-light page-section" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Our Top Rated Vendors</h2>
                    <h3 class="section-subheading text-muted">Keep Trusting US, We Bring the Best & Better for You.</h3>
                </div>
            </div>
            <div class="row">
                <?php
                    foreach ($vendor_list as $key => $vendor) {
                ?>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a class="portfolio-link single_vendor" data-toggle="modal" data-vendor-id="<?php echo $vendor->vendor_id; ?>"
                      data-service-id="<?php echo $vendor->id; ?>" data-service-name="<?php echo $vendor->service_name; ?>"
                      data-service-desc="<?php echo $vendor->service_desc; ?>" data-service-price="<?php echo $vendor->service_price; ?>"
                      data-vendor-type="<?php echo $vendor->vendor_name; ?>" data-event-type="<?php echo $vendor->event_category; ?>"
                      href="#vendorModal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" style="height:100% !important;" src="<?php echo base_url(); ?><?php echo $vendor->service_img ? $vendor->service_img : " "?>" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4><?php echo $vendor->company_name ? $vendor->company_name : " "?></h4>
                        <p class="text-muted"><?php echo $vendor->vendor_name ? $vendor->vendor_name : " "?></p>
                    </div>
                </div>
                <?php
                    }
                ?>
                <div class="col-md-12">
                    <a class="float-right" href="<?php echo base_url(); ?>More_services"><b>View more ...</b></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Clients -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="assets/img/logos/envato.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="assets/img/logos/designmodo.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="assets/img/logos/themeforest.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="assets/img/logos/creative-market.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include "inc/staff_reg_modal.php"; ?>
    <?php include "inc/footer.php"; ?>



    <!-- Portfolio Modals -->


    <?php include "inc/main_part.php"; ?>
    <?php include "inc/footer_script.php"; ?>
