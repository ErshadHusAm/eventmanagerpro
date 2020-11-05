
<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<!-----Datatable---->
<script src="<?php echo base_url(); ?>assets/libs/datatables/1.10.20/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables-bs/1.10.20/dataTables.bootstrap4.min.js"></script>
<!---End Datatable-->
<!-- Chart.js -->
<script src="<?php echo base_url(); ?>assets/libs/Chart.js/dist/Chart.min.js"></script>
<!-- Chartjs-plugin-labels.js -->
<script src="<?php echo base_url(); ?>assets/libs/Chart.js/dist/chartjs-plugin-labels.min.js"></script>
<!-- Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Contact form JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/jqBootstrapValidation.js"></script>
<script src="<?php echo base_url(); ?>assets/js/contact_me.js"></script>

<!-- Custom scripts for this template -->
<script src="<?php echo base_url(); ?>assets/js/agency.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/libs/alertify/js/alertify.js"></script>
<script>
alertify.set('notifier', 'position', 'top-right');
var BASE_URL = "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url(); ?>scripts/helper.js"></script>
<script src="<?php echo base_url(); ?>scripts/master.js"></script>
<?php
if(isset($scripts)){
    if(gettype($scripts) == "array"){
        for($i=0; $i<count($scripts); $i++){
            echo '<script type="text/javascript" src="'.base_url().$scripts[$i].'"></script>';
        }
    }else{
        echo '<script type="text/javascript" src="'.base_url().$scripts.'"></script>';
    }
}
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
});
</script>

</body>

</html>
