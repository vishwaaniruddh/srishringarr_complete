<?php
//ini_set( "display_errors", 0);
include('config.php');
$cid=$_POST['cid'];
$result = mysql_query("SELECT * FROM  phppos_people where person_id='$cid'");
	$row = mysql_fetch_row($result);
$design=$_POST['design'];
$items=$_POST['items'];
$acc=$_POST['acc'];

$pick=$_POST['pick'];
$del=$_POST['del'];
$name=$_POST['name'];
$pamount=$_POST['pamount'];
$paid=$_POST['paid'];
$rentpaid=$_POST['rentpaid'];
$commis=$_POST['commis'];
$comm=$_POST['comm'];
$discount=$_POST['discount'];
$amt=$_POST['amt'];
$note=$_POST['note'];
$qty=$_POST['qty11'];
$qtyn=$_POST['qty'];
$qty1=0;
$d=count($design);
$del_date='';

if($pick=="Customer")
{
	$pick_date=$_POST['cust_pick'];
	
}
else
{
	//$pick_date=$_POST['compick_date'];
	$pick_date=$_POST['comdel_date'];
}

if(isset($_POST['del']) && $_POST['del']=='Customer Return')
{
 $del_date=$_POST['cust_del'];
}
else
{
//$del_date=$_POST['comdel_date'];
$del_date=$_POST['compick_date'];
}

