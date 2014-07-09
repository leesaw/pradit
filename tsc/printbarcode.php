<html>
   <head>
       <title>Barcode</title>
   </head>
   <body>

       <?php 
              
			  $TSCObj  = new COM ("TSCActiveX.TSCLIB") or die("Unable to open COM object");
			  $TSCObj->ActiveXopenport("TSC TTP-244 Plus");			  
			  //$TSCObj->ActiveXdownloadpcx("C:/xampp/htdocs/pradit/tsc/logo.pcx","logo.pcx");
			  $TSCObj->ActiveXsetup("104", "52", "3", "10", "0", "2", "0");
			  //$TSCObj->ActiveXformfeed();
			  //$TSCObj->ActiveXsendcommand("HOME");
			  //$TSCObj->ActiveXsendcommand("SET TEAR OFF");
			  $TSCObj->ActiveXclearbuffer();
			  //$TSCObj->ActiveXsendcommand("PUTPCX 300,250,\"logo.pcx\"");
			  
			  // print product name
			  $name1 = iconv("UTF-8", "TIS-620", $_GET['name']);
			  $TSCObj->ActiveXwindowsfont(60, 50, 54, 0, 2, 0, "Angsana New", $name1);
			  $TSCObj->ActiveXwindowsfont(450, 50, 54, 0, 2, 0, "Angsana New", $name1);
			  
			  // print product price + vat
			  $price1 = "ราคา ".number_format($_GET['price'], 2, '.', ',')." บาท";
			  $TSCObj->ActiveXwindowsfont(60, 330, 54, 0, 2, 0, "Angsana New", $price1);
			  $TSCObj->ActiveXwindowsfont(450, 330, 54, 0, 2, 0, "Angsana New", $price1);
			  
			  // print barcode
			  $TSCObj->ActiveXbarcode("60", "110", "128", "200", "1", "0", "2", "2", $_GET['bc']);	
			  $TSCObj->ActiveXbarcode("450", "110", "128", "200", "1", "0", "2", "2", $_GET['bc']);	
			 
			  // print number of copies
			  $copy = ceil($_GET["copy"]/2);
			  if ($copy > 0) {
				for ($i=0; $i<$copy; $i++) {
					$TSCObj->ActiveXprintlabel("1","1");
				}
				echo "Printing....";
			  }else{
				echo "Error!!!";
			  }
			  //$TSCObj->ActiveXformfeed();
		      $TSCObj->ActiveXcloseport();
			  
       ?>
   </body>
</html> 