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
            <div class="col-lg-8">
                <div class="panel panel-default">
				<?php if ($this->session->flashdata('showresult') == 'success') {
						echo '<div class="panel-heading"><div class="alert alert-success"> ระบบทำการแก้ไขข้อมูลเรียบร้อยแล้ว</div>'; 
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managebranch"); ?>'"> กลับไปหน้าจัดการข้อมูลสาขา </button></div> <?php
					  } else if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="panel-heading"><div class="alert alert-danger"> ระบบไม่สามารถแก้ไขข้อมูลได้</div>';
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managebranch"); ?>'"> กลับไปหน้าจัดการข้อมูลสาขา </button></div> <?php
					  } else { 
				?>
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
					
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <?php echo form_open('managebranch/update'); ?>
								
								<?php if(is_array($branch_array)) {
									foreach($branch_array as $loop){
								?>
                                    <div class="form-group">
									<input type="hidden" name="id" id="id" value="<?php echo $loop->id; ?>">
                                            <label>ชื่อสาขา *</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $loop->name; ?>">
											<p class="help-block"><?php echo form_error('name'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>ที่อยู่ *</label>
                                            <textarea class="form-control" name="address" id="address" rows="3"><?php echo $loop->address; ?></textarea>
											<p class="help-block"><?php echo form_error('address'); ?></p>
                                    </div>
									<div class="form-group">
                                        <label>จังหวัด *</label>
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
									<div class="form-group">
                                            <label>รหัสไปรษณีย์ *</label>
                                            <input type="text" class="form-control" name="zipcode" id="zipcode" maxlength="5" value="<?php echo $loop->zipcode; ?>">
											<p class="help-block"><?php echo form_error('zipcode'); ?></p>
                                    </div>
									
									<?php } }?>
									
								
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
									
									<div class="form-group">
                                            <label>เบอร์โทรศัพท์ *</label>
                                            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $loop->telephone; ?>">
											<p class="help-block"><?php echo form_error('telephone'); ?></p>
                                    </div>
							</div>
							<div class="col-lg-4">
									
									<div class="form-group">
                                            <label>FAX *</label>
                                            <input type="text" class="form-control" name="fax" id="fax" value="<?php echo $loop->fax; ?>">
											<p class="help-block"><?php echo form_error('fax'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-5">
									<div class="form-group">
                                            <label>เลขประจำตัวผู้เสียภาษี *</label>
                                            <input type="text" class="form-control" name="taxid" id="taxid" value="<?php echo $loop->taxid; ?>">
											<p class="help-block"><?php echo form_error('taxid'); ?></p>
                                    </div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-6">
								<button type="submit" class="btn btn-primary">  แก้ไขข้อมูลสาขา </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managebranch"); ?>'"> ยกเลิก </button>
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