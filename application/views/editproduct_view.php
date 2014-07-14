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
            <div class="col-md-12">
                <h3 class="page-heading">แก้ไขข้อมูลสินค้า</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
				
								
				<?php if ($this->session->flashdata('showresult') == 'success') {
						echo '<div class="panel-heading"><div class="alert alert-success"> ระบบทำการแก้ไขข้อมูลเรียบร้อยแล้ว</div>'; 
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageproduct/viewSelectedCat/".$this->session->flashdata('id')); ?>'"> กลับไปหน้าจัดการข้อมูลสินค้า</button></div> <?php
					  } else if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="panel-heading"><div class="alert alert-danger"> ระบบไม่สามารถแก้ไขข้อมูลได้</div>';
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageproduct/viewSelectedCat/".$this->session->flashdata('id')); ?>'"> กลับไปหน้าจัดการข้อมูลสินค้า </button></div> <?php
					  } else { 
				?>
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
								<?php echo form_open('manageproduct/update'); ?>
								
								<?php if(is_array($product_array)) {
									foreach($product_array as $loop){ 
								?>
                                    <div class="form-group">
									<input type="hidden" name="id" id="id" value="<?php echo $loop->pid; ?>">
                                            <label class="control-label">รหัสสินค้ามาตรฐาน *</label>
                                            <input type="text" class="form-control" name="standardid" id="standardid" value="<?php echo $loop->standardID; ?>" disabled>
											<p class="help-block"><?php echo form_error('standardid'); ?></p>
                                    </div>
							</div>
							<div class="col-md-4">
                                    <div class="form-group">
                                            <label>รหัสสินค้าผู้จำหน่าย *</label>
                                            <input type="text" class="form-control" name="supplierid" id="supplierid" value="<?php echo $loop->supplierID; ?>" >
											<p class="help-block"><?php echo form_error('supplierid'); ?></p>
                                    </div>
							</div>
							<div class="col-md-4">
                                    <div class="form-group">
                                            <label>Barcode *</label>
                                            <input type="text" class="form-control" name="barcode" id="barcode" value="<?php echo $loop->barcode; ?>" disabled>
											<p class="help-block"><?php echo form_error('barcode'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									<div class="form-group">
                                            <label>ชื่อสินค้า *</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $loop->pname; ?>">
											<p class="help-block"><?php echo form_error('name'); ?></p>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group">
                                        <label>ประเภทสินค้า *</label>
                                        <select class="form-control" name="categoryid" id="categoryid">
										<?php 	if(is_array($cat_array)) {
												foreach($cat_array as $loopcat){
													echo "<option value='".$loopcat->id."'";
													if ($loop->categoryID == $loopcat->id) echo " selected";
													echo ">".$loopcat->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
									<div class="form-group">
                                            <label>หน่วย *</label>
											<input type="text" class="form-control" name="unit" id="unit" value="<?php echo $loop->unit; ?>">
											<p class="help-block"><?php echo form_error('unit'); ?></p>
                                    </div>
							</div>
							<div class="col-md-3 col-md-offset-1">
									<div class="form-group">
                                            <label>ราคาทุน *</label>
                                            <input type="text" class="form-control" name="cost" id="cost" onChange="numberWithCommas(this);" value="<?php echo number_format($loop->costPrice, 2, '.', ','); ?>">
											<p class="help-block"><?php echo form_error('cost'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="panel panel-info">
							<div class="panel-heading"><b>ราคาขาย </b></div>
							<div class="panel-body">
							<div class="col-md-3">
									<div class="form-group">
                                            <label>ราคาไม่รวม VAT *</label>
                                            <input type="text" class="form-control" name="pricenovat" id="pricenovat" onChange="numberWithCommas(this);" value="<?php echo number_format($loop->priceNoVAT, 2, '.', ','); ?>">
											<p class="help-block"><?php echo form_error('pricenovat'); ?></p>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group">
                                            <label>ราคารวม VAT *</label>
                                            <input type="text" class="form-control" name="pricevat" id="pricevat" onChange="numberWithCommas(this);" value="<?php echo number_format($loop->priceVAT, 2, '.', ','); ?>">
											<p class="help-block"><?php echo form_error('pricevat'); ?></p>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="form-group">
                                            <label>ราคาต่ำสุด *</label>
                                            <input type="text" class="form-control" name="lowestprice" id="lowestprice" onChange="numberWithCommas(this);" value="<?php echo number_format($loop->lowestprice, 2, '.', ','); ?>">
											<p class="help-block"><?php echo form_error('lowestprice'); ?></p>
                                    </div>
							</div>
							<!--
							<div class="col-md-3">
									<div class="form-group">
                                            <label>ราคารวมส่วนลด *</label>
                                            <input type="text" class="form-control" name="pricediscount" id="pricediscount" onChange="numberWithCommas(this);" value="<?php echo number_format($loop->priceDiscount, 2, '.', ','); ?>">
											<p class="help-block"><?php echo form_error('pricediscount'); ?></p>
                                    </div>
							</div>
							-->
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
									<div class="form-group">
                                            <label>รายละเอียดสินค้า *</label>
											<textarea class="form-control" name="detail" id="detail" rows="3"><?php echo $loop->detail; ?></textarea>
											<p class="help-block"><?php echo form_error('detail'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
									<div class="form-group">
                                            <label>ชั้นเก็บ</label>
                                            <input type="text" class="form-control" name="shelf" id="shelf" value="<?php echo $loop->shelf; ?>">
											<p class="help-block"><?php echo form_error('shelf'); ?></p>
                                    </div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
									<button type="submit" class="btn btn-primary">  แก้ไขข้อมูลสินค้า  </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageproduct/viewSelectedCat/".$loop->categoryID); ?>'"> ยกเลิก </button>
							</div>
						</div>
								
						<?php } } ?>			
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
<script>

function numberWithCommas(obj) {
	var x=$(obj).val();
    var parts = x.toString().split(".");
	parts[0] = parts[0].replace(/,/g,"");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $(obj).val(parts.join("."));
}
</script>
</body>
</html>