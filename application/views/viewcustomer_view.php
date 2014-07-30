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
                <h3 class="page-header">ข้อมูลลูกค้า</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>แสดงข้อมูลลูกค้า</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
								<?php if(is_array($cus_array)) {
									foreach($cus_array as $loop){
								?>
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รหัสลูกค้า</label>
                                            <input type="text" class="form-control" name="customerid" id="customerid" value="<?php echo $loop->customerID; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">คำนำหน้า</label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $loop->title; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							
							<div class="col-md-8">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ชื่อลูกค้า</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $loop->name; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ที่อยู่</label>
                                            <textarea class="form-control" name="address" id="address" rows="3" style="font-weight: bold;" readonly><?php echo $loop->address; ?></textarea>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">จังหวัด</label>
                                        <input type="text" class="form-control" name="province" id="province" value="<?php echo $loop->province_name; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รหัสไปรษณีย์</label>
											<input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo $loop->zipcode; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-4">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">ภาค</label>
                                        <input type="text" class="form-control" name="part" id="part" value="<?php echo $loop->part; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
											<input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $loop->telephone; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-4">
									
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">FAX</label>
											
                                            <input type="text" class="form-control" name="fax" id="fax" value="<?php echo $loop->fax; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-4">
									
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">มือถือ</label>
											
                                            <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $loop->mobile; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ชื่อผู้ติดต่อ</label>
                                            <input type="text" class="form-control" name="contactname" id="contactname" value="<?php echo $loop->contactName; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-4">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">วงเงินอนุมัติ (Credit)</label>
                                            <input type="text" class="form-control" name="credit" id="credit" value="<?php echo $loop->credit; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">เลขประจำตัวผู้เสียภาษี</label>
                                            <input type="text" class="form-control" name="taxid" id="taxid" value="<?php echo $loop->taxID; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">เงื่อนไขการชำระเงิน</label>
                                        <input type="text" class="form-control" name="status" id="status" value="<?php 
										if($loop->status==0) echo "-";
										elseif($loop->status==1) echo "สด";
										elseif($loop->status==2) echo "เชื่อ";
										?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">จำนวนวันเครดิต</label>
                                            <input type="text" class="form-control" name="creditday" id="creditday" value="<?php echo $loop->creditDay; ?>" style="font-weight: bold;" readonly>
                                    </div>
  
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ราคาสินค้า</label>
                                            <input type="text" class="form-control" name="saleprice" id="saleprice"
											<?php if ($loop->salePrice == 1) echo 'value="ไม่มี VAT"';
												  else if ($loop->salePrice == 2) echo 'value="รวม VAT"';
												  else if ($loop->salePrice == 3) echo 'value="ส่วนลด"';
												  else { echo ""; }
											?> style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-4">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ส่วนลด</label>
                                            <input type="text" class="form-control" name="discount" id="discount" value="<?php echo $loop->discount; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">หมายเหตุ</label>
											<textarea class="form-control" name="note" id="note" rows="3" style="font-weight: bold;" readonly><?php echo $loop->note; ?></textarea>
                                    </div>
							</div>
						</div>
						<?php } } ?>
						<div class="row">
							<div class="col-md-6">
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managecustomer"); ?>'"> กลับไปหน้าจัดการข้อมูลลูกค้า </button>
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