<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
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
<style>
.results {table-layout:fixed;text-transform:uppercase;}
.results td {overflow: hidden;text-overflow: ellipsis; font-size:12px; width:120px;}
.results td input{font-size:12px;}
</style>
</head>

<body>
<input type="button" id="cou_btn" value="Print" style="width:100px;"/>
 <div id="cou_box">
<table border="1" id="results" cellpadding="2" cellspacing="0">
 <tr><td align="center" colspan="12">
 <?php include('opd2.php');
 $i=1;
 ?>
 </td></tr> 
       
          <tr>
          <td width="19" style="color:#ac0404; font-size:12px; font-weight:bold;">Sr. No</td>
          <td width="37" style="color:#ac0404; font-size:12px; font-weight:bold;">Time</td>
          <td width="60" style="color:#ac0404; font-weight:bold;">App_Date</td>
          <td width="63" style="color:#ac0404; font-size:12px; font-weight:bold;">Name</td>
          <td width="47" style="color:#ac0404; font-size:12px; font-weight:bold;">Contact/  Email</td>
          <td width="56" style="color:#ac0404; font-size:12px;font-weight:bold;">Ref.Doctor</td>
          <td width="53" style="color:#ac0404; font-size:12px; font-weight:bold;">Speciality</td>
          <td width="61" style="color:#ac0404; font-size:12px; font-weight:bold;">Dr.Contact No.</td>
          <td width="44" style="color:#ac0404; font-size:12px;font-weight:bold;">Hospital</td>
          <td width="52" style="color:#ac0404; font-size:12px;font-weight:bold;">Diagnosis</td>
          <td width="24" style="color:#ac0404; font-size:12px;font-weight:bold;">F/u Plan</td>
          <td width="44" style="color:#ac0404; font-size:12px;font-weight:bold;">Category</td>
          </tr>


<?php
include('config.php');
$query ="select a.no,a.new_old,a.hospital,a.app_date,a.slot,a.type,a.block_id,b.name,b.srno from appoint a,patient b where a.no=b.srno and ";

if(isset($_GET['hos']))
{
	
$hos=$_GET['hos'];

$query.="a.hospital like('".$hos."%') ";
}

if(isset($_REQUEST['adate']) && $_REQUEST['adate']!="")
{
$adate=$_GET['adate'];
//$qu =mysql_query("select * from patient where name like('".$fname."%')");
//$ro=mysql_fetch_row($qu);
$query.="and a.app_date like STR_TO_DATE('".$adate."%','%d/%m/%Y')";
}


$result = mysql_query($query) or die(mysql_error());


$intRows = 0;
$i=1;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
$result1 = mysql_query("select * from patient where srno='$row[0]'");
$row1=mysql_fetch_row($result1);

$result2=mysql_query("select doc_id,name,special,mobile from doctor where doc_id='$row1[9]'");
$row2=mysql_fetch_row($result2);

$result3=mysql_query("select diagnosis from opd where patient_id='$row1[2]'");
$row3=mysql_fetch_row($result3);

$result6=mysql_query("select * from slot where block_id='$row[6]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[4]-1)* 10;
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	

$result4 = mysql_query("select lower(email) from patient where srno='$row[0]'");
$row4=mysql_fetch_row($result4); 
?>

	<tr>
    <td> <?php echo $i++ ; ?></td>
    <td> <?php echo $apptime; ?></td>
    <td> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td> <?php echo $row1[6]." / ".$row1[26]; ?></td>
    <td style="text-transform:lowercase;"> <?php echo $row1[23]."/ ".$row4[0]; ?></td>
 	<td> <?php echo $row2[1]; ?></td>
    <td> <?php echo $row2[2]; ?></td>
    <td> <?php echo $row2[3]; ?></td>
    <td> <?php echo $row[2]; ?></td>
    <td style="word-break:break-all; white-space:normal"> <?php echo $row3[0]; ?></td>
    <td></td>
    <td></td>
   
</tr><?php
		}}
	?> 

	</table>
    </div>
            
</body>
</html>