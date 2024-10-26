<?php
include('config.php');
session_start();
?>
<body>
    <center>
<div style="background-color:hsl(0.15turn, 90%, 75%); width:60%" >

<table border="1">
    <tr><th>SN</th><th>Engineer Name</th><th>Designation</th><th>Branch</th><th>Mobile</th><th>Last Update</th></tr>
<?php
$dd=date('Y-m-d H:i:s', strtotime('-120 minutes'));

//echo $_SESSION['branch'];

if ($_SESSION['branch']=='all') {         
$sql=mysqli_query($con1,"SELECT a.last_updated,a.mac_id,b.engg_name,b.engg_desgn,b.phone_no1,c.name FROM `engg_current_location` a,area_engg b,avo_branch c where a.latitude!='0.0000000000' and a.last_updated<='".$dd."' and a.engg_id=b.engg_id and b.branch_id=c.id and b.status=1 and b.deleted =0 order by a.last_updated desc");
}else 
$sql=mysqli_query($con1,"SELECT a.last_updated,a.mac_id,b.engg_name,b.engg_desgn,b.phone_no1,c.name FROM `engg_current_location` a,area_engg b,avo_branch c where a.latitude!='0.0000000000' and a.last_updated<='".$dd."' and a.engg_id=b.engg_id and b.branch_id=c.id and b.status=1 and b.deleted =0 and b.area='".$_SESSION['branch']."' order by a.last_updated desc"); 

$i=1;
while($row=mysqli_fetch_row($sql)){
    ?>
    <tr><td><?php echo $i++; ?></td><td><?php echo $row[2]; ?></td> <td><?php echo $row[3]; ?></td>        <td><?php echo $row[5]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[0]; ?></td></tr>    
<?php
}
?>
</table>

</div></center></body>