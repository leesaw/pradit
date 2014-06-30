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
                <h3 class="page-header">ออกใบเสนอราคา</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
				<?php if ($showresult == 'success') {
						echo '<div class="panel-heading"><div class="alert alert-success"> ระบบทำรายการเรียบร้อยแล้ว</div>'; 
						
					  } 
				?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                    <div class="form-group">
                                    	<a href="<?php echo site_url("managebill/printCashQuotation/".$billid); ?>" class="btn btn-success btn-lg btn-block" target="_blank">พิมพ์ใบเสนอราคา</a>
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