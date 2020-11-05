<?php include "inc/header.php"; ?>
<body id="page-top">
<?php include "inc/navigation.php"; ?>


  <!-- Side bar -->
  <div class="wrapper">
     <?php include "inc/sidebar.php"; ?>

      <!-- Page Content  -->
      <div id="content">
          <?php echo isset($main_content) ? $main_content : ""; ?>

      </div>
  </div>

<?php include "inc/footer.php"; ?>
