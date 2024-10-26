<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$branch=$_SESSION['branch'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<script>
function runScript(e) {
    if (e.keyCode == 13) {
		searchById('Listing','1','');
       // alert('enter pressed');
        // document.getElementById('button').click();
    }
}

//=============search===================== 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='10';
else
ppg=document.getElementById(perpg).value;
//alert(ppg);
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
		 
			 var br=document.getElementById('br').value;//alert(br);
			var type=document.getElementById('type').value
			
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var city=document.getElementById('city').value;//alert(city);
			 var area=document.getElementById('area').value;//alert(area);
		     var branch=document.getElementById('branch').value;//alert(state);
			 	  }
			if(document.getElementById('type').value=="A"){
			var url = 'search_pm_batt.php';
			}else if(document.getElementById('type').value=="B"){
			var url='search_pmmust.php'
			}else if(document.getElementById('type').value=="C"){
			var url='search_pmcat_c.php'
		 
			}
 	
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'id='+id+'&cid='+cid+'&city='+city+'&area='+area+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&br='+br+'&branch='+branch;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&br='+br;	
			}
			//alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert("gg"); 
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

<body onLoad="searchById('Loading','1','')">
<center>
<?
     if($_SESSION['designation']==5){
            include("AccountManager/menubar.php");
        } else{
          include("menubar.php");  
        }
       
$br= $_SESSION['branch']; ?>

<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
<h2 class="h2color">Preventive Maintenance Site</h2>

<div class="">
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table  border="0" cellpadding="0" cellspacing="0">
<tr>

</tr>
<tr>
<th >Select Site <select  name="type" id="type" onchange="searchById('Listing','1','');">

<option value="A">Priority - A</option>
<option value="B">PM Must in AMC</option>
<option value="C">Priority - C </option>
</select> </th>
<th width="77">

<select id="cid" onchange="searchById('Listing','1','');">
<option value="">Vertical/ Customer</option>
<?php $qrycust=mysqli_query($con1,"select cust_id,cust_name from customer");
while($fetchcust=mysqli_fetch_array($qrycust))
{
?>
<option value="<?php echo $fetchcust[0];?>"><?php echo $fetchcust[1];?></option>
<?php } ?>
</select>

<th width="145"><input type="text" size="15" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="End User"/></th>

<th width="75"><input type="text" size="15" name="city" id="city" onkeypress="return runScript(event)" placeholder="City"/></th>


<th width="77">
     	<?php 
		$selbr="select * from avo_branch where 1";
		if($_SESSION['branch']!='all')
		$selbr.=" and id IN (".$_SESSION['branch'].") ";
		
	 	$selbr.=" order by id ASC";
		//echo $selbr;
		$selbr2=mysqli_query($con1,$selbr)
		?>
        <select name="branch" id="branch" onchange="searchById('Listing','1','');" >
        
		<?php if($_SESSION['branch']=='all'){?>
        <option value="">Branch</option>
        <?php }?>
        
		<?php
        
        while($branch1=mysqli_fetch_array($selbr2))
        {         ?>
        <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
        <?php } ?>
        </select>
</th>




<th width="75"><input type="text" size="15" name="area" id="area" onkeypress="return runScript(event)" placeholder="Address"/></th>
<th width="75"><input type="text" size="15" name="id" id="id" onkeypress="return runScript(event)" placeholder="Site/Sol/ATM Id"/><br /></th>

<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>

</tr>
</table>
</div>
<div id="search"></div>

</center>
</body>
</html>