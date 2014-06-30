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
                <h3 class="page-header">แก้ไขประเภทสินค้า</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
				<?php if ($this->session->flashdata('showresult') == 'success') {
						echo '<div class="panel-heading"><div class="alert alert-success"> ระบบทำการแก้ไขข้อมูลเรียบร้อยแล้ว</div>'; 
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managecat"); ?>'"> กลับไปหน้าจัดการประเภทสินค้า </button></div> <?php
					  } else if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="panel-heading"><div class="alert alert-danger"> ระบบไม่สามารถแก้ไขข้อมูลได้</div>';
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managecat"); ?>'"> กลับไปหน้าจัดการประเภทสินค้า </button></div> <?php
					  } else { 
				?>
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
					
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo form_open('managecat/update'); ?>
								
								<?php if(is_array($cat_array)) {
									foreach($cat_array as $loop){
								?>
                                    <div class="form-group">
                                            <label>ประเภทสินค้า *</label>
											<input type="hidden" name="id" id="id" value="<?php echo $loop->id; ?>">
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $loop->name; ?>">
											<p class="help-block"><?php echo form_error('name'); ?></p>
                                    </div>
									
									<?php } }?>
									<button type="submit" class="btn btn-primary">  แก้ไขประเภทสินค้า  </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managecat"); ?>'"> ยกเลิก </button>
								</form>
								
							</div>
						</div>
					</div>
				<?php } ?>
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