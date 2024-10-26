<?php

include "access.php";
include "config.php";
//include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$id = $_GET['id'];
$br = $_GET['br'];
$ctype = $_GET['ctype'];

date_default_timezone_set('Asia/Kolkata');
$qr = mysqli_query($conc,"select caller_email,call_status from alert where alert_id='" . $id . "'");
$ro1 = mysqli_fetch_row($qr);

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script>
    window.onunload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
</script>

<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
<script>

function mail_value(){

if(document.getElementById('mail').checked==false){
	//alert("hi");
	document.getElementById('email').value="";
}
else
document.getElementById('email').value=document.getElementById('ml').value;
}

function responsetime(){

if(document.getElementById('response').checked==false){
	//alert("hi");
	document.getElementById('rtime').value="";
}
else
document.getElementById('rtime').value=document.getElementById('dt').value;
}
</script>

<script>
function validate(form){
 with(form)
 {
   if(up.value=="")/*Name validation*/
   {
	alert("Please Enter Some Update");
	up.focus();
	return false;
    }

 }
   if(confirm('Are you sure you want to Enter this Update.'))
   {
    return true;
   }
   else
   {
    return false;
}
 return true;
 }


</script>
<style>
h2{color:#F00;}

</style>


<!--<h2 align="center">Updates <a href="#" onclick="closepopup('<?php echo $id; ?>');"><span class="close_button">X</span></a></h2>-->

<body bgcolor="#009999">
<table border="1" width="100%">
<thead>
<tr><th colspan="3" align="center"> <h2 style="text-align:center">Update</h2> </th> </tr>
<tr>
<th>Update</th>
<th>Date / Time</th>
<th>Updating Person</th>
</tr>
</thead>

<tbody>

<?php

//include_once('config.php');
//$sql=mysqli_query($conc,"select * from alert_updates where alert_id='$id'");

//include_once('class_files/filter.php');
//$ob=new filter();
//$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),'alert_updates',array("alert_id"),array($id),'','');
//echo "select f.up,f.user,f.update_time,l.designation from alert_updates f,login l where f.alert_id='".$id."' and f.user=l.username order by f.update_time DESC";
//echo "select feedback,engineer,feed_date from eng_feedback where alert_id='".$id."'  order by feed_date DESC";
$tab = mysqli_query($conc,"select feedback,engineer,feed_date from eng_feedback where alert_id='" . $id . "'  order by feed_date DESC");
while ($row = mysqli_fetch_row($tab)) {
    $upby = "Masteradmin";

    $str = "select engg_name from area_engg where loginid='" . $row[1] . "'";
    $up = mysqli_query($str);

    if (mysqli_num_rows($up) > 0) {
        $upro = mysqli_fetch_array($up);
        $upby = $upro[0];

    } else {
        $str = "select `username` from `login` where srno ='" . $row[1] . "'";
        $up = mysqli_query($str);
        $upro = mysqli_fetch_array($up);
        $upby = preg_replace('/\d/', '', $upro[0]);

    }
    $upby;
    // $qry=mysqli_query($conc,"select * from state where state_id='".$row[4]."'");
    //$rw=mysqli_fetch_row($qry);

    ?>


<tr>
<td><?php echo $row[0]; ?></td>
<td><?php if (isset($row[2]) and $row[2] != '0000-00-00') {
        echo date('d/m/Y h:i:s a', strtotime($row[2]));
    }
    ?></td>
<td><?php echo $upby; ?></td>
</tr>

<?php }?>


<!--
<tr><td colspan="3" align="center"><h2> Update</h2></td></tr>
<tr><td colspan="3" align="center">
<form action="process_update1.php" method="post" name="form" onsubmit="return validate(this) ">
<input type="hidden" name="ml" id="ml" value="<?php echo $ro1[0]; ?>" />
<table width="363">

<tr>
<td width="184" height="35">Update : </td>
<td width="167">
<textarea name="up" id="up" rows="4" cols="25"></textarea>
</td>
</tr>
-->

<tr>
<!--<td height="35"><input type="submit" value="submit" class="readbutton"/></td>-->
<!--<td><input type="button" value="cancel" class="readbutton" onclick="self.close()"/></td>-->

<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="br" value="<?php echo $br; ?>" />
<input type="hidden" name="ctype" value="<?php echo $ctype; ?>" />
<input type="hidden" name="dt" value="<?php echo date("Y-m-d H:i:s"); ?>" id="dt" />
</tr>
</table>
</form>

</td>
</tr>
</tbody>
</table>

</body>