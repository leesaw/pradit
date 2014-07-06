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
            <div class="col-md-10">
                <h3 class="page-header">เพิ่มข้อมูลลูกค้า</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
					<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail') echo '<div class="alert-message alert alert-danger"> ระบบไม่สามารถเพิ่มข้อมูลได้</div>';
					
					?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <?php echo form_open('managecustomer/save'); ?>
                                    <div class="form-group">
                                            <label>รหัสลูกค้า *</label>
                                            <input type="text" class="form-control" name="customerid" id="customerid" value="<?php echo set_value('customerid'); ?>">
											<p class="help-block"><?php echo form_error('customerid'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
									<div class="form-group">
                                        <label>คำนำหน้า *</label>
                                        <select class="form-control" name="title" id="title">
										<?php 	if(is_array($title_array)) {
												foreach($title_array as $loop){
													echo "<option value='".$loop->name."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
							
							<div class="col-md-8">
									<div class="form-group">
                                            <label>ชื่อลูกค้า *</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>">
											<p class="help-block"><?php echo form_error('name'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
									<div class="form-group">
                                            <label>ที่อยู่ *</label>
                                            <textarea class="form-control" name="address" id="address" rows="3"><?php echo set_value('address'); ?></textarea>
											<p class="help-block"><?php echo form_error('address'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
									<div class="form-group">
                                        <label>จังหวัด *</label>
                                        <select class="form-control" name="province" id="province">
										<?php 	if(is_array($province_array)) {
												foreach($province_array as $loop){
													echo "<option value='".$loop->province_code."'>".$loop->province_name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group">
                                            <label>รหัสไปรษณีย์ *</label>
                                            <input type="text" class="form-control" name="zipcode" id="zipcode" maxlength="5" value="<?php echo set_value('zipcode'); ?>">
											<p class="help-block"><?php echo form_error('zipcode'); ?></p>
                                    </div>
							</div>
							<div class="col-md-4">
									<div class="form-group">
                                            <label>ภาค *</label>
                                            <select class="form-control" name="part" id="part">
											<option value="ภาคเหนือ">ภาคเหนือ</option>
											<option value="ภาคตะวันออกเฉียงเหนือ">ภาคตะวันออกเฉียงเหนือ</option>
											<option value="ภาคกลาง">ภาคกลาง</option>
											<option value="ภาคตะวันออก">ภาคตะวันออก</option>
											<option value="ภาคตะวันตก">ภาคตะวันตก</option>
											<option value="ภาคใต้">ภาคใต้</option>
											</select>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									
									<div class="form-group">
                                            <label>เบอร์โทรศัพท์ *</label>
                                            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo set_value('telephone'); ?>">
											<p class="help-block"><?php echo form_error('telephone'); ?></p>
                                    </div>
							</div>
							<div class="col-md-6">
									
									<div class="form-group">
                                            <label>FAX *</label>
                                            <input type="text" class="form-control" name="fax" id="fax" value="<?php echo set_value('fax'); ?>">
											<p class="help-block"><?php echo form_error('fax'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
                                            <label>ชื่อผู้ติดต่อ *</label>
                                            <input type="text" class="form-control" name="contactname" id="contactname" value="<?php echo set_value('contactname'); ?>">
											<p class="help-block"><?php echo form_error('contactname'); ?></p>
                                    </div>
							</div>
							<div class="col-md-4">
									<div class="form-group">
                                            <label>วงเงินอนุมัติ (Credit) *</label>
                                            <input type="text" class="form-control" name="credit" id="credit" value="<?php echo set_value('credit'); ?>">
											<p class="help-block"><?php echo form_error('credit'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									<div class="form-group">
                                            <label>เลขประจำตัวผู้เสียภาษี *</label>
                                            <input type="text" class="form-control" name="taxid" id="taxid" value="<?php echo set_value('taxid'); ?>">
											<p class="help-block"><?php echo form_error('taxid'); ?></p>
                                    </div>
							</div>
							<div class="col-md-4">
									<div class="form-group">
                                        <label>เงื่อนไขการชำระเงิน *</label>
                                        <select class="form-control" name="status" id="status">
											<option value="0">-</option>
											<option value="1">สด</option>
											<option value="2">เชื่อ</option>
                                        </select>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group">
                                            <label>จำนวนวันเครดิต </label>
                                            <input type="text" class="form-control" name="creditday" id="creditday" value="<?php echo set_value('creditday'); ?>">
											<p class="help-block"><?php echo form_error('creditday'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									<div class="form-group">
                                            <label>ราคาขาย *</label>
                                            <select class="form-control" name="saleprice" id="saleprice">
											<option value="1">ไม่มี VAT</option>
											<option value="2">บวก VAT</option>
											<option value="3">ลดราคา</option>
                                        </select>
                                    </div>
							</div>
							<div class="col-md-4">
									<div class="form-group">
                                            <label>ส่วนลด *</label>
                                            <input type="text" class="form-control" name="discount" id="discount" value="<?php echo set_value('discount'); ?>">
											<p class="help-block"><?php echo form_error('discount'); ?></p>
                                    </div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-8">
									<div class="form-group">
                                            <label>หมายเหตุ</label>
											<textarea class="form-control" name="note" id="note" rows="3"><?php echo set_value('note'); ?></textarea>
											<p class="help-block"><?php echo form_error('note'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									<button type="submit" class="btn btn-primary">  เพิ่มข้อมูลลูกค้า  </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managecustomer"); ?>'"> ยกเลิก </button>
							</div>
						</div>
								
									
						</form>

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