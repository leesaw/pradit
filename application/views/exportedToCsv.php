<?php 
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream'); 
header('Content-Disposition: attachment; filename=file.csv');
//header('Content-type: text/csv; charset=ISO-8859-1');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
//echo "\xEF\xBB\xBF";
$csv = iconv("utf-8", "Windows-874", $csv );
echo $csv; 



?>