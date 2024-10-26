<html>
<head>
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


<style>

</style>
</head>
<body>
<form name="frm1" action="processSO.php" method="post" enctype="multipart/form-data" >
<div align="center" style="padding:10px">
<input type="hidden" name="sid" value="<?php echo $_GET['id']; ?>" >
<h3>SALES ORDER</h3>
<table id="tab">
<tr>
  <td>
  Invoice NO:
  </td>
  
  <td>
  <input type="text" name="invno" id="invno"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Invoice Date:
  </td>
  
  <td>
  <input type="text" name="date1" id="date1"  onclick="displayDatePicker('date1');"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Invoice Value:
  </td>
  
  <td>
  <input type="text" name="invval" id="invval"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Courier Name:
  </td>
  
  <td>
  <input type="text" name="cname" id="cname"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Docket No:
  </td>
  
  <td>
  <input type="text" name="dno" id="dno"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Estimated Delivery Date:
  </td>
  
  <td>
  <input type="text" name="estdate" id="estdate"  onclick="displayDatePicker('estdate');"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td>
  Dispatch Date:
  </td>
  
  <td>
  <input type="text" name="date2" id="date2"  onclick="displayDatePicker('date2');"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Delivery Date:
  </td>
  
  <td>
  <input type="text" name="deldt" id="deldt"  onclick="displayDatePicker('deldt');"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td>
  Upload Invoice:
  </td>
  
  <td>
  <input type="file" name="invfile" id="invfile" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note No.:
  </td>
  
  <td>
  <input type="text" name="crn" id="crn" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note Date:
  </td>
  
  <td>
  <input type="text" name="crndate" id="crndate" onclick="displayDatePicker('crndate');"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note Amount:
  </td>
  
  <td>
  <input type="text" name="crnamt" id="crnamt" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Upload Credit Note:
  </td>
  
  <td>
  <input type="file" name="crnfile" id="crnfile" />
  </td>
</tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td colspan="2" align="center">
  <input type="submit" name="subs" value="submit" />
  </td>
</tr>


</table>
<br>
<a href="generateSO.php" >BACK</a>
</div>
</form>
</body>