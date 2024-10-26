<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");

 include('config.php');
 include('template_clinic.html');
?>

<link href="paging.css" rel="stylesheet" type="text/css"/>

<script>
//////////////subcat
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
			  //var id=document.getElementById('idd').value;//alert(id);
			  var s=document.getElementById('fname22').value;//alert(s);
			  var city=document.getElementById('city').value;//alert(city);
			  var contact=document.getElementById('contact').value;//alert(contact);
			  var category=document.getElementById('category').value;//alert(category);
			var url = 'get_docID.php';
		//  }
 	
		
			//alert(url);
			var pmeters = 'mode='+Mode+'&Page='+Page+'&fname='+s+'&city='+city+'&con='+contact+'&cat='+category;;

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
///////////////////delete doctor


function Ddelete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		
		document.location="delete_doc.php?id="+id;
	}
}


</script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

 <html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>

<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="M_page">
<fieldset class="textbox">
 <legend><h1><img src="ddmenu/Doctor-icon1.png" height="50" width="50" />Doctor's Records</h1></legend>
   
   <div id="search">
		<?php
//include('config.php');
############# must create your db base connection
 

$query =mysql_query("select * from doctor where doc_id='".$_GET['id']."'");

?>

 <table class="results">
 
       
<thead>      

<tr>
         
          <th >Name</th>
          <th >City</th>
          <th>Contact</th>
          <th>category</th>
		  <th>Specialist</th>
          <th >Edit</th>
          <th >Delete</th>
</tr>
</thead>
<?php
while($row= mysql_fetch_row($query))
{
	 
?>

<tbody>
<tr>
    
	<td ><?php echo  $row[1]; ?></td>
    <td><?php echo  $row[3]; ?></td>
    <td ><?php echo  $row[6]; ?></td>
    <td ><?php echo  $row[8]; ?></td>
	<td ><?php echo  $row[9]; ?></td>
    <td ><a href='edit_doc.php?id=<?php echo  $row[0]; ?>'> Edit </a></td>
    <td><a href='javascript:Ddelete(<?php echo  $row[0]; ?>)'> Delete </a></td>
    </tr>
</tbody>

<?php
		}
 
 
 ################ home end

 ?>
</table> 

</div>


   <!-- <button class="submit formbutton" type="button" onClick="var n=document.getElementById('fname22').value;window.open('doc_print.php?name='+n, '_BLANK')">Print</button>-->

</fieldset>
</div>
</body>
</html>
