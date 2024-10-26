<?php
include("datacon.php");
if(isset($_POST['done']))
{
 if(isset($_POST['empid']) && $_POST['empid']!='-1'){
    // echo $_POST['empid'];
 if(isset($_POST['empsal']) && $_POST['empsal']!='' && $_POST['empsal']>=0){
    // echo $_POST['empsal'];
     $qry1="SELECT baseyear FROM  salary  where empid='".$_POST['empid']."' ";
     $res1=mysql_query($qry1);                
     $num1=mysql_num_rows($res1);

    if($num1>0){
    $result=mysql_query("update salary set baseyear='".$_POST['empsal']."' where empid='".$_POST['empid']."' ");
  //  echo "update salary set baseyear='".$_POST['empsal']."' where empid='".$_POST['empid']."' ";
   }
   else{
    $result=mysql_query("insert into salary(empid,baseyear) values('".$_POST['empid']."','".$_POST['empsal']."')");
  //   echo "insert into salary(empid,baseyear) values('".$_POST['empid']."','".$_POST['empsal']."')";
  }
    if($result)
     echo "Salary added Successfully";
    else
     echo "Some Error Occured Please try again";
     }
     else echo "Please Enter Salary";
   }
   else echo "Please Select an Employee";

}

$resultx=mysql_query("select * from employee");

?>
<script>
function getSalary()
{
	//alert("hi");
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
		///alert(xmlhttp.responseText);
		var s=xmlhttp.responseText;
	 //   alert(s);
		document.getElementById('empsal').value=s;
		
    }		
    
  }
   var str=document.getElementById('empid').value;
  // alert(str);
   xmlhttp.open("GET","getSalary.php?eid="+str,true);
   xmlhttp.send();
}

</script>
<center><br><br>
<h3> ADD/EDIT EMPLOYEE SALARY </h3><br><br>
<form action='addSalary.php' method='post'>
<table>
<tr height='50'><td>EMPLOYEE  :</td><td> <select name='empid' id='empid' onchange='getSalary();'>
<option value='-1' >Select</option>
<?php while($row=mysql_fetch_row($resultx)){ ?>
<option value='<?php echo $row[10]; ?>' ><?php echo $row[8]." ".$row[7]; ?></option>
<?php } ?>
</select></td></tr>
<tr height='50'><td>SALARY  :</td><td> <input type='text' name='empsal' id='empsal' /></td></tr>
<tr height='50'><td colspan='2' align='center'>     <input type='submit' name='done' id='done' /></td></tr>
</table>
</form>
</center>