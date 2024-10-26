<?php
session_start();
include("access.php");
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Expenses Summary <?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="jquery-1.8.3.js"></script>
<script type="text/javascript" src="javascript.js"></script>
        
 
 
        <script>
        
            function a(strPage,perpg){
            
             
              var Branch=document.getElementById("Branch").value;
              var Employee_name=document.getElementById("Employee_name").value;
              var from=document.getElementById("from").value;  //alert(from);
              var to=document.getElementById("to").value; 
              var status=document.getElementById("status").value; //alert(status);
 
var Page="";
if(strPage!="")
{
Page=strPage;
}

var perp='';
if(perpg=='')
perp='25';
else
perp=document.getElementById(perpg).value;

         document.getElementById("show").innerHTML ="<center><img src=loader.gif></center>";

             $.ajax({
               
            type:'POST',    
 
 
   url:'search_app_othexp.php',
//url:'testing.php',
  data:'Branch='+Branch+'&Employee_name='+Employee_name+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp+'&status='+status,

   success: function(msg){
     //var jsr = JSON.parse(msg);
    
  //alert(msg);
   document.getElementById("show").innerHTML=msg;
   
  
   
} })
            }
            
            
function setSubmit(id)
{

//alert("hi");
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // alert(xmlhttp.responseText);
                 document.getElementById('subdiv'+id).innerHTML = "";
                 document.getElementById('subdiv'+id).innerHTML = xmlhttp.responseText;
                 
                //alert('You have no update ');
             }
         }
         //sub=document.getElementById('sub'+id).value;
         reason=document.getElementById('reason'+id).value;
         remarks=document.getElementById('remarks'+id).value;
         amount=document.getElementById('amount'+id).value;
         
         if(reason.length==0)
         alert("Please select a Verify type");
         if(amount.length==0)
         alert("Please input Verified amount");
         
         else{
       //xmlhttp.open("GET", "tempcall_status.php?id="+id+"&sub="+sub, true);
        
         xmlhttp.open("GET", "process_verify_exp.php?id="+id+"&reason="+reason+"&remarks="+remarks+"&amount="+amount, true);
      
      
         xmlhttp.send();
         }
}
             
 
 function pick_engg(val){
//alert(val);
brid=val;
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
    {
    var s=xmlhttp.responseText;
  	//alert(s);
	 document.getElementById('mystate').innerHTML = s;	
    }
  }
   
   //	alert("get_engg_br.php?brid="+brid);    
	xmlhttp.open("GET","get_engg_br.php?brid="+brid,true);
	xmlhttp.send();
}           



        </script>
        </head>



<body onLoad="searchById('Loading','1','')">
<?php include("menubar.php");?>
		      
		 <h2 class="h2color" align="center" st>Other Expenses- Approved by Br.</h2>
<div>
	
		<table border="0"  style="border: 1px solid #fff;" align="center"  >       
			<tr >
                            

                                  
				<th> Branch:</th>
				<th>Engineer Name:</th>
				<th>from date:</th>
                <th>To date:</th>
                 <th>Verification</th>
                  <th>Search</th>
 				</tr>


<?php 
if($_SESSION['branch']=='all'){
$selbr= mysqli_query($con1,"select distinct(branch_id) from other_approved_expenses where branch_id <>'' order by branch_id ASC"); 

} else {

$selbr= mysqli_query($con1,"select distinct(branch_id) from other_approved_expenses where branch_id IN (".$_SESSION['branch'].") order by branch_id ASC");
}
?> 

<tr>
<td width="77" colspan="">
    
    <select name="Branch" id="Branch" onchange="pick_engg(this.value);">
      	
     <option value= "">Select</option>

        <?php while ($result=mysqli_fetch_array($selbr)) {
	    $branch=mysqli_query($con1,"select id, name from avo_branch where id='".$result[0]."'");
	    $brname=mysqli_fetch_row($branch);
               ?>
	<option value="<?php echo $brname[0]; ?>"><?php echo $brname[1]; ?></option>
      
      <? }      ?>
</select>
</td>

<td>
<div id="mystate">
    
 <select name="Employee_name" id="Employee_name" >
    
    <option value="">Select</option>

  <option value="<?php echo $name[0]; ?>"><?php echo $name[1]; ?></option>
 
</div>
</td>


<td><input type="date" name="from" id="from"></td>
<td><input type="date" name="to" id="to"></td>

<td><input type="hidden" name="status" id="status" value =""></td>

<!--<td><select name="status" id="status">
<option value = "1">Pending</option>
<option value = "">All </option>
<option value = "2">Verified</option>
<option value = "0">Rejected</option>
</select>    
</td>  -->                             

<td><input type="button" style="color:red" name="submit" onclick="a('','')" value="search"></button></td>
				

</tr>
</table>

 </div>
            <div id="show"></div>
</body>
</html>
