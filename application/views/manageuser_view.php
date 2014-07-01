<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
	<?php $url = site_url("manageuser/delete"); ?>
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">จัดการผู้ใช้งาน</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
					<div class="panel-heading"><button type="button" class="btn btn-outline btn-success" onClick="window.location.href='<?php echo site_url("manageuser/adduser"); ?>'">เพิ่มผู้ใช้งาน</button></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="usertable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>ชื่อ</th>
                                        <th>นามสกุล</th>
                                        <th>สิทธิ</th>
										<th>จัดการ</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(is_array($user_array) && count($user_array) ) {
									foreach($user_array as $loop){
								?>
									<tr>
                                        <td><?php echo $loop->username; ?></td>
                                        <td><?php echo $loop->firstname; ?></td>
                                        <td><?php echo $loop->lastname; ?></td>
                                        <td class="center">
										<?php
											if ($loop->status == 1) { echo "Admin"; }
											else if ($loop->status == 2) {echo "Stock";}
											else if ($loop->status == 3) {echo "Owner";}
											else { echo "error"; }
										?>
										</td>
										<td>
										
	<div class="tooltip-demo">
	<a href="<?php echo site_url("manageuser/edituser/".$loop->id); ?>" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="tooltip" data-target="#edit" data-placement="top" rel="tooltip" title="แก้ไข"><span class="glyphicon glyphicon-pencil"></span></a>
	<button class="btnDelete btn btn-danger btn-xs" onclick='del_confirm(<?php echo $loop->id; ?>)' data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-trash"></span></button>
	</div>
										</td>
                                    </tr>
									<?php } } ?>
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
<script src="<?php echo base_url(); ?>js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>js/bootbox.min.js"></script>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#usertable').dataTable({"order": [[ 0, "asc" ]]});
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