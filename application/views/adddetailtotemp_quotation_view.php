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
                <h3 class="page-header">ใบเสนอราคา</h3>
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
                            <div class="col-lg-3">
                                <?php 
									echo form_open('managebill/previewCashQuotation'); ?>
                                    <div class="form-group">
                                    	<label>สาขาที่ออกบิล *</label>
                                        <select class="form-control" name="branchid" id="branchid">
										<?php 	if(is_array($branch_array)) {
												foreach($branch_array as $loop){
													echo "<option value='".$loop->id."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>

							</div>
							<div class="col-lg-4">
                                    <div class="form-group">
                                    	<label>เลขที่บิล *</label>
                                        <input type="text" class="form-control" name="cashid" id="cashid" value="<?php echo set_value('cashid'); ?>">
										<p class="help-block"><?php echo form_error('cashid'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-lg-4">
                                    <div class="form-group">
                                    	<label>ชื่อลูกค้า *</label>
										<input type="hidden" name="cusid" id="cusid" value="<?php echo $cusid; ?>">
                                        <input type="text" class="form-control" name="cusname" id="cusname" value="<?php echo set_value('cusname'); ?>">
										<p class="help-block"><?php echo form_error('cusname'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-lg-6">
                                    <div class="form-group">
                                    	<label>ที่อยู่ลูกค้า *</label>
										<textarea class="form-control" name="cusaddress" id="cusaddress" rows="3"><?php echo set_value('cusaddress'); ?></textarea>
										<p class="help-block"><?php echo form_error('cusaddress'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-lg-6">
                                    <div class="form-group">
                                    	<label>ชื่อผู้ติดต่อ *</label>
										<input type="text" class="form-control" name="cuscontact" id="cuscontact" value="<?php echo set_value('cuscontact'); ?>">
										<p class="help-block"><?php echo form_error('cuscontact'); ?></p>
                                    </div>

							</div>
						</div>
						<div class="row">
						<!--
                            <div class="col-lg-3">
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
							<div class="col-lg-3">
                                    <div class="form-group">
                                    	<label>เงื่อนไขการชำระเงิน *</label>
                                            <select class="form-control" name="condition" id="condition">
											<option value="0" <?php echo set_select('condition', '0'); ?>>-</option>
											<option value="1" <?php echo set_select('condition', '1'); ?>>สด</option>
											<option value="2" <?php echo set_select('condition', '2'); ?>>เชื่อ</option>
                                        </select>
                                    </div>
									

							</div>
							<div class="col-lg-2">
									<div class="form-group">
                                            <label>จำนวนวันเครดิต </label>
                                            <input type="text" class="form-control" name="creditday" id="creditday" value="<?php echo set_value('creditday'); ?>">
											<p class="help-block"><?php echo form_error('creditday'); ?></p>
                                    </div>
							</div>
						</div>
						<div class="row">
                            <div class="col-lg-3">
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
							<div class="col-lg-3">
                                    <div class="form-group">
                                    	<label>ส่วนลด *</label>
                                        <input type="text" class="form-control" name="discount" id="discount" value="<?php echo set_value('discount'); ?>">
										<p class="help-block"><?php echo form_error('discount'); ?></p>
                                    </div>

							</div>
						</div>
						
		<div class="row">
			<div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
										<th>NO.</th>
                                        <th>รหัสสินค้า/รายละเอียด</th>
										<th>จำนวน</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(isset($temp_array)) { foreach($temp_array as $loop) { ?>
									<tr>
									<td></td>
									<td><?php echo $loop->productname; ?></td>
									<td><?php echo $loop->amount." ".$loop->unit; ?></td>
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
							<div class="col-lg-6">
									<button type="submit" class="btn btn-primary btn-lg">  ยืนยันข้อมูลลูกค้า  </button></a>
									<button type="button" id="cancel" class="btn btn-warning btn-lg" onClick="window.location.href='<?php echo site_url("managebill/addquotationfrombarcode"); ?>'">  ยกเลิก  </button></a>
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
	
        var oTable = $('#tablebarcode').dataTable
        ({
            "bJQueryUI": false,
            "bProcessing": true,
            "sPaginationType": "simple_numbers",
            'bServerSide'    : false,
			'bFilter'  : false,
			"bInfo": false,
			"bLengthChange" : false,
			"bPaginate" : false,
			"iDisplayLength": 10000,
            "bDeferRender": false,
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                $.ajax( {
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success":fnCallback
                
                });
            },
			
			"fnDrawCallback": function ( oSettings ) {
                /* Need to redo the counters if filtered or sorted */
                if ( oSettings.bSorted || oSettings.bFiltered )
                {
                    for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                    {
                        $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                    }
                }
            }
			
        });
		
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
									address: customer.cusaddress,
									saleprice: customer.saleprice,
									discount: customer.discount,
									contact: customer.contactName,
									credit: customer.creditDay,
									status: customer.status
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
			$("#saleprice").val(ui.item.saleprice);
			$("#discount").val(ui.item.discount);
			$("#cuscontact").val(ui.item.contact);
			$("#creditday").val(ui.item.credit);
			$("#condition").val(ui.item.status);
        }
		});

		
		
	});

	
	
});
</script>
</body>
</html>