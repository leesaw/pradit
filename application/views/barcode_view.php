<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<style type="text/css">
html {
  overflow-x: hidden;
  overflow-y: auto;
}
</style>

</head>

<body>
<div class="row">
            <div class="col-lg-5">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>แสดง  Barcode</strong></div>
				<div class="panel-body">
					<div id="bcTarget"></div> 

				</div>
			</div>
			</div>


</div>
<div class="row show-grid">
			<div class="col-lg-2 col-lg-offset-3">
				<button type="button" class="btn btn-primary" onClick="window.location.href='#'"> พิมพ์ Barcode </button>
			</div>
</div>
<br><br><br><br><br><br><br><br>
<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>js/jquery-barcode.min.js"></script>
<script type='text/javascript'> 
$(document).ready(function() {
	$("#bcTarget").barcode("<?php echo $barcodeid; ?>", "code128" ,{barWidth:2, barHeight:80});  
});
 </script>
</body>
</html>