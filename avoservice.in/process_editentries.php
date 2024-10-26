<?php
include("config.php");

 $id=$_POST['id'];

 $agent=$_POST['agent'];
 $cust=$_POST['cust'];
 $material=$_POST['material'];
 $qty=$_POST['qty'];
 $aqty=$_POST['aqty'];
 
 $so=$_POST['so'];
 $bookdate=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['date'])));
 
 $inv=$_POST['inv'];
 $rate=$_POST['rate'];
 $terms=mysqli_real_escape_string($_POST['terms']);
 $port=$_POST['port'];
 $factory=$_POST['factory'];
 $payterm=$_POST['payterm'];
 $blno=$_POST['blno'];
 $loaddate=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['ldate'])));
  $vesseldate=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['vdate'])));
 $eta=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['eta'])));
 
 $splterm=mysqli_real_escape_string($_POST['splterm']);
 $status=$_POST['status'];
 $docstatus=$_POST['docstatus'];

$update="update factory_entries set `cust_id`='".$cust."',`agent_id`='".$agent."' ,`material`='".$material."',`qty`='".$qty."', `aqty`='".$aqty."', `pi_so_no`='".$so."',`bookdate` ='".$bookdate."',`invoice` ='".$inv."',`rate`='".$rate."',`del_term` ='".$terms."', `port` ='".$port."', `factory` ='".$factory."', `payterm` ='".$payterm."' , `blno` ='".$blno."', `loaddate` ='".$loaddate."', `vess_date` ='".$vesseldate."', `eta` ='".$eta."', `splterm` ='".$splterm."', `status` ='".$status."', `docstatus` ='".$docstatus."' where id='".$id."'";
//echo $update;
$qry=mysqli_query($con1,$update);

if($qry)  { ?>
    <script type="text/javascript">
alert("Details are added Successfully !!");

		window.location.href="view_entries.php"; </script> 
<?
	
} else ?>

   <script type="text/javascript">
alert("Something went wrong or Some illegal charecters!!");

	window.location:href='history.back()'; </script> 
