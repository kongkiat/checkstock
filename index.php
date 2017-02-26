<html>
<head>

<meta http-equiv="content-Type" content="text/html; charset=utf-8"> 


<title>Aries50 Stock Express Check</title>
</head>
<body>

<!--
<style type="text/css">
      tr:nth-child(2n) {
             background-color: #cccccc;
        }
		input {
			font-size: 25px; 
		}
</style>
-->

<div align="center">
<?php
$objCSV = fopen("check_stocks.csv", "r");
?>

<form method="get"  class="search"> 
รหัสสินค้า : <input type="text" name="txtProductID" value='<?=$_GET['txtProductID'];?>'/>
<input type="submit" value="ค้นหา" /> 
</form></html> 

<table width="800" border="1"  cellspacing="2" cellpadding="10">
  <tr>
    <th width="400"> <div align="center">รหัส </div></th>
	<th width="91"> <div align="center">คลัง</div></th>
    <th width="98"> <div align="center">จำนวน</div></th>
    <th width="198"> <div align="center">ยอดจอง</div></th>
	<th width="198"> <div align="center">คงเหลือ</div></th>
	<th width="198"> <div align="center">รวม</div></th>

  </tr>
  
<?php
echo "check_stocks.csv ข้อมูลของวันที่: " . date ("F d Y H:i:s.", filemtime("check_stocks.csv"));
if ( !empty ( $_GET['txtProductID'] ) ) { 

      $productID = $_GET['txtProductID'];    

$totals=0;
	  
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	if ($objArr[0]==$productID) {
		if ($objArr[1]=='1'){
			echo "<tr bgcolor=\"#fff000\">";	//คลังที่ 1 พื้นหลังสีเหลือง
		}elseif ($objArr[1]=='2'){
			echo "<tr bgcolor=\"#00fff0\">";	//คลังที่ 2 พื้นหลังสีฟ้า
		}else{
			echo "<tr>";	
			
		}
		//echo 'full search';
		$total=$objArr[2]-$objArr[3];
		$totals+=$total;
		echo "<td><div align='center'>"; echo $objArr[0]; echo "</div></td>";
		echo "<td><div align='center'>"; echo $objArr[1]; echo "</div></td>";
		echo "<td><div align='center'>"; echo round($objArr[2]); echo "</div></td>";
		echo "<td><div align='center'>"; echo round($objArr[3]); echo "</div></td>";
		echo "<td align='center'>";echo $total; echo "</td>";
   		echo  "</tr>";
		echo "<td align='center' rowspan='2'>";echo $totals; echo "</td>";
		

    
	}elseif (stripos($objArr[0],$productID)!==false){
				if ($objArr[1]=='1'){
			echo "<tr bgcolor=\"#fff000\">";	//คลังที่ 1 พื้นหลังสีเหลือง
		}elseif ($objArr[1]=='2'){
			echo "<tr bgcolor=\"#00fff0\">";	//คลังที่ 2 พื้นหลังสีฟ้า
		}else{
			echo "<tr>";	
			
		}
		
		echo "<td><div align='center'>"; echo $objArr[0]; echo "</div></td>";
		echo "<td><div align='center'>"; echo $objArr[1]; echo "</div></td>";
		echo "<td><div align='center'>"; echo round($objArr[2]); echo "</div></td>";
		echo "<td><div align='center'>"; echo round($objArr[3]); echo "</div></td>";
		echo "<td align='center'>";echo $objArr[2]-$objArr[3]; echo "</td>";
   		echo  "</tr>";
		
	}
	
	
	
	}
}
fclose($objCSV);
?>
</table>
</div>
</body>
</html>