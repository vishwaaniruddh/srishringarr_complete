<?php include("access.php");
include("config.php");
//include("search_pmalert_new.php");
$getdata=$_GET['id'];
$gettype=$_GET['type'];

//echo "hello : ".$getdata;

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>


/////for city
function getXMLHttp()

{

  var xmlHttp

 //alert("hi1");

  try

  {

    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }

  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
   catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
}
function MakeRequest()

{ 
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {

      HandleResponse3(xmlHttp.responseText);
    }
  }


}

function HandleResponse3(response)

{
//alert(response);
  document.getElementById('res').innerHTML = response;

}
</script>
</head>
<body>
<?php



$queryalert="select atm_id,problem,entry_date,close_date,createdby from alert where atm_id='".$_GET['id']."' and assetstatus='".$_GET['type']."'  ";

if(isset($_GET['frdt']) && $_GET['frdt']!='' && isset($_GET['todt']) && $_GET['todt']!=''){
			$queryalert.=" and entry_date between '".$_GET['frdt']." 00:00:00' and '".$_GET['todt']." 23:59:59'";
}


//echo $queryalert;

$queryalert=mysqli_query($con1,$queryalert);
?>
<table>
<tr>
<th>sr.no.</th>
<th>Entry Date</th>
<th>Complain ID </th>
<th width="350px">Problem</th>
<th>Close Date</th>
</tr>
<?php 
$i=1;
while($fetchqry=mysqli_fetch_array($queryalert))
{

?>

<tr>
<td><?php echo $i; ?></td>
<td><?php echo $fetchqry[2]?></td>
<td><?php echo $fetchqry[4]?></td>
<td><?php echo $fetchqry[1]?></td>
<td><?php echo $fetchqry[3]?></td>
</tr>
<?php $i++; } ?>

</table>


</center>
</body>
</html>