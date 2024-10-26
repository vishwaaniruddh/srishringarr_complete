<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
include('template_clinic.php');
include('config.php');
?>
<link href="paging.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
 <link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<style>


 .M_page:-ms-input-placeholder { color:#f00; } 
 
 
</style>

<body onLoad="searchById('Listing','1')">
  
  
  
   <div class="M_page">
   <fieldset class="textbox">
   
	<legend><h1><img src="ddmenu/img1.png" style="width:50px; height:50px;" />Patients Records</h1></legend>
<table class="results">
	<thead align="left">
		<tr>
			<th>ID</th>
			<th>Full Name </th>
			<th>Phone </th>
			<th>Start Date </th>
			<th>End Date </th>
		</tr>
	</thead>
	<?php
$intRows = 0;
$qry="select  a.srno,a.name,a.city,a.area,a.date,a.reference,a.sex,a.mobile from patient a where a.REFERENCE='".$_REQUEST['id']."'";
if($_REQUEST['type']=='p')
$qry.=" and REFERENCE1='Y'";
if($_REQUEST['type']=='u')
$qry.=" and REFERENCE1 is null";
$result=mysql_query($qry);
while($row= mysql_fetch_row($result))
{
	 
?>
<tbody>
<tr>
    <td ><?php echo $row[0]; ?></td>
	<td ><?php echo $row[1]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td ><?php 
	//echo "select * from patient_package where patientid='$row[0]' and status=0 order by id DESC limit 1";
	$dt=mysql_query("select * from patient_package where patientid='$row[0]' and status=0 order by id DESC limit 1");
	if(mysql_num_rows($dt)>0)
	{
	$dtro=mysql_fetch_row($dt);
	echo date('d/m/Y',strtotime($dtro[3]))."</td><td>";
	if(date('Y',strtotime($dtro[4]))>='1990')
	echo date('d/m/Y',strtotime($dtro[4]))."";
	}
	else
	{
	if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4]))."</td><td>".date('d/m/Y',strtotime($row[4]))."";
     }
	 ?></td>
</tr>  </tbody><?php
			$intRows++;	
		}
		
	?>
</table>

            </fieldset>
              
         </div>
</body>