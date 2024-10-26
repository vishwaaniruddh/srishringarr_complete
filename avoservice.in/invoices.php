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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>

.modal1{
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content1 {
  
    margin: auto;
height: 30%;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
left: 0;
    top: 0;
 background-color: #4D9494; 
}


</style>
<script>
var modal=null;
$( document ).ready(function() {
   
modal=document.getElementById("myModal1");


document.getElementById("clsb").onclick = function() {

    modal.style.display = "none";
}

});
//=============================confirm generate call ===========================================
function confirm_generate(cust,atmid,trackid,callid)
{
//alert("hi");
//alert("cust="+cust+"atmid="+atmid+"trackid="+trackid+"cname="+cname);
if(confirm("Ensure Material is delivered at site."),confirm("Ensure Site is ready for Installation."))
  {
    document.location="AccountManager/newalert1.php?cust="+cust+"&atmid="+atmid+"&trackid="+trackid+"&callid="+callid+'&frmpg=1';
  }
  
}


//============

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

function setDelivery(id)
{
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 alert(xmlhttp.responseText);
                 document.getElementById('deldiv'+id).innerHTML = "";
                 document.getElementById('deldiv'+id).innerHTML = xmlhttp.responseText;
                 
               // alert('Your site is Rejected ');
             }
         }
         del=document.getElementById('del'+id).value;
         //alert(del);
         if(del.length==0)
         alert("Please select a date");
         else{
         xmlhttp.open("GET", "setDelivery.php?id="+id+"&del="+del, true);
         xmlhttp.send();     
         }
}

function setSubmit(id)
{
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 alert(xmlhttp.responseText);
                 document.getElementById('subdiv'+id).innerHTML = "";
                 document.getElementById('subdiv'+id).innerHTML = xmlhttp.responseText;
                 
             //   alert('Your site is Rejected ');
             }
         }
         sub=document.getElementById('sub'+id).value;
         if(sub.length==0)
         alert("Please select a date");
         else{
         xmlhttp.open("GET", "setSubmit.php?id="+id+"&sub="+sub, true);
         xmlhttp.send();
         }
}
</script>







<script>


function cancelinstallationcallfunc(id)
{

try
{

var r = confirm("Are you sure to continue");
    if (r) {
$.ajax({
            type: "POST",
            url:"process_cancelinstallationcall.php",
            data: "id="+id,
            success: function (data)
            {
//alert(data);
if(data=="1")
{


searchById('Listing','1','');

}else
{
alert("Error");
}

            }
        });
}
}catch(ex)
{
alert(ex);
}
}



function processsofunc(id,stats)
{

modal.style.display = "block";

var sbtn=document.getElementById("subch");
document.getElementById("chreason").value="";
document.getElementById("soid").value=id;
document.getElementById("sosts").value=stats;

}

