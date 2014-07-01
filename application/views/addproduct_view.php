<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-select.css" >
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
	
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-8">
                <h3 class="page-header">เพิ่มข้อมูลสินค้า</h3>
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
                            <div class="col-lg-4">
                                <?php echo form_open('manageproduct/save'); ?>
                                    <div class="form-group">
                                            <label>รหัสสินค้ามาตรฐาน *</label>
                                            <input type="text" class="form-control" name="standardid" id="standardid" value="<?php echo set_value('standardid'); ?>">
											<p class="help-block"><?php echo form_error('standardid'); ?></p>
                                    </div>
							</div>
							<div class="col-lg-4">
                                    <div class="form-group">
                                            <label>รหัสสินค้าผู้จำหน่าย *</label>
                                            <input type="text" class="form-control" name="supplierid" id="supplierid" value="<?php echo set_value('supplierid'); ?>">
											<p class="help-block"><?php echo form_error('supplierid'); ?></p>
                                    </div>
							</div>
							<div class="col-lg-4">
                                    <div class="form-group">
                                            <label>Barcode *</label>
                                            <input type="text" class="form-control" name="barcode" id="barcode" value="<?php echo set_value('barcode'); ?>">
											<p class="help-block"><?php echo form_error('barcode'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
									<div class="form-group">
                                            <label>ชื่อสินค้า *</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>">
											<p class="help-block"><?php echo form_error('name'); ?></p>
                                    </div>
							</div>
							<div class="col-lg-3">
									<div class="form-group">
                                        <label>ประเภทสินค้า *</label>
                                        <select class="form-control" name="categoryid" id="categoryid">
										<?php 	if(is_array($cat_array)) {
												foreach($cat_array as $loop){
													echo "<option value='".$loop->id."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
									<div class="form-group">
                                            <label>หน่วย *</label>
											<input type="text" class="form-control" name="unit" id="unit" value="<?php echo set_value('unit'); ?>">
											<p class="help-block"><?php echo form_error('unit'); ?></p>
                                    </div>
							</div>
							<div class="col-lg-3 col-lg-offset-1">
									<div class="form-group">
                                            <label>ราคาทุน *</label>
                                            <input type="text" class="form-control" name="cost" id="cost" value="<?php echo set_value('cost'); ?>">
											<p class="help-block"><?php echo form_error('cost'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
									<div class="form-group">
                                            <label>ราคาไม่รวม VAT *</label>
                                            <input type="text" class="form-control" name="pricenovat" id="pricenovat" value="<?php echo set_value('pricenovat'); ?>">
											<p class="help-block"><?php echo form_error('pricenovat'); ?></p>
                                    </div>
							</div>
							
							<div class="col-lg-3 col-lg-offset-1">
									<div class="form-group">
                                            <label>ราคารวม VAT *</label>
                                            <input type="text" class="form-control" name="pricevat" id="pricevat" value="<?php echo set_value('pricevat'); ?>">
											<p class="help-block"><?php echo form_error('pricevat'); ?></p>
                                    </div>
							</div>
							<div class="col-lg-3 col-lg-offset-1">
									<div class="form-group">
                                            <label>ราคารวมส่วนลด *</label>
                                            <input type="text" class="form-control" name="pricediscount" id="pricediscount" value="<?php echo set_value('pricediscount'); ?>">
											<p class="help-block"><?php echo form_error('pricediscount'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-8">
									<div class="form-group">
                                            <label>รายละเอียดสินค้า *</label>
											<textarea class="form-control" name="detail" id="detail" rows="3"><?php echo set_value('detail'); ?></textarea>
											<p class="help-block"><?php echo form_error('detail'); ?></p>
                                    </div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
									<button type="submit" class="btn btn-primary">  เพิ่มข้อมูลสินค้า  </button>
									<button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("manageproduct"); ?>'"> ยกเลิก </button>
							</div>
						</div>
								
									
						</form>

					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
<script type='text/javascript' src="<?php echo base_url(); ?>js/bootstrap-select.js"></script>
<?php $this->load->view('js_footer'); ?>
<script>
$(".alert-message").alert();
window.setTimeout(function() { $(".alert-message").alert('close'); }, 2000);
</script>
</body>
</html>