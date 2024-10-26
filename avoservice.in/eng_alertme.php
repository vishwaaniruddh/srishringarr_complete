<?php
include("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='40';
else
ppg=document.getElementById(perpg).value;
document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
//alert("hi");
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		  var br=document.getElementById('br').value;
		  var calltype=document.getElementById('calltype').value;
		 /* if(document.getElementById('idd').value=="" && document.getElementById('fname22').value=="")
		  {
			  var url = 'get_docID.php';
		  }else   if(document.getElementById('fname22').value==""){
			  
			  var s=document.getElementById('idd').value;
			var url = 'get_docID.php?id='+s;
		  } else if(document.getElementById('idd').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_docID.php?fname='+s;
		  } else{*/
			 // var id=document.getElementById('idd').value;//alert(id);
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			// var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var eng=document.getElementById('eng').value
			 var fromdt=document.getElementById('fromdt').value;
			 var area=document.getElementById('area').value;//alert(area);
			 var todt=document.getElementById('todt').value;
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'search_engalert.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&area='+area+'&bank='+bank+'&br='+br+'&Page='+b+"&calltype="+calltype+'&perpg='+ppg+'&eng='+eng+'&fromdt='+fromdt+'&todt='+todt;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+"&Page="+b+"&calltype="+calltype+'&perpg='+ppg;
			}
			//alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
			HttPRequest.onreadystatechange = function()
			{
 /*
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 */
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }
</script>
</head>

<body <?php if($_SESSION['designation']=='1' || $_SESSION['designation']=='2' ){ ?> onload="searchById('Listing','1','')"<?php } ?>>
<center>

<?php include("menubar.php"); ?>
<h2>Engineer Alerts</h2>
<?php if($_SESSION['designation']=='1' || $_SESSION['designation']=='2' ){ ?>
<table cellpadding="" cellspacing="0" >
<?php $br= $_SESSION['branch'];// if($_SESSION['branch']!='all') { $br=implode(",",$_SESSION['branch']); } else{ $br=$_SESSION['branch'];  } ?>
<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
  <tr> <th width="77" colspan="5"><select name="calltype" id="calltype" onchange="searchById('Listing','1','');">
      <option value="Delegated">Open call</option>
      <option value="Done">Closed call</option>
      
      <option value="">All Calls</option>
    </select></th>
    <th>
    <?php
    include("config.php");
    $eng=mysqli_query($con1,"select * from area_engg where status='1' order by engg_name ASC");
    if(!$eng)
    echo mysqli_error();
    ?>
    <select name="eng" id="eng" onchange="searchById('Listing','1','');" style="width:150px"><option value="">-select Engineer-</option><?php 
  //  include("config.php");
	
	while($engg=mysqli_fetch_array($eng))
	{
	?>
    <option value="<?php echo $engg[0]; ?>"><?php echo $engg[1]; ?></option>
    <?php
	}
	 ?></select></th>
    <!--<th width="77"><input type="text" name="cid" id="cid" onkeyup="searchById('Listing','1','');" placeholder="Name"/></th>-->
    <th width="75"><input type="text" name="atmid" id="atmid" onkeyup="searchById('Listing','1','');" placeholder="ATM"/></th>
    <th width="75"><input type="text" name="bank" id="bank" onkeyup="searchById('Listing','1','');" placeholder="Bank"/></th>
    <th width="75"><input type="text" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="Address"/></th>
    <th width="75"><input type="text" name="fromdt" id="fromdt" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/><input type="text" name="todt" id="todt"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/><input type="button" onclick="searchById('Listing','1','');" value="search by date" /></th>
  
  </tr>
  
  <tr>
    
  </tr>
</table><?php } ?>
<div id="search">
<?php
$count=0;
$des=$_SESSION['designation'];
 $username=$_SESSION['user'];
//$pass=$_SESSION['password'];

