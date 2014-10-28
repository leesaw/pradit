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
                <h3 class="page-header">คืนสินค้า</h3>
            </div>
        </div>
		<div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>เลือกสาขา และ สถานะสินค้า</strong></div>
					<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail') echo '<div class="alert-message alert alert-danger"> ไม่มี Barcode นี้ในระบบ</div>';
					
					?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <form action="<?php echo site_url("managestock/savetemptostock_return"); ?>" method="post" accept-charset="utf-8" class="myform" id="myform" onsubmit="mySubmit.disabled = true; return true;">
                                    <div class="form-group">
                                    	<label>เข้าสต็อก สาขา *</label>
                                        <select class="form-control" name="branchid" id="branchid">
										<?php 	if(is_array($branch_array)) {
												foreach($branch_array as $loop){
													echo "<option value='".$loop->id."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-8">
                                    <div class="form-group">
                                            <label>เลขที่ใบส่งของชั่วคราว ของสินค้าที่คืน</label>
											<input type="text" class="form-control" name="billid" id="billid">
                                    </div>
							</div>
						</div>
		
						<div class="row">
							<div class="col-lg-8">
                                    <div class="form-group">
                                            <label>รายละเอียด</label>
											<textarea class="form-control" name="detail" id="detail" rows="2"></textarea>
                                    </div>
							</div>
						</div>
		
						<div class="row">
							<div class="col-lg-6">
									<button type="submit" class="btn btn-primary btn-lg" name="mySubmit">  บันทึก  </button>
									<button type="button" id="cancel" class="btn btn-warning btn-lg" onClick="window.location.href='<?php echo site_url("managestock/returnstockfrombarcode"); ?>'">  ยกเลิก  </button></a>
							</div>
						</div>
								
						<?php echo form_close(); ?>
                    <br/>
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-success">
                    <div class="panel-heading"><strong>รายการสินค้า</strong></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
										<th></th>
                                        <th>Barcode</th>
										<th>ชื่อ</th>
										<th width="80">จำนวน</th>
										<th>หน่วย</th>
                                    </tr>
                                </thead>
								<tbody>
                                    <?php   $count = 1;
                                            foreach($product_array as $loop) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $loop->pbarcode; ?></td>
                                        <td><?php echo $loop->pname; ?></td>
                                        <td><?php echo $loop->samount; ?></td>
                                        <td><?php echo $loop->unit; ?></td>
                                    </tr>
                                    <?php $count++; } ?>
                                </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>

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
<script type="text/javascript">
$(document).ready(function() {
     $("#cancel").click(function() {
             parent.$.fancybox.close();
     });
	 
});
</script>
</body>
</html>