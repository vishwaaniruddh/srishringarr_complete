<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">

                 $(document).ready(function() {

                        $('#cou_btn').click(function(e) {
                          e.preventDefault();

                          w=window.open();
                          var temp=$('#cou_box').html();
                          w.document.write(temp);
                          if (navigator.appName == 'Microsoft Internet Explorer') window.print();
        else w.print();
                         
                          w.close();
                         return false;
                        });
                       });  


            </script>

</head>

<body>
<input type="button" id="cou_btn" value="Print" style="width:100px;"/>
 <div id="cou_box">
  <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Patient's Records</p>
<table width="1102"  border="1" id="results" cellpadding="4" cellspacing="0" style="text-transform:uppercase;font-size:13px;">
 
         <tr>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">ID</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Full Name </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Date </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">City </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Area </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Reference Doctor </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Diagnosis</td>
         </tr>

<?php
include('config.php');


/*if ($_GET['name']=="" && $_GET['area']=="" && $_GET['city']=="" && $_GET['diag']=="" && $_GET['pdate']=="" && $_GET['ref']=="")
{

$name=$_GET['name'];
$area=$_GET['area'];
$city=$_GET['city'];
$diag=$_GET['diag'];
$pdate=$_GET['pdate'];
$ref=$_GET['ref'];

$query ="select a.no,a.name,a.city,a.area,a.date,a.reference from patient a";
}

else if ($_GET['area']=="" && $_GET['city']=="" && $_GET['diag']=="" && $_GET['pdate']=="" && $_GET['ref']=="")
{
    $name=$_GET['name'];
    $query ="select a.no,a.name,a.city,a.area,a.date,a.reference from patient a where a.name like '$name%'";
}

else if ($_GET['name']=="" && $_GET['city']=="" && $_GET['diag']=="" && $_GET['pdate']=="" && $_GET['ref']=="")
{
    $area=$_GET['area'];
    $query ="select a.no,a.name,a.city,a.area,a.date,a.reference from patient a where a.area like '$area%'";
}

else if ($_GET['area']=="" && $_GET['name']=="" && $_GET['diag']=="" && $_GET['pdate']=="" && $_GET['ref']=="")
{
    $city=$_GET['city'];
    $query ="select a.no,a.name,a.city,a.area,a.date,a.reference from patient a where a.city like '$city%'";
}

else if ($_GET['area']=="" && $_GET['name']=="" && $_GET['diag']=="" && $_GET['city']=="" && $_GET['ref']=="")
{
    $pdate=$_GET['pdate'];
    $query ="select a.no,a.name,a.city,a.area,a.date,a.reference from patient a where a.date like STR_TO_DATE('".$pdate."%','%d/%m/%Y')";
}


else
{

$name=$_GET['name'];
$area=$_GET['area'];
$city=$_GET['city'];	
	$query ="select a.no,a.name,a.city,a.area,a.date,a.reference from patient a where a.name like '$name%' and a.name like '$name%'";
}
*/
if($_REQUEST['diag']!=""){
$query ="select a.no,a.name,a.city,a.area,a.date,a.reference,b.diagnosis from patient a,opd b where ";	}

else if($_REQUEST['ref']!=""){
$query ="select a.no,a.name,a.city,a.area,a.date,a.reference,c.name from patient a,doctor c where ";	}

else
$query ="select a.no,a.name,a.city,a.area,a.date,a.reference from patient a where  ";
if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$query.="a.no like('".$id."%') ";
}
if(isset($_REQUEST['name']))
{
	
$name=$_REQUEST['name'];
$query.="and a.name like('".$name."%')";
}
if(isset($_REQUEST['city'])){
	
$city=$_REQUEST['city'];
$query.="and a.city like('".$city."%') ";

}
if(isset($_REQUEST['area'])){
	
$area=$_REQUEST['area'];
$query.="and a.area like('".$area."%') ";

}

if(isset($_REQUEST['diag']) && $_REQUEST['diag']!=""){
	
$diag=$_REQUEST['diag'];
$query.="and b.diagnosis like('".$diag."%') and a.no=b.patient_id";

}

if(isset($_REQUEST['ref']) && $_REQUEST['ref']!=""){
	
$ref=$_REQUEST['ref'];
$query.="and c.name like('".$ref."%') and a.reference=c.doc_id";

}

if(isset($_REQUEST['pdate']) && $_REQUEST['pdate']!="")
{
	
$pdate=$_REQUEST['pdate'];
//echo "hi";
$query.="and a.date like STR_TO_DATE('".$pdate."%','%d/%m/%Y') ";
}

$result = mysql_query($query) or die(mysql_error());

while($row= mysql_fetch_row($result))
{

?>
<tr>
    <td><?php echo $row[0]; ?></td>
	<td><?php echo $row[1]; ?></td>
    <td><?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?></td>
    <td><?php echo $row[2]; ?></td>
    <td> <?php echo $row[3]; ?></td>

<?php
$result1 = mysql_query("select * from doctor where doc_id='$row[5]'");
$row1=mysql_fetch_row($result1);

if($_REQUEST['diag']==""){
$result2 = mysql_query("select diagnosis from opd where patient_id='$row[0]'");
$row2=mysql_fetch_row($result2);}
?>  
   
    <td><?php if( $row1[1]==""){echo  $row[5]; } else { echo $row1[1]; } ?></td>
    <td style="word-break:break-all; white-space:normal"> <?php if($_REQUEST['diag']=="") echo $row2[0]; else echo $row[6]; ?></td>
   
</tr>

<?php } ?>
</table>
</div>
            
</body>
</html>