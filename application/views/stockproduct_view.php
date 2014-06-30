<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
	<?php $url = site_url("manageproduct/delete"); ?>
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-10">
                <h3 class="page-header">ตรวจสอบจำนวนสินค้า</h3>
            </div>
        </div>

						<div class="row">
							<form method="post">
							<div class="col-lg-4">
									<div class="form-group">
                                        <label>เลือก สาขา</label>
										<select class="form-control" name="branchid" id="branchid" onChange="this.form.action='<?php echo site_url('managestock/viewStockByBranch')?>/'+this.value;this.form.submit()"> 
											<option value=""></option>
										<?php 	if(is_array($branch_array)) {
												foreach($branch_array as $loop){
													echo "<option value='".$loop->id."'";
													if ($branchid==$loop->id) echo " selected";
													echo ">".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
							</form>
						</div>
		<div class="row">
            <div class="col-lg-2">
				<div class="panel-body">
					<div class="row">
						<div class="well" style="width:220px; padding: 8px 10px;">
							<div style="overflow-y: scroll; overflow-x: hidden; height: 300px;">
								<ul class="nav nav-list">
									<li><label class="tree-toggler nav-header">เลือกประเภทสินค้า</label>
									<ul class="nav nav-list tree">
									<?php if(is_array($cat_array) && count($cat_array)) {
											foreach($cat_array as $loop) {
									?>
									<li><a href="<?php echo site_url("managestock/viewStockBySelectedCat/".$loop->id."/".$branchid); ?>"><?php echo $loop->name; ?></a></li>
									<?php } }?>
									</ul>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
			
			<?php if ($page>0) { ?>
			
			<div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="dataTables-example" width="100%">
                                <thead>
                                    <tr>
										<th>รหัสสินค้ามาตรฐาน</th>
										<th>Barcode</th>
                                        <th>ชื่อสินค้า</th>
										<th>ประเภท</th>
										<th>จำนวน</th>
                                    </tr>
                                </thead>
							</table>
						</div>
					</div>
				</div>
			</div>	
			<?php } ?>
		</div>
	</div>
</div>

<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>/js/bootbox.min.js"></script>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function()
    {
        var oTable = $('#dataTables-example').dataTable
        ({
            "bJQueryUI": false,
            "bProcessing": true,
            "sPaginationType": "simple_numbers",
            'bServerSide'    : false,
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("managestock/ajaxGetStockAmount/".$this->uri->segment(3)."/".$this->uri->segment(4)); ?>',
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                $.ajax( {
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success":fnCallback
                
                });
            }
        });
    });
</script>
	
<script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[rel=tooltip]",
        container: "body"
    })

</script>
</body>
</html>