<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
	<?php $url = site_url("managesupplier/delete"); ?>
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">จัดการข้อมูลผู้จำหน่าย (Supplier)</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
					<div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>รหัสผู้จำหน่าย</th>
										<th>ชื่อ</th>
										<th>ที่อยู่</th>
										<th>เบอร์โทรศัพท์</th>
										<th>FAX</th>
										<th>จัดการ</th>
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
            "sPaginationType": "full_numbers",
            'bServerSide'    : false,
            "autoWidth": false,
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("managesupplier/getdatabyajax"); ?>',
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