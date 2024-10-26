<?php
session_start();
include('getcenter.php');
include('config.php');
############# must create your db base connection
//echo $_REQUEST['qry'];
$result = mysql_query(str_replace("\*","*",$_REQUEST['qry'])) or die(mysql_error());

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
 
       <thead align="left">
          <tr>
          <th>ID</th>
          <th>Full Name </th>
          <th>Phone </th>
          <th>Next FollowUP Date </th>
          <!--<th>End Date </th>-->
          <th>City </th>
          <th>Area </th>
          <th>Reference</th>
          <th>Feedback</th>
         </tr>
</thead>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {

while($row= mysql_fetch_row($result))
{
	//echo "Select * from enquiryperson where trackid='".$row[6]."'";
$qr=mysql_query("Select * from enquiryperson where trackid='".$row[6]."'");	 
$qrro=mysql_fetch_array($qr);
//echo $qrro[4];	
?>
<tbody>
<tr>
    <td ><?php echo $row[6]; ?></td>
	<td ><?php echo $qrro[1]; ?></td>
    <td><?php 
	if($qrro[11]!='')
	echo $qrro[11]."<br>";
	if($qrro[12]!='')
	echo $qrro[12]."<br>";
	
	if($qrro[13]!='')
	echo $qrro[13]."<br>";
	
	if($qrro[10]!='')
	echo $qrro[10]."<br>";
	
	 ?></td>
    <td ><?php echo date("Y-m-d",strtotime($row[4])); ?></td>
 <td ><?php echo $qrro[6]; ?></td>
    <td > <?php echo $qrro[9]; ?></td>
<td><?php echo $qrro['reference']; ?></td>
    <td width="78" align="center"><?php
	echo $row[1];
?> </td>

</tr>  </tbody><?php
			$intRows++;
	?> 

	<?php
			
		}
		
	?>
</table>
</div>
<?php
############
}
else{
echo "<div class='error'>No Records Found!</div>";
}
 
 
 ################ home end

 ?>
 </body>