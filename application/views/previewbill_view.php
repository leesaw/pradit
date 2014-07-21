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
					<div class="panel-heading"><strong>กรุณาตรวจสอบข้อมูล </strong></div>
					<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail') echo '<div class="alert-message alert alert-danger"> ไม่มี Barcode นี้ในระบบ</div>';
					
					?>
                    <div class="panel-body">
					<?php echo form_open('managebill/saveCashBill'); ?>
						<div class="row">
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">เลขที่ใบส่งสินค้าชั่วคราว</label>
										
                                        <input type="text" class="form-control" name="cashid" id="cashid" value="<?php echo $cashid; ?>" readonly>

										</div>
                                      
                                    </div>

							</div>
						</div>
					<?php if(isset($branch_array)) { foreach($branch_array as $loop) { 
						echo form_hidden('branchid', $loop->id);
					?>
                        <div class="row">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">ที่อยู่สาขาที่ออก</label>
										
                                        <input type="text" class="form-control" name="branchaddress" id="branchaddress" value="<?php echo $loop->address." จ.".$loop->province_name." ".$loop->zipcode; ?>" readonly>

										</div>
                                      
                                    </div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" name="branchtelephone" id="branchtelephone" value="<?php echo $loop->telephone; ?>" readonly>

										</div>
                                      
                                    </div>

							</div>
							<div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">Fax</label>
                                        <input type="text" class="form-control" name="branchfax" id="branchfax" value="<?php echo $loop->fax; ?>" readonly>
										
										</div>
                                    </div>

							</div>
							<div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">เลขประจำตัวผู้เสียภาษี</label>
                                        <input type="text" class="form-control" name="branchtaxid" id="branchtaxid" value="<?php echo $loop->taxid; ?>" readonly>

										</div>
                                      
                                    </div>

							</div>
						</div>
						<?php } }?>
						<hr/>
						<div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ชื่อลูกค้า</label>
										<?php echo form_hidden('cusid', $cusid); ?>
										<input type="text" class="form-control" name="cusname" id="cusname" value="<?php echo $cusname; ?>" readonly>
										</div>
                                    </div>

							</div>
							<div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">วันที่</label>
										<input type="text" class="form-control" name="date" id="date" value="<?php echo date('d')."/".date('m')."/".(date('Y')+543); ?>" readonly>
										</div>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-md-12">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ที่อยู่ลูกค้า</label>
										<input type="text" class="form-control" name="cusaddress" id="cusaddress" value="<?php echo $cusaddress; ?>" readonly>
										</div>
                                    </div>

							</div>
						</div>
						<div class="row">
                            <div class="col-md-3">
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
							<div class="col-md-3">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ส่วนลด (บาท) </label>
										<input type="text" class="form-control" name="discount" id="discount" value="<?php echo $discount; ?>" readonly>
										</div>
                                    </div>

							</div>
							<div class="col-md-3">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ส่วนลด (%) </label>
										<input type="text" class="form-control" name="discount2" id="discount2" value="<?php echo $discount2; ?>" readonly>
										</div>
                                    </div>

							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
									<div class="form-group">
                                        <div class="form-group has-success">
                                    	<label class="control-label" for="inputSuccess">ขนส่งโดย</label>
										<input type="text" class="form-control" name="transport" id="transport" value="<?php echo $transport; ?>" readonly>
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
										<th>NO.</th>
                                        <th>รหัสสินค้า/รายละเอียด</th>
										<th>จำนวน</th>
										<th>หน่วยละ</th>
										<th style="width: 20%">จำนวนเงิน</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php 
								$pricesum = 0;
								$numindex = 0;
								if(isset($temp_array)) { foreach($temp_array as $loop) { 
									$numindex++;
									if ($vat==2) $price = ceil($loop->price*100/(100+$percentvat));
									else $price = $loop->price;
								?>
									<tr>
									<td><?php echo $numindex; ?></td>
									<td><?php echo $loop->productname; ?></td>
									<td><?php echo number_format($loop->sumamount, 2, '.', ',')." ".$loop->unit; ?></td>
									<td><?php echo number_format($price, 2, '.', ','); $priceperunit=$price;  $price1 = $loop->sumamount*$price;  
												/*}
												elseif ($saleprice==2) { echo number_format(ceil($loop->price*0.93), 2, '.', ','); $priceperunit=$loop->price;  $price1 = $loop->sumamount*$loop->price; }
												elseif ($saleprice==3) { echo number_format($loop->price, 2, '.', ','); $priceperunit=$loop->price;  $price1 = $loop->sumamount*$loop->price; } */
									?>
									</td>
									<td><?php echo number_format($price1, 2, '.', ',');
									$pricesum+=$price1; ?></td>
									</tr>
									
								<?php 
									$productid_array[] = $loop->pid;
									$price1_array[] = $priceperunit;
									$amount_array[] = $loop->sumamount;
									

									
								
								
								} }
									
								?>
								</tbody>
							</table>
							<table class="table table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="width: 45%"></th>
									<th style="width: 35%">รวมเป็นเงิน</th>
									<?php echo form_hidden('totalprice', $pricesum); ?>
									<th style="text-align: right;width: 20%"><?php echo number_format($pricesum, 2, '.', ','); ?></th>
								</tr>
								<tr>
									<th style="width: 45%"></th>
									<th style="width: 35%">หักส่วนลด</th>
									<?php 
									$pricesum_discount = ($discount)+(($pricesum-$discount)*$discount2/100);
									echo form_hidden('totaldiscount', $pricesum_discount); ?>
									<th style="text-align: right;width: 20%"><?php echo number_format($pricesum_discount, 2, '.', ','); ?></th>
								</tr>
								<tr>
									<th style="width: 45%"></th>
									<th style="width: 35%">ยอดหลังหักส่วนลด</th>
									<?php 
									$pricesum_after_discount = $pricesum - $pricesum_discount;
									echo form_hidden('totalafterdiscount', $pricesum_after_discount); ?>
									<th style="text-align: right;width: 20%"><?php echo number_format($pricesum_after_discount, 2, '.', ','); ?></th>
								</tr>
								<tr>
									<th style="width: 45%"></th>
									<th style="width: 35%">จำนวนภาษีมูลค่าเพิ่ม <?php $percentvat=number_format($percentvat, 2, '.', ','); echo $percentvat."% "; if ($vat==2) echo "(รวม vat)"; elseif ($vat==3) echo "(แยก vat)";?></th>
									<?php 
									if ($vat==3) $pricevat7 = ($pricesum_after_discount*$percentvat/100);
									elseif ($vat==2) $pricevat7 = ($pricesum_after_discount*$percentvat/100);
									else $pricevat7 = 0;
									echo form_hidden('totalvat', $pricevat7); 
									echo form_hidden('percentvat', $percentvat); 
									?>
									<th style="text-align: right;width: 20%"><?php echo number_format($pricevat7, 2, '.', ','); ?></th>
								</tr>
								<tr>
									<th style="width: 45%"></th>
									<th style="width: 35%">จำนวนเงินรวมทั้งสิ้น</th>
									<?php 
									$finalprice = $pricesum_after_discount + $pricevat7;
									echo form_hidden('finalprice', $finalprice); ?>
									<th style="text-align: right;width: 20%"><?php echo number_format($finalprice, 2, '.', ','); ?></th>
								</tr>
							</thead>
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