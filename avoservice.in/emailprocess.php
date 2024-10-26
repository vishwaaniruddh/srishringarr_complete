<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<?php
include ('config.php');
include("access.php");
?>
<style>
      table, td {
                 border: 1px solid black;
                padding:5px;
                }
                
                
</style>
</head>
<body>
<?php include("menubar.php");?>
<?php //include("menubar.php"); ?>

<h2 align="center">send pdf </h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="sendpdf_process.php" >

<table align="center" id="myTable" width="70" height="35" border="1">
         
  <tr>
<td><leble>Email ID:</lable></td>
    <td ><input type="text" name="email" id="email" style="width: 168px;"></td>
</tr>

</table>
<center><input type="submit"  name="submit" value="ok" class="readbutton" /></center>                      

		</form>
		


		


</body>
</html>
