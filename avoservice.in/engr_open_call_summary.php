<?php
include("access.php");
include('config.php');
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);

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
  function opennew(eid,ct)
  { //alert(eid);
 //  var fromdt=document.getElementById('fromdt').value;//alert(fromdt);
   var todt=document.getElementById('todt').value;//alert(todt);
   window.open("br_eng_det.php?eid="+eid+"&todt="+todt+"&ct="+ct, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=200, width=800, height=600");
  }
</script>
<script>
///////////////////////////////search 



function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);

var ppg='';
if(perpg=='')
ppg='25';
else
ppg=document.getElementById(perpg).value; //alert(ppg);
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
				  
			 if(a!="Loading"){
			
			 	
				var ddl_branch=document.getElementById('ddl_branch').value;
			
			
			  }
			
			var url = 'search_engr_open_calls.php'; 
	
		    var pmeters="";
		
			if(a!="Loading"){ 
  
      pmeters = 'Page='+b+'&perpg='+ppg+'&ddl_branch='+ddl_branch;
			//alert(pmeters);
			}
			else
			{
				// pmeters='calltype='+calltype+'&perpg='+ppg;
				 pmeters='perpg='+ppg;
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

<!--<body onLoad="searchById('Loading','1','')"> -->
<body>

<?php $br= $_SESSION['branch'];// if($_SESSION['branch']!='all') { $br=implode(",",$_SESSION['branch']); } else{ $br=$_SESSION['branch'];  } ?>
<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>



<h2 class="h2color">Engr Open Calls Summary</h2>

<div >
<button id="myButtonControlID" onClick="tableToExcel('callsummary', 'Branch Calls Summary')">Export</button>
	<br />
<table cellpadding="" cellspacing="0" >
  <tr>
  		
    
  <th width="75" colspan="2">
   		    
   	<select id="ddl_branch" name="ddl_branch" onchange="searchById('Listing','1','');">
   	
 <?  if ($_SESSION['branch'] =='all'){ ?>
   	
   	<option value="">All Branch</option>
   		 <?php }
   		 $sql="Select id,name from avo_branch where 1" ;
   	        if ($_SESSION['designation'] =='3')	       
   		
   		 $sql.=" and id = '".$br."'" ;     
   		       
   		       $table=mysqli_query($con1,$sql);
   		        while($fetch=mysqli_fetch_array($table)) {?>
   		            
   		            
   	<option value="<?php echo $fetch['id'];?>"><?php echo $fetch['name'];?></option>
   		    <?    }
   		       ?>
   		       
   		       
   		   </select> </th>
   		    	<th width="75" colspan="2">
   		    
   		
   <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
  
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>