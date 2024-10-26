<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sri-Shringarr</title>
<link rel="stylesheet" href="adstyle.css" type="text/css" />
</head>
<script type="text/javascript">
<!--
function confirm_delete(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="deleteGcat.php?id="+id;
  }
}
//-->
</script>

<script>
function searchById(Mode,page1) {
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
		
 	
		      var lodimgsearch=document.getElementById('lodimgsearch').value;
			 // alert(lodimgsearch);
			  
			  
			  var url = 'get_lodimg.php';
			
            var pmeters = 'lodimgsearch='+lodimgsearch+'&page='+page1;
//            alert(pmeters);
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
    //alert("hi");
    //alert(response);
				   document.getElementById("imgsearch").innerHTML  = response;
			  }
		}
  }	
  function openchild(id,url,winname,style){
 childWin = window.open(url,winname, style);
}


/////////////////////////////////////////////////////////////////

function createFolder(Mode) {
 //alert("hi");
 if(document.getElementById('catfolder').value!='')
{ // alert("Please enter your folder name");
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
		
 	
		      var createfolder=document.getElementById('catfolder').value;
			 alert(createfolder);
			  
			  
			  var url = 'process_create_folder.php';
			
            var pmeters = 'createfolder='+createfolder;
//            alert(pmeters);
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
    //alert("hi");
    alert(response);
	document.getElementById("shodir").innerHTML  = response;
			  }
		}

    }
  }
  
  ////////////////////////////////////////////////
  
  
  function create_subFolder(mode1)
{
	 //alert("hi");
 if(document.getElementById('subfolder').value!='')
{ // alert("Please enter your folder name");
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
		
 	
		      var subfolder=document.getElementById('subfolder').value;
			 alert(subfolder);
			  var mainfolder=document.getElementById('lodimg').value;
			  alert(mainfolder);
			  
			  var url = 'process_subfolder.php';
			
            var pmeters = 'subfolder='+subfolder +'&mainfolder='+mainfolder;
//            alert(pmeters);
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
    //alert("hi");
    alert(response);
	document.getElementById("shodir").innerHTML  = response;
			  }
		}

    }
	
	
	
	}


  ////////////////
  
  	
  function openchild(id,url,winname,style){
 childWin = window.open(url,winname, style);
}
</script>

<script>
function validation(form)
{
with(form)
{
	if(lodimg.value=="")
{
	alert("select your categery ");
	lodimg.focus();
	return false;
}


if(image.value=="")
{
	alert("select your Image ");
	image.focus();
	return false;
}
 
if(desc.value=="")
{
	alert("Enter your description");
	desc.focus();
	return false;
}

return true;
}
}


</script>


<style>
/*#imgsearch{height:300px; width:400px; border:1px solid #F00;}*/
.imgList 
{
max-height:150px;
max-width:200px;
margin-left:5px;
margin-top:2px;
border:1px solid #FF0000;
padding:4px;	
float:left;	
}

#imgsearch{background-color:#FF6;}
</style>

<link rel="stylesheet" href="style.css" type="text/css" />
<body>

<div id="main">
<div id="uploadimg">
  
   <table width="100%" border="1" cellspacing="0" cellpadding="0" >
   <tr><td colspan="7" style="text-align:center;"><a href="../../../index.php/reports">Back</a></td></tr>
   <tr><td colspan="7" align="center" style="color:#F00;"> 
   <div id="shodir"></div>
   <?php if(isset($_GET['success'])){echo $_GET['success'];}else if(isset($_GET['extension'])){echo $_GET['extension'];}?> </td></tr>
   <tr> <td>Create Main Cat</td>
   
   <form id="form3" name="form3" method="post"  action="" enctype="multipart/form-data" >
   <td><input type="text" name="catfolder" id="catfolder" /></td>
   <td><input type="button" name="cfolder" id="cfolder" value="Submit" onclick="createFolder('Listing');"  /> </td>  
   </form>
   
   
   <td width="192" colspan="4" align="center"><h3 style="color:#0000FF;">Upload Your Image Type Here</h3></td></tr><tr>
   
   <tr><td>Select Main Cat</td> 
    <form id="form4" name="form4" method="post"  action="" enctype="multipart/form-data">
   <td>
  
   <select id="lodimg" name="lodimg">
    <option></option>
    <option>Select</option>
  
  <?php $sql= mysql_query("select * from `catfolder` where 1");
    
	
	$count=0;
while($namefolder =mysql_fetch_row($sql))
{
	$count++;?>
	
	<option value="<?php echo $namefolder[1]; ?>"> <?php echo $namefolder[1]; ?> </option>
    
  <?php
   }
  ?>
  </select>
  </td> 
  
   <td>Add Sub Cat</td>
   
    <td><input type="text" name="subfolder" id="subfolder" /></td>
    <td><input type="button" name="sfolder" id="sfolder" value="Submit" onclick="create_subFolder('Listing');"  /> </td>
    </form>
    </tr>
  
  <form id="form1" name="form1" method="post"  action="process_img_load.php" enctype="multipart/form-data" onsubmit="return validation(this)" >             					
   <tr>
  
   <td>Select Your Folder </td>
  
  <td>
   <select id="lodimg" name="lodimg">
    <option></option>
    <option>Select</option>
  
  <?php $sql= mysql_query("select * from `subfolder` where 1");
    
	
	$count=0;
while($namefolder =mysql_fetch_row($sql))
{
	$count++;?>
	
	<option value="<?php echo $namefolder[1]; ?>"> <?php echo $namefolder[1]; ?> </option>
    
  <?php
   }
  ?>
  </select> 
  </td>
  
 
  

  <td width="192" height="35" > Select Image </td>
      <td width="218">
       
      <input type="file" name="image" id="image" />
      </td>

  <td height="38" >Image Description :</td>
      <td>
        <textarea name="desc" id="desc" cols="20" rows="4" style="resize:none;"></textarea></td>

  <td height="" colspan="2" align="center"><input type="submit" name="Submit" id="Submit" value="Submit" class="sub"/></td>
    </tr>
   
 </form> 
 
</table>

 </div>
 
 <br />
 <div id="searching">
  <form id="form1" name="form1" method="post"  action="process_img_load.php" enctype="multipart/form-data">             					
   <table width="100%" border="1" cellspacing="0" cellpadding="0" >
   
   <tr> 
   <td  colspan="2" align="center"><h3 style="color:#0000FF;">Search Your Image Type Here</h3></td></tr><tr>
  
   <tr>  
  <td>
  Category Of Images:
  <select id="lodimgsearch" name="lodimgsearch" onchange="searchById('Listing','1');">
  <option>select</option>
  <?php $sql= mysql_query("select * from `subfolder` where 1");
    
	
	$count=0;
while($namefolder =mysql_fetch_row($sql))
{
	$count++;?>
	
	<option value="<?php echo $namefolder[1]; ?>"> <?php echo $namefolder[1]; ?> </option>
    
  <?php
   }
  ?>
  
  </select> 
  </td>
  </tr>
   
      <tr>
      
      <td colspan="4">
     
    
     <div id="imgsearch"> </div>

  
    
      </td>
      
      </tr>

</table>
 </form> 
 </div>
 
</div>
</body>
</html>