$tphone=$_POST['tphone'];
$pname=$_POST['pname'];
$pcontact=$_POST['pcontact'];
$odate=$_POST['bill_date'];
$myflag=true;$dname="";$dqty=0;$bqty=0;
for($i=0;$i<$d;$i++)
{
$a=$qtyn[$i].".00";
$sq="SELECT quantity FROM phppos_items WHERE name='$design[$i]'";
$res2 = mysql_query($sq);
$det = mysql_fetch_row($res2);
if($a>$det[0])
{
 $dname=$design[$i];
 $dqty=$a;
 $bqty=$det[0];
 $myflag=false;
 break;
}
}
if(!$myflag){
            echo "<br><br><br><center>You don't have enough quantity for ".$dname.", required  (".$dqty.",) in Stock  (".$bqty;
            echo "). Go back and try again</center>";
            
}
mysql_query("BEGIN;");
if($myflag){
    
    
      $cardperc="0";
	    if(isset($_POST['pay_By']))
	    {
	        
	        
	        if($_POST['pay_By']=="Card")
	        {
	            
	           $cardperc="2"; 
	        }
	    }
    
    
    
//echo "insert into `phppos_rent`(cust_id,bill_date,status,pick,delivery,throught,pstatus,bal_amount,pick_date,delivery_date,delivery_status,throught_phone,person_Name,person_contact,comm_by,comm_amount,note,booking_status) values('$cid',STR_TO_DATE('".$odate."','%d/%m/%Y'),'A','$pick','$del','$name','$rentpaid','$pamount',STR_TO_DATE('".$pick_date."','%d/%m/%Y'),STR_TO_DATE('".$del_date."','%d/%m/%Y'),'$paid','$tphone','$pname','$pcontact','$commis','$comm','$note','Booked')";
$t1=mysql_query("insert into `phppos_rent`(cust_id,bill_date,status,pick,delivery,throught,pstatus,bal_amount,pick_date,delivery_date,delivery_status,throught_phone,person_Name,person_contact,comm_by,comm_amount,note,booking_status,card_perc,card_amt) 
values('$cid',STR_TO_DATE('".$odate."','%d/%m/%Y'),'A','$pick','$del','$name','$rentpaid','$pamount',STR_TO_DATE('".$pick_date."','%d/%m/%Y'),STR_TO_DATE('".$del_date."','%d/%m/%Y'),'$paid','$tphone','$pname','$pcontact','$commis','$comm','$note','Booked','".$cardperc."','".$_POST['cardpercamt']."')");
 

 if($_POST['pamount']>0)
 	$paymat=mysql_query("Insert into rent_amount(`cust_id`,`amount`) Values('".$cid."','".$_POST['pamount']."')");
		if($paymat){
	 //echo "INSERT INTO `bank_transaction`(`trans_id`, `bank_id`, `trans_type`, `trans_amt`, `trans_date`, `trans_memo`, `reconcile`,`enrty_date`) VALUES ('','".$acc."','receit','".$pamount."',STR_TO_DATE('".$odate."','%d/%m/%Y'),'rent payment from customer $cid','NO',now())";		
		$t3=mysql_query("INSERT INTO `bank_transaction`(`trans_id`, `bank_id`, `trans_type`, `trans_amt`, `trans_date`, `trans_memo`, `reconcile`,`enrty_date`) VALUES ('','".$acc."','receit','".$pamount."',STR_TO_DATE('".$odate."','%d/%m/%Y'),'rent payment from customer $row[0] $row[1]','NO',now())");	
			}
	$result1 = mysql_query("SELECT max(bill_id) FROM  `phppos_rent` where cust_id='$cid'");
	$rowordno = mysql_fetch_row($result1);
	
	
	$people = mysql_query("SELECT * FROM  phppos_people where person_id='$name'");
	$prow = mysql_fetch_row($people);
	
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SHRINGAAR</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<script type="text/javascript" src="paging.js"></script>
<script type="text/javascript">     





        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
           popupWin.document.close();
                }
		function rollback(){
			document.getElementById("bdy").innerHTML="Transaction is rolled back. Please refresh this page to complete the transaction!";
			//document.getElementById("pageNavPosition").innerHTML="";
			}
		
</script>
<body id="bdy">

<style>
body{
    font-size:10px;
}
td{
    padding:3px;
}
    .tnc li{
        font-size:12px;
    }
    p{
        margin:0;
        padding:0;
    }
    pre{
        display:none;
    }
</style>

<div id="bill">

        <p style="text-align:center;"><B><U> CONFIRMATION MEMO </U></B></font></p>
        
        
        
<table width="826" border="0" align="center">
<tr>
<td width="820" height="42">
    
    <table width="100%">
       <tr>
          
          <td style="padding:0px; margin:0px;">
              <div><u><b style="font-size:11px;">We Rent, Sell And Customise </b></u></div>
              <ul style="margin:0;font-size:10px;">
                  <li>Bridal Jewellery & Accessories</li>
                  <li>Lehenga, Evening Gowns, Blouse</li>
                  <li>All Kinds Of Jewellery & Outfits</li>
              </ul>
              <br>
              
              <div><b><u style="font-size:11px;">Bank Account Details</u></b></div>
              <div style="font-size:10px;">SRI SHRINGARR FASHION STUDIO</div>
              <div style="font-size:11px;">HDFC Bank A/C No : 50200010838727</div>
              <div style="font-size:11px;">IFSC: HDFC0000227. Vile Parle (E) Branch</div>
              <div style="font-size:11px;">Contact : Nipa Agrawal: +91-8928272568</div>
          </td>
          
          <td style="padding:0px; margin:0px;">
              <img src="sri_logo.jpg" width="250px"/>
          </td>
          
          <td style="padding:0px; margin:0px;" style="font-size:11px;">
              <div>Shyamkamal Building B,</div>
              <div>Wing B/1, Flat No.104,1st Floor,</div>
              <div>Agarwal Market, Vile Parle (East),</div>
              <div>Mumbai-400057, India.</div>
              <div>Phone - +91-9324243011/ +91-7400413163</div>
              <div>Email - raianioodarPKmail.com</div>
          </td>
       
       </tr>
       </table>
       
       <hr style="margin:3px;border-top: 1px solid #000;">








    <table width="100%">
       <tr>
           <td>
            <div style="width: 300px; height:30px;"><b> Name :</b><?php echo $row[0] . " ".$row[1]; ?></div>
            <div style="height:30px;"><b>Contact No: </b><?php echo $row[2]; ?></div>
            <div><b> Address : </b><?php echo $row[4]." ".$row[5]; ?><br/><?php echo $row[6]; ?><?php echo $row[8]; ?> <?php echo $row[9]; ?></div>
            <div style="height:30px;"><b> 2nd Person Name : </b>&nbsp;&nbsp;&nbsp; <?php echo $pname; ?></div>
            <div style="height:30px;"><b> 2nd Contact No.: </b>&nbsp;&nbsp;&nbsp; <?php echo $pcontact; ?></div>
           </td>
           
           <td>
               <div style="width: 220px;height:30px;"><b> Through Name: </b><?php echo $prow[0]." ".$prow[1]; ?></b></div>
               <div><b> Through Contact No:</b> <?php echo $tphone; ?></div>
               <div style="height:30px;"><b> Pick-Up By: </b>&nbsp;<?php echo $pick ?></div>
               <div style="height:30px;"><?php if($del=="Customer Return"){
                echo "<b>Return By</b>";
                }else{ echo "<b>Delivery By</b>";}
           ?> :<b><?php echo $del; ?></b></div>
               
               <div style="height:30px;"> <b> Pick-Up Date : </b>
            	      <?php if($pick=="Customer"){ echo $pick_date; }else{
        	             echo $pick_date; } ?> </div>
        	             
                <div style="height:30px;"><?php if($del=="Customer Return"){ echo "<b>Return Date</b>";}else{ echo "<b>Delivery Date</b>"; }
	   
            ?>   : &nbsp;<b><?php if($del=="<b>Customer Delivery</b>"){ echo $del_date; }else{
		     echo $del_date;} ?></b></div>     
           </td>
           
           
           <td>
               <div style="width: 320px;"><b> Bill. No. </b><?php echo $rowordno[0]; ?><br/><b> Date: </b><?php echo $odate; ?></div>
               <div style="width: 320px;">
                   <br>
                   <b><u>TERMS & CONDITION:</u></b>
          <ul style="padding: 0;">
              <li>Once An Order Is Booked, It Will Not Be Changed, Exchange Or Cancelled.</li>
              <li>No Money Will Be Refunded.</li>
              <li>The Full Amount Of Rent Is To Be Given On The Day Of Booking.</li>
              <li>Rental Is For 3 Days Only, 10% Extra For Each Day.</li>
              <li>Security Deposit Is Compulsory.</li>
              <li>Any Damage Done Will Be Deducted From The Security Deposit.</li>
              <li>Subject To Mumbai Jurisdiction.</li>
              <li>Fixed Price No Bargaining.</li>
            </ul>
               </div>
           </td>
        </tr>
        
    
</table>



  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <font size="2" >
  
  <table width="100%" border="1" cellpadding="4" cellspacing="0" id="results">
  <tr>
    <th style="padding:3px;" width="96"><font size="2"><u><center>SR NO.</center></u></font></th>
    <th style="padding:3px;" width="96"><font size="2"><u><center>ITEM CODE</center></u></font></th>
    <th style="padding:3px;" width="130"><u>PARTICULARS</u></th>
    <th style="padding:3px;" width="96"><font size="2"><u><center>DESCRIPTION</center></u></font></th>
    <th style="padding:3px;" width="86"><font size="2"><u><center>MRP</center></u></font></th>
    <th style="padding:3px;" width="86"><font size="2"><u><center>QTY</center></u></font></th>
    <th style="padding:3px;" width="110"><font size="2"><u><center>RENT</center></u></font></th>
    <th style="padding:3px;" width="119"><font size="2"><u><center>DEPOSIT</center></u></font></th>
    <th style="padding:3px;" width="88"><font size="2"><u><center>TOTAL RENT</center></u></font></th>
  </tr>
  
  <?php
  $a=1;
  $total=0;
  $total1=0;
  $p2=0;
  $tol1=$_POST['total'];
  ///echo $tol1;
  for($i=0;$i<$d;$i++)
{
//echo "SELECT * FROM phppos_items WHERE name=".$design[$i];

$sq="SELECT * FROM phppos_items WHERE name='$design[$i]'";
$res2 = mysql_query($sq);
$num2=mysql_num_rows($res2);
$row1=mysql_fetch_row($res2);


$prz=$_POST['prz'];
$qt=$_POST['qty'];
$q=$qt[$i];

////////update on 08/07/2013///$t2=mysql_query("update `phppos_items` set quantity=quantity-$q WHERE name='".$design[$i]."'");

$dep=$_POST['dep'];
 if($commis=="%"){
$p2=round($amt[$i]*($comm/100.0));
///$sum=$amt[$i]-$p;

}else{
//$p1=$comm;
$c=$comm/$tol1;
$b=$c*100;
$p2=round($amt[$i]*($b/100.0));

}
$rpt=$prz[$i]-$p2;

/////echo $rowordno[0]."/ ".$design[$i]." / ".$prz[$i]." / ".$amt[$i]."/".$p2."/".$rpt."<br/>";
 $t3=mysql_query("insert into order_detail(bill_id,item_id,rent,deposit,discount,total_amount,item_detail,commission_amt,qty) values('$rowordno[0]','$design[$i]','$prz[$i]','$dep[$i]','$discount[$i]','$amt[$i]','$items[$i]','$rpt','$qt[$i]')");

  ?>
  <tr>
    <td align="center"><?php echo $a; ?></td>
    <td align="center"><?php echo $row1[0]; ?></td>
    <td align="center"><?php echo $row1[1]; ?></td>
    <td align="center"><?php echo $items[$i]; ?></td>
    <td align="center"><?php echo $row1[6] ?></td>
    <td align="center"><font size="2" ><?php echo $qt[$i]; $qty1+= $qt[$i]; ?></font></td>
    <td align="center"><?php echo $prz[$i] ?></td>
    <td align="center"><?php echo $dep[$i]; ?></td>
    <td align="center"><?php echo $amt[$i]; ?></td>
  </tr>
 
  <?php 
  $total+=$dep[$i]+$prz[$i];
  $total1+=$amt[$i]; 
  $a++;
  } 
 ?>
 
 
 <?php if($_POST['cardpercamt']>0)
 {
     ?>
      <td colspan="6" align="right"></td>
 <td colspan="3" align="right"> <b>Card 2 % &nbsp; :&nbsp;</b><b><?php echo $_POST['cardpercamt']; ?></b></td>
<?php
 }
 
 
 ?>
 
 <tr>
<?php 
    
if($commis=="%")
{
$p=round($total1*($comm/100.0));
$sum=$total1-$p;
}
else
{
$p=$comm;
$sum=$total1-$p;
}
$famt=$total1-$p;
$ap= ($total1+$_POST['cardpercamt'])-$pamount;
///echo $sum."/".$comm."/".$commis;
    $t4=mysql_query("update `phppos_rent`  set amount='".$famt."',rent_amount='".$total1."',total_comm='".$p."' where bill_id='".$rowordno[0]."'");
?>
 <td colspan="3" align="left"><b> Bill Made by : </b><?php echo $_POST['bill_by']; ?></td>
 <td colspan="3" align="right"><b> Total Qty : </b><?php echo $qty1; ?></td>
 <td colspan="3" align="center"> <b>Total Rent &nbsp; :&nbsp;</b><b><?php echo $total1+$_POST['cardpercamt']; ?></b></td>
 </tr>
 
 <tr>
    <td colspan="2.8" align="left"><b> Mode of Payment :  </b><?php echo $qty1; ?></td>
    <td colspan="2.5" align="right"><b> Deposit : </b><?php echo $paid; ?></td>
    <td colspan="3" align="center"> <b>Paid Amount :</b><b><?php echo $pamount; ?></b></td>
    <td colspan="3" align="center"> <b>Balance : </b><b><?php echo $ap; ?></b></td>
 </tr>
 
 <tr>
    <td colspan="9"><b>Note : </b> <?php echo $_POST['note'];?></td>     
 </tr>
 
</table>
</font>

</td>
</tr>
     
</tr>



</table>

<div style="width:826px; margin:auto; padding-top: 30px; text-align: right; padding-bottom: 11px;">
    <p><b>SRI SHRINGARR FASHION STUDIO</b></p>
</div>

<div style="width:826px; margin:auto; text-align: right; padding: 40px;"> 
    <p><b>AUTH. SIGNATORY</b></p>
</div>



</div>
<br/><br/>
<div id="pageNavPosition"></div>
<center><a href="#" onclick='PrintDiv();'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../../application/views/reports/rent.php">Back</a></center>
<br><br>
<br><br>
</body>
</html><?php }
////if($t1 && $t2 && $t3 && $t4){
if($t1 && $t3 && $t4){
	mysql_query("COMMIT;");
	}
	else{
		mysql_query("ROLLBACK;");
		echo "<script> rollback(); </script>";
		}
	 ?>
	 <?php
	 
	 	$title ="Rent bill generated" ;

	 	//NOtification Code Start
	

include "nottest.php";

    //Notification Code End
	 
	 ?>
	 
	 