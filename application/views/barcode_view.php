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
            <div class="col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>แสดง  Barcode</strong></div>
				<div class="panel-body">
				<div class="col-md-4">
					<div id="bcTarget"></div> 
				</div>
				<div class="col-md-6">
					<label>จำนวนที่ต้องการพิมพ์</label>
					<input type="text" class="form-control" name="copy" id="copy"> 
				</div>
			</div>
			</div>


</div>
<div class="row show-grid">
			<div class="col-lg-2 col-lg-offset-3">
				<button type="button" class="btn btn-primary" onClick="sendPrinter()"> พิมพ์ Barcode </button>
			</div>
</div>
<br><br><br><br><br>
<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>js/jquery-barcode.min.js"></script>
<script type='text/javascript'> 
$(document).ready(function() {
	$("#bcTarget").barcode("<?php echo $barcodeid; ?>", "code128" ,{barWidth:2, barHeight:80});
	var txtbox = document.getElementById("copy");
	txtbox.value = 1;
});

function sendPrinter() {
	var txtbox = document.getElementById("copy");
	window.location.href="<?php echo base_url()."/tsc/printbarcode.php?bc=".$barcodeid."&name=".$pname."&price=".$price; ?>"+"&copy="+txtbox.value;
}
 </script>
</body>
</html>