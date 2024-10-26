<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
$brmain=$_SESSION['branch'];

$srno=mysqli_query($con1,"select `srno` from login where `username`='".$_SESSION['user']."'");
$srno1=mysqli_fetch_row($srno);
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
function Approve(id,user) {
   // alert(id);
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // alert(HttPRequest.responseText);
                 if(confirm("Are you sure you want to Approved") == true){
                 document.getElementById('approve'+id).innerHTML = "Approved";
                 
                alert('Approved sucessfully');
                }
             }
         }
        
         xmlhttp.open("GET", "approve.php?id="+id+"&user="+user, true);
         xmlhttp.send();
     
}
function Reject(id) {
   // alert(id);
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 alert(HttPRequest.responseText);
                 document.getElementById('reject'+id).innerHTML = "Rejected";
                 
                alert('Your site is Rejected ');
             }
         }
         xmlhttp.open("GET", "reject.php?id="+id, true);
         xmlhttp.send();
     
}
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
		  var bravo=document.getElementById('bravo').value; //alert(bravo);
		  
		  //var calltype=document.getElementById('calltype').value;
		  //var openall=document.getElementById('openall').value;
		  var branch_avo=document.getElementById('branch_avo').value; //alert(branch_avo);
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
				 //alert("hi");
			 	//var id=document.getElementById('atmid').value; alert(id);
			 	//var bravo=document.getElementById('bravo').value;
			 	var fromdt=document.getElementById('fromdt').value;
			 	var todt=document.getElementById('todt').value;		 	
			 	var eng=document.getElementById('eng').value; //alert(eng); 
			 	var type=document.getElementById('type').value;
				var cid=document.getElementById('cid').value; //alert(eng);		  	
			  	var branch_avo=document.getElementById('branch_avo').value;  //alert(branch_avo);
				
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'gen_salesreport.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters='&bravo='+bravo+'&Page='+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&eng='+eng+'&branch_avo='+branch_avo+'&type='+type+'&cid='+cid;
			 //alert(pmeters);
			}
			else
			{
				 pmeters = 'bravo='+bravo+"&Page="+b+'&perpg='+ppg+'&branch_avo='+branch_avo+'&type=sales';
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


function newwin(url,winname,w,h)
{
//alert("hi");
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  //mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
  
  /////////////////////
  
  
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

<body>

<?php $branchavo= $_SESSION['branch']; ?>
<input type="hidden" value="<?php  echo $branchavo;?>" name="bravo" id="bravo"/>
<center>
<?php include("menubar.php");  ?>





<h2 class="h2color">Completed Sales Orders Summary Report</h2>

<div >
 <!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>-->
	<br />
<form action="gen_completedso.php" method="POST" target="_new">
<table cellpadding="" cellspacing="0" >

  <!--<tr>
  
    
    <th style="display:none">
     <?php  
	 $engq="select * from area_engg where status='1'";
	 if($_SESSION['branch']!='all')
	 $engq.=" and area in (".$brmain.")";
	 //echo $engq;
	 $engq.=" order by engg_name ASC";
	 ?>
     <select name="eng" id="eng"  style="width:150px"><option value="">-select Engineer-</option><?php 
	
	$eng=mysqli_query($con1,$engq);
	while($engg=mysqli_fetch_array($eng))
	{
	?>
    <option value="<?php echo $engg[8]; ?>"><?php echo $engg[1]; ?></option>
    <?php
	}
	
	 ?>
	 
	 </select></th>
    

    

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
        <select name="branch_avo" id="branch_avo" >       
				<?php if($_SESSION['branch']=='all' and $_SESSION['designation']!='3' ){ ?>
                <option value="">Branch</option>
                <?php } while($branch1=mysqli_fetch_array($selbr2)){ ?>
                <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
                <?php } ?>
        </select>
</th>

 <th><select name="cid" id="cid"  ><option value="">Select Client</option><?php
		$cl=mysqli_query($con1,"select cust_id,cust_name from customer order by cust_name ASC");
			while($clro=mysqli_fetch_row($cl))
			{
			?>
			<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
			<?php
			}
		?></select></th>
    <th width="75" ><select name="type" id="type" ><option value="sales">Sales</option><option value="amc">Amc</option></select></th>
    
    </tr>-->
    
    <br />
    
    <tr>
    
 		<th width="75"><select name="type" id="type" ><option value="cwise">Clientwise</option><option value="bwise">Branchwise</option></select></th>
     <th width="75"><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date" value="<?php echo date(d/m/Y); ?>" /></th>
     <th width="75"><input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date" value="<?php echo date(d/m/Y); ?>" /></th>
     
    <th width="75" ><input type="submit"  value="Export" /></th> 
  
 
  
  </tr>
  
</table>
</form>
</div>
<div id="search"></div>


</center>
</body>
</html>