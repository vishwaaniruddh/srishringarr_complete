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

</script>

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
   
   	//alert("get_state_br.php?brid="+brid);    
	xmlhttp.open("GET","get_areaengg_br.php?brid="+brid,true);
	xmlhttp.send();
}

</script>




<script type="text/javascript">


///////////////////////////////search 
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
		 
			 var branch=document.getElementById('branch_avo').value;//alert(br);
			var type=document.getElementById('type').value;
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			 var branch=document.getElementById('branch_avo').value;//alert(branch);
			 var engg=document.getElementById('Employee_name').value;
			 	  }
			
			if(document.getElementById('type').value=="warr"){
			var url = 'search_dist_calc.php';
			
			    
			}else if(document.getElementById('type').value=="amc"){
			var url='search_dist_amc.php'
			}
 	
		var pmeters="";
		//	alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'id='+id+'&Page='+b+'&perpg='+ppg+'&branch='+branch+'&engg='+engg;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&branch='+branch;	
			}
		//	alert(pmeters);
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

<body> <!-- onLoad="searchById('Loading','1','')"> -->

<? include("menubar.php"); 
?>

<center>

        
        <?php  $br= $_SESSION['branch']; ?>

<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
<h2 class="h2color">Engineer to site Distance</h2>

<div class="">
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table  border="0" cellpadding="0" cellspacing="0">
<tr>

</tr>
<tr>
<th >Select Site <select  name="type" id="type" onchange="searchById('Listing','1','');">

<option value="warr">Warranty Sites</option>
<option value="amc">AMC sites</option>


</select> </th>

 <th width="77">
     	<?php 				
		$selbr="select * from avo_branch where 1";
		if($_SESSION['branch']!='all'){
		$selbr.=" and id in( ".$_SESSION['branch'].")";
		}		
	 	$selbr.=" order by id ASC";
		//echo $selbr;
		$selbr2=mysqli_query($con1,$selbr)
		?>
        <select name="branch_avo" id="branch_avo" onchange="pick_engg(this.value);" >       
			
			
				<?php
			//	if($_SESSION['branch']=='all'){ 
				?>
                <option value="">Branch</option>
                <?php  // } 
                while($branch1=mysqli_fetch_array($selbr2)){ ?>
                <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
                <?php } ?>
        </select>
</th>


<th>
<div id="mystate">

<?php

$engr="select engg_id, engg_name from area_engg where status=1 and deleted=0";

	if($_SESSION['branch']!='all')
	$engr.=" and area= '".$_SESSION['branch']."'";

	?>

	<select name="Employee_name" id="Employee_name" >
	<option value="">-select Engineer-</option>
	
	
	<?php
	$enggid=mysqli_query($con1,$engr);
	while($eid=mysqli_fetch_array($enggid))
	{
	?>
    <option value="<?php echo $eid[0]; ?>"><?php echo $eid[1]; ?></option>
    <?php
	}
	?>
     </select>
     
</div>
</th>


<th width="75"><input type="text" size="15" name="id" id="id" onkeypress="return runScript(event)" placeholder="Site/Sol/ATM Id"/><br /></th>

<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>

</tr>
</table>
</div>




<div id="search"></div>

</center>
</body>
</html>