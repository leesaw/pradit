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
            <div class="col-lg-10">
                <h3 class="page-header">ประวัติใบสั่งซื้อทั้งหมด</h3>
            </div>
        </div>
		<div class="row">
			<form method="post">
				<div class="col-lg-4">
					<div class="form-group">
                        <label>เลือก สาขา</label>
						<select class="form-control" name="branchid" id="branchid" onChange="this.form.action='<?php echo site_url('managepurchase/viewPurchaseByBranch_cash')?>/'+this.value;this.form.submit()"> 
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
			<div class="col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="dataTables-example" width="100%">
                                <thead>
                                    <tr>
                                        <th>เลขที่ใบสั่งซื้อ</th>
										<th>ชื่อผู้จำหน่าย</th>
										<th>วันที่</th>
										<th>พิมพ์ใบสั่งซื้อ</th>
                                    </tr>
                                </thead>
								
							</table>
						</div>
					</div>
				</div>
			</div>	
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
            'sAjaxSource'    : '<?php echo site_url("managepurchase/ajaxGetStockHistoryPurchase_cash/".$this->uri->segment(3)); ?>',
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