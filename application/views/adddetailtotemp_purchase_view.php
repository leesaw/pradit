<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.fancybox.css" >
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui-1.10.4.min.css" >
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-8">
                <h3 class="page-header">ใบสั่งซื้อ</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-10">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>กรุณาใส่ข้อมูลให้ครบทุกช่อง</strong></div>
					<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail') echo '<div class="alert-message alert alert-danger"> ไม่มี Barcode นี้ในระบบ</div>';
					
					?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <?php 
									echo form_open('managepurchase/previewCashPurchase'); ?>
                                    <div class="form-group">
                                    	<label>สาขาที่ออกใบสั่งซื้อ *</label>
                                        <select class="form-control" name="branchid" id="branchid" onchange="autonumber(this);">
										<?php 	if(is_array($branch_array)) {
												foreach($branch_array as $loop){
													echo "<option value='".$loop->id."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>

							</div>
							<div class="col-md-5">
                                    <div class="form-group">
                                    	<label>เลขที่ใบสั่งซื้อ *</label>
                                        <input type="text" class="form-control" name="purchaseid" id="purchaseid" value="<?php echo set_value('purchaseid'); ?>">
										<p class="help-block"><?php echo form_error('purchaseid'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                    	<label>ชื่อซัพพลายเออร์ *</label>
										<input type="hidden" name="cusid" id="cusid" value="<?php echo $cusid; ?>">
                                        <input type="text" class="form-control" name="cusname" id="cusname" value="<?php echo set_value('cusname'); ?>">
										<p class="help-block"><?php echo form_error('cusname'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-md-8">
                                    <div class="form-group">
                                    	<label>ที่อยู่ซัพพลายเออร์ *</label>
										<textarea class="form-control" name="cusaddress" id="cusaddress" rows="3"><?php echo set_value('cusaddress'); ?></textarea>
										<p class="help-block"><?php echo form_error('cusaddress'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                    	<label>ชื่อผู้ติดต่อ *</label>
										<input type="text" class="form-control" name="cuscontact" id="cuscontact" value="<?php echo set_value('cuscontact'); ?>">
										<p class="help-block"><?php echo form_error('cuscontact'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
						<!--
                            <div class="col-md-3">
                                    <div class="form-group">
                                    	<label>ราคาซื้อ *</label>
                                            <select class="form-control" name="lastprice" id="lastprice">
											<option value="0"></option>
											<option value="1" <?php //echo set_select('lastprice', '1'); ?>>ไม่มี VAT</option>
											<option value="2" <?php //echo set_select('lastprice', '2'); ?>>บวก VAT</option>
                                        </select>
                                    </div>

							</div>
						-->
							<div class="col-md-3">
                                    <div class="form-group">
                                    	<label>เงื่อนไขการชำระเงิน *</label>
                                            <select class="form-control" name="condition" id="condition">
											<option value="0" <?php echo set_select('condition', '0'); ?>>-</option>
											<option value="1" <?php echo set_select('condition', '1'); ?>>สด</option>
											<option value="2" <?php echo set_select('condition', '2'); ?>>เชื่อ</option>
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
							<div class="col-md-6">
								<div class="form-group">
								<label>ราคา *</label>
                                <div class="form-group">
									<label class="radio-inline"><input type="radio" name="vat" id="vat" value="0">ไม่รวม VAT</label>
									<label class="radio-inline"><input type="radio" name="vat" id="vat" value="1" checked>รวม VAT</label>
								</div>
								</div>
							</div>
						</div>
						
		<div class="row">
			<div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
										<th>ลำดับ</th>
                                        <th>รหัสสินค้า/รายละเอียด</th>
										<th>จำนวน</th>
										<th style="text-align: center;width: 20%">ราคาต่อหน่วย</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php 
									$numIndex = 0;
									if(isset($temp_array)) { foreach($temp_array as $loop) { 
										$numIndex++;
									?>
									<tr>
									<td><?php echo $numIndex; ?></td>
									<td><?php echo $loop->productname; ?></td>
									<td><?php echo $loop->sumamount." ".$loop->unit; ?></td>
									<td>
									<input type="hidden" name="barcode[]" value="<?php echo $loop->_barcode; ?>">
									<input type="text" class="form-control" name="price[]" id="price<?php echo $loop->tid; ?>" value="<?php echo $loop->costPrice; ?>"</td>
									</tr>
								<?php } }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
						<div class="row">
							<div class="col-md-6">
									<button type="submit" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-thumbs-up"></span>  ยืนยันข้อมูลซัพพลายเออร์  </button></a>
									<button type="button" id="cancel" class="btn btn-warning btn-md" onClick="window.location.href='<?php echo site_url("managepurchase/addpurchasefrombarcode"); ?>'">  ยกเลิก  </button></a>
							</div>
						</div>
								
						<?php echo form_close(); ?>


					</div>
				</div>
			</div>	
		</div>

<br><br><br><br><br><br>
<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>/js/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.4.min.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function()
    {
		$("#barcode").focus();
		// auto insert po id
		var _lastid = <?php echo json_encode($lastid); ?>;
		var mytextbox = document.getElementById('branchid').value  + "-PO" + zeroPad(++_lastid,7);;
		$('#purchaseid').val(mytextbox);
	
        
		
    });
</script>
<script type="text/javascript">
$(document).ready(function()
{
	$(function(){
		$('#cusname').autocomplete({
			source: function(request, response){
				 $.ajax({
                    url: "<?php echo site_url('managepurchase/autocompleteResponse'); ?>",
                    dataType: "json",
                    data: {term: request.term},
                    success: function(data) {
                                response($.map(data, function(supplier) {
                                return {
									id: supplier.supid,
                                    name: supplier.supname,
									value: supplier.supname,
									address: supplier.supaddress,
									contact: supplier.contactName,
									credit: supplier.creditDay,
									status: supplier.supstatus,
                                    };
                            }));
                        }
                    });
    

			},
			minLength: 2,
			autofocus: true,
			select: function (event, ui) {
            event.preventDefault();
			$("#cusname").val(ui.item.name);
			$("#cusaddress").val(ui.item.address);
			$("#cusid").val(ui.item.id);
			$("#cuscontact").val(ui.item.contact);
			$("#creditday").val(ui.item.credit);
			$("#condition").val(ui.item.status);
        }
		});

		
		
	});

	
	
});

function autonumber(obj,id) {
	var _lastid = <?php echo json_encode($lastid); ?>;
	var po=$(obj).val() + "-PO" + zeroPad(++_lastid,7);
	$('#purchaseid').val(po);
}

function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}
</script>
</body>
</html>