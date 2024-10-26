<?php

include("access.php");
include("config.php");
//include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$id=$_GET['id'];



$id=$_GET['id'];
$br=$_GET['br'];
$ctype=$_GET['ctype'];


/*require_once('config.php');
$sq=mysql_query("select cust_id from alert where alert_id='$id'");
$ro=mysql_fetch_row($sq);

$sq1=mysql_query("select * from cust where id='$ro[0]'");
$ro1=mysql_fetch_row($sq1);
*/

/*include_once('class_files/filter.php');
	$ob=new filter();
	$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("cust_id"),'alert',array("alert_id"),array($id),'','');
	$ro=mysql_fetch_row($tab);
	//echo $ro[0];
	$tab1=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),'customer',array("cust_id"),array($ro[0]),'','');
	$ro1=mysql_fetch_row($tab1);*/
date_default_timezone_set('Asia/Kolkata');
$qr=mysql_query("select caller_email,call_status,status from pmalert where alert_id='".$id."'");
$ro1=mysql_fetch_row($qr);



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
<table border="1" width="50%">
<thead>
<tr><th colspan="3" align="center"> <h2 style="text-align:center">Previous Update</h2> </th> </tr>
<tr>
<th>Update</th>
<th>Date / Time</th>
<th>Updating Person</th>
</tr>
</thead>

<tbody>

<?php

//include_once('config.php');
//$sql=mysql_query("select * from alert_updates where alert_id='$id'");

//include_once('class_files/filter.php');
	//$ob=new filter();
	//$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),'alert_updates',array("alert_id"),array($id),'','');
	//echo "<br><brselect * from alert_updates where alert_id='".$id."' order by id DESC";
	$tab=mysql_query("select f.feedback,f.engineer,f.feed_date,l.designation from pmfeedback f,login l where f.alert_id='".$id."' and f.engineer=l.srno order by f.feed_date DESC");
 while ($row=mysql_fetch_row($tab)) {
	 $upby="Masteradmin";
	 if($row[3]=='4')
	 $str="select engg_name from area_engg where loginid='".$row[1]."'";
	 elseif($row[3]=='3')
	 $str="select head_name from branch_head where loginid='".$row[1]."'";
	 
	 $up=mysql_query($str);
	 $upro=mysql_fetch_array($up);
	 $upby=$upro[0];
	// $qry=mysql_query("select * from state where state_id='".$row[4]."'");
	 //$rw=mysql_fetch_row($qry);
	
	  ?>
    

<tr>
<td><?php echo $row[0]; ?></td>
<td><?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[2])); ?></td>
<td><?php echo $upby; ?></td>
</tr>
<?php }

//echo $ro1[1];
if($ro1[1]!='Done'){
 include("eng_feedbackpm.php");
}
?>
</tbody>
</table>

</body>