<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
	
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-8">
                <h3 class="page-header">สินค้าออกสต็อก</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
				<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำรายการเรียบร้อยแล้ว</div>';
						 
				?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                    <div class="form-group">
                                    	<a href="<?php echo site_url("managestock/printStockOut/".$listid); ?>" class="btn btn-success btn-lg btn-block" target="_blank">พิมพ์รายการสินค้าออกสต็อก</a>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    	<a href="<?php echo site_url("managestock/addstockfrombarcode_out"); ?>" class="btn btn-warning btn-lg btn-block">เริ่มสแกน Barcode สินค้าออกจากสต็อก</a>
                                    </div>
							     </div>
						</div>
								
									

					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<?php $this->load->view('js_footer'); ?>
<script>
$(".alert-message").alert();
window.setTimeout(function() { $(".alert-message").alert('close'); }, 2000);
</script>
</body>
</html>