if($des!='1' || $des!='2')
{
	include("config.php");
	//echo "select srno from login where username='".$_SESSION['user']."'";
	$qry=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
	$row=mysqli_fetch_row($qry);
	//echo $row[0];
	//echo "<br>select engg_id from area_engg where loginid='".$row[0]."'";
	$qry2=mysqli_query($con1,"select engg_id from area_engg where loginid='".$row[0]."'");
	$row2=mysqli_fetch_row($qry2);
	//echo "<br>".$row2[0];
?>
<table width="506" border="1" cellpadding="2" cellspacing="0" class="res">
<th>Complain ID</th>
<th width="49">ATM</th>
<th width="68">Bank</th>
<th width="58">Area</th>
<th width="58">Address</th>
<th width="106">Problem</th>
<th width="106">Date/Time</th>
<th width="58">Alert</th>
<th width="58">Assets / Qty</th>
<th width="106">Status</th>


<?php
//echo "<br>Select * from alert_delegation where engineer='".$row2[0]."' and alert_id in (select alert_id from alert where call_status<>'Done'";
$sql1=mysqli_query($con1,"Select * from alert_delegation where engineer='".$row2[0]."' and alert_id in (select alert_id from alert where call_status<>'Done')");
//$sql1=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("alert_id"),"alert_delegation","engineer",$row[0],array(""),"y","","");


while($row1=mysqli_fetch_row($sql1)) {
	$atmrow='';
	//echo "select * from alert where alert_id='".$row1[3]."'";
	//echo "<br>select * from alert where alert_id='".$row1[3]."' where call_status<>'Done'";
$sql2=mysqli_query($con1,"select * from alert where alert_id='".$row1[3]."'and call_status<>'Done'");	//$sql2=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"alert","alert_id",$row1[0],array(""),"y","","");
	$row2=mysqli_fetch_row($sql2);
	
	//echo "<br>".$row2[17];
if($row2[17]=='service')
{
//echo "<br>select atmid from Amc where amcid='".$row2[2]."'<br><br><br>";
	$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row2[2]."'");
	$atmrow=mysqli_fetch_row($atm);
}
	 if($row2[16]!='Done')
	 {
	 
	 $count=$count+1;
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row2[25]; ?></td>
<td><?php if($row2[17]=='new' || $row2[17]=='new temp' ){ echo $row2[2];}else{ echo $atmrow[0]; } ?></td>
<td><?php echo $row2[3]; ?></td>
<td><?php echo $row2[4]; ?></td>
<td><?php echo $row2[5]; ?></td>
<td><?php echo $row2[9];
if($row2[28]=='1')
 {
 //echo "select desc from buyback where alertid='".$row[0]."'";
// echo "select * from buyback where alertid='".$row2[0]."'";
 $buy=mysqli_query($con1,"select * from buyback where alertid='".$row2[0]."'");
 $buyro=mysqli_fetch_row($buy);
 echo "<br><b>Buy Back :</b>".$buyro[2];
 
 }
 ?></td>
 <td><?php 
echo date("d/m/Y h:i:s a",strtotime($row2[10]));
 ?></td>
<td><?php 
if($row2[16]=='1')
echo "Pending";
else
echo $row2[16];
//echo "<br>select * from alert where alert_id='".$row1[3]."'and call_status<>'Done'";
 ?></td>

<td><?php

 for($i=0;$i<count($row2[0]);$i++) {
 //echo "select assets,qty from alert_assets where alert_id='$row2[0]'";
 $sql3=mysqli_query($con1,"select assets,qty from alert_assets where alert_id='$row2[0]'");
       while($row3=mysqli_fetch_row($sql3))
       echo $row3[0]."($row3[1])".", ";}
       ?></td>
<td>
<?php if($row2[15]!='Done') { ?>
<input type="button" value="Done" class="readbutton" onclick="javascript:location.href='eng_feedback1.php?alert=<?php echo $row1[3]; ?>&eng_id=<?php echo $row[0]; ?>'"/>
<?php } else { ?>
<img src="images/right.png" /><?php } ?></td>
</tr>
<?php } } 
//echo $_SESSION['designation'];
if($_SESSION['designation']=='1' || $_SESSION['designation']=='2')
{
//echo "Select * from alert_delegation order by id DESC";
$sq=mysqli_query($con1,"Select * from alert_delegation order by id DESC");
//$sql1=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("alert_id"),"alert_delegation","engineer",$row[0],array(""),"y","","");
while($ro=mysqli_fetch_row($sq)) {
	$atmrow='';
	//echo "select * from alert where alert_id='".$row1[3]."'";
	//echo "select * from alert where alert_id='".$ro[3]."' and call_status<>'Done'";
$sql2=mysqli_query($con1,"select * from alert where alert_id='".$ro[3]."' and call_status<>'Done'");	//$sql2=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"alert","alert_id",$row1[0],array(""),"y","","");
	while($row2=mysqli_fetch_row($sql2))
	{
if($row2[17]=='service')
{
	$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row2[2]."'");
	$atmrow=mysqli_fetch_row($atm);
}
$count=$count+1;	
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row2[25]; ?></td>
<td><?php if($row2[17]=='new' || $row2[17]=='new temp' ){ echo $row2[2];}else{ echo $atmrow[0]; } ?></td>
<td><?php echo $row2[3]; ?></td>
<td><?php echo $row2[4]; ?></td>
<td><?php echo $row2[5]; ?></td>
<td><?php echo $row2[9];
if($row2[28]=='1')
 {
 //echo "select desc from buyback where alertid='".$row[0]."'";
// echo "select * from buyback where alertid='".$row2[0]."'";
 $buy=mysqli_query($con1,"select * from buyback where alertid='".$row2[0]."'");
 $buyro=mysqli_fetch_row($buy);
 echo "<br><b>Buy Back :</b>".$buyro[2];
 
 }
 ?></td>
 <td><?php echo date("d/m/Y h:i:s a",strtotime($row2[10])); ?></td>
<td><?php if($row2[16]=='1')
echo "Pending";
else
echo $row2[16]; ?></td>

<td><?php

 for($i=0;$i<count($row2[0]);$i++) {
//echo "select assets,qty from alert_assets where alert_id='$row2[0]'";
 $sql3=mysqli_query($con1,"select assets,qty from alert_assets where alert_id='$row2[0]'");
       while($row3=mysqli_fetch_row($sql3))
       echo $row3[0]."($row3[1])".", ";}
       ?></td>
<td>
<?php if($row2[15]!='Done') { ?>
<input type="button" value="Done" class="readbutton" onclick="javascript:location.href='eng_feedback1.php?alert=<?php echo $ro[3]; ?>&eng_id=<?php echo $row[0]; ?>'"/>
<?php } else { ?>
<img src="images/right.png" /><?php } ?></td>
</tr>
<?php } } 	
}
}
?>
</table>
</div>
</center>
</body>
</html>