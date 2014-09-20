<!DOCTYPE html>
<html>
<head>
<title>Bill Printing</title>
</head>
<body>
<table border="0">
<tbody>
<?php if(isset($bill_array)) { foreach($bill_array as $loop) { ?>
<tr><td height="58">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td width="400">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $loop->_customerID; ?></td><td width="10"> </td><td width="80"> </td><td width="120"><?php echo $loop->billID; ?></td></tr>
<tr><td width="400" height="30"><?php echo $loop->title." ".$loop->customerName; ?></td><td width="10"> </td><td width="80"> </td><td width="120"><br> 
<?php  
 $GGyear=substr($loop->date,0,4); 
 $GGmonth=substr($loop->date,5,2); 
 $GGdate=substr($loop->date,8,2); 
 echo $GGdate."/".$GGmonth."/".$GGyear; ?></td></tr>
<tr><td width="400" height="44"><?php echo $loop->customerAddress; ?></td><td width="10"> </td><td width="80"> </td><td width="150"> 
 </td></tr>
 <tr><td height="30">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td width="400">&nbsp;</td><td width="10"> </td><td width="80"> </td><td width="200"><?php echo $loop->fname." ".$loop->lname; ?></td></tr>
<tr><td width="400">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php echo $loop->transport;?></td><td width="10"> </td><td width="80"> </td><td width="200"> </td></tr>
 <?php $percentvat=$loop->percentvat; } }?>
</tbody>
</table>
<br>
<table>
<thead>
	<tr>
		<th width="20"> </th><th width="380"> </th><th width="140" > </th><th width="110"> </th><th width="110"> </th>
	</tr>
</thead>
<tbody>
<tr><td height="43"> </td><td> </td><td> </td><td> </td><td> </td></tr>
<?php $no=1; $sum=0; if(isset($billproduct_array)) { foreach($billproduct_array as $loop) { ?>
<tr><td align="left"><?php echo $no; ?></td>
<td align="left"><?php echo "&nbsp;&nbsp;".$loop->productname; ?></td>
<td align="center" ><?php echo $loop->amount." &nbsp; ".$loop->unit; ?></td>
<td align="center" ><?php echo number_format($loop->pricePerUnit, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
<td align="right" ><?php echo number_format($loop->amount*$loop->pricePerUnit, 2, '.', ',')."&nbsp;&nbsp;"; $sum += $loop->amount*$loop->pricePerUnit; ?></td>
</tr>
<?php $no++; $discount=$loop->discount; $discount2=$loop->discountPercent; $tax=$loop->tax; } }

if ($no<=15) { for($i=15-$no; $i>0; $i--) {?> 
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php } } ?>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</tbody>
<tbody>
<tr>
<td align="right" colspan=4 scope="row">&nbsp;</td><td align="right"><?php echo number_format($sum, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
<tr>
<td align="right" colspan=4 scope="row">&nbsp;</td><td align="right" style="padding:0px; margin:0px;"><?php echo number_format(($discount+($sum*$discount2/100)), 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
<tr>
<td align="right" colspan=4 scope="row">&nbsp;</td><td align="right"><?php echo number_format($sum-($discount+($sum*$discount2/100)), 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
<tr>
<td align="right" colspan=4 scope="row"><?php echo $percentvat; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align="right"><?php echo number_format($tax, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
<tr>
<td align="left" colspan=2 scope="row">( <?php echo num2thai($sum-($discount+($sum*$discount2/100))+$tax); ?> )</td>
<td align="right" colspan=2 scope="row">&nbsp;</td><td align="right" ><?php echo number_format($sum-($discount+($sum*$discount2/100))+$tax, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
</tbody>
<?php
function num2thai($number){
$t1 = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
$t2 = array("เอ็ด", "ยี่", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
$zerobahtshow = 0; // ในกรณีที่มีแต่จำนวนสตางค์ เช่น 0.25 หรือ .75 จะให้แสดงคำว่า ศูนย์บาท หรือไม่ 0 = ไม่แสดง, 1 = แสดง
(string) $number;
$number = explode(".", $number);
if(!empty($number[1])){
if(strlen($number[1]) == 1){
$number[1] .= "0";
}else if(strlen($number[1]) > 2){
if($number[1]{2} < 5){
$number[1] = substr($number[1], 0, 2);
}else{
$number[1] = $number[1]{0}.($number[1]{1}+1);
}
}
}

for($i=0; $i<count($number); $i++){
$countnum[$i] = strlen($number[$i]);
if($countnum[$i] <= 7){
$var[$i][] = $number[$i];
}else{
$loopround = ceil($countnum[$i]/6);
for($j=1; $j<=$loopround; $j++){
if($j == 1){
$slen = 0;
$elen = $countnum[$i]-(($loopround-1)*6);
}else{
$slen = $countnum[$i]-((($loopround+1)-$j)*6);
$elen = 6;
}
$var[$i][] = substr($number[$i], $slen, $elen);
}
}	

$nstring[$i] = "";
for($k=0; $k<count($var[$i]); $k++){
if($k > 0) $nstring[$i] .= $t2[7];
$val = $var[$i][$k];
$tnstring = "";
$countval = strlen($val);
for($l=7; $l>=2; $l--){
if($countval >= $l){
$v = substr($val, -$l, 1);
if($v > 0){
if($l == 2 && $v == 1){
$tnstring .= $t2[($l)];
}elseif($l == 2 && $v == 2){
$tnstring .= $t2[1].$t2[($l)];
}else{
$tnstring .= $t1[$v].$t2[($l)];
}
}
}
}
if($countval >= 1){
$v = substr($val, -1, 1);
if($v > 0){
if($v == 1 && $countval > 1 && substr($val, -2, 1) > 0){
$tnstring .= $t2[0];
}else{
$tnstring .= $t1[$v];
}

}
}

$nstring[$i] .= $tnstring;
}

}
$rstring = "";
if(!empty($nstring[0]) || $zerobahtshow == 1 || empty($nstring[1])){
if($nstring[0] == "") $nstring[0] = $t1[0];
$rstring .= $nstring[0]."บาท";
}
if(count($number) == 1 || empty($nstring[1])){
$rstring .= "ถ้วน";
}else{
$rstring .= $nstring[1]."สตางค์";
}
return $rstring;
}

?>
</table>
</body>
</html>