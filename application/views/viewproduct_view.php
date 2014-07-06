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
            <div class="col-lg-12">
                <h3 class="page-header">ข้อมูลสินค้า</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>แสดงข้อมูลสินค้า</strong></div>
                    <div class="panel-body">
					<?php if(is_array($product_array)) {
							foreach($product_array as $loop){
					?>
						<div class="row">
                            <div class="col-md-4">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รหัสสินค้ามาตรฐาน</label>
                                            <input type="text" class="form-control" name="standardid" id="standardid" value="<?php echo $loop->standardID; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-4">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รหัสสินค้าผู้จำหน่าย</label>
                                            <input type="text" class="form-control" name="supplierid" id="supplierid" value="<?php echo $loop->supplierID; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-4">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Barcode</label>
                                            <input type="text" class="form-control" name="barcode" id="barcode" value="<?php echo $loop->barcode; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ชื่อสินค้า</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $loop->pname; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">ประเภทสินค้า</label>
                                        <input type="text" class="form-control" name="category" id="category" value="<?php echo $loop->cname; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">หน่วย</label>
											<input type="text" class="form-control" name="unit" id="unit" value="<?php echo $loop->unit; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							<div class="col-md-3 col-md-offset-1">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ราคาทุน</label>
                                            <input type="text" class="form-control" name="cost" id="cost" value="<?php echo number_format($loop->costPrice, 2, '.', ','); ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="panel panel-info">
							<div class="panel-heading"><b>ราคาขาย </b></div>
							<div class="panel-body">
							<!--
							<div class="col-md-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ราคาไม่รวม VAT</label>
                                            <input type="text" class="form-control" name="pricenovat" id="pricenovat" value="<?php echo number_format($loop->priceNoVAT, 2, '.', ','); ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							-->
							<div class="col-md-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ราคารวม VAT</label>
                                            <input type="text" class="form-control" name="pricevat" id="pricevat" value="<?php echo number_format($loop->priceVAT, 2, '.', ','); ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div> 
							<div class="col-md-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ราคาต่ำสุด</label>
                                            <input type="text" class="form-control" name="lowestprice" id="lowestprice" value="<?php echo number_format($loop->lowestprice, 2, '.', ','); ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div> 
							<div class="col-md-3">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ราคารวมส่วนลด</label>
                                            <input type="text" class="form-control" name="pricediscount" id="pricediscount" value="<?php echo number_format($loop->priceDiscount, 2, '.', ','); ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">รายละเอียดสินค้า</label>
											<textarea class="form-control" name="detail" id="detail" rows="3" style="font-weight: bold;" readonly><?php echo $loop->detail; ?></textarea>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ราคารวมส่วนลด</label>
                                            <input type="text" class="form-control" name="shelf" id="shelf" value="<?php echo $loop->shelf; ?>" style="font-weight: bold;" readonly>
                                    </div>
							</div>
						</div>
                        
						
						<div class="row">
							<div class="col-md-5">
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageproduct/viewSelectedCat/".$loop->categoryID); ?>'"> กลับไปหน้าจัดการข้อมูลสินค้า </button>
							</div>
							<div class="col-md-3">
								<a id="fancyboxview" href="<?php echo site_url("manageproduct/jquerybarcode/".$loop->barcode);  ?>"><button type="button" class="btn btn-info btn-md"> พิมพ์ Barcode </button></a>
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