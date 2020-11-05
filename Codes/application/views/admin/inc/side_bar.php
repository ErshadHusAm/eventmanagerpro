<!-- Side bar -->
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <ul class="list-unstyled components nav nav-tabs" style="display: block;">
            <li class="active nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>admin/home" >
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a class="nav-link"  href="<?php echo base_url(); ?>admin/decoration">
                    <i class="fas fa-briefcase"></i>
                    Decoration Service
                </a>
            </li>
            <li>
                <a href="#pageSubmenuBookings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy"></i>
                    Bookings
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenuBookings">
                    <li>
                        <a href="#">Client Side</a>
                    </li>
                    <li>
                        <a href="#">Vendor Side</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#pageSubmenuManage" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy"></i>
                    Manage Users
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenuManage">
                    <li>
                        <a href="<?php echo base_url(); ?>admin/manage_client">Client</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/manage_vendor">Vendor</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/manage_staff">Staff</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="nav-link"  href="<?php echo base_url(); ?>admin/invitation">
                    <i class="fas fa-briefcase"></i>
                    Invitation system
                </a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fas fa-align-left"></i>

                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <!--
                        <li class="nav-item active">
                        <a class="nav-link" href="#">Page</a>
                    </li>
                -->
            </ul>
        </div>
    </div>
</nav>
