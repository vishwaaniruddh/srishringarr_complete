<?php
ini_set( "display_errors", 0);
include('config.php');

       $id=$_GET['cid'];

$sumpd=0;
$bal=0;

/////count total retun
$qry1="SELECT * FROM  `approval` where cust_id='$id' ";
$res1=mysql_query($qry1);                
$num1=mysql_num_rows($res1);
while($row1=mysql_fetch_row($res1)){

$pd=0;
 $s1=0;			

$ba=0;
$na=0;	
$ra=0;
$qry2="SELECT paid_amount FROM  `approval` where bill_id ='$row1[0]'";
$res2=mysql_query($qry2);                
$num2=mysql_num_rows($res2);
$row2=mysql_fetch_row($res2);
			
$qry3="SELECT sum(`amount`) FROM `approval_detail` WHERE bill_id ='$row1[0]'";
$res3=mysql_query($qry3);
$row3=mysql_fetch_row($res3);
$a=0;	
$a1=0;
$qry4="SELECT *  FROM `approval_detail` WHERE bill_id ='$row1[0]'";
$res4=mysql_query($qry4);

while($row4=mysql_fetch_row($res4)){

$a=round(($row4[7]/$row4[2])*$row4[4]);
$a1+=$a;
//echo $row4[7]."/".$row4[2].")*".$row4[4]."=".$a1."<br/>";

//echo "c-".$row[11]."pd-".$row2[0]."bll-".$row1[0]."/".$a1."k<br/>";
$ba+=$row4[7];
}

$pd=$row[4];
$na=$ba;
$s1=$ba-$a1;
//echo "cust=".$row[11]."paidamt=".$pd."bal amt=".$na."return".$a1."net amt=".$s1."<br/>";
$s=$row3[0]-$row2[0];

$bal+=$s1; 
}
 $qry41="SELECT sum(amount) FROM `paid_amount` WHERE `bill_id`='$id'";
$res41=mysql_query($qry41);
$num411=mysql_num_rows($res41);
$row41=mysql_fetch_row($res41);
///echo $id."/".$num411."<br/>";

 $qry42="SELECT SUM( paid_amount ) FROM  `approval` WHERE  `cust_id` ='$id'";
$res42=mysql_query($qry42);
$row42=mysql_fetch_row($res42);
if($num41==0 || $num41=="") { $pd11=$row42[0]; }else{  $pd11=$row41[0]; }
$pp=$bal-$pd11;
echo $pd11."&&".$pp;				 				 
?>
