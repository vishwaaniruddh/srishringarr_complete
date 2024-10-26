<?php
session_start();
include("access.php");
include("menubar.php");
	include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />
<link href="../popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<script src="../popup.js" type="text/jscript" language="javascript"> </script>
<script>

function pick_engg(val){
//alert(val);
brid=val;
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
  	//alert(s);
	 document.getElementById('mystate').innerHTML = s;	
    }
  }
   
   //	alert("get_engg_br.php?brid="+brid);    
	xmlhttp.open("GET","get_engg_br.php?brid="+brid,true);
	xmlhttp.send();
}           


</script>
</head>

<body>
    </br>
    
<center>
<form name="frm" method="post" action="route_plan.php">
 <table cellpadding="" cellspacing="0" >

 <tr>
<?     
if($_SESSION['designation']=='4') {
    // echo $_SESSION['user'];
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");

$qry2ro=mysqli_fetch_row($qry2);

// echo $qry2ro[0];
$sql.= "select engg_id, engg_name, area from area_engg where loginid='".$qry2ro[0]."' and status='1' ";
$result = mysqli_query($con1,$sql);
$engr=mysqli_fetch_row($result);
$selbr= "select id from avo_branch where id ='".$engr[3]."'";}
	  else if($_SESSION['branch']!='all'){
	$selbr= "select id from avo_branch where id IN (".$_SESSION['branch'].") order by name ASC ";
	  } else 
	  
	  $selbr= "select id from avo_branch order by id ASC ";
	  
	  
		$selbr2=mysqli_query($con1,$selbr);
?>

<tr>
<th width="77" colspan="">
 
         
         <select name="branch" id="branch" onchange="pick_engg(this.value);">
     	
      	<option value= "">Select</option>
<?php
		while ($result=mysqli_fetch_array($selbr2)) {
	    $branch=mysqli_query($con1,"select id, name from avo_branch where id='".$result[0]."'");
	    $brname=mysqli_fetch_row($branch);
               ?>
	   <option value="<?php echo $brname[0]; ?>"><?php echo $brname[1]; ?></option>
      
      <? }      ?>
       </select>
</th>

 
<th>
 <div id="mystate">
 <select name="Employee_name" id="Employee_name" >
    
<? if($_SESSION['designation']!='4'){ ?>
    <option value="">Select</option> <? } ?>
<?   if($_SESSION['designation']=='4'){   ?>
    
    <option value="<?php echo $engr[0]; ?>"<? if($_POST['Employee_name']==$engr[0]){ echo 'selected'; } ?> ><?php echo $engr[1]; ?></option>
   
   <? }  else ?>
    
    <option value="<?php echo $name[0]; ?>" <? if($_POST['Employee_name']==$name[0]){ echo 'selected'; } ?> ><?php echo $name[1]; ?></option>
</div>
</th>

 <th width="75" rowspan="2"><input type="submit" value="Search" /></th>
  
  </tr>
  
</table>
</form> 
 </br>
    <form name="frm" method="post" action="opencall_map.php" target="_new">
<table width="700" border="1" cellpadding="2" cellspacing="0" class="res" id="table1">
    <th>Srno</th>
    <th>Action</th>
<th>Complain ID</th>
<th>Engineer name</th>
<th width="49">ATM</th>
<th width="49">Site Status</th>
<th width="68">Bank</th>
<th width="58">Area</th>
<th width="58">State</th>
<th width="58">Address</th>
<th width="150">Problem</th>
<th width="150">Alert Date/Time</th>
<!--<th width="58">Assets / Qty</th> -->
<th width="106">Status</th>
<th width="200">Last Update</th>
<th width="100">Location Mark</th>


<?php
$i=1;
// $dt = $_POST['date'];
$engg_id=$_POST['Employee_name'];
$sqlen= "select engg_id, engg_name from area_engg where engg_id='".$engg_id."'";
$rest = mysqli_query($con1,$sqlen);
$engg_name=mysqli_fetch_row($rest);

$qry="select * from alert where alert_id in (select alert_id from alert_delegation where engineer='".$engg_id."') ";

