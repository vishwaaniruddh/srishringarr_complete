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
//alert(br);
		  var calltype=document.getElementById('calltype').value;
		// alert(calltype);
			
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			  var state=document.getElementById('state').value; //alert(state);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var eng=document.getElementById('eng').value;
			 var fromdt=document.getElementById('fromdt').value;
			 var area=document.getElementById('area').value;//alert(area);
			 var todt=document.getElementById('todt').value;
			  }
			  
			var url = 'searchpmeng.php'; 
		
		    var pmeters="";
			
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&area='+area+'&bank='+bank+'&br='+br+'&Page='+b+"&calltype="+calltype+'&perpg='+ppg+'&eng='+eng+'&fromdt='+fromdt+'&todt='+todt+'&state='+state;
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

<body  onload="searchById('Listing','1','');">
<center>

<?php include("menubar.php"); ?>
<h2>Engineer Alerts</h2>
<?php //if($_SESSION['designation']=='1' || $_SESSION['designation']=='2' ){ ?>
<table cellpadding="" cellspacing="0" width="100%" >
<?php $br= $_SESSION['branch'];// if($_SESSION['branch']!='all') { $br=implode(",",$_SESSION['branch']); } else{ $br=$_SESSION['branch'];  } ?>
<input type="hidden" value="<?php  echo $br;?>" name="br" id="br"/>
     <tr> 
     <th  ><select name="calltype" id="calltype" onchange="searchById('Listing','1','');">
      <option value="Delegated">Open call</option>
      <option value="Done">Closed call</option>
      
      <option value="">All Calls</option>
    </select></th>
    <th> <!--1-->
    <?php
    include("config.php");
    $sq="select * from area_engg where status='1'";
    if($_SESSION['designation']=='4')
    $sq.=" and loginid=(select srno from login where username='".$_SESSION['user']."')";
    
    $sq.=" order by engg_name ASC";
    $eng=mysqli_query($con1,$sq);
    if(!$eng)
    echo mysqli_error();
    ?>
    <select name="eng" id="eng" onchange="searchById('Listing','1','');" style="width:150px"><?php if($_SESSION['designation']!='4'){ ?><option value="">-select Engineer-</option><?php }
  //  include("config.php");
	
	while($engg=mysqli_fetch_array($eng))
	{
	?>
    <option value="<?php echo $engg[0]; ?>"><?php echo $engg[1]; ?></option>
    <?php
	}
	 ?></select></th><!--2-->
    <th >
    <select name="state" id="state" onchange="searchById('Listing','1','');" ><?php if($_SESSION['designation']!='4'){ ?>
    <option value="">state</option>
          <?php }
          $sttt="select * from state order by state ASC";
          $br=$_SESSION['branch'];
if($br!='all'){
//$br1=str_replace(",","','",$br);
//$br1="'".$br1."'";

echo "select state from state where branch_id= '".$br."'";
$src=mysqli_query($con1,"select state from state where branch_id= '".$br."'");
			while($srcrow=mysqli_fetch_array($src)){

				$bran[]=$srcrow[0];
			?>
           <option value="<?php echo $srcrow[0]; ?>"><?php echo $srcrow[0]; ?></option>
            <?php
            }
           
		}

    ?>
 </select>
    
    
    
    </th><!--3-->
    <th><input type="text" name="atmid" id="atmid" onkeypress="return runScript(event)" placeholder="ATM"/></th><!--4-->
    </tr>
   
   
    <tr>
    <th ><input type="text" name="bank" id="bank" onkeypress="return runScript(event)" placeholder="Bank"/></th><!--5-->
    <th ><input type="text" name="area" id="area" onkeypress="return runScript(event)" placeholder="Address"/></th><!--6-->
    <th ><input type="text" name="fromdt" id="fromdt" onkeypress="return runScript(event)" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/> </th ><!--7-->
    <th > <input type="text" name="todt" id="todt" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/> </th ><!--8-->
    <th > <input type="button" onclick="searchById('Listing','1','');" value="Search" /></th><!--9-->
  
  </tr>
  
  <tr>
    
  </tr>
</table><?php //} ?>
<div id="search">

</div>
</center>
</body>
</html>