<?php include "inc/header.php"; ?>

<body id="page-top">
    <?php include "inc/navigation.php"; ?>
    <?php include "inc/modal.php"; ?>

    <!-- service page banner-->
    <header class="masthead" style="height: 400px !important;">
        <div class="container">
            <div class="intro-text" style="padding-top: 170px !important;">
                <div class="intro-heading text-uppercase">Explore our services</div>
            </div>
        </div>
    </header>
    <!-- service page banner end-->
    <!-- service page search-->
    <section class="service_search" style="padding: 60px;">
        <div class="container">
            <div class="row">
                <form action="" method="post" id="frmVendorServiceSearch" style="display: contents;">
                    <div class="col">
                        <select id="event_type" class="form-control" required="" name="event_type">
                            <option value="" >Type</option>
                            <?php
                            foreach($vendor_type_list as $vendor_type){
                                $selected = $event_type == $vendor_type->vendor_type_id ? "selected" : "";
                                echo "<option $selected value='".$vendor_type->vendor_type_id."'>".$vendor_type->vendor_name."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="start price" name="service_price_start" value="<?php echo $service_price_start; ?>" >
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="end price" name="service_price_end" value="<?php echo $service_price_end; ?>" >
                    </div>

                    <div class="col">
                        <input type="text" class="form-control custom_search"  id="my_search_input" placeholder="Type Keywords or your Question here" value="<?php echo $search_term; ?>"  name="search_term">

                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" style="width: 100%;" type="button" id="btn_search_vendor_service">
                            <i class="fas fa-search"></i> Search</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- service page search end-->
    <!-- service page cards-->
    <section class="bg-light page-section" id="portfolio">
        <div class="container">
            <div class="row">
                <?php
                    if(isset($search_result)){
                ?>
                <?php
                foreach ($search_result as $key => $vendor) {
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

                <?php
            }else{
                echo "No result found";
            }
                ?>







            </div>
        </div>
    </section>
    <!-- service page cards end-->

    <?php include "inc/footer.php"; ?>



    <!-- Portfolio Modals -->
    <?php include "inc/main_part.php"; ?>
    <?php include "inc/footer_script.php"; ?>
