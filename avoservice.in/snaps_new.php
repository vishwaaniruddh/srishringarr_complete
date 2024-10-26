<?php
//session_start();
include("access.php");
include('config.php');

 
 
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<script>
///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='10';
else
ppg=document.getElementById(perpg).value;
document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
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
		  var bravo=document.getElementById('bravo').value;
		  var calltype=document.getElementById('calltype').value;
		  var branch_avo=document.getElementById('branch_avo').value; //alert(branch_avo);
		  var engg=document.getElementById('Employee_name').value;
	var cid=document.getElementById('cid').value;//alert(cid);
		
			 if(a!="Loading"){
			 	var id=document.getElementById('atmid').value;//alert(id);
			 	var cid=document.getElementById('cid').value;//alert(cid);
			 //	var bank=document.getElementById('bank').value;//alert(bank);
			  	var fromdt=document.getElementById('fromdt').value;
			 	var todt=document.getElementById('todt').value;
			   	var complaintno=document.getElementById('complaintno').value;
			  	var branch_avo=document.getElementById('branch_avo').value; //alert(branch_avo);
			  	var engg=document.getElementById('Employee_name').value;
			  	 var bravo=document.getElementById('bravo').value;
			  	 var calltype=document.getElementById('calltype').value;
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'search_snaps_new.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&bravo='+bravo+'&Page='+b+"&calltype="+calltype+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&complaintno='+complaintno+'&branch_avo='+branch_avo+'&engg='+engg;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'bravo='+bravo+"&Page="+b+"&calltype="+calltype+'&perpg='+ppg+'&branch_avo='+branch_avo+'&engg='+engg+'&cid='+cid;
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
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }


function newwin(url,winname,w,h)
{
//alert("hi");
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  //mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
 
 }
 
 function runScript(e) {
    if (e.keyCode == 13) {
		searchById('Listing','1','');
       // alert('enter pressed');
        // document.getElementById('button').click();
    }
}
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

<!--<body onLoad="searchById('Loading','1','')">-->
<body>
<?php $branchavo= $_SESSION['branch'];

if($_SESSION['designation']=='4') {
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");

$qry2ro=mysqli_fetch_row($qry2);

$sql.= "select engg_id, engg_name, area from area_engg where loginid='".$qry2ro[0]."' and status='1' ";

$result = mysqli_query($con1,$sql);
$engr=mysqli_fetch_row($result);
$selbr= "select id from avo_branch where id='".$engr[2]."'";}
	    
	 else if($_SESSION['branch']!='all'){
	$selbr= "select id from avo_branch where id IN (".$_SESSION['branch'].") order by id ASC ";
	  } else 
	  
	  $selbr= "select id from avo_branch order by id ASC ";
		$selbr2=mysqli_query($con1,$selbr);
//echo $selbr;

	
?>
 
 

<input type="hidden" value="<?php  echo $branchavo;?>" name="bravo" id="bravo"/>
<center>
 <?php include("menubar.php");    ?>
 
<h2 class="h2color">Installation Snaps</h2>
<h4 class="h2color">Closed Calls From 18-10-2022</h4>
<div >
 <table cellpadding="" cellspacing="0" >

<tr>
<th width="77" colspan="">
        <select name="branch_avo" id="branch_avo" onchange="pick_engg(this.value);">
    <? if($_SESSION['designation']!='4'){ ?> 
      	<option value= "">Select</option>
<?php }
	while ($result=mysqli_fetch_array($selbr2)) {
	    $branch=mysqli_query($con1,"select id, name from avo_branch where id='".$result[0]."'");
echo "select id, name from avo_branch where id='".$result[0]."'";	    
	    $brname=mysqli_fetch_row($branch);
               ?>
	   <option value="<?php echo $brname[0]; ?>"><?php echo $brname[1]; ?></option>
      <? }   ?> 
       </select>
</th>

<th>
 <div id="mystate">
 <select name="Employee_name" id="Employee_name" >
    
<? if($_SESSION['designation']!='4'){ ?>
    <option value="">Select</option> <? } ?>
<?   if($_SESSION['designation']=='4'){   ?>
    <option value="<?php echo $engr[0]; ?>"><?php echo $engr[1]; ?></option>
  
   <? } else ?>
<option value="<?php echo $name[0]; ?>"><?php echo $name[1]; ?></option>
</div>
</th>
 
 
 
    <th width="77" colspan=""><select name="calltype" id="calltype" onchange="searchById('Listing','1','');"> 
      <option value="0">Snaps Pending</option>
      <option value="1">Attached </option>
      
    </select>
    </th>
   
   <?  include("config.php");
   
   $client="select cust_id,cust_name from customer where 1";
        if($_SESSION['designation']==5){
        $cust=mysqli_query($con1,"select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
        }
    $client.=" order by cust_name ASC";      ?>
   <th>
    <select name="cid" id="cid" onchange="searchById('Listing','1','');"> <?php if($_SESSION['designation']!=5){ ?><option value="">Select Client</option><?php }
$cl=mysqli_query($con1,$client);
while($clro=mysqli_fetch_row($cl)) { ?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php  } ?></select></th>

   
        <th width="75"><input type="text" name="atmid" id="atmid" onkeypress="return runScript(event)" placeholder="Site/Sol/ATM I'd"/></th>
    <!--<th width="75"><input type="text" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="End User"/></th> -->
   
    
   
	<th width="75"><input type="text" name="complaintno" id="complaintno" onkeypress="return runScript(event)" placeholder="ComplaintNo"/></th>

     
     <th width="75"><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
     
     <th width="75"><input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
      
  <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
 
  
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>