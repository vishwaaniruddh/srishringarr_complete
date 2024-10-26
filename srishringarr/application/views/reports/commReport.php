<?php
ini_set( "display_errors", 0);
	include('config.php');
	$s=$_GET['search'];
	
	$thr=$_GET['through'];
	$throgh=explode("/",$thr);
$from=$_GET['from'];
$to=$_GET['to'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Commission</title>
<script type="text/javascript" src="datepick_js.js"></script>
<link rel="stylesheet" type="text/css" href="date_css.css"  />
<script type="text/javascript">
function validate(form){
	with(form){
		if(through.value=="0"){
			alert("Please select Through Name");
			through.focus();
			return false;
		}
	}
	return true;
}

////////////// phone no	
function loadPhoneNo()
{
	//alert("hi");
var xmlhttp;
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
		///alert(xmlhttp.responseText);
		var s=xmlhttp.responseText;
	    alert(s);
		var s1=s.split('&&');
		//alert(s1[0]+"/"+s1[1]);
		if(s1[0]=="0")
		alert("No such Phone Number"); 
		else{
		document.getElementById("through").value=s1[1];
		MakeRequest1();
		}
		
		
		//document.getElementById("").value=s1[];
       //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;

    }
  }
   var str=document.getElementById('phoneNo').value;
   alert(str);
   xmlhttp.open("GET","getbyphone.php?cid="+str,true);
   xmlhttp.send();
}



</script>
</head>

<body>
<form action="commReport.php" onsubmit="return validate(this)" name="form">
<table width="88%" align="center">
<tr><td height="247" align="center">
<a href="../../../index.php/reports">Back</a><br><br>
<img src="bill.PNG" width="408" height="165"/>
</td></tr>
	<tr>
    	<td width="281"><strong>From Date : </strong><input type="text" name="from" id="from" onClick="displayDatePicker('from');" />
        <strong>To Date : </strong><input type="text" name="to" id="to" onClick="displayDatePicker('to');" />
        
        <strong> Phone Number:</strong> <input type="text" name="phoneNo" id="phoneNo" value=""  /> <a href="#" onClick="loadPhoneNo();">Find</a> 
        
        <strong>Through Name : </strong><select name="through" id="through" style="width:200px;"><option value="0">Select Name (Mobile)</option>
        <?php 
	  	$result = mysql_query("SELECT  `throught` FROM  `phppos_rent` where  throught<>'-1' or throught<>' ' GROUP BY  `throught` ");

	  	while($row = mysql_fetch_row($result)){ 
		$sql=mysql_query("SELECT * FROM  `phppos_people` WHERE  `person_id` ='$row[0]'");
		$people=mysql_fetch_row($sql);
		
	  	?>
           <?php if($people[11]!=""){?><option value="<?php echo $people[11]; ?>" ><?php echo $people[0]."(".$people[11].")"; ?></option><?php } ?>
           <?php } ?>
        </select>
       <input type="submit" name="search" id="search" value="Search"/></td>
	</tr>
    <tr><td>
    <?php

