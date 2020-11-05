<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


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
<!-- Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Contact form JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/jqBootstrapValidation.js"></script>
<script src="<?php echo base_url(); ?>assets/js/contact_me.js"></script>

<!-- Custom scripts for this template -->
<script src="<?php echo base_url(); ?>assets/js/agency.min.js"></script>

</body>

</html>
