<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.fancybox.css" >
</head>

<body>
<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	<?php $url = site_url("managestock/deletestocktemp_in"); ?>
	
	
	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-8">
                <h3 class="page-header">Barcode สินค้าเข้าสต็อก</h3>
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>กรุณาสแกน Barcode</strong></div>
					<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail') echo '<div class="alert-message alert alert-danger"> ไม่มี Barcode นี้ในระบบ</div>';
					
					?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php 
									echo form_open('managestock/saveBarcodeTemp_in'); ?>
                                    <div class="form-group">
                                    	<label>Barcode *</label>
                                        <input type="text" class="form-control" name="barcode" id="barcode" value="" placeholder="ยิง Barcode">
										<p class="help-block"><?php echo form_error('barcode'); ?></p>	
										<button type="submit" class="btn btn-success btn-lg">  เพิ่มรายการ  </button>
                                    </div>
									
								</form>
							</div>
						</div>
						
		
		<div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
					<div class="panel-heading"><strong>รวมทั้งหมด <?php echo $count; ?> รายการ</strong></div>
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
										<th>จัดการ</th>
                                    </tr>
                                </thead>
								
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>
						<div class="row">
							<div class="col-lg-6">
									<a id="fancyboxview" href="<?php echo site_url("managestock/showtemptostock");  ?>"><button type="button" class="btn btn-primary btn-lg">  ยืนยันรายการสินค้าทั้งหมด  </button></a>
									<button type="button" class="btn btn-danger btn-lg" onClick="window.location.href='<?php echo site_url("managestock/cleartemp/1"); ?>'"> เริ่มต้นใหม่ทั้งหมด </button>
							</div>
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
<script src="<?php echo base_url(); ?>js/jquery.fancybox.js"></script>
<script type='text/javascript'> 
$(document).ready(function() {
$('#fancyboxview').fancybox({ 
'width': '40%',
'height': '70%', 
'autoScale':false,
'transitionIn':'none', 
'transitionOut':'none',
'afterClose': function() {  parent.location.reload(true); }, 
'type':'iframe'}); 
});
 </script>
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
            'sAjaxSource'    : '<?php echo site_url("managestock/ajaxGetStockTemp/1"); ?>',
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
<script>
function del_confirm(val1) {
	bootbox.confirm("ต้องการลบข้อมูลที่เลือกไว้ใช่หรือไม่ ?", function(result) {
				var currentForm = this;
				var myurl = <?php echo json_encode($url); ?>;
            	if (result) {
				
					window.location.replace(myurl+"/"+val1);
				}

		});
}
function edit_amount(tempid) {
	bootbox.prompt("กรุณาป้อนจำนวนสินค้า", function(result) {       
		if (result != null && result>0) {                                                                        
			var amount = result;
			$.ajax({
					'url' : '<?php echo site_url('managestock/edit_amount_temp_in'); ?>',
					'dataType': 'json',
					'type':'post',
					'data':{tempid:tempid, 
							amount:amount
							}
				}); 
						
		}		
	});
}
/*
$(function() {
    $('#barcode').bind('blur', function(e) {
        e.preventDefault();
        $(this).focus();
    });
});
*/
$(".alert-message").alert();
window.setTimeout(function() { $(".alert-message").alert('close'); }, 2000);
</script>
</body>
</html>