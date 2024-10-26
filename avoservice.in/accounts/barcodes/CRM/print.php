<?php
include('config.php');
include('access.php');

$id=$_GET['id'];
$query=mysql_query("Select * from phppos_service where id='$id'");
$row=mysql_fetch_row($query);

?>
<!DOCTYPE html>
<html>
<head>
<script>
function printpage()
{
window.print();
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
@media print {
#print_div {
display:block;
}
#not {
display:none;
}

}
</style>
</head>
<body>
<div id="not" align="center">
<input type="button" value="Print this page" onclick="printpage()" vspace="50"/></div>
<div id="print_div">
<p><br/><br/><br/><br/><br/><br/></p>
<h1><b><p align="center" > Warranty Letter</p></b></h1>
<div ><?php if($row[21]!="")?><img src="modelphoto/<?php echo $row[21]; ?>" width="200" height="150" hspace="450"></div>
<font size="+3"><b>
<table align="center" width="70%" valign="top" >
<tr valign="top"><td width="31%" height="27" align="left">Customer Code</td><td width="10%" align="center">:</td><td width="59%" align="left"><?php echo $row[18]?></td></tr>
<tr valign="top"><td width="31%" height="33" align="left">Name</td><td width="10%" align="center">:</td><td width="59%" align="left"><?php echo $row[2]."<br/>".$row[3];?></td></tr>
<?php //$qry=mysql_query("Select name,catagory,item_number from phppos_item where name='$row[6]'");
	//$res=mysql_fetch_row($qry);
?>
<tr valign="top"><td width="31%" height="34" align="left">Product Name</td><td width="10%" align="center">:</td><td width="59%" align="left"><?php echo $row[6];?></td></tr>
<tr valign="top"><td width="31%" height="33" align="left" valign="top">Address</td><td width="10%" align="center">:</td><td width="59%" align="left"><?php echo $row[5]?></td></tr>
<tr valign="top"><td width="31%" height="32" align="left">Date of Delivery</td><td width="10%" align="center">:</td><td width="59%" align="left"><?php echo date('d/m/Y',strtotime($row[7]));?></td></tr>
<tr valign="top"><td width="31%" height="32" align="left">Warranty UpTo</td><td width="10%" align="center">:</td><td width="59%" align="left"><?php echo date('d/m/Y',strtotime($row[7].'+1 year -1 day'));?></td></tr>

<tr valign="top"><td width="31%" align="left" valign="top">Warranty</td><td width="10%" align="center" valign="top">:</td><td width="59%" align="left">1 Year Warranty<br/>No Warranty for Plastic & Rubber Parts</td></tr>
<tr valign="top"><td width="31%" height="30" align="left">Motor Warranty</td><td width="10%" align="center">:</td><td width="59%" align="left"><?php echo $row[20];?></td></tr>
<tr valign="top"><td width="31%" height="67" align="left" valign="top">For Free Service Call</td><td width="10%" align="center">:</td><td width="59%" align="left">Mustaq 9870951840 &nbsp/ 9869326989<br>speedfitservice@gmail.com<br>Time : 10:00am to 6:00pm<br/> (Monday - Saturday)</td></tr>
<?php /*?><tr valign="top"><td>Service Dates : </td></tr>
<tr valign="top"><td colspan="3">
<?php if($row[16]=="domestic")
{ ?>
<table align="center" width="81%" border="1"><tr align="center"><td width="25%"> I </td><td width="25%">II</td><td width="25%">III</td><td width="25%">IV</td></tr>
<tr align="center"><td width="25%"> <?php echo date('d/m/Y',strtotime($row[8]));?></td><td width="25%"><?php echo date('d/m/Y',strtotime($row[10]));?></td><td width="25%"><?php echo date('d/m/Y',strtotime($row[12]));?></td><td width="25%"><?php echo date('d/m/Y',strtotime($row[14]));?></td></tr>
</table>
<?php } 
else{ 
  $qry1=mysql_query("select * from `phppos_servicestatus` where id='".$row[0]."'");
  $num=mysql_num_rows($qry1);
  if($num==6){
	  ?>
	  <table align="center" width="81%" border="1"><tr align="center"><td width="33%"> I </td><td width="33%">II</td><td width="33%">III</td></tr><tr align="center"><td>
 <?php $i=0; while($sql=mysql_fetch_array($qry1)){
 			if($i==5)
			echo date('d/m/Y',strtotime($sql[2]))."";
			else if($i!=2)
			echo date('d/m/Y',strtotime($sql[2]))."</td><td>";
			else
			echo date('d/m/Y',strtotime($sql[2]))."</td></tr><tr align='center'><td width='33%'> IV </td><td width='33%'>V</td><td width='33%'>VI</td></tr><tr><tr align='center'><td>";
			$i++;
			}
?>
</td></tr></table>
<?php	}//if num ends
	else{
	  ?>
	  <table align="center" width="81%" border="1"><tr align="center"><td width="16.33%"> I </td><td width="16.33%">II</td><td width="16.66%">III</td><td width="16.66%">IV</td><td width="16.33%">IV</td><td width="16.33%">IV</td></tr><tr align="center"><td>
 <?php $i=0; while($sql=mysql_fetch_array($qry1)){
 			if($i==11)
			echo date('d/m/Y',strtotime($sql[2]))."";
			else if($i!=5)
			echo date('d/m/Y',strtotime($sql[2]))."</td><td>";
			else
			echo date('d/m/Y',strtotime($sql[2]))."</td></tr><tr align='center'><td width='16.33%'> VII </td><td width='16.33%'>VIII</td><td width='16.66%'>IX</td><td width='16.66%'>X</td><td width='16%'>XI</td><td width='16%'>XII</td></tr><tr align='center'><td>";
						$i++;
			}
?>
</td></tr></table>
<?php	}
}
?>
</td></tr><?php */?>
</table></b>
<table align="center" width="70%"><tr><td>
<p></p>
<p>For SUNRISE SPORTS & FITNESS
<br/><br/>
 Proprietor / Authorised Signatory</p></font></td></tr></table>
</div>
</body>
</html>