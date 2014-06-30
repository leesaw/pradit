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
                <h3 class="page-header">แก้ไขผู้ใช้งาน</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
				<?php if ($this->session->flashdata('showresult') == 'success') {
						echo '<div class="panel-heading"><div class="alert alert-success"> ระบบทำการแก้ไขข้อมูลเรียบร้อยแล้ว</div>'; 
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageuser"); ?>'"> กลับไปหน้าจัดการผู้ใช้งาน </button></div> <?php
					  } else if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="panel-heading"><div class="alert alert-danger"> ระบบไม่สามารถแก้ไขข้อมูลได้</div>';
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageuser"); ?>'"> กลับไปหน้าจัดการผู้ใช้งาน </button></div> <?php
					  } else { 
				?>
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
					
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo form_open('manageuser/update'); ?>
								
								<?php if(is_array($user_array)) {
									foreach($user_array as $loop){
								?>
                                    <div class="form-group">
                                            <label>Username *</label>
											<input type="hidden" name="id" id="id" value="<?php echo $loop->id; ?>">
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $loop->username; ?>" disabled>
											<p class="help-block"><?php echo form_error('username'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>ชื่อ *</label>
                                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $loop->firstname; ?>">
											<p class="help-block"><?php echo form_error('fname'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>นามสกุล *</label>
                                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $loop->lastname; ?>">
											<p class="help-block"><?php echo form_error('lname'); ?></p>
                                    </div>
									<div class="form-group">
                                        <label>สิทธิการใช้งาน *</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1" <?php if($loop->status==1) echo "selected"; ?>>ผู้ดูแลระบบ( Admin )</option>
											<option value="2" <?php if($loop->status==2) echo "selected"; ?>>เจ้าหน้าที่คลังสินค้า ( Stock )</option>
											<option value="3" <?php if($loop->status==3) echo "selected"; ?>>Owner</option>
                                        </select>
                                    </div>
									<?php } }?>
									<button type="submit" class="btn btn-primary">  แก้ไขข้อมูลผู้ใช้งาน  </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageuser"); ?>'"> ยกเลิก </button>
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