$qry.=" and status='Delegated' and call_status='1'";
//echo $qry;
$sq=mysqli_query($con1,$qry);
	while($row2=mysqli_fetch_row($sq))
	{


if($row2[21] ==  'amc')
$atm=mysqli_query($con1,"select atmid, latitude1 from Amc where amcid='".$row2[2]."'");
	if($row2[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id, latitude1 from atm where track_id='".$row2[2]."'");
	
$atmrow=mysqli_fetch_row($atm);
$atm_id=$atmrow[0];

if($atmrow[1]==0){ $mapped="Site Location Not Marked" ;} 
else { $mapped="Site Mapped" ; }


if ($atm_id=='') { $atm_id= $row2[2];}

if($row2[21] ==  'amc') { $site= "AMC" ; }
if($row2[21] ==  'site') { $site= "Warranty" ; }
if($row2[21] ==  '') { $site= "PCB" ; }

$branch=$row2[7];

$count=$count+1;

?>

<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $i;?></td>
<td> <input type="checkbox" name="checkbox[]" id="checkbox11" value="<? echo $row2[0]; ?> "  onclick="terms_changed(this)" >
<!--<input type="hidden" name= "ch[]" value="<?=$i ?>" >-->
</td>

<td><?php echo $row2[25]; ?></td>
<td><?php echo $engg_name[1]; ?></td>

<td><?php echo $atm_id; ?> </td>

<td><?php echo $site; ?></td>

<td><?php echo $row2[3]; ?></td>
<td><?php echo $row2[4]; ?></td>
<td><?php echo $row2[27]; ?></td>
<td><?php echo $row2[5]; ?></td>
<td><?php echo $row2[9]; ?> </td> <!-- Problem -->

 
  <td><?php 
echo date("d/m/Y h:i:s a",strtotime($row2[10]));
 ?></td>

<td>
    <?php if($row2[15]=="Delegated" && $row2[16]=="1") { echo "Pending"; }
     if($row2[15]=="Delegated" && $row2[16]=="Rejected") { echo "Delegated but Branch Rejected"; }
     if($row2[15]=="Done" && $row2[16]=="Rejected") { echo "Engr Closed but Branch Rejected"; }
     if($row2[15]=="Pending" && $row2[16]=="Rejected") { echo "Branch Rejected"; }
     if($row2[15]=="Done" || $row2[16]=="Done") { echo "Closed"; } ?>
</td>

<td valign="top">
<!-- <div height="100px" style="height:50px; width:150px; overflow:hidden;"> -->
<div height="100px" style="width:150px; ">
<?php //============Updates=========	
$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row2[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
if(mysqli_num_rows($tab)>0){

 echo wordwrap($row1[0],50,"<br />\n",TRUE);
 ?>


<?php echo date('d/m/Y h:i:s a',strtotime($row1[2]))."<br>".wordwrap($row1[0],10,"<br />\n",TRUE); ?></a> -->
<?php
}
else
echo "No Updates so far";
?>
</div>
</td>
<td><? echo $mapped ;?></td>

</tr>
<?php

	    $i++;
	}

?>
</table>
<br/>
<input type="hidden" name="engg_id" id="engg_id" value="<? echo $engg_name[0];?>" readonly>
<input type="hidden" name="qr" value="<?php echo $qry; ?>" readonly>
<!--<input type="checkbox" name="check1"  onclick="terms_changed(this)" >Home--> </br>
<!--<input type="hidden" name="srno" value="<?php echo $i;?>" >-->
<button type="submit" name="cmdsub" id="submit" style="width:10%;height:5%" disabled >View Map</button>
</form>
 
<div id="bg" class="popup_bg"> </div> 

</center>
<script>


function terms_changed(termsCheckBox){

    
    if(termsCheckBox.checked ){
        //Set the disabled property to FALSE and enable the button.
        document.getElementById("submit").disabled = false;
    } else{
        //Otherwise, disable the submit button.
        document.getElementById("submit").disabled = true;
    }
}

  
</script>
</body>