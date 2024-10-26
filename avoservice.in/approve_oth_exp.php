<?php include("access.php"); 

// if($_SESSION['user']=='masteradmin' || $_SESSION['designation']=="3" || $_SESSION['designation']=="7")

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js">
    </script>
<script>

$(document).ready(function(){
    $('.InvQty').keyup(function(){

       var val2 = 0;
        $('.InvQty').each(function(){
            val2+=(parseFloat($(this).val()) || 0);
        });
        $('#Total').val(val2);
    });
});




function validate()
{
var form=document.getElementById('form');
with(form)
{
//alert("hello");

if(Total.value=='0')
{
alert("Alert !!  Please Check Approved Amount !! ");
Total.focus();
return;
}

if(app_rem.value=='')
{
alert("Please Write something on Approval justification");
app_rem.focus();
return;
}


form.submit();
}
}



</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2>Expense Approval</h2>
<div id="header">

<?php
$id=$_GET['id'];

$abc=mysqli_query($con1,"select * from engg_oth_expenses where id = '".$id."' ") ;
$row=mysqli_fetch_row($abc);
?>
<form action="process_approve_othexp.php" method="post" name="form" id="form" enctype="multipart/form-data">
<table>

<tr>
<td height="25">Claim Date: </td>
<td style="color:red; font-weight:bold; "> <?php echo $row[2]; ?> </td>
<td></td><td></td> </tr>
<tr>
<td width="100" height="25">Name: </td>
<td width="100">

<?php
$qry=mysqli_query($con1,"select engg_id, engg_name,loginid from area_engg where engg_id='".$row[1]."'");
//echo "select engg_id, engg_name from area_engg where engg_id='".$row[1]."'";
$name=mysqli_fetch_row($qry);
?>
<?php echo $name[1]; ?></td>


<td width="100" height="25">Branch: </td>
<td width="100">
<?php
$br=mysqli_query($con1,"select id, name from avo_branch where id='".$row[3]."'");
$branch=mysqli_fetch_row($br);
?>
<?php echo $branch[1]; ?></td>
</tr>

<tr>
<th height="25">Expense Type </th> <th>Claim remarks</th> <th>Claimed Amount</th><th>Approved Amount </th> 


</tr>
<tr>
<td height="25">Logistics Expenses </td>
<td><?php echo $row[4];  ?></td>
<td><?php echo $row[5];  ?></td>
<div><td><input type="number" class="InvQty" min="0" max="3000" name="log_amt" id="log_amt" value="0" onkeyup="if(parseInt(this.value)>3000){ this.value =''; return false; }" /></td></div>
</tr>

<tr>
<td height="25">Handling / Hamali Expenses </td>
<td><?php echo $row[6];  ?></td>
<td><?php echo $row[7];  ?></td>
<div><td><input type="number" class="InvQty" min="0" max="3000" name="hand_amt" id="hand_amt" value="0" onkeyup="if(parseInt(this.value)>3000){ this.value =''; return false; }" /></td></div>
</tr>
<tr>
<td height="25">Spares Expenses </td>
<td><?php echo $row[8];  ?></td>
<td><?php echo $row[9];  ?></td>
<div><td><input type="number"  class="InvQty" min="0" max="3000" name="spare_amt" id="spare_amt" value="0" onkeyup="if(parseInt(this.value)>3000){ this.value =''; return false; }" /></td></div>
</tr>
<tr>
<td height="25">Courier Expenses </td>
<td><?php echo $row[10];  ?></td>
<td><?php echo $row[11];  ?></td>
<div><td><input type="number" class="InvQty" min="0" max="1000" name="mobile_amt" id="mobile_amt" value="0" onkeyup="if(parseInt(this.value)>1000){ this.value =''; return false; }"/></td></div>
</tr>
<tr>
<td height="25">Stationary Expenses </td>
<td><?php echo $row[12];  ?></td>
<td><?php echo $row[13];  ?></td>
<div><td><input type="number" class="InvQty" min="0" max="1000" name="room_amt" id="room_amt"value="0"  onkeyup="if(parseInt(this.value)>1000){ this.value =''; return false; }"/></td></div>
</tr>
<tr>
<td height="25">Other Expenses </td>
<td><?php echo $row[14];  ?></td>
<td><?php echo $row[15];  ?></td>
<div><td><input type="number" class="InvQty" min="0" max="1000" name="oth_amt" id="oth_amt" value="0" onkeyup="if(parseInt(this.value)>3000){ this.value =''; return false; }" /></td></div>
</tr>

<tr>
<td height="25" style="color:blue; font-weight:bold;">Total Expenses </td>
<td></td>
<td style="color:blue; font-weight:bold;"><?php echo $row[16];  ?></td>
<div><td style="color:blue; font-weight:bold;"><input type="text" class="Total" readonly="readonly" id="Total" name="Total" value="0"/></td></div>
</tr>
<!--<tr>
<td> <a style="color:red; font-size:15px; font-weight:bold;" href="check_alert.php?eid=<?php echo $name[2]; ?>&date=<?php echo $row[3]; ?>" target="_new">Check calls</a></td> 

<? 

$result = mysqli_query($con1,"SELECT COUNT(responsetime) AS `count` FROM `alert_progress` where engg_id='".$name[2]."' and date(responsetime)='".$row[3]."' and responsetime !='0000-00-00 00:00:00'");

$calls = mysqli_fetch_assoc($result);
$cnt1 = $calls['count']; 

?>

<td><input type="hidden" name="pcall" id="pcall" readonly="readonly" value="<?php echo $cnt1; ?>"/><?php echo $cnt1; ?></td>

</tr> -->


<tr>
<td height="35" colspan="1" >Approval Remarks</td>
<td width="180">
<textarea  input type="text" colspan="4" name="app_rem" id="app_rem" maxlength="100" ></textarea>
</td>

<td height="35" colspan="4">
<input type="hidden" name="id" value="<?php echo $row[0]; ?>" />
<input type="button" value="submit" class="readbutton" onclick="validate();"/></td>
</tr>
</table>
</form>
</div>
<td height="45" ><center><button onclick="goBack()"> Keep Pending >> GO BACK</button></center></td>

<script>
function goBack() {
  window.close();
}
</script>


</center>
</body>
</html>