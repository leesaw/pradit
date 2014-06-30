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
                <h3 class="page-header">บิล</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-10">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>กรุณาตรวจสอบข้อมูล </strong></div>
					<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail') echo '<div class="alert-message alert alert-danger"> ไม่มี Barcode นี้ในระบบ</div>';
					
					?>
                    <div class="panel-body">
					<?php echo form_open('managebill/saveCashBill'); ?>
						<div class="row">
                            <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">เลขที่บิล</label>
										
                                        <input type="text" class="form-control" name="cashid" id="cashid" value="<?php echo $cashid; ?>" readonly>

										</div>
                                      
                                    </div>

							</div>
						</div>
					<?php if(isset($branch_array)) { foreach($branch_array as $loop) { 
						echo form_hidden('branchid', $loop->id);
					?>
                        <div class="row">
                            <div class="col-lg-8">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">ที่อยู่สาขาที่ออกบิล</label>
										
                                        <input type="text" class="form-control" name="branchaddress" id="branchaddress" value="<?php echo $loop->address." จ.".$loop->province_name." ".$loop->zipcode; ?>" readonly>

										</div>
                                      
                                    </div>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" name="branchtelephone" id="branchtelephone" value="<?php echo $loop->telephone; ?>" readonly>

										</div>
                                      
                                    </div>

							</div>
							<div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">Fax</label>
                                        <input type="text" class="form-control" name="branchfax" id="branchfax" value="<?php echo $loop->fax; ?>" readonly>
										
										</div>
                                    </div>

							</div>
							<div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">เลขประจำตัวผู้เสียภาษี</label>
                                        <input type="text" class="form-control" name="branchtaxid" id="branchtaxid" value="<?php echo $loop->taxid; ?>" readonly>

										</div>
                                      
                                    </div>

							</div>
						</div>
						<?php } }?>
						<div class="row">
                            <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ชื่อลูกค้า</label>
										<?php echo form_hidden('cusid', $cusid); ?>
										<input type="text" class="form-control" name="cusname" id="cusname" value="<?php echo $cusname; ?>" readonly>
										</div>
                                    </div>

							</div>
							<div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">วันที่</label>
										<input type="text" class="form-control" name="date" id="date" value="<?php echo date('d')."/".date('m')."/".(date('Y')+543); ?>" readonly>
										</div>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-lg-6">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ที่อยู่ลูกค้า</label>
										<input type="text" class="form-control" name="cusaddress" id="cusaddress" value="<?php echo $cusaddress; ?>" readonly>
										</div>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ราคาขาย</label>
										<?php echo form_hidden('saleprice', $saleprice); ?>
										<input type="text" class="form-control" name="saleshow" id="saleshow" value="<?php 
										if ($saleprice==1) echo "ไม่มี VAT";
										elseif ($saleprice==2) echo "บวก VAT";
										elseif ($saleprice==3) echo "ลดราคา";
										?>" readonly>
										</div>
                                    </div>

							</div>
							<div class="col-lg-3">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ส่วนลด</label>
										<input type="text" class="form-control" name="discount" id="discount" value="<?php echo $discount; ?>" readonly>
										</div>
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
										<th>หน่วยละ</th>
										<th>จำนวนเงิน</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php 
								$pricesum = 0;
								if(isset($temp_array)) { foreach($temp_array as $loop) { 
								?>
									<tr>
									<td></td>
									<td><?php echo $loop->productname; ?></td>
									<td><?php echo number_format($loop->amount, 2, '.', ',')." ".$loop->unit; ?></td>
									<td><?php 	if ($saleprice==1 || $saleprice==2) { echo number_format($loop->priceNoVAT, 2, '.', ','); $priceperunit=$loop->priceNoVAT;  $price1 = $loop->amount*$loop->priceNoVAT; }
												//elseif ($saleprice==2) { echo $loop->priceVAT; $priceperunit=$loop->priceVAT;  $price1 = $loop->amount*$loop->priceVAT; }
												elseif ($saleprice==3) { echo number_format($loop->priceDiscount, 2, '.', ','); $priceperunit=$loop->priceDiscount;  $price1 = $loop->amount*$loop->priceDiscount; }
									?>
									</td>
									<td><?php echo number_format($price1, 2, '.', ',');
									$pricesum+=$price1; ?></td>
									</tr>
									
								<?php 
									$productid_array[] = $loop->pid;
									$price1_array[] = $priceperunit;
									$amount_array[] = $loop->amount;
									

									
								
								
								} }
									
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>
						<?php 
							for($i=0; $i<count($productid_array); $i++) {
								$data = array(
												  'productid[]'  => $productid_array[$i],
												  'price1[]' => $price1_array[$i],
												  'amount[]'   => $amount_array[$i]
												);
								echo form_hidden($data); 
							}
						?>
						<div class="row">
							<div class="col-lg-3">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">รวมเป็นเงิน</label>
										<input type="text" class="form-control" name="pricesum" id="pricesum" value="<?php echo number_format($pricesum, 2, '.', ','); ?>" readonly>
										</div>
                                    </div>

							</div>
							<div class="col-lg-3">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ยอดหลังหักส่วนลด</label>
										<?php echo form_hidden('totalprice', $pricesum-$discount); ?>
										<input type="text" class="form-control" name="pricesumdiscount" id="pricesumdiscount" value="<?php echo number_format($pricesum-$discount, 2, '.', ','); ?>" readonly>
										</div>
                                    </div>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">จำนวนภาษีมูลค่าเพิ่ม 7%</label>
										<input type="text" class="form-control" name="pricetax" id="pricetax" value="<?php 
										if ($saleprice==1) echo 0;
										else echo number_format(($pricesum-$discount)*0.07, 2, '.', ','); 
										?>" readonly>
										</div>
                                    </div>

							</div>
							<div class="col-lg-3">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">จำนวนเงินรวมทั้งสิ้น</label>
										<?php echo form_hidden('totalprice', $pricesum-$discount); ?>
										<input type="text" class="form-control" name="pricetotal" id="pricetotal" value="<?php 
										if ($saleprice==1) echo number_format($pricesum-$discount, 2, '.', ',');
										else echo number_format(($pricesum-$discount)*1.07, 2, '.', ','); 
										?>" readonly>
										</div>
                                    </div>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
									<button type="submit" class="btn btn-primary btn-lg">  ยืนยันข้อมูลลูกค้า  </button></a>
									<button type="button" id="cancel" class="btn btn-warning btn-lg" onClick="window.location.href='<?php echo site_url("managebill/addbillfrombarcode"); ?>'">  ยกเลิก  </button></a>
							</div>
						</div>
								
						<?php echo form_close(); ?>


					</div>
				</div>
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
			$("#cusaddress").val(ui.item.address);
			$("#cusid").val(ui.item.id);
			$("#saleprice").val(ui.item.saleprice);
			$("#discount").val(ui.item.discount);
        }
		});

		
		
	});

	
	
});
</script>
</body>
</html>