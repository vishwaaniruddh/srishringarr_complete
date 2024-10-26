<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
 include('config.php');
 include('template_clinic.html');
?>

<!--Datepicker-->

<script>


function confirm_deleteslot(slot_id)
{
if(confirm("Are you sure you want to delete this slot?"))
  {
    document.location="delete_slot.php?slot_id="+slot_id;
  }
}
</script>


<link href="style1.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
<script type="text/javascript" src="paging.js"></script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="M_page">
<fieldset class="textbox">
<?php 
$result = mysql_query("select * from slot ORDER BY  `slot`.`app_date` DESC");
?>

        
        <legend><h1>Slots</h1></legend>
          
        
        
          <table width="717"  border="1"  id="st" cellpadding="0" cellspacing="0"> 
          
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Block</th>
		  <th width="216" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Hospital</th>
          <th width="95" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Date</th>
          <th width="102" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Start_Time </th>
          <th width="96" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">End_Time</th>
		  <th width="61" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Edit</th>
		  <th width="61" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Delete</th>
          <?php while($row=mysql_fetch_row($result)){
			  //echo $row[3]." ".$row[4]; 
		  $stime24=strtotime($row[3]); 
  		  $etime24=strtotime($row[4]); //echo $stime24." ".$etime24;
		  $stime12=date("h:i a",$stime24); 
		  $etime12=date("h:i a",$etime24);?>

	<tr>
    <td> <?php echo $row[0]; ?></td>
    <td> <?php echo $row[1]; ?></td>
    <td> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
    <td> <?php echo $stime12; ?></td>
    <td> <?php echo $etime12; ?></td>
	<td><a href='edit_slot.php?slot_id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deleteslot(<?php echo $row[0]; ?>);"> Delete</a></td>
	<?php } ?>
    </tr>
    </table>
    </fieldset>
    </div>
  </body>

</html>
