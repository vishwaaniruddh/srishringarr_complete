<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");
 
include('config.php');

?>
<link href="style1.css" rel="stylesheet" type="text/css" />
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<link href="view_master.css" rel="stylesheet" type="text/css" />


<style>
ul li{display:inline;}
li{display:inline;}

</style>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="paging.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function confirm_deletecity(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_city.php?id="+id;
  }
}


//////////////search city
function loadXMLDoc()
{
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
    {// alert(xmlhttp.responseText);
    document.getElementById("sub_cat").innerHTML=xmlhttp.responseText;
    }

  }
  var cat=document.getElementById('diagnosis').value;
xmlhttp.open("POST","sub_cat.php?cat="+cat,true);

xmlhttp.send();
}



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
			  var city=document.getElementById('city').value;//alert(id);
			
			 
			var url = 'searchcity.php';
		//  }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&city='+city;

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

</script>

<body onLoad="searchById('Listing','1')">


	<div id="site_title_bar">
    
   	 
        
            <?php include("header_clinic.php")?><!--end of site title-->
            



       <!--View Complaint-->
<?php 
include('config.php');
$result66 = mysql_query("select * from city where name<>'' order by name ASC");

?>


        


         
                <h2> City</h2>
                
      <table width="913" class="se"><tr><td width="563" height="154">                   
          
			 
               <input type="text"  name="city" id="city" placeholder="Search City" onKeyUp="searchById('Listing','1');"/>
		
          <div id="search"></div>
        </td>

			





<td width="338">
<form method="post" class="signin" action="new_city.php"  >
                <fieldset class="textbox">
                <p>Add New City</p>
                
            	<label class="name">
                <span>City Name :</span>
                <textarea id="cityname" name="cityname" rows="3" cols="35" style="resize:none;border:1px #ac0404 solid;"></textarea>
                </label>
                
                <button class="submit formbutton" type="submit">Add New</button>
                <button type="reset" class="submit formbutton">Reset</button>
                       
                </fieldset>
          </form>
</td></tr>


    
     <tr>
     <td>
     <a href="masters.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'masters.php';">Go Back</button></a>
    
     <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Home</button></a>
     </td>
     </tr>
     </table>
</div> 
	<!-- end of site_title_bar  -->
    

</body>

