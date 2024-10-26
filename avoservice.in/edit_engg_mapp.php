<?php include("access.php");
include("config.php");

$oldeng=$_GET['id'];

$branch=$_GET['br'];


 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
function validate(form){
 with(form)
 {
var numbers = /^[0-9]+$/;  

if(atm.value=="")
{
alert("Please Enter ATM ID");
atm.focus();
return false;
}
if(state.value=="")
{
alert("Please Select Branch");
state.focus();
return false;
}

}
return true;
}


function getXMLHttp()

{   var xmlHttp

  try   {
    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }   catch(e)
  {
    //Internet Explorer
    try     {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }    catch(e)
    {
      try       {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }       catch(e)
      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
}


function HandleResponse3(response)

{
//alert(response);
  document.getElementById('res').innerHTML = response;
}
</script>
</head>

<body>
<center>
<?php // include("menubar.php"); ?>
<h2>Change Engineer</h2>
<div id="header">
<form action="change_engg_mapp.php" method="post" name="form">
<table>
    
    <? $engqry=mysqli_query($con1,"select  engg_id, engg_name,area, city, status from area_engg where engg_id='".$oldeng."'") ;
$engrow=mysqli_fetch_row($engqry);
if($engrow[4]==1) { $stat="Acive";}
else {$stat="Engineer Left or Transferred"; }
$brqrry=mysqli_query($con1,"select  id, name from avo_branch where id='".$branch."'") ;
$bran=mysqli_fetch_row($brqrry);
$citqry=mysqli_query($con1,"select city from cities where city_id='".$engrow[3]."'") ;
$city=mysqli_fetch_row($citqry);
?>
<tr>
<input type="hidden" id="oldengg" name="oldengg" value="<?php echo $engrow[0]; ?>">
<td width="126" height="35"> Old Engineer Name: </td>
<td><font color="yellow"> <? echo $engrow[1]; ?> </font></td>

</tr>

<tr>
<td width="126" height="35"> Branch: </td>
<td><font color="yellow"> <? echo $bran[1]; ?> </font></td>

</tr>

<tr>
<td width="126" height="35"> City: </td>
<td><font color="yellow"> <? echo $city[0]; ?> </font></td>

</tr>

<tr>
<td width="126" height="35"> Engineer Status: </td>
<td><font color="red"> <? echo $stat; ?> </font></td>

</tr>



<tr>
<td height="35"> Select Engineer: </td>
<td>
<select name="neweng" id="neweng">
<option value=""> Select</option>
<?php
$brqry=mysqli_query($con1,"select  engg_id, engg_name,city  from area_engg where area='".$branch."' and status=1 order by engg_name ASC") ;

while($row=mysqli_fetch_row($brqry)) { 
$cqry=mysqli_query($con1,"select city from cities where city_id='".$row[2]."'") ;
$city=mysqli_fetch_row($cqry);
?>
<option value="<?php echo $row[0]; ?>"> <?php echo $row[1]." - ".$city[0]; ?></option>
<?php } ?>
</select>
</td>
</tr>

<tr>
<td height="35" colspan="2" align="center">
<input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>