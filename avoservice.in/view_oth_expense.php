<?php
session_start();
include("access.php");
include("config.php");
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Other Expenses <?php echo $_SESSION['user']; ?></title>
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
   
   url:'search_oth_exp.php',

  data:'Branch='+Branch+'&Employee_name='+Employee_name+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp+'&status='+status,

   success: function(msg){
     //var jsr = JSON.parse(msg);
    
  //alert(msg);
   document.getElementById("show").innerHTML=msg;
   
  
   
} })
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
		      
		 <h2 class="h2color" align="center" st>View Other Expense Claims</h2>
<div>
   

<table border="0"  style="border: 1px solid #fff;" align="center"  >       
			<tr >
                            

                                  
				<th> Branch:</th>
				<th>Engineer Name:</th>
				<th>from date:</th>
                <th>To date:</th>
                 <th>Approval Status</th>
                  <th>Search</th>
 				</tr>

<?
include("config.php");
if($_SESSION['designation']=='4') {
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");

$qry2ro=mysqli_fetch_row($qry2);

$sql.= "select engg_id, engg_name from area_engg where loginid='".$qry2ro[0]."' and status='1' ";

//echo "select engg_id, engg_name from area_engg where loginid='".$qry2ro[0]."' and status='1' ";
$result = mysqli_query($con1,$sql);
$engr=mysqli_fetch_row($result);


    
$selbr= "select distinct(branch_id) from engg_oth_expenses where engg_id='".$engr[0]."'";}
	    
	  else if($_SESSION['branch']!='all'){
	$selbr= "select distinct(branch_id) from engg_oth_expenses where branch_id IN (".$_SESSION['branch'].") order by id ASC ";
	  } else 
	  
	  $selbr= "select distinct(branch_id) from engg_oth_expenses order by id ASC ";
	  
//	echo $selbr  ;
		$selbr2=mysqli_query($con1,$selbr);


?>

<tr>
<td width="77" colspan="">
 
         
         <select name="Branch" id="Branch" onchange="pick_engg(this.value);">
      	
      	<option value= "">Select</option>
<?php 
		while ($result=mysqli_fetch_array($selbr2)) {
	    $branch=mysqli_query($con1,"select id, name from avo_branch where id='".$result[0]."'");
	    
	 	    $brname=mysqli_fetch_row($branch);
               ?>
	   <option value="<?php echo $brname[0]; ?>"><?php echo $brname[1]; ?></option>
      
      <? } 
     
     ?>
       </select>
</td>

<td>
 <div id="mystate">
 <select name="Employee_name" id="Employee_name" >
    
<? if($_SESSION['designation']!='4'){ ?>
    <option value="">Select</option> <? } ?>
    
    
<?   if($_SESSION['designation']=='4'){   ?>
    
    <option value="<?php echo $engr[0]; ?>"><?php echo $engr[1]; ?></option>
   
   <? } 
   
   else ?>
    
    <option value="<?php echo $name[0]; ?>"><?php echo $name[1]; ?></option>
 
  
 

</div>
</td>


<td><input type="date" name="from" id="from"></td>
<td><input type="date" name="to" id="to"></td>

<td><select name="status" id="status">

<option value = "1">Pending</option>
<option value = "">All</option>
<option value = "2">Approved</option>
</select>    
</td>                               

<td><input type="button" style="color:red" name="submit" onclick="a('','')" value="search"></button></td>
				

</tr>
</table>
</div>
 <div id="show"></div>
</body>
</html>
