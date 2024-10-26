<?php
include('config.php'); ?>

<script type='text/javascript' src='jquery-1.6.2.min.js'></script>
    <script type='text/javascript' src='jquery-ui-1.8.14.custom.min.js'></script>
    
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<?php

//$date=date("Y-m-d", strtotime( '-1 days' ) );

if(isset($_GET['date']))
{
    $date=$_GET['date'];
   
}
else
{
    $date=date("Y-m-d", strtotime( '-1 days' ));
  
}

//echo $date;

?>
<body>
    <center>
        <form name="form1" action="distances.php" >
        
        <input type="date" name="date" id ="date" />

        
<input type="submit" name="done" value="GO" />
</form>
<div style="background-color:hsl(0.15turn, 90%, 75%); width:80%" >
<table border="1">
    <tr><th>SN</th><th>Engineer Name</th><th>Branch</th><th>Mobile</th><th>Date</th><th>Distance Travelled (KM)</th><th>Distance Expected(KM)</th><th>View</th></tr>
<?php
//$dd=date('Y-m-d H:i:s', strtotime('-120 minutes'));
          
$sql=mysqli_query($con1,"SELECT a.dis_date,a.dis_travelled,a.dis_expected,b.engg_name,b.phone_no1,c.name,a.eng_id FROM `engg_distances` a,area_engg b,avo_branch c where a.dis_date='".$date."' and a.eng_id=b.engg_id and b.branch_id=c.id order by b.engg_name");

$i=1;
while($row=mysqli_fetch_row($sql)){
    ?>
    <tr><td><?php echo $i++; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><th><a href="travellingmap.php?eid=<?php echo $row[6]; ?>&date=<?php echo $row[0]; ?>" target="_new">View</a></a></th></tr>    
<?php
}
?>
</table>

</div></center></body>