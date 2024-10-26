<?
    $fullname=$_GET['fulln'];
    $stid=$_GET['stid'];
    $ssn=$_GET['ssn'];
    $dept=$_GET['dept'];
    $fees=$_GET['fees'];
    $paid=$_GET['paid'];
     // Starting Payslip display
     
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bill</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	color: #0033CC;
}
.style2 {color: #0033FF}
.style3 {color: #0033CC}
-->
</style>
</head>

<body>
<table width="100%" >
<tr>
<td>
<img src="images/Qarma_eng.jpg" width="400" height="250" />
</td><td><span class="style1">Qarma Studios.<br />
  Shop No. 2, balaji shriji chs,<br />
  plot no. 13A, sector - 11,<br />
         koparkhairane, Navi Mumbai - 400709 <br />
         Email: performingarts@qarma.net    
     </span></td>
</tr></table><br />
<table width="600" border="0" align="center">
  <tr>
    <td width="200"><span class="style3">Student Name : </span></td>
    <td><? echo $fullname; ?></td>
  </tr>
  <tr>
    <td><span class="style3">SSN : </span></td>
    <td><? echo $ssn; ?></td>
  </tr>
  <tr>
    <td><span class="style3">Student ID : </span></td>
    <td><? echo $stid; ?></td>
  </tr>
  <tr>
    <td><span class="style3">Course Name : </span></td>
    <td><? echo $dept; ?></td>
  </tr>
  <tr>
    <td width="200"><span class="style3">Course Fees : </span></td>
    <td><? echo $fees; ?></td>
  </tr>
  <tr>
    <td width="200"><span class="style3">Fees Paid : </span></td>
    <td><? echo $paid; ?></td>
  </tr>
</table>
</body>
</html>               
           
