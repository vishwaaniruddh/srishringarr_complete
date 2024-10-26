<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
 
include('config.php');
include('template_clinic.html');
$result = mysql_query("select * from patient");
?>
<style>

</style>
<style type="text/css">
	
	
</style>
<script type="text/javascript" src="autocomplete/jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString,id,suggest,suggestlist,ref) {
	//alert(inputString+" "+id+" "+suggest+" "+suggestlist+" "+ref);
	//var obj = { queryString:  ""+inputString+"", name: $("#txtname").val() };
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#'+suggest).hide();
		} else {
		//alert("hi");
			$.post("autocomplete/rpcmail.php", {
			
			queryString: ""+inputString+"",
			id: ""+id+"",
			suggest: ""+suggest+"",
			suggestlist: ""+suggestlist+"",
			ref: ""+ref+""
			}, function(data){
				if(data.length >0) {
					$('#'+suggest).show();
					$('#'+suggestlist).html(data);
				}
			});
		}
	} // lookup
	
	function fill(obj,suggest,id,ref) {
	document.getElementById(suggest).style.display='none';
	//alert(obj+" "+suggest+" "+id)
	//alert(document.getElementById().value);
	//alert("hi "+obj);
	document.getElementById('texting').value='';
var doc = obj.split("***");
	//alert(doc[0]);
		$('#'+id).val(doc[0]);
		$('#'+ref).val(doc[1]);
		setTimeout("$('#'"+suggest+").hide();", 200);
		//alert(doc[1]);
		//alert(ref);
		if(ref=='mailref1')
		{
		if(doc[1]=='')
		{
		alert("There is no email id for this doctor");
		}
		else
		{
		//alert(document.getElementById("email").value);
		if(document.getElementById("email").value=='')
		document.getElementById("email").value=document.getElementById("email").value+""+doc[1];
		else
		document.getElementById("email").value=document.getElementById("email").value+","+doc[1];
		
		}
		}
		
	}
</script>
<link href="paging.css" rel="stylesheet" type="text/css" />
<script>


///////////////////////////////search By Id
function searchById(Mode,Page) {
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
		 
 	
		     // var name=document.getElementById('name').value;//alert(id);
			  var searchdate=document.getElementById('searchdate').value;//alert(adate);
			   var searchdate2=document.getElementById('searchdate2').value;
			 // var cont=document.getElementById('cont').value;//alert(city);
			  // var hos=document.getElementById('hos').value;//alert(city);
			  // var ref=document.getElementById('ref').value;//alert(city);
			  
			  var url = 'searchopdcollection.php';
			
			var pmeters = 'mode='+Mode+'&Page='+Page+'&searchdate='+searchdate+'&searchdate2='+searchdate2;

			HttPRequest.open('POST',url,true);
 
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 

			HttPRequest.onreadystatechange = function()
			{
 
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
// alert(response);
				   document.getElementById("search").innerHTML = response;
			  }
		}
  }


function filldate(dt)
{
document.getElementById("searchdate").value=dt;
}


</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript">

                 $(document).ready(function() {

                        $('#cou_btn').click(function(e) {
                          e.preventDefault();

                          w=window.open();
                          var temp=$('#search').html();
                          w.document.write(temp);
                          if (navigator.appName == 'Microsoft Internet Explorer') window.print();
        else w.print();
                          w.close();
                         return false;
                        });
                       });  


            </script>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<body onLoad="searchById('Listing','1')">
<div class="M_page">
<fieldset class="textbox">

<legend><h1>OPD COLLECTION</h1></legend>
<input type="button" id="cou_btn" value="Print" style="width:100px;"/>
   <table >
   <tr>
   <th><input type="text"  name="searchdate" id="searchdate" onBlur="searchById('Listing','1');"  placeholder="From Date" onClick="displayDatePicker('searchdate');" value="<?php  if(isset($_GET['searchdate'])){ echo $_GET['searchdate']; } else { echo date('d/m/Y',strtotime('-1 month')); } ?>"/></td>
   <td><input type="text"  name="searchdate2" id="searchdate2" onBlur="searchById('Listing','1');"  placeholder="To Date" onClick="displayDatePicker('searchdate2');" value="<?php  if(isset($_GET['searchdate2'])){ echo $_GET['searchdate2']; }else { echo date('d/m/Y'); } ?>"/></td>
   <th><input type="hidden"  name="name" id="name"  onkeyup="searchById('Listing','1');" placeholder="Name"/></th>
   <th><input type="hidden"  name="cont" id="cont"  onkeyup="searchById('Listing','1');" placeholder="Contact"/></th>
   <th><input type="hidden"  name="ref" id="ref"  onkeyup="searchById('Listing','1');" placeholder="Reference"/></th>
   <th><input type="hidden" name="hos" id="hos"  onkeyup="searchById('Listing','1');" placeholder="Hospital"/></th>
   </tr>
   </table>

        <div id="search"></div>


   <!-- <button class="submit formbutton" type="button" onClick="var name=document.getElementById('name').value;
          var searchdate=document.getElementById('searchdate').value; var cont=document.getElementById('cont').value;
          window.open('app_print.php?name='+name+'&searchdate='+searchdate+'&cont='+cont, '_BLANK')">Print</button>-->
<div id="report"></div>
</fieldset>
</div>
</body>
