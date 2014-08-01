<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/datepicker.css" >
<style type="text/css">
.datepicker {z-index: 1151 !important;}
</style>
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
		
	<div id="page-wrapper">
		<div class="row">
            <div class="col-md-10">
                <h3 class="page-header">ประวัติคืนสินค้าทั้งหมด</h3>
            </div>
        </div>
		<div class="row">
			<div class="col-md-8">
					<div class="form-group">
						<a href="<?php echo site_url("managestock/historystockexcel_return"); ?>" class="btn btn-success btn-md">Export Excel ทั้งหมด</a>
						<a data-toggle="modal" data-target="#myModal" class="btn btn-primary" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="เลือกช่วงวันที่" data-backdrop="static" data-keyboard="false">Export Excel เลือกช่วงวันที่</a>
						
						<!-- datepicker modal-->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						
						  <div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">	                 	
										<strong>เลือกช่วงวันที่ต้องการ</strong> 
									</h4>
								</div>            <!-- /modal-header -->
								<div class="modal-body">
									<form class="form-inline" role="form" action="<?php echo site_url("managestock/excelbetweendate_return"); ?>" method="POST" >
									<div class="form-group">
										<label for="">เริ่ม: </label>
										<input type="text" class="form-control" id="startdate" name="startdate" />
									</div>
									<div class="form-group">
										<label for=""> สิ้นสุด :</label>
										<input type="text" class="form-control" id="enddate" name="enddate" />
									</div>
										
								</div>            <!-- /modal-body -->
							
								<div class="modal-footer">
										<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> ตกลง</button>			
										<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ปิด</button>
								</div> 	
								</form>								
							</div>
						</div>
					</div>
						
                    </div>
				</div>
		</div>
		
		<div class="row">
            <div class="col-md-3">
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
									<li><a href="<?php echo site_url("managestock/viewStockReturnSelectedCat/".$loop->id); ?>"><?php echo $loop->name; ?></a></li>
									<?php } }?>
									</ul>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
			
			<?php if ($page>0) { ?>
			
			<div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="dataTables-example" width="100%">
                                <thead>
                                    <tr>
                                        <th>รหัสสินค้ามาตรฐาน</th>
										<th>ชื่อสินค้า</th>
										<th>ประเภท</th>
										<th>สาขา</th>
										<th>วันเวลา</th>
										<th></th>
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
<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-datepicker-thai.js"></script>
<script src="<?php echo base_url(); ?>js/locales/bootstrap-datepicker.th.js"></script>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function()
    {
		get_datepicker("#startdate");
		get_datepicker("#enddate");
        var oTable = $('#dataTables-example').dataTable
        ({
            "bJQueryUI": false,
            "bProcessing": true,
            "sPaginationType": "simple_numbers",
            'bServerSide'    : false,
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("managestock/ajaxGetStockHistoryReturn/".$this->uri->segment(3)); ?>',
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
function get_datepicker(id)
{

	$(id).datepicker({ language:'th-th',format:'dd/mm/yyyy'
		    });

}
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