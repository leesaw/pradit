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
                <h3 class="page-header">หมายเลขรถ</h3>
            </div>
        </div>
		<form role="form" action="<?php echo site_url("managestock/excelrepair"); ?>" method="POST" >
		<div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                    	<input type="text" class="form-control" name="repair" id="repair">
                                    </div>
							</div>
                            
						</div>
								
						 <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                    	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> ตกลง</button>			
                                    </div>
							</div>
                            
						</div>			

					</div>
				</div>
			</div>	
		</div>
            </form>
	</div>
</div>

<?php $this->load->view('js_footer'); ?>
<script>
$(".alert-message").alert();
window.setTimeout(function() { $(".alert-message").alert('close'); }, 2000);
</script>
</body>
</html>