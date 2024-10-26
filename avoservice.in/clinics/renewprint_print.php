<?php
include('config.php');

$result = mysql_query($_REQUEST['qry']) or die(mysql_error());

?>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript">

 $(document).ready(function() {

        $('#cou_btn').click(function(e) {
          e.preventDefault();

          w=window.open();
          var temp=$('#search').html();
          w.document.write(temp);
          if (navigator.appName == 'Microsoft Internet Explorer') window.print();
	else w.print();
          w.close();
         return false;
        });
       });  


</script>
<style type="text/css">
   table { page-break-inside:auto }
   tr    { page-break-inside:avoid; page-break-after:auto }

</style>
</head>
<body>
<input type="button" id="cou_btn" value="Print" style="width:100px;"/>
<div id="search">
<table border="1" style="border:thin" cellpadding="0" cellspacing="0" width="100%">
          <tr>
          <th>ID</th>
          <th>Full Name </th>
          <th>Start Date </th>
          <th>End Date </th>
          <th>City </th>
          <th>Area </th>
          <th>Balance</th>
           <!--<th  >Diagnosis</th>-->
        
          </tr>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {

while($row= mysql_fetch_row($result))
{
	 
?>
<tr>
    <td ><?php echo $row[0]; ?></td>
	<td ><?php echo $row[1]; ?></td>
    <td ><?php 
	//echo "select * from patient_package where patientid='$row[0]' and status=0 order by id DESC limit 1";
	$dt=mysql_query("select * from patient_package where patientid='$row[0]' and id='$row[6]' and status=0 order by id DESC limit 1");
	if(mysql_num_rows($dt)>0)
	{
	$dtro=mysql_fetch_row($dt);
	echo date('d/m/Y',strtotime($dtro[3]))."</td><td>";
	if(date('Y',strtotime($dtro[4]))>='1990')
	echo date('d/m/Y',strtotime($dtro[4]))."";
	}
	else
	{
	if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4]))."</td><td>".date('d/m/Y',strtotime($row[4]))."";
     }
	 ?></td>
    <td ><?php echo $row[2]; ?></td>
    <td > <?php echo $row[3]; ?></td>
    
<td width="78" align="center"><?php
	//echo "select sum(amt) from opd_collection where patientid='".$row[0]."'";
	$pac=mysql_query("select sum(amt) from patient_package where patientid='".$row[0]."' and status='0'");
$pacro=mysql_fetch_row($pac);
$qr=mysql_query("select sum(amt) from opd_collection where patientid='".$row[0]."'");
$ro=mysql_fetch_row($qr);
echo ($pacro[0]-$ro[0]);
?> </td>

</tr><?php
			$intRows++;
	?> 

	<?php
			
		}
	}
		
	?>
</table>
</div>
</body>