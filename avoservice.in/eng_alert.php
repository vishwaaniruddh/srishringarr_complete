<?php
include("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Engr Alert</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
<script>

function runScript(e) {
    if (e.keyCode == 13) {
		searchById('Listing','1','');
       // alert('enter pressed');
        // document.getElementById('button').click();
    }
}

///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='10';
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
		 
		  var calltype=document.getElementById('calltype').value;
		  var type=document.getElementById('type').value;
		// alert(calltype);
			
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			
		
			 var fromdt=document.getElementById('fromdt').value;
			 var bank=document.getElementById('bank').value;//alert(area);
			 var todt=document.getElementById('todt').value;
			  }
			  
			var url = 'search_engalert.php'; 
		
		    var pmeters="";
			
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&bank='+bank+'&Page='+b+"&type="+type+"&calltype="+calltype+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+"&Page="+b+"&calltype="+calltype+'&perpg='+ppg;
			}
	HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
			HttPRequest.onreadystatechange = function()
			{
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

<body onload="searchById('Listing','1','')">
<center>
<?php include("menubar.php"); ?>

<h2 class="h2color">View Your Calls</h2>

<table cellpadding="" cellspacing="0" width="100%" >
     <tr> 
     <th><select name="calltype" id="calltype" onchange="searchById('Listing','1','');">
      
      <option value="Delegated">Open call</option>
      <option value="Rejected">Rejected By Branch</option>
      <option value="onhold">On Hold  By Branch</option>
      <option value="Done">Closed call</option>
      <option value="">All Calls</option>
    </select></th>
    
    <th><select name="type" id="type" onchange="searchById('Listing','1','');">
      <option value="">All Calls</option>
      <option value="service">Service Call</option>
      <option value="inst"> New Installation</option>
      <option value="pm">PM Call</option>
      <option value="de_re">De-Re Inst</option>
     
    </select></th>
    
    <!--<input type="hidden" name="eng" id="eng" value= > -->
   
    <th><input type="text" name="atmid" id="atmid" onkeypress="return runScript(event)" placeholder="SIte id"/></th><!--4-->
 
    <th ><input type="text" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="Bank"/></th><!--5-->
    
    <th ><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/> </th ><!--7-->
    <th > <input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/> </th ><!--8-->
    <th > <input type="button" onclick="searchById('Listing','1','');" value="Search" /></th><!--9-->
  
  </tr>
  
  <tr>
    
  </tr>
</table>
<div id="search">

<?php
//befor echo "Select * from alert_delegation where engineer='".$row2[0]."' and alert_id in (select alert_id from alert where call_status<>'Done')"
 //echo "<br>Select * from alert_delegation where `call_close_status`=0 and engineer='".$row2[0]."' and alert_id in (select alert_id from alert where call_status='1')";
/*

$sql1=mysqli_query($con1,"Select * from alert_delegation where `call_close_status`=0 and engineer='".$row2[0]."' and alert_id in (select alert_id from alert where call_status='1')");
//$sql1=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("alert_id"),"alert_delegation","engineer",$row[0],array(""),"y","","");


while($row1=mysqli_fetch_row($sql1)) {
	$atmrow='';
	//echo "select * from alert where alert_id='".$row1[3]."'";
	//Befor query echo "<br>select * from alert where alert_id='".$row1[3]."' and call_status<>'Done'";
	//echo "<br>select * from alert where alert_id='".$row1[3]."' and call_status='1'";
$sql2=mysqli_query($con1,"select * from alert where alert_id='".$row1[3]."' and call_status='1'");	//$sql2=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"alert","alert_id",$row1[0],array(""),"y","","");
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

<!-----contact-->
<td><?php echo $row2[13]; ?></td>

<!-----name-->
<td><?php echo $row2[12]; ?></td>

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
 
 	<td>
 	<?php 
	echo date("d/m/Y h:i:s a",strtotime($row2[10]));
 	?>
    </td>
	
    <td>
	<?php 
	if($row2[16]=='1')
		echo "Pending";
		else
		echo $row2[16];
		//echo "<br>select * from alert where alert_id='".$row1[3]."'and call_status<>'Done'";
 	?>
    </td>

<td><?php

 for($i=0;$i<count($row2[0]);$i++) {
 //echo "select assets,qty from alert_assets where alert_id='$row2[0]'";
 $sql3=mysqli_query($con1,"select assets,qty from alert_assets where alert_id='$row2[0]'");
       while($row3=mysqli_fetch_row($sql3))
       echo $row3[0]."($row3[1])".", ";}
       ?></td>
<td>
<?php if($row2[15]!='Done') { ?>
<!--<input type="button" value="Done" class="readbutton" onclick="javascript:location.href='eng_feedback1.php?alert=<?php echo $row1[3]; ?>&eng_id=<?php echo $row[0]; ?>'"/>--> Pending
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

<!--contact-->
<td><?php echo $row2[13]; ?></td>

<!--name-->
<td><?php echo $row2[12]; ?></td>


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
}  */
?>


</div>
</center>
</body>
</html>