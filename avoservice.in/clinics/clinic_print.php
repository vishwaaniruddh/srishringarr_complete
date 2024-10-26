<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
<body>
<div id="bill">
<?php

$print=$_POST['print1'];
///echo $print;
if($print=="cp"){
$dt=$_POST['dt'];
$doc=$_POST['doc'];
$dear=$_POST['dear'];
$status=$_POST['status'];
$wordChunks6 = explode("\n", $status);

?>
<br><br><br><br><br><br><br><br><br><hr>
<table width="470" align="center" height="185" border="0">
<tr><td width="154" height="43">
<?php echo $dt; ?>
</td></tr>
<tr><td width="154" height="43">
To,
</td></tr>
<tr><td width="154" height="43">
<?php echo $doc; ?>
</td></tr>
<tr><td height="34"><?php echo  $dear; ?></td></tr>
<tr><td><?php for($i = 0; $i < count($wordChunks6); $i++){
	echo "$wordChunks6[$i] <br />";
} ?></td></tr>
<tr><td width="154" height="43">
Thanking you, With warm Regards, Dr. Taral Nagda.
</td></tr>
</table>

<?php  }else if($print=="tp"){
$dt=$_POST['dt'];
$doc=$_POST['doc'];
$dear=$_POST['dear'];
$status=$_POST['status'];
$wordChunks = explode("\n", $status);

?>
<br><br><br><br><br><br><br><br><br><hr>
<table width="470" align="center" height="185" border="0">
<tr><td width="154" height="43">
<?php echo $dt; ?>
</td></tr>
<tr><td width="154" height="43">
To,
</td></tr>
<tr><td width="154" height="43">
<?php echo $doc; ?>
</td></tr>

<tr><td height="34"><?php echo  $dear; ?></td></tr>
<tr><td><?php for($i = 0; $i < count($wordChunks); $i++){
	echo "$wordChunks[$i] <br />";
} ?></td></tr>
<tr><td width="154" height="43">
Thanking you, With warm Regards, Dr. Taral Nagda.
</td></tr>
</table>

<?php }else if($print=="ap"){
$dt=$_POST['dt'];
$hosp=$_POST['hosp'];
$status=$_POST['status'];
$wordChunks1 = explode("\n", $status);
$note=$_POST['note'];
 ?>
  <br><br><br><br><br><br><br><br><br><hr>
 <table width="470" align="center" height="185" border="0">
 <tr><td width="154" height="43">
<?php echo $dt; ?>
</td></tr>
<tr><td width="154" height="43">
<?php echo $hosp; ?>
</td></tr>
<tr><td><?php for($i = 0; $i < count($wordChunks1); $i++){
	echo "$wordChunks1[$i] <br />";
} ?></td></tr>
<tr><td height="34"><?php echo  $note; ?></td></tr></table>

 <?php } else if($print=="ip"){
 $dt=$_POST['dt'];
$centre=$_POST['centre'];
$status=$_POST['status'];
$wordChunks2 = explode("\n", $status);
 ?>
  <br><br><br><br><br><br><br><br><br><hr>
 <table width="470" align="center" height="185" border="0">
 <tr><td width="154" height="43">
<?php echo $dt; ?>
</td></tr>
<tr><td width="154" height="43">
<?php echo $centre; ?>
</td></tr>
<tr><td><?php for($i = 0; $i < count($wordChunks2); $i++){
	echo "$wordChunks2[$i] <br />";
} ?></td></tr>
</table>

 <?php } else if($print=="mcp"){
$dat=$_POST['dat'];
$status=$_POST['status'];
$wordChunks3 = explode("\n", $status);
 ?>
  <br><br><br><br><br><br><br><br><br><hr>
 <table width="470" align="center" height="185" border="0">
<tr><td width="154" height="43">
<?php echo $dat; ?>
</td></tr>
<tr><td><?php for($i = 0; $i < count($wordChunks3); $i++){
	echo "$wordChunks3[$i] <br />";
} ?></td></tr>
</table>

 <?php } else if($print=="pp"){ 
  $dt=$_POST['dt'];
 $doc=$_POST['doc'];
 $dear=$_POST['dear'];
$status=$_POST['status'];
$wordChunks4 = explode("\n", $status);
 ?>
 <br><br><br><br><br><br><br><br><br><hr>
 <table width="470" align="center" height="185" border="0">
 <tr><td width="154" height="43">
<?php echo $dt; ?>
</td></tr>
<tr><td width="154" height="43">
To,
</td></tr>
<tr><td width="154" height="43">
<?php echo $doc; ?>
</td></tr>
<tr><td height="34"><?php echo  $dear; ?></td></tr>
<tr><td><?php for($i = 0; $i < count($wordChunks4); $i++){
	echo "$wordChunks4[$i] <br />";
} ?></td></tr>
<tr><td width="154" height="43">
Thanking you, With warm Regards, Dr. Taral Nagda.
</td></tr>

</table>

 <?php } else if($print=="rp"){
 $dt=$_POST['dt']; 
  $doc=$_POST['doc'];
 $dear=$_POST['dear'];
$status=$_POST['status'];
$wordChunks5 = explode("\n", $status);
?>
 <br><br><br><br><br><br><br><br><br><hr>
<table width="470" align="center" height="185" border="0">
<tr><td width="154" height="43">
<?php echo $dt; ?>
</td></tr>
<tr><td width="154" height="43">
To,
</td></tr>
<tr><td width="154" height="43">
<?php echo $doc; ?>
</td></tr>
<tr><td height="34"><?php echo  $dear; ?></td></tr>
<tr><td><?php for($i = 0; $i < count($wordChunks5); $i++){
	echo "$wordChunks5[$i] <br />";
} ?></td></tr>
<tr><td width="154" height="43">
Thanking you, With warm Regards, Dr. Taral Nagda.
</td></tr>
</table>
<?php }  ?>
</div>

<input type="button" onclick="PrintDiv();" name="print" id="print" value="Print" style="width:100px;"/>

</body>
</html>