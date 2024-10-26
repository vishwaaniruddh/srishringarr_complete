<?php
session_start();
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['logid']." ".$_SESSION['designation'];

//if($_SESSION['branch']==''){ $_SESSION['branch'] = '';}
//if($_SESSION['designation']==''){ $_SESSION['designtion']=''; }
//if($_SESSION['user']==''){ $_SESSION['user']=''; }

// include('config.php');
include("db_connection.php");
$con1 = OpenCon1();


$brmain=$_SESSION['branch'];
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>Call Alerts</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 


<script TYPE="text/javascript"> 
function popup(mylink, windowname) { if (! window.focus)return true; var href; if (typeof(mylink) == 'string') href=mylink; else href=mylink.href; window.open(href, windowname, 'width=400,height=200,scrollbars=yes'); return false; } 
</script>


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
		  var openall=document.getElementById('openall').value;
		  var branch_avo=document.getElementById('branch_avo').value; //alert(branch_avo);
		
			 // var id=document.getElementById('idd').value;//alert(id);
			 if(a!="Loading"){
			 	var id=document.getElementById('atmid').value;//alert(id);
			 	var cid=document.getElementById('cid').value;//alert(cid);
			 	var bank=document.getElementById('bank').value;//alert(bank);
			  	var docket=document.getElementById('docket').value;//alert(cid);
			 	var fromdt=document.getElementById('fromdt').value;
			 	var todt=document.getElementById('todt').value;
			 	var area=document.getElementById('area').value;//alert(area);
			 	var eng=document.getElementById('eng').value;
			  	var assetstatus=document.getElementById('assetstatus').value;
			  //	var state=document.getElementById('state').value;
			  //  var state=document.getElementById('snaps').value;// instead of state- Snaps taken
              	var complaintno=document.getElementById('complaintno').value;
			  	var branch_avo=document.getElementById('branch_avo').value; //alert(branch_avo);
			  }
	
		//	var url = 'search_alertme2.php'; 
			
			var url = 'search_alertme_new.php'; 
	
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&bravo='+bravo+'&Page='+b+"&calltype="+calltype+"&openall="+openall+'&perpg='+ppg+"&docket="+docket+'&fromdt='+fromdt+'&todt='+todt+'&eng='+eng+'&assetstatus='+assetstatus+'&complaintno='+complaintno+'&branch_avo='+branch_avo;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'bravo='+bravo+"&Page="+b+"&calltype="+calltype+'&perpg='+ppg+'&branch_avo='+branch_avo;
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
 
 function newwindow()  
{  
    var myChild= window.open('link.html','','width=,height=,resizable=no');  
    myChild.blur();
} 
 
 function runScript(e) {
    if (e.keyCode == 13) {
		searchById('Listing','1','');
       // alert('enter pressed');
        // document.getElementById('button').click();
    }
}

</script>

  
</head>

<body onLoad="searchById('Loading','1','')">

<?php $branchavo= $_SESSION['branch']; ?>
<input type="hidden" value="<?php  echo $branchavo;?>" name="bravo" id="bravo"/>
<center>
<?php include("menubar.php");  ?>

<h2 class="h2color">View Alerts</h2>

<div >

<table cellpadding="" cellspacing="0" >

  <tr>
  
    <th width="77" colspan=""><select name="calltype" id="calltype" onchange="searchById('Listing','1','');"> 
      <option value="open">Open call</option>
      <option value="Done">Closed call</option>
      <option value="onhold">Customer Dependency Calls</option>
      <option value="Rejected">Rejected</option>
      <option value="">All Calls</option>
     
    </select>
    </th>
    
<th width="77" colspan="">
<select name="openall" id="openall"  onchange="searchById('Listing','1','');">
<option value="all">All</option>
<option value="install">New Installation</option>
<option value="service">Service</option>
<option value="pm">PM Calls</option>
<option value="dere">DeRe</option>

</select></th>

    <th><select name="cid" id="cid" onchange="searchById('Listing','1','');" ><option value="">Select Client</option><?php
$cl=mysqli_query($con1,"select cust_id,cust_name from customer order by cust_name ASC");
while($clro=mysqli_fetch_row($cl))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></th>

    <th><input type="text" name="docket" id="docket" onkeypress="return runScript(event)" placeholder="Client Docket Number"/></th>
    <!--<th width="77"><input type="text" name="cid" id="cid" onkeyup="" placeholder="Name"/></th>-->
    <th width="75"><input type="text" name="atmid" id="atmid" onkeypress="return runScript(event)" placeholder="Site/Sol/ATM I'd"/></th>
    <th width="75"><input type="text" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="End User"/></th>
    <th width="75"><input type="text" name="area" id="area" onkeypress="return runScript(event)" placeholder="Address"/></th>
    <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
    
    </tr>
    
    <br />
    
    <tr>
     
	<th width="75"><input type="text" name="complaintno" id="complaintno" onkeypress="return runScript(event)" placeholder="ComplaintNo"/></th>

     <th>
     <?php  
	 $engq="select * from area_engg where status='1'";
	 if($_SESSION['branch'] !='all')
	 $engq.=" and area  in(".$brmain.")";

	 $engq.=" order by engg_name ASC";
	 ?>
     <select name="eng" id="eng" onchange="searchById('Listing','1','');" style="width:150px"><option value="">-select Engineer-</option><?php 
	
	$eng=mysqli_query($con1,$engq);
	while($engg=mysqli_fetch_array($eng))
	{
	?>
    <option value="<?php echo $engg[0]; ?>"><?php echo $engg[1]; ?></option>
    <?php
	}
	
	 ?>
	 <option value="-1">Pending Delegation</option>
	 <option value="-3">Engr Reject & Pending Delegate</option>
	 <option value="-4">Attended Calls</option>
	 <option value="-2">No Updates </option>
	 </select></th>
     
     <th width="77" colspan=""><select name="assetstatus" id="assetstatus" onchange="searchById('Listing','1','');" style="width:100px">
     <option value="">-select-</option>
      <option value="amc">AMC Site</option>
      <option value="site">Warranty Sites</option>
      <option value="temp">Temp Call</option>
      
    </select></th>
    
    
    
     <th width="75"><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
     
     <th width="75"><input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
     <th width="77">
     	<?php 
		$selbr="select * from avo_branch where 1";
		if($_SESSION['branch']!='all')
		$selbr.=" and id IN (".$_SESSION['branch'].") ";
		
	 	$selbr.=" order by id ASC";
		//echo $selbr;
		$selbr2=mysqli_query($con1,$selbr)
		?>
        <select name="branch_avo" id="branch_avo" >
        
		<?php if($_SESSION['branch']=='all'){?>
        <option value="">Branch</option>
        <?php }?>
        
		<?php
        
        while($branch1=mysqli_fetch_array($selbr2))
        {
        ?>
        <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
        <?php
        }
        ?>
        </select>
</th>
  
 
  
  </tr>
  
</table>
</div>
<div id="search"></div>

</center>
</body>
</html>
<?php
 CloseCon($con1);
?>