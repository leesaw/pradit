<?php

$name1 = iconv("UTF-8", "TIS-620", $name);
$price1 = "ราคา ".number_format($price, 2, '.', ',')." บาท";

echo "bc = $bc, name = $name, price1 = $price1";

?>