function processsofuncf()
{

try
{
var id=document.getElementById("soid").value;
var stats=document.getElementById("sosts").value;

var reas=document.getElementById("chreason").value;
if(reas=="")
{
alert("Reason is Mandatory");

}else
{
modal.style.display = "none";



var sstr="";

if(stats=="c")

{
sstr="Cancel";
}


if(stats=="h")

{
sstr="Hold";
}

if(stats=="")

{
sstr="Unhold";
}

var r = confirm("Are you sure to continue");
    if (r) {

$.ajax({
            type: "POST",
            url:"so_cancel_hold_process.php",
            data: "sts="+stats+ "&id=" +id+"&reas="+reas,
            success: function (data)
            {
//alert(data);

if(data=="1")
{
alert("SO "+sstr+" successful");
//$("#subch").prop("onclick", null).attr("onclick", null);
//document.getElementById("subch").onclick = null;

searchById('Listing','1','');

}else
{
alert("Error");
}
sstr=="";

            }
        });
}
}
}catch(ex)
{
alert(ex);
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
		//  var bravo=document.getElementById('bravo').value; //alert(bravo);
		  
		  //var calltype=document.getElementById('calltype').value;
		  //var openall=document.getElementById('openall').value;
		//  var branch_avo=document.getElementById('branch_avo').value; //alert(branch_avo);
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
			 var pmeters="";
			 if(a!="Loading"){
				// alert("hi");
			 	//var id=document.getElementById('atmid').value; alert(id);
			 	//var bravo=document.getElementById('bravo').value;
			 	var fromdt=document.getElementById('fromdt').value;
			 	var todt=document.getElementById('todt').value;		 	
			 	//var eng=document.getElementById('eng').value; //alert(eng); 
				var cid=document.getElementById('cid').value; //alert(eng);		  	
			  	var branch_avo=document.getElementById('branch_avo').value;  //alert(branch_avo);
			  	var invno=document.getElementById('invno').value;
			  	var crnno=document.getElementById('crnno').value;
			  	var del_date=document.getElementById('del_date').value;
			  	var sub_date=document.getElementById('sub_date').value;
				var atmid=document.getElementById('atmid').value;
var invtyp=document.getElementById('invtyp').value;
var sostats=document.getElementById('sostats').value;


var address=document.getElementById('address').value; pmeters="&Page="+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&cid='+cid+'&branch_avo='+branch_avo+'&invno='+invno+'&crnno='+crnno+'&del_date='+del_date+'&sub_date='+sub_date+'&atmid='+atmid+'&address='+address+'&invtyp='+invtyp+'&sostats='+sostats;
			      //   alert(pmeters);
			  }
			  else
			  {
			   pmeters = "&Page="+b+'&perpg='+ppg;
			  // alert(pmeters);
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'search_invoices.php'; 
		//  }
 	//alert(br);
		    
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

<!--<body onLoad="searchById('Loading','1','')">-->
<body>

<?php $branchavo= $_SESSION['branch']; ?>
<input type="hidden" value="<?php  echo $branchavo;?>" name="bravo" id="bravo"/>
<center>
<?php include("menubar.php");  ?>





<h2 class="h2color">Sales Orders</h2>

<div >
 
	<br />
<table cellpadding="" cellspacing="0" >

  <tr>
  
    <th width="75"><input type="text" name="invno" id="invno" placeholder="Invoice Number"/></th>
    <th width="75"><input type="text" name="crnno" id="crnno" placeholder="Credit Note Number"/></th>
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

 <th><select name="cid" id="cid" onchange="searchById('Listing','1','');" ><option value="">Select Client</option><?php
		$cl=mysqli_query($con1,"select cust_id,cust_name from customer order by cust_name ASC");
			while($clro=mysqli_fetch_row($cl))
			{
			?>
			<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
			<?php
			}
		?></select></th>
    
 		<th width="75"><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
     
     <th width="75"><input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
     <th width="75" ><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
  
 
  
  </tr>
  <tr>
  
    <th width="75"><input type="text" name="atmid" id="atmid" placeholder="Site/Sol/ATM ID"/></th>
    
    <th width="77">
     	<select name="del_date" id="del_date" >       				
                <option value="0">Delivery Date</option>                
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
        </select>
</th>
<th width="77">
     	<select name="sub_date" id="sub_date" >       				
                <option value="0">Invoice Sub Date</option>                
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
        </select>
</th>
     
     <th width="75"><textarea id="address" name="address" placeholder="Address"></textarea></th>
     <th width="75"><select id="invtyp" name="invtyp">
<option value="">All</option>
<option value="1">No Attached Invoice</option>

</select></th>
     <th width="75" ><select id="sostats" name="sostats">
<option value="">Status</option>
<option value="c">Cancelled</option>
<option value="h">Hold</option>

</select></th>
  
 
  
  </tr>
</table>
</div>
<div id="search"></div>
<div id="myModal1" class="modal1">
        <div class="modal-content1">
<button type="button" style="float: right;" id="clsb">X</button>
  </br>
            <center>

<b>Reason</b><textarea style="height:140px;width:470px;resize:none;" id="chreason"></textarea></br>
      <button type="button" id="subch" name="subch" onclick="processsofuncf();"> Submit </button>        
            </center>
        </div>
    </div>

</center>
</body>
</html>