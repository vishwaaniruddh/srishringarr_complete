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
 <br><br><br><br><br><br><br><br><br><hr>
<table width="1102"  border="1" id="results" cellpadding="4" cellspacing="0" style="text-transform:uppercase;font-size:13px;">
 
 


       
      <tr>
          <td width="146" style="color:#ac0404; font-size:13px; font-weight:bold;">Patient_Name</td>
          <td width="70" style="color:#ac0404; font-size:13px; font-weight:bold;">Contact</td>
          <td width="79" style="color:#ac0404; font-size:13px;font-weight:bold;">New/Old</td>
          <td width="200" style="color:#ac0404; font-size:13px;font-weight:bold;">Ref.Doctor</td>
          <td width="146" style="color:#ac0404; font-size:13px; font-weight:bold;">Hospital</td>
          <td width="115" style="color:#ac0404; font-size:13px; font-weight:bold;">App_Date</td>
          <td width="53" style="color:#ac0404; font-size:13px; font-weight:bold;">Time</td>
          <td width="90" style="color:#ac0404; font-size:13px; font-weight:bold;">Type</td>
     </tr>

<?php
include('config.php');
$dt=date('Y-m-d');

if ($_GET['name']=="" && $_GET['searchdate']=="" && $_GET['cont']=="")
{
$searchdate=$_GET['searchdate'];
$name=$_GET['name'];
$cont=$_GET['cont'];
$query ="select a.new_old,a.doctor,a.hospital,a.app_date,a.block_id,a.slot,a.no,a.type,b.name,b.mobile from appoint a,patient b where a.app_date='$dt' and a.waiting_list='0' and a.status='' and a.no=b.srno";
}

else if ($_GET['searchdate']=="" && $_GET['cont']=="")
{
    $name=$_GET['name'];
    $query ="select a.new_old,a.doctor,a.hospital,a.app_date,a.block_id,a.slot,a.no,a.type,b.name,b.mobile from appoint a,patient b where a.app_date='$dt' and b.name like '$name%'  and a.waiting_list='0' and a.status='' and a.no=b.srno";
}

else if ($_GET['searchdate']=="" && $_GET['name']=="")
{
    $cont=$_GET['cont'];
    $query ="select a.new_old,a.doctor,a.hospital,a.app_date,a.block_id,a.slot,a.no,a.type,b.name,b.mobile from appoint a,patient b where a.app_date='$dt' and b.mobile like '$cont%' and a.waiting_list='0' and a.status='' and a.no=b.srno";
}

else
{
$searchdate=$_GET['searchdate']; 
$name=$_GET['name'];
$cont=$_GET['cont'];
	
	$query ="select a.new_old,a.doctor,a.hospital,a.app_date,a.block_id,a.slot,a.no,a.type,b.name,b.mobile from appoint a,patient b where a.app_date like STR_TO_DATE('".$searchdate."%','%d/%m/%Y') and b.name like '$name%' and b.mobile like '$cont%' and a.waiting_list='0' and a.status='' and a.no=b.srno";
}
if(isset($_REQUEST['center']) && $_REQUEST['center']!='')
{
$query.=" and a.center like '".$_REQUEST['center']."%' ";
}
//echo $query;
$result = mysql_query($query) or die(mysql_error());

while($row= mysql_fetch_row($result))
{
$result1 = mysql_query("select * from patient where srno='$row[6]'");
$row1=mysql_fetch_row($result1);
$result2=mysql_query("select doc_id,name from doctor where doc_id='$row1[9]'");
$row2=mysql_fetch_row($result2);

$result6=mysql_query("select * from slot where block_id='$row[4]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[5]-1)* 10;
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);		 
?>
<tr>
    <td height="31"> <?php echo $row1[6]; ?></td>
    <td height="31"> <?php echo $row1[23]; ?></td>
 	<td width="79" height="31"> <?php if($row[0]=="N"){ echo "New";}else if($row[0]=="O"){ echo "Old"; }  ?></td>
    <td width="200" height="31"> <?php echo $row2[1]; ?></td>
    <td width="200" height="31"> <?php echo $row[2]; ?></td>
    <td width="115" height="31"> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td width="53" height="31"> <?php echo $apptime; ?></td>
    <td width="90" height="31"> <?php echo $row[7]; ?></td>
</tr>

<?php } ?>
</table>
</div>
            
</body>
</html>