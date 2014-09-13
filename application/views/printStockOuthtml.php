<!DOCTYPE html>
<html>
<head>
<title>Purchase Printing</title>
</head>
<body>
<table border="0">
<tbody>
<tr>
<td width="450">
<div style="text-align: left; font-weight: bold; font-size: 20pt;">บริษัท ประดิษฐ์ แอนด์ เฟรนด์ แมชีนเนอรี่ จำกัด</div><br\><div style="text-align: left; font-weight: font-size: 16pt;">102/17-20 หมู่ 9 ถ.ท่าเรือ-พระแท่น ต.ตะคร้ำเอน อ.ท่ามะกา จ.กาญจนบุรี 71130</div>
</td> 
<td width="100"> </td>
<td width="200"><div style="text-align: right; font-weight: bold; font-size: 16pt;">ใบรายการสินค้าออกจากสต๊อก</div></td>
</tr>
<?php foreach($stock_array as $loop) { $datetime = $loop->onDate; $editor = $loop->firstname." ".$loop->lastname; $stockdetail = $loop->stockdetail; $status = $loop->stockstatus; break; } 

 $GGyear=substr($datetime,0,4); 
 $GGmonth=substr($datetime,5,2); 
 $GGdate=substr($datetime,8,2); 
 $time = substr($datetime,11,8);
?>
<tr>
    <td>วันที่ : <?php echo $GGdate."/".$GGmonth."/".$GGyear; ?> เวลา : <?php echo $time; ?></td><td> </td><td> ชื่อผู้ใส่ข้อมูล:  <?php echo $editor; ?>
    </td>
</tr>
<tr>
    <td>รายละเอียด : <?php echo $stockdetail; ?> </td><td> </td><td>สถานะ : 
<?php switch ($status) {
     case 1 : echo "ขายออก"; break;
     case 2 : echo "ย้ายคลัง"; break;
     case 3 : echo "เบิกใช้ซ่อม"; break;
     case 4 : echo "ของเคลม"; break;
     case 5 : echo "ของแถม"; break;
 }
?> </td>
</tr>
</tbody>
</table>
<table style="border:1px solid black; border-spacing:0px 0px;">
<thead>
	<tr>
		<th width="30" style="border-bottom:1px solid black;">No.</th><th width="280" style="border-left:1px solid black;border-bottom:1px solid black;">รหัสสินค้า/รายละเอียดสินค้า</th><th width="80" style="border-left:1px solid black;border-bottom:1px solid black;">จำนวน<br>ในสต๊อก</th><th width="80" style="border-left:1px solid black;border-bottom:1px solid black;">จำนวน<br>ตัดสต๊อก</th><th width="80" style="border-left:1px solid black;border-bottom:1px solid black;">จำนวน<br>หลังตัดสต๊อก</th><th width="100" style="border-left:1px solid black;border-bottom:1px solid black;">หน่วยละ</th><th width="120" style="border-left:1px solid black;border-bottom:1px solid black;">จำนวนเงิน</th>
	</tr>
</thead>
<tbody>
<?php $no=1; $sum=0; if(isset($stock_array)) { foreach($stock_array as $loop) { ?>
<tr style="border:1px solid black;"><td align="center"><?php echo $no; ?></td>
<td style="border-left:1px solid black;"><?php echo $loop->barcode."&nbsp;&nbsp;".$loop->pname; ?></td>
<td align="center" style="border-left:1px solid black;"><?php echo $loop->stockamount." &nbsp; ".$loop->unit; ?></td>
<td align="center" style="border-left:1px solid black;"><?php echo $loop->amount." &nbsp; ".$loop->unit; ?></td>
<td align="center" style="border-left:1px solid black;"><?php echo ($loop->stockamount-$loop->amount)." &nbsp; ".$loop->unit; ?></td>
<td align="right" style="border-left:1px solid black;"><?php echo number_format($loop->priceVAT, 2, '.', ',')."&nbsp;&nbsp;"; ?></td>
<td align="right" style="border-left:1px solid black;"><?php echo number_format($loop->amount*$loop->priceVAT, 2, '.', ',')."&nbsp;&nbsp;"; $sum += $loop->amount*$loop->priceVAT; ?></td>
</tr>
<?php $no++; } } ?> 
<tr><td style="border-top:1px solid black;">&nbsp;</td><td style="border-top:1px solid black;">&nbsp;</td><td style="border-top:1px solid black;">&nbsp;</td><td style="border-top:1px solid black;">&nbsp;</td><td style="border-left:1px solid black;border-top:1px solid black;">&nbsp;</td><td style="border-top:1px solid black;">รวมเงิน</td><td align="right" style="border-left:1px solid black;border-top:1px solid black;"><?php echo number_format($sum, 2, '.', ',')."&nbsp;&nbsp;"; ?></td></tr>

</tbody>
</table>
</body>
</html>