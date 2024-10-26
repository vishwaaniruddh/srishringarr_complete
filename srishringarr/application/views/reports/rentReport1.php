<?php
ini_set( "display_errors", 0);
$s=$_GET['submit'];

$id=$_GET['cid'];
$from=$_GET['from'];
$to=$_GET['to_date'];
?>
<script type="text/javascript" src="datepick_js.js"></script>
<link rel="stylesheet" type="text/css" href="date_css.css"  />
<script>
/////////////////

function validate1(form1){
 with(form1)
 {
  
if(cid.value== -1)
 {
alert("Please Select Customer Name to continue.");
cid.focus();
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
	    //alert(s);
		var s1=s.split('&&');
		//alert(s1[0]+"/"+s1[1]);
		if(s1[0]=="0")
		alert("No such Phone Number"); 
		else{
		document.getElementById("cid").value=s1[1];
		MakeRequest();
		}
		//document.getElementById("").value=s1[];
    //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;

    }
  }
   var str=document.getElementById('phoneNo').value;
   //alert(str);
   xmlhttp.open("GET","getbyphone.php?cid="+str,true);
   xmlhttp.send();
}
</script>
 
<div style="text-align: center;">
  <a href="../../../index.php/reports">Back</a>
  <table width="1096"  border="1" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  align="center">
  
<tr>
<td align="center">
<img src="bill.PNG" width="408" height="165"/><br><br>
<b>Rent  Report</b>

</td></tr>
<tr>
<td width="1084"  valign="top">
      
     <center>
       <form  action="rentReport1.php" onSubmit="return validate1(this)">
       <br/>
       
       <table width="1073" height="42"><tr>
       <td width="293" height="36"><strong>From Date :</strong>
         <input type="text" name="from" id="from" onClick="displayDatePicker('from');" /></td>  
       <td width="216" ><strong>To Date: </strong>
         <input type="text" name="to_date" id="to_date" onClick="displayDatePicker('to_date');"/></td><td width="463" height="34">
         
         <strong> Phone Number:</strong> <input type="text" name="phoneNo" id="phoneNo" value=""  /> <a href="#" onClick="loadPhoneNo();">Find</a> <br />
         
         <strong>Customer Name:&nbsp;</strong>&nbsp;&nbsp;
         <select name="cid" id="cid">
           <option value="-1" >select</option>
           <?php 
	  include('config.php');
	  $result = mysql_query("SELECT * FROM  phppos_people order by first_name");
	  while($row = mysql_fetch_row($result)){ 
	  ?>
           <option value="<?php echo $row[11]; ?>" ><?php echo $row[0] ."  ". $row[1]; ?></option>
           <?php } ?>
         </select>
        </td><td width="81"> <input type="submit" value="Search" name="submit" /></td></tr></table>
       </form></center>
 </td></tr>
 
<tr><td height="103">
  <?php

if(isset($s)){
       
  
   if($from=="" && $to==""){
	  $qry="SELECT * FROM  `scheme` where cust_id='$id'";
		//echo "all";
   }else if($from==""){
	    $qry="SELECT * FROM  `scheme` where cust_id='$id' and bill_date=STR_TO_DATE('".$to."','%d/%m/%Y')";
	
	 //  echo "to";
   }else if($to==""){
	 
	      $qry="SELECT * FROM  `scheme` where cust_id='$id' and bill_date=STR_TO_DATE('".$from."','%d/%m/%Y')";
	
	   
   }else{
   $qry="SELECT * FROM  `scheme` where cust_id='$id' and bill_date BETWEEN STR_TO_DATE('".$from."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y')";
    // echo "between";
   }
$res=mysql_query($qry);                
$num=mysql_num_rows($res);
			
				 				 
?>
<table  border="1" cellpadding="4" cellspacing="0" width="1085" align="left">
 <tr>
 <th width='57' height="34"><U>Sr.No.</U></th>
    <th width='57' height="34"><U>Bill No.</U></th>
    <th width='96'><u>Customer Name</u></th>
    <th width='66'><u>Throught</U></th>
     <th width='65'><u>Bill Date</U></th>
	 <th width='78'><u>Maturty Date</U></th>
  <th width='98'><U>Paid Amount </U></th>
    <th width='87'><U>Balance  Amount</U></th>
	<th width='87'><U>Scheme Return Amount </U></th>
		<th width='87'><U>Net Amount </U></th>
    <th width='104'><u>Bill Detail</u></th>
  </tr>
<?php
$i=1;
while($row = mysql_fetch_row($res)) 
 {
$sql1=mysql_query("SELECT * FROM `phppos_people` WHERE `person_id`='$row[1]'");
$row1=mysql_fetch_row($sql1);
 
 $qry2="SELECT sum(bal_amount) FROM  `scheme` where bill_id ='$row[0]'";
$res2=mysql_query($qry2);                
$num2=mysql_num_rows($res2);
$row2=mysql_fetch_row($res2);
			
$qry3="SELECT sum(`rent`) FROM `scheme_detail` WHERE bill_id ='$row[0]'";
$res3=mysql_query($qry3);
$row3=mysql_fetch_row($res3);
$s=$row3[0]-$row2[0];
//echo $row2[0]."&&".$s;
$bal=$row[3]-$row[6];
?>				   
				   
<tr>
<td width="77"><?php echo $i; ?></td>
<td width="77"><?php echo $row[0]; ?></td>

<td width="96" align="center"><?php echo $row1[0]." " .$row1[1]; ?></td>
<td width="66"><?php echo $row[5]; ?></td>
<td width="65"> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
<td width="78"> <?php if(isset($row[7]) and $row[7]!='0000-00-00') echo date('d/m/Y',strtotime($row[7])); ?></td>
<td width="98"><?php echo $row[6];  ?></td>
<td width="87"><?php echo  $bal; ?></td>
<td  align="left" width="87"><?php $p=round($row[3]*(65/100.0)); echo $p;  $sra+=$p;?></td>
<td><?php $na=$row[3]-$p; echo $na; $na1+=$na;?></td>
 <td  align="center" width="104"><a href="rent_report_detail1.php?id=<?php echo $row[0]; ?>" target="_new">Bill Detail</a></td>

     </tr>
				
			<?php $i++;	} ?>
            </table>
            <?php } else { }?>
	</td></tr> </table>
</div>
<div align="center">You are using Point Of Sale Version 10.5 .</div>