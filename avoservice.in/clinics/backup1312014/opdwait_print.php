<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Patient Records</title>
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
 <table width="1002"  border="1" id="results" cellpadding="4" cellspacing="0" style="font-size:13px;">

       
         <tr>
		 <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td> 
           <td width="250" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient Name</td>
           <td width="128" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Date</td>
		  <td width="86" style="color:#ac0404; font-size:14px; font-weight:bold;">Timing</td>
		  <td width="79" style="color:#ac0404; font-size:14px; font-weight:bold;">Type</td>
          <td width="65" style="color:#ac0404; font-size:14px; font-weight:bold;">New/Old</td>
          <td width="272" style="color:#ac0404; font-size:14px; font-weight:bold;">Hospital</td>
         
         
         
          
          
          <!--<td width="83" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission</td>
          <td width="62" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery</td>-->
          
        </tr>
        
<?php

include('config.php');
if ($_GET['fname22']!="" && $_GET['adate']!="" ){

$adate=$_GET['adate'];
$fname22=$_GET['fname22'];
$query ="select * from opdwait where name like '$fname22%' and app_date=STR_TO_DATE('".$adate."','%d/%m/%Y')";

}
else if ($_GET['adate']=="")
{
    $fname22=$_GET['fname22'];
    $query ="select * from opdwait where name like '$fname22%'";
	
}
else if ($_GET['fname22']=="")
{
	$adate=$_GET['adate'];
	$query ="select * from opdwait where app_date=STR_TO_DATE('".$adate."','%d/%m/%Y')";
}
else{
	
$query ="select * from opdwait order by id ASC";

}
$result = mysql_query($query) or die(mysql_error());


while($row1= mysql_fetch_row($result))
{

?>

<tr>
<?php
$result2=mysql_query("select * from patient where name='$row1[1]'");
$row2=mysql_fetch_row($result2);
?>
<td><?php echo $row2[2]; ?></td>
    <td  width='250'> <?php echo $row1[1]; ?></td>
    <td  width='128'> <?php if(isset($row1[3]) and $row1[3]!='0000-00-00') echo date('d/m/Y',strtotime($row1[3])); ?></td>
	<td width="86"> <?php echo $row1[2]; ?></td>
	<td width="79"> <?php echo $row1[7]; ?></td>
    <td  width='65'><?php if($row1[4]=="N"){ echo "New";}else if($row1[4]=="O"){ echo "Old"; }  ?></td>
    <td  width='272'><?php echo  $row1[8]; ?></td>
    

</tr>
<?php } ?>
</table>
</div>
</body>
</html>