<!DOCTYPE html>
<html>
<head>
<title>Purchase Printing</title>
</head>
<body>
<div style="text-align: right; font-weight: font-size: 16pt;">เลขประจำตัวผู้เสียภาษี 0715540000416<br><div style="text-align: right; font-weight: bold; font-size: 16pt;">ใบสั่งซื้อ</div></div><br>
<table border="0">
<tbody>
<?php if(isset($purchase_array)) { foreach($purchase_array as $loop) { 
$signature = $loop->fname." ".$loop->lname; 
?>
<tr><td width="400">ผู้จำหน่าย &nbsp;&nbsp;<?php echo $loop->_supplierid; ?></td><td width="10"> </td><td width="100">เลขที่ใบสั่งซื้อ</td><td width="120"><?php echo $loop->purchaseID; ?></td></tr>
<tr><td width="400"><?php echo $loop->title." ".$loop->supplierName; ?></td><td width="10"> </td><td width="100">วันที่</td><td width="120">
<?php  
 $GGyear=substr($loop->date,0,4); 
 $GGmonth=substr($loop->date,5,2); 
 $GGdate=substr($loop->date,8,2); 
 echo $GGdate."/".$GGmonth."/".$GGyear; ?>
 </td></tr>
 
 <tr><td width="400"><?php echo $loop->supplierAddress; ?></td><td width="10"> </td><td width="100">วันที่รับของ</td><td width="120">
 <?php 
 $ryear = substr($loop->receiveDate,0,4);
 $rmonth = substr($loop->receiveDate,5,2);
 $rday = substr($loop->receiveDate,8,2);
 echo $rday."/".$rmonth."/".$ryear;
 ?>
 </td></tr>
 
 <tr><td width="400"><?php echo "โทร. ".$loop->supplierTel." FAX. ".$loop->supplierFax; ?></td><td width="10"> </td><?php if ($loop->purstatus==2) { ?><td width="100">เครดิต</td><td width="120"><?php echo $loop->creditDay." วัน "; }?></td></tr>
 
 <tr><td width="400">หมายเหตุ &nbsp;&nbsp;<?php if ($loop->purstatus==1) { echo "ซื้อสินค้าเป็นเงินสด"; } ?></td><td width="10"> </td><td width="100">ขนส่งโดย</td><td width="120"><?php echo $loop->transport; ?></td></tr>
 <?php $vat = $loop->vat; $percentvat=$loop->percentvat; $tax=$loop->tax; } }?>
</tbody>
</table>
<br>
<table style="border:1px solid black; border-spacing:0px 0px;">
<thead>
	<tr>
		<th width="50" style="border-bottom:1px solid black;">No.</th><th width="300" style="border-left:1px solid black;border-bottom:1px solid black;">รหัสสินค้า/รายละเอียดสินค้า</th><th width="120" style="border-left:1px solid black;border-bottom:1px solid black;">จำนวน</th><th width="100" style="border-left:1px solid black;border-bottom:1px solid black;">หน่วยละ</th><th width="120" style="border-left:1px solid black;border-bottom:1px solid black;">จำนวนเงิน</th>
	</tr>
</thead>
<tbody>
<?php $no=1; $sum=0; if(isset($purchaseproduct_array)) { foreach($purchaseproduct_array as $loop) { ?>
<tr style="border:1px solid black;"><td align="center"><?php echo $no; ?></td>
<td style="border-left:1px solid black;"><?php echo "&nbsp;&nbsp;".$loop->productname; ?></td>
<td align="center" style="border-left:1px solid black;"><?php echo $loop->amount." &nbsp; ".$loop->unit; ?></td>
<td align="right" style="border-left:1px solid black;"><?php echo number_format($loop->pricePerUnit, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
<td align="right" style="border-left:1px solid black;"><?php echo number_format($loop->amount*$loop->pricePerUnit, 2, '.', ',')."&nbsp;&nbsp;"; $sum += $loop->amount*$loop->pricePerUnit; ?></td>
</tr>
<?php $no++; $discount=$loop->discount;  } }

if ($no<=15) { for($i=15-$no; $i>0; $i--) {?> 
<tr><td>&nbsp;</td><td style="border-left:1px solid black;">&nbsp;</td><td style="border-left:1px solid black;">&nbsp;</td><td style="border-left:1px solid black;">&nbsp;</td><td style="border-left:1px solid black;">&nbsp;</td></tr>
<?php } } ?>

</tbody>
<tbody>
<tr>
<td align="right" colspan=4 scope="row" style="border-top:1px solid black;">รวมเป็นเงิน&nbsp;&nbsp;</td><td align="right" style="border-top:1px solid black; border-left:1px solid black;"><?php  echo number_format($sum, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
<tr>
<td align="right" colspan=4 scope="row"><u>หัก</u>&nbsp;ส่วนลด&nbsp;&nbsp;</td><td align="right" style="border-left:1px solid black;"><?php echo number_format($discount, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
<tr>
<td align="right" colspan=4 scope="row">จำนวนเงินหลังหักส่วนลด&nbsp;&nbsp;</td><td align="right" style="border-left:1px solid black;"><?php echo number_format($sum-$discount, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
<tr>
<td align="right" colspan=4 scope="row">จำนวนภาษีมูลค่าเพิ่ม&nbsp;&nbsp;<?php echo $percentvat; ?> %&nbsp;&nbsp;</td><td align="right" style="border-left:1px solid black;"><?php echo number_format($tax, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
</tr>
<tr>
<td align="left" colspan=2 scope="row" style="border-top:1px solid black;">( <?php echo num2thai($sum-$discount+$tax); ?> )</td>
<td align="right" colspan=2 scope="row" style="border-top:1px solid black;">จำนวนเงินรวมทั้งสิ้น&nbsp;&nbsp;</td><td align="right" style="border-left:1px solid black; border-top:1px solid black;"><?php echo number_format($sum-$discount+$tax, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
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
<table style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-spacing:0px 0px;">
<tbody>
<tr><td width="200" align="left">&nbsp;</td><td width="500" align="center">ในนาม บริษัท ประดิษฐ์ แอนด์เฟรนด์ แมชีนเนอรี่ จำกัด</td>
</tr>
<tr><td>..........................................................</td><td>&nbsp;</td></tr>
<tr><td align="center">ผู้สั่งซื้อ</td><td align="center">ผู้รับมอบอำนาจ  &nbsp;&nbsp;&nbsp; ..........................................................</td>
</tr>
<tr><td> &nbsp;</td><td> &nbsp;</td></tr>
<tbody>
</table>
<script>
$(document).ready(function()
{
	window.print();
}
</script>
</body>
</html>