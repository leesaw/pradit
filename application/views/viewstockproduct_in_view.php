<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.fancybox.css" >
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
	
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-8">
                <h3 class="page-header">ข้อมูลสินค้าเข้าสต็อก</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>แสดงข้อมูล</strong></div>
                    <div class="panel-body">
					<?php if(is_array($stock_array)) {
							foreach($stock_array as $loop){
					?>
						<div class="row">
                            <div class="col-lg-4">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รหัสสินค้ามาตรฐาน</label>
                                            <input type="text" class="form-control" name="standardid" id="standardid" value="<?php echo $loop->standardID; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-4">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รหัสสินค้าผู้จำหน่าย</label>
                                            <input type="text" class="form-control" name="supplierid" id="supplierid" value="<?php echo $loop->supplierID; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-4">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Barcode</label>
                                            <input type="text" class="form-control" name="barcode" id="barcode" value="<?php echo $loop->barcode; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ชื่อสินค้า</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $loop->pname; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-3">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">ประเภทสินค้า</label>
                                        <input type="text" class="form-control" name="category" id="category" value="<?php echo $loop->cname; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-2">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">หน่วย</label>
											<input type="text" class="form-control" name="unit" id="unit" value="<?php echo $loop->unit; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">สถานะ</label>
                                            <input type="text" class="form-control" name="stockstatus" id="stockstatus" value="<?php 
											if ($loop->stockstatus == 1)   echo "ซื้อเข้า"; 
											elseif ($loop->stockstatus == 2)   echo "ย้ายคลัง"; 
											?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">สาขา</label>
                                            <input type="text" class="form-control" name="bname" id="bname" value="<?php echo $loop->bname; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-8">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รายละเอียด</label>
											<textarea class="form-control" name="detail" id="detail" rows="3" style="font-weight: bold;" readonly><?php echo $loop->stockdetail; ?></textarea>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $loop->username; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ชื่อผู้ใส่ข้อมูล</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $loop->firstname; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-lg-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">นามสกุลผู้ใส่ข้อมูล</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $loop->lastname; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">วันและเวลาที่ใส่ข้อมูล</label>
                                            <input type="text" class="form-control" name="onDate" id="onDate" value="<?php echo date("d M Y H:i", strtotime($loop->onDate)); ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
                        
						
						<div class="row">
							<div class="col-lg-5">
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("managestock/viewStockINSelectedCat/".$loop->categoryID); ?>'"> กลับไปหน้าประวัติสินค้าเข้าสต็อก </button>
							</div>
						</div>
								
						<?php } } ?>			
						</form>

					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>
<script type='text/javascript'> 
$(document).ready(function() {
$('#fancyboxview').fancybox({ 
'width': '50%',
'height': '70%', 
'autoScale':false,
'transitionIn':'none', 
'transitionOut':'none', 
'type':'iframe'}); 
});
 </script>
<script>
$(".alert-message").alert();
window.setTimeout(function() { $(".alert-message").alert('close'); }, 2000);
</script>
</body>
</html>