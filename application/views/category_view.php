<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
	<?php $url = site_url("managecat/delete"); ?>
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">จัดการประเภทสินค้า</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
					<div class="panel-heading"><button type="button" class="btn btn btn-success" onClick="window.location.href='<?php echo site_url("managecat/addcat"); ?>'">เพิ่มประเภทสินค้า</button></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>รหัส</th>
                                        <th>ชื่อประเภท</th>
										<th>จัดการ</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(is_array($cat_array) && count($cat_array) ) {
									$i=1;
									foreach($cat_array as $loop){
								?>
									<tr>
                                        <td><?php echo $loop->id; ?></td>
                                        <td><?php echo $loop->name; ?></td>
										<td>
										
	<div class="tooltip-demo">
	<a href="<?php echo site_url("managecat/editcat/".$loop->id); ?>" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="tooltip" data-target="#edit" data-placement="top" rel="tooltip" title="แก้ไข"><span class="glyphicon glyphicon-pencil"></span></a>
	<button class="btnDelete btn btn-danger btn-xs" onclick='del_confirm(<?php echo $loop->id; ?>)' data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-trash"></span></button>
	</div>
										</td>
                                    </tr>
									<?php $i++; } } ?>
                                </tbody>
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

<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
	
<script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[rel=tooltip]",
        container: "body"
    })
function del_confirm(val1) {
	bootbox.confirm("ต้องการลบข้อมูลที่เลือกไว้ใช่หรือไม่ ?", function(result) {
				var currentForm = this;
				var myurl = <?php echo json_encode($url); ?>;
            	if (result) {
				
					window.location.replace(myurl+"/"+val1);
				}

		});
}

</script>
</body>
</html>