if(isset($s)){
       
  
   if($from=="" && $to==""){
	  $qry="SELECT * FROM  `phppos_rent` where throught='$throgh[0]' ";
	  
		//echo "all".$throgh[0];
   }else if($from==""){
	    $qry="SELECT * FROM  `phppos_rent` where throught='$throgh[0]' and bill_date=STR_TO_DATE('".$to."','%d/%m/%Y')";
	
	 //  echo "to";
   }else if($to==""){
	 
	      $qry="SELECT * FROM  `phppos_rent` where throught='$throgh[0]'  and bill_date=STR_TO_DATE('".$from."','%d/%m/%Y')";
	
	   
   }else{
   $qry="SELECT * FROM  `phppos_rent` where throught='$throgh[0]'  and bill_date BETWEEN STR_TO_DATE('".$from."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y')";
    // echo "between";
   }
$res=mysql_query($qry);                
$num=mysql_num_rows($res);
$sum=0;	
$sumrent=0;				
				 				 
?><br/><a href="comm_paid.php?name=<?php echo $throgh[0]?>  ">Commission Paid</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="commPaid_report.php?name=<?php echo $throgh[0] ?>"  target="_new">Commission Payment Report</a><br/>
    <table  border="1" cellpadding="4" cellspacing="0" width="100%" align="center">
 <tr>
 <th width='43' height="29"><U>Sr.No.</U></th>
    <th width='54' height="29"><U>Bill No.</U></th>
    <th width='132'><u>Customer Name</u></th>
    <th width='82'><U>Bill Date</U></th>
    <th width='99'><U>Rent Amount</U></th>
    <th width='128'><U>Through Name</U></th>
     <th width='144'><U>Through Mobile</U></th>
    <th width='141'><U>Commission</U></th>
  
    <th width='129'><u>Total Commission</u></th>
  </tr>
<?php
$i=1;
while($row = mysql_fetch_row($res)) 
 {
	 $qry1="SELECT * FROM phppos_people where person_id='$row[1]'";
	 $result1=mysql_query($qry1);
	  $row1=mysql_fetch_row($result1);
	 	  
	 $qry8="SELECT * FROM phppos_people where person_id='$row[8]'";
	 $result8=mysql_query($qry8);
	  $row8=mysql_fetch_row($result8);
//echo $row2[0]."&&".$s;
?>				   
				   
<tr>
<td width="43" align="center"><?php echo $i; ?></td>
<td width="54" align="center"><?php echo $row[0]; ?></td>
<td width="132" align="center"><?php echo $row1[0]." " .$row1[1]; ?></td>
<td width="82" align="center"> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
<td width="99" align="center"><?php echo $row[3];$sumrent+=$row[3]; ?></td>
<td width="128" align="center"><?php echo $row8[0]; ?></td>
<td width="144" align="center"><?php echo $row8[2]; ?></td>
<td align="center"><?php if($row[17]=="%") { echo $row[18]." " .$row[17];} else { echo $row[17]." " .$row[18]; } ?></td>
<td align="center"><?php echo $row[19]; $sum+=$row[19];?></td>

     </tr>
				
			<?php $i++; } ?>
            <tr>
<td width="43" align="center">&nbsp;</td>
<td width="54" align="center">&nbsp;</td>
<td width="132" align="center">&nbsp;</td>
<td width="82" align="center">&nbsp;</td>
<td width="99" align="center">Total : <?php echo $sumrent." /-."; ?></td>
<td colspan="3" align="right"><b><u>Total Commission</u></b></td>
<td align="center"><?php echo $sum."/-"; ?></td>

     </tr>
     <?php  $qry1=mysql_query("SELECT sum(amount) FROM  `commission_paid` where name='$throgh[0]' ");
    $row1=mysql_fetch_row($qry1);
	?>
                 <tr>
<td width="43" align="center">&nbsp;</td>
<td width="54" align="center">&nbsp;</td>
<td width="132" align="center">&nbsp;</td>
<td width="82" align="center">&nbsp;</td>
<td width="99" align="center">&nbsp;</td>
<td colspan="3" align="right"><b><u>Paid Commission</u></b></td>
<td align="center"><?php echo $row1[0]."/-"; ?></td>

     </tr>
                 <tr>
<td width="43" align="center">&nbsp;</td>
<td width="54" align="center">&nbsp;</td>
<td width="132" align="center">&nbsp;</td>
<td width="82" align="center">&nbsp;</td>
<td width="99" align="center">&nbsp;</td>
<td colspan="3" align="right"><b><u>Balance Commission</u></b></td>
<td align="center"><?php echo $sum-$row1[0]."/-"; ?></td>

     </tr>
        </table>
            <?php } else { }?>
	</td></tr> </table></tr>
</table>
</form>

</body>
</html>