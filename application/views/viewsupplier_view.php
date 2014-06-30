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
                <h3 class="page-header">ข้อมูลผู้จำหน่าย (Supplier)</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>แสดงข้อมูลผู้จำหน่าย</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
								<?php if(is_array($sup_array)) {
									foreach($sup_array as $loop){
								?>
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รหัสผู้จำหน่าย</label>
                                            <input type="text" class="form-control" name="supplierid" id="supplierid" value="<?php echo $loop->supplierID; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">คำนำหน้า</label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $loop->title; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							
							<div class="col-lg-8 col-lg-offset-1">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ชื่อผู้จำหน่าย</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $loop->name; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ที่อยู่</label>
                                            <textarea class="form-control" name="address" id="address" rows="3" style="font-weight: bold;" readonly><?php echo $loop->address; ?></textarea>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">จังหวัด</label>
                                        <input type="text" class="form-control" name="province" id="province" value="<?php echo $loop->province_name; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-3 col-lg-offset-1">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รหัสไปรษณีย์</label>
											<input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo $loop->zipcode; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
									
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
											<input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $loop->telephone; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-6">
									
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">FAX</label>
											
                                            <input type="text" class="form-control" name="fax" id="fax" value="<?php echo $loop->fax; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ชื่อผู้ติดต่อ</label>
                                            <input type="text" class="form-control" name="contactname" id="contactname" value="<?php echo $loop->contactName; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">เลขประจำตัวผู้เสียภาษี</label>
                                            <input type="text" class="form-control" name="taxid" id="taxid" value="<?php echo $loop->taxID; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-3">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">เงื่อนไขการชำระเงิน</label>
                                        <input type="text" class="form-control" name="status" id="status" value="<?php 
										if($loop->status==0) echo "-";
										elseif($loop->status==1) echo "สด";
										elseif($loop->status==2) echo "เชื่อ";
										?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-2">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">จำนวนวันเครดิต</label>
                                            <input type="text" class="form-control" name="creditday" id="creditday" value="<?php echo $loop->creditDay; ?>" style="font-weight: bold;" readonly>
                                    </div>
  
							</div>
						</div>
						<?php } } ?>
						<div class="row">
							<div class="col-lg-6">
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managesupplier"); ?>'"> กลับไปหน้าจัดการข้อมูลผู้จำหน่าย </button>
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