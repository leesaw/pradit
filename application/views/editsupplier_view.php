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
            <div class="col-lg-10">
                <h3 class="page-header">แก้ไขข้อมูลผู้จำหน่าย (Supplier)</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-10">
                <div class="panel panel-default">
				<?php if ($this->session->flashdata('showresult') == 'success') {
						echo '<div class="panel-heading"><div class="alert alert-success"> ระบบทำการแก้ไขข้อมูลเรียบร้อยแล้ว</div>'; 
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managesupplier"); ?>'"> กลับไปหน้าจัดการข้อมูลผู้จำหน่าย </button></div> <?php
					  } else if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="panel-heading"><div class="alert alert-danger"> ระบบไม่สามารถแก้ไขข้อมูลได้</div>';
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managesupplier"); ?>'"> กลับไปหน้าจัดการข้อมูลผู้จำหน่าย </button></div> <?php
					  } else { 
				?>
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
								<?php echo form_open('managesupplier/update'); ?>
								
								<?php if(is_array($sup_array)) {
									foreach($sup_array as $loop){
								?>
                                    <div class="form-group">
									<input type="hidden" name="id" id="id" value="<?php echo $loop->id; ?>">
                                            <label class="control-label">รหัสผู้จำหน่าย *</label>
                                            <input type="text" class="form-control" name="supplierid" id="supplierid" value="<?php echo $loop->supplierID; ?>">
											<p class="help-block"><?php echo form_error('supplierid'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
									<div class="form-group">
                                        <label class="control-label">คำนำหน้า *</label>
                                        <select class="form-control" name="title" id="title">
										<?php 	
												if(is_array($title_array)) {
												foreach($title_array as $loopti){
													echo "<option value='".$loopti->name."'";
													if ($loop->title == $loopti->name) echo " selected";
													echo ">".$loopti->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
							
							<div class="col-md-8">
									<div class="form-group">
                                            <label class="control-label">ชื่อผู้จำหน่าย *</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $loop->name; ?>">
											<p class="help-block"><?php echo form_error('name'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
									<div class="form-group">
                                            <label class="control-label">ที่อยู่ *</label>
                                            <textarea class="form-control" name="address" id="address" rows="3"><?php echo $loop->address; ?></textarea>
											<p class="help-block"><?php echo form_error('address'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
									<div class="form-group">
                                        <label class="control-label">จังหวัด *</label>
                                        <select class="form-control" name="province" id="province">
										<?php 	
												if(is_array($province_array)) {
												foreach($province_array as $looppro){
													echo "<option value='".$looppro->province_code."'";
													if ($loop->province_name == $looppro->province_name) echo " selected";
													echo ">".$looppro->province_name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
							<div class="col-md-3 col-md-offset-1">
									<div class="form-group">
                                            <label class="control-label">รหัสไปรษณีย์ *</label>
											<input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo $loop->zipcode; ?>">
											<p class="help-block"><?php echo form_error('zipcode'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
									
									<div class="form-group">
                                            <label class="control-label">เบอร์โทรศัพท์ *</label>
											<input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $loop->telephone; ?>">
											<p class="help-block"><?php echo form_error('telephone'); ?></p>
                                    </div>
							</div>
							<div class="col-md-5">
									
									<div class="form-group">
                                            <label class="control-label">FAX *</label>
											
                                            <input type="text" class="form-control" name="fax" id="fax" value="<?php echo $loop->fax; ?>">
											<p class="help-block"><?php echo form_error('fax'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
									<div class="form-group">
                                            <label class="control-label">ชื่อผู้ติดต่อ *</label>
                                            <input type="text" class="form-control" name="contactname" id="contactname" value="<?php echo $loop->contactName; ?>">
											<p class="help-block"><?php echo form_error('contactname'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									<div class="form-group">
                                            <label class="control-label">เลขประจำตัวผู้เสียภาษี *</label>
                                            <input type="text" class="form-control" name="taxid" id="taxid" value="<?php echo $loop->taxID; ?>">
											<p class="help-block"><?php echo form_error('taxid'); ?></p>
                                    </div>
							</div>
							<div class="col-md-4">
									<div class="form-group">
                                        <label class="control-label">เงื่อนไขการชำระเงิน *</label>
                                        <select class="form-control" name="status" id="status">
											<option value="0"<?php if ($loop->status==0) echo " selected"; ?>>-</option>
											<option value="1"<?php if ($loop->status==1) echo " selected"; ?>>สด</option>
											<option value="2"<?php if ($loop->status==2) echo " selected"; ?>>เชื่อ</option>
                                        </select>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group">
                                            <label>จำนวนวันเครดิต </label>
                                            <input type="text" class="form-control" name="creditday" id="creditday" value="<?php echo $loop->creditDay; ?>">
											<p class="help-block"><?php echo form_error('creditday'); ?></p>
                                    </div>
							</div>
						</div>
						<?php } } ?>
						<div class="row">
							<div class="col-md-6">
									<button type="submit" class="btn btn-primary">  แก้ไขข้อมูลผู้จำหน่าย  </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managesupplier"); ?>'"> ยกเลิก </button>
							</div>
						</div>
								
									
						</form>

					</div>
				</div>
			</div>	
			<?php } ?>
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