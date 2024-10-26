<?php session_start();
include("access.php");
include('config.php');

 if($_SESSION['designation']==5){
    include("AccountManager/menubar.php");
        } else{
          include("menubar.php");  
        } 


?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<script src="excel.js" type="text/javascript"></script>
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
		 var cid=document.getElementById('cid').value;//alert(cid);
			 if(a!="Loading"){
				
			 	var cid=document.getElementById('cid').value;//alert(cid);
			 	var fromdt=document.getElementById('fromdt').value;//alert(fromdt);
			 	var todt=document.getElementById('todt').value;//alert(todt);
				
				
				var branch=document.getElementById('branch').value;//alert(branch);
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'search_so_status.php';
		
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
   pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&branch='+branch;
			//alert(pmeters);
			}
			else
			{
				 pmeters='Page='+b+'&perpg='+ppg+'cid='+cid;
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


function newwin(url,winname)
{

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=600,left=420,top=130");
  
 }
</script>


<style>


div#lyrics{
    width:300px;
    height:100px;
    background-color:#003300;
    position:absolute;
    left:700px;
    padding:10px;
	color:#FFF;
    
}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript">
 
$(document).ready(function(){
    $("div#lyrics").hide();
    
    $("#songlist tr").mouseover(function(){
        $(this).css("background-color","#ccc");
        $("#lyrics",this).show();
    }).mouseout(function(){
        $(this).css("background-color","#eee");
        $("#lyrics",this).hide();
    });
    
});
</script>
</head>

<body onLoad="searchById('Loading','1','')"> 


<center>

<h2 class="h2color">Track Your Sales Order</h2>

<div >
<!-- <button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export</button> -->

<table cellpadding="" cellspacing="0" >
  <tr>
  		
    	<th width="77" colspan="">
    		
    
        </th>
    
   <? include("../config.php");
   
      	$client="select cust_id,cust_name from customer where 1";
    
    
    if($_SESSION['designation']==5){
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysqli_query($con1,"select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
        }
    $client.=" order by cust_name ASC"; 
    
    ?>
   <th>
    <select name="cid" id="cid" onchange="searchById('Listing','1','');"> <?php if($_SESSION['designation']!=5){ ?><option value="">Select Client</option><?php }
$cl=mysqli_query($con1,$client);
while($clro=mysqli_fetch_row($cl))
{ ?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php  } ?></select></th>
   
    	
    
        
       	<!--Branch Name-->
    	<th>
        	<select name="branch" id="branch"  ><option value="">Branch</option>
					<?php
                    $st=mysqli_query($con1,"SELECT * FROM `avo_branch` ORDER BY `name` ASC");
                    while($stro=mysqli_fetch_array($st))
                    {
                    ?>
                    <option value="<?php echo $stro[0]; ?>"><?php echo $stro[1]; ?></option>
                    <?php
                    }
                    ?>
                    </select>
       	</th>
     	
        <!--Call Type-->
    	
        
        <!--From Date-->
     	<th width="75" colspan="2">
     <input type="text" name="fromdt" id="fromdt" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
     
     	<!--To Date-->
   		<th width="75" colspan="2">
   		<input type="text" name="todt" id="todt" readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
   <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
   
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>