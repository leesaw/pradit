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
                <h3 class="page-header">ใบส่งสินค้าชั่วคราว</h3>
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
									echo form_open('managebill/previewCashBill'); ?>
                                    <div class="form-group">
                                    	<label>สาขาที่ออก *</label>
                                        <select class="form-control" name="branchid" id="branchid">
										<?php 	if(is_array($branch_array)) {
												foreach($branch_array as $loop){
													echo "<option value='".$loop->id."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>

							</div>
							<div class="col-md-4">
                                    <div class="form-group">
                                    	<label>เลขที่ใบส่งสินค้าชั่วคราว *</label>
                                        <input type="text" class="form-control" name="cashid" id="cashid" value="<?php echo set_value('cashid'); ?>">
										<p class="help-block"><?php echo form_error('cashid'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                    	<label>ชื่อลูกค้า *</label>
										<input type="hidden" name="cusid" id="cusid" value="<?php echo $cusid; ?>">
                                        <input type="text" class="form-control" name="cusname" id="cusname" value="<?php echo set_value('cusname'); ?>">
										<p class="help-block"><?php echo form_error('cusname'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                    	<label>ที่อยู่ลูกค้า *</label>
										<textarea class="form-control" name="cusaddress" id="cusaddress" rows="3"><?php echo set_value('cusaddress'); ?></textarea>
										<p class="help-block"><?php echo form_error('cusaddress'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-md-3">
                                    <div class="form-group">
                                    	<label>ราคาขาย *</label>
                                            <select class="form-control" name="saleprice" id="saleprice">
											<option value="0"></option>
											<option value="1" <?php echo set_select('saleprice', '1'); ?>>ไม่มี VAT</option>
											<option value="2" <?php echo set_select('saleprice', '2'); ?>>บวก VAT</option>
											<option value="3" <?php echo set_select('saleprice', '3'); ?>>ลดราคา</option>
                                        </select>
                                    </div>

							</div>
							<div class="col-md-3">
                                    <div class="form-group">
                                    	<label>ส่วนลด (บาท) *</label>
                                        <input type="text" class="form-control" name="discount" id="discount" value="<?php echo set_value('discount'); ?>">
										<p class="help-block"><?php echo form_error('discount'); ?></p>
                                    </div>

							</div>
							<div class="col-md-3">
                                    <div class="form-group">
                                    	<label>ส่วนลด (%) *</label>
                                        <input type="text" class="form-control" name="discount2" id="discount2" value="<?php echo set_value('discount2'); ?>">
										<p class="help-block"><?php echo form_error('discount2'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									<div class="form-group">
                                            <label>ขนส่งโดย </label>
                                            <input type="text" class="form-control" name="transport" id="transport" value="<?php echo set_value('transport'); ?>">
											<p class="help-block"><?php echo form_error('transport'); ?></p>
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
								<?php $numIndex = 0; 
									if(isset($temp_array)) { foreach($temp_array as $loop) { 
										$numIndex++;
									?>
									<tr>
									<td><?php echo $numIndex; ?></td>
									<td><a id="fancyboxview" href="<?php echo site_url("manageproduct/viewproduct_iframe/".$loop->_productid);  ?>"><?php echo $loop->productname; ?></a></td>
									<td><?php echo $loop->sumamount." ".$loop->unit; ?></td>
									<td>
									<input type="hidden" name="barcode[]" value="<?php echo $loop->_barcode; ?>">
									<input type="hidden" name="lowestprice[]" id="lowestprice<?php echo $loop->tid; ?>" value="<?php echo $loop->lowestPrice; ?>">
									<input type="text" class="form-control" name="price[]" onchange="checklowest(<?php echo $loop->tid; ?>);" id="price<?php echo $loop->tid; ?>" value="<?php echo $loop->priceVAT; ?>"</td>
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
									<button type="submit" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-thumbs-up"></span>  ยืนยันข้อมูลลูกค้า  </button></a>
									<button type="button" id="cancel" class="btn btn-warning btn-md" onClick="window.location.href='<?php echo site_url("managebill/addbillfrombarcode"); ?>'">  ยกเลิก  </button></a>
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
		var mytextbox = document.getElementById('branchid').value  + "-HS" + zeroPad(++_lastid,7);;
		$('#cashid').val(mytextbox);
		
		$('#fancyboxview').fancybox({ 
		'width': '70%',
		'height': '70%', 
		'autoScale':false,
		'transitionIn':'none', 
		'transitionOut':'none', 
		'type':'iframe'}); 
		
    });
</script>
<script type="text/javascript">
$(document).ready(function()
{
	$(function(){
		$('#cusname').autocomplete({
			source: function(request, response){
				 $.ajax({
                    url: "<?php echo site_url('managebill/autocompleteResponse'); ?>",
                    dataType: "json",
                    data: {term: request.term},
                    success: function(data) {
                                response($.map(data, function(customer) {
                                return {
									id: customer.cusid,
                                    name: customer.cusname,
									value: customer.cusname,
									address: customer.address,
									provinceid: customer.province_code,
									provincename: customer.province_name,
									zipcode: customer.zipcode,
									saleprice: customer.saleprice,
									discount: customer.discount
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
			if (ui.item.provinceid == 10) $("#cusaddress").val(ui.item.address+" "+ui.item.provincename+" "+ui.item.zipcode);
			else $("#cusaddress").val(ui.item.address+" จ. "+ui.item.provincename+" "+ui.item.zipcode);
			$("#cusid").val(ui.item.id);
			$("#saleprice").val(ui.item.saleprice);
			$("#discount").val(ui.item.discount);
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

function get_datepicker(id)
{

	$(id).datepicker({ language:'th-th',format:'dd/mm/yyyy'
		    });

}

function checklowest(id)
{
	var _lowestprice = (document.getElementById('lowestprice'+id).value);
	var _price = (document.getElementById('price'+id).value);

	if (_price < _lowestprice) {
		alert("ราคาที่กำหนด ต่ำกว่าราคาต่ำสุด");
		/*window.setTimeout(function () { 
			document.getElementById('price'+id).focus(); 
		}, 0); */
	}
}
</script>
</body>
</html>