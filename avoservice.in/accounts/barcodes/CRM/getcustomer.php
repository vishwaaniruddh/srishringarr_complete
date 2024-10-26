<?php

session_start();
  
include('config.php');

$cname=$_GET['cname'];

if($cname=='sales'){
      
              $qry="select * from phppos_amc where `atype`='sales'";
			  
}
else { 
    $qry="select * from phppos_amc  where `atype`='services' or `atype`='service'";
    }
              $res=mysql_query($qry);                
              $num=mysql_num_rows($res);
		  
$out="Select Customer Name:<select name='cust' id='cust' onchange='cust()'>
<option value='0'>select </option>";

 
               while ($row1=mysql_fetch_row($res)) 
                {
					
                 $id = $row1[0]; 
                 //$pid=mysql_result($res,$i,"person_id");
                 if($cname=='sales')
                 { //echo "select * from `phppos_service` where `id`='$pid' ";
                 $qry1=mysql_query("SELECT * FROM `phppos_service` WHERE `id`='".$row1[1]."' ");
                 $row=mysql_fetch_row($qry1);
                 $name = $row[2];
                 }
                 else
                 {
                 $qry1=mysql_query("select * from `phppos_service1` where `id`='".$row1[1]."' ");
                 $row=mysql_fetch_row($qry1);
                 $name = $row[2];
                   }
                  
$out=$out."<option value=".$id.">".$name."</option>";
 // $out=$out."=".$ccode;
            }
$out=$out."</select>";


echo $out;  
?>