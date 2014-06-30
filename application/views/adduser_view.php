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
                <h3 class="page-header">เพิ่มผู้ใช้งาน</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
					<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail') echo '<div class="alert-message alert alert-danger"> ระบบไม่สามารถเพิ่มข้อมูลได้</div>';
					
					?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo form_open('manageuser/save'); ?>
                                    <div class="form-group">
                                            <label>Username *</label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username'); ?>">
											<p class="help-block"><?php echo form_error('username'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>Password *</label>
                                            <input type="password" class="form-control" name="password" id="password">
											<p class="help-block"><?php echo form_error('password'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>Confirm Password *</label>
                                            <input type="password" class="form-control" name="passconf" id="passconf">
											<p class="help-block"><?php echo form_error('passconf'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>ชื่อ *</label>
                                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo set_value('fname'); ?>">
											<p class="help-block"><?php echo form_error('fname'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>นามสกุล *</label>
                                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo set_value('lname'); ?>">
											<p class="help-block"><?php echo form_error('lname'); ?></p>
                                    </div>
									<div class="form-group">
                                        <label>สิทธิการใช้งาน *</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">ผู้ดูแลระบบ( Admin )</option>
											<option value="2">เจ้าหน้าที่คลังสินค้า ( Stock )</option>
											<option value="3">Owner</option>
                                        </select>
                                    </div>
									<button type="submit" class="btn btn-primary">  เพิ่มข้อมูลผู้ใช้งาน  </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageuser"); ?>'"> ยกเลิก </button>
								</form>
								
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