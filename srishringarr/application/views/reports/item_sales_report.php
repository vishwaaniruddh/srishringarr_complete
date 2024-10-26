<script type="text/javascript" src="datepicker/datepick_js.js"></script>
<link rel="stylesheet" type="text/css" href="datepicker/date_css.css"  />
<script>
function sales1()
{
	//alert("hii bal");
	
		 var item_id=document.getElementById('item_id').value;
		 var frmdate=document.getElementById('frmdate').value;
		 var todate=document.getElementById('todate').value;
		 var status=document.getElementById('status').value;
		 
		 //alert(item_id);
		if(item_id=="")
		{
			alert("Please Enter Item Name.");
			document.getElementById('item_id').focus();
			return;
			}
			
		 if((frmdate=="" && todate!="")||(frmdate!="" && todate==""))
		 {
			 alert("Please Enter date in both Fields");
			 return ;
		 }
	 document.getElementById('bal').innerHTML="<img src='loading.gif' width='150px' height='100px'>";
		 document.getElementById('dtl').innerHTML='';
		if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  { 
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {	
		
		
	document.getElementById('bal').innerHTML=xmlhttp.responseText;
    }
  }
  //if(str=='')
xmlhttp.open("GET","getdetailsitems.php?item_id="+item_id+"&frmdate="+frmdate+"&todate="+todate+"&status="+status,true);
xmlhttp.send();

	
}
</script>
<body onLoad="">

<div style="text-align: center;">
<a href="../../../index.php/reports">Back</a>
<table width="1320" height="300" border="1" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  align="center">
<tr>
<td align="center"> 
<?php
include('config.php');
$result5=mysql_query("select * from `phppos_app_config`");
$row5 = mysql_fetch_array($result5);
mysql_data_seek($result5,1);
$row6=mysql_fetch_array($result5);
mysql_data_seek($result5,10);
$row7=mysql_fetch_array($result5);
?>

<img src="../reports/bill.PNG" width="408" height="165"/><br/><br/>
<b>*** Sales Report [ Item Wise]***</b>
</td></tr>

<tr>
<td width="1308"  valign="top"><center>
      
      
     <form id="purchse" >  
     <hr>
     <?php $qryitem=mysql_query("select bank_name, bank_id from banks");
	 	//$items=array();
		
		
			//print_r($items);
		
	 ?>
     <div id="back">
     <table width="500px">
     <?php /*?><!--<tr>
       <td align="right"> Item Name : </td><td><select name="item_id" id="item_id" onChange="sales()"><option value="0">Select Item</option>
         <?php 
	 
	  $result = mysql_query("SELECT * FROM  phppos_items ");
	  while($row = mysql_fetch_row($result)){ 
	  ?>
      
      <option value="<?php echo $row[0]; ?>" ><?php echo $row[0] ?></option>
      <?php } ?> 	</select></td></tr>
     --><?php */?>  
     <tr><td align="right">Item Name : <input type="text" name="item_id" id="item_id" ></td><td>Status : <select id="status" ><option value="a">Approved</option><option value="s">Sold</option></select></td></tr>
     <tr><td> Date From :<input type="text" name="frmdate" id="frmdate" onClick="displayDatePicker('frmdate');"></td><td>To : <input type="text" id="todate" name="todate" onClick="displayDatePicker('todate');"></td></tr>
        <tr><td colspan="2" align="center"><input type="button" name="btn" onClick="sales1()" value="&nbsp;&nbsp;Get Details&nbsp;&nbsp;"></td></tr>
        <tr><td colspan="2"><div id="bal" align="center"></div></td></tr>
           <tr><td colspan="2"><div id="dtl" align="center"></div></td></tr>
            </table>
        </div>&nbsp; &nbsp;<a href="../../../index.php/purchase"><input type="button" name="cancel"  value="EXIT to Main Menu"></a>
     <br/>
  </form>
      
</center>
</td>
</tr>
</table>
</div>
<div align="center">You are using Point Of Sale Version 10.5 .</div>
</body>