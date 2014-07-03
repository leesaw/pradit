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
                <h3 class="page-header">เพิ่มข้อมูลสาขา</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
					<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail') echo '<div class="alert-message alert alert-danger"> ระบบไม่สามารถเพิ่มข้อมูลได้</div>';
					
					?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php echo form_open('managebranch/save'); ?>
                                    <div class="form-group">
                                            <label>ชื่อสาขา *</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>">
											<p class="help-block"><?php echo form_error('name'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>ที่อยู่ *</label>
                                            <textarea class="form-control" name="address" id="address" rows="3"><?php echo set_value('address'); ?></textarea>
											<p class="help-block"><?php echo form_error('address'); ?></p>
                                    </div>
									<div class="form-group">
                                        <label>จังหวัด *</label>
                                        <select class="form-control" name="province" id="province">
										<?php 	if(is_array($province_array)) {
												foreach($province_array as $loop){
													echo "<option value='".$loop->province_code."'>".$loop->province_name."</option>";
										 } } ?>
                                        </select>
                                    </div>
									<div class="form-group">
                                            <label>รหัสไปรษณีย์ *</label>
                                            <input type="text" class="form-control" name="zipcode" id="zipcode" maxlength="5" value="<?php echo set_value('zipcode'); ?>">
											<p class="help-block"><?php echo form_error('zipcode'); ?></p>
                                    </div>
									
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									
									<div class="form-group">
                                            <label>เบอร์โทรศัพท์ *</label>
                                            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo set_value('telephone'); ?>">
											<p class="help-block"><?php echo form_error('telephone'); ?></p>
                                    </div>
							</div>
							<div class="col-md-4">
									
									<div class="form-group">
                                            <label>FAX *</label>
                                            <input type="text" class="form-control" name="fax" id="fax" value="<?php echo set_value('fax'); ?>">
											<p class="help-block"><?php echo form_error('fax'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
									<div class="form-group">
                                            <label>เลขประจำตัวผู้เสียภาษี *</label>
                                            <input type="text" class="form-control" name="taxid" id="taxid" value="<?php echo set_value('taxid'); ?>">
											<p class="help-block"><?php echo form_error('taxid'); ?></p>
                                    </div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<button type="submit" class="btn btn-primary">  เพิ่มข้อมูลสาขา  </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managebranch"); ?>'"> ยกเลิก </button>
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