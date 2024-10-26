<?php
include("config.php");


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

$qry=mysqli_query($con1,"Insert into factory_entries (`cust_id`,`agent_id`,`material`,`qty`,`aqty`, `pi_so_no`,`bookdate`,`invoice`,`rate` ,`del_term`, `port`, `factory`, `payterm` , `blno`, `loaddate`, `vess_date`, `eta`, `splterm`, `status`, `docstatus`) Values('".$cust."','".$agent."','".$material."','".$qty."','".$aqty."','".$so."', '".$bookdate."','".$inv."','".$rate."','".$terms."', '".$port."','".$factory."','".$payterm."','".$blno."','".$loaddate."','".$vesseldate."','".$eta."','".$splterm."','".$status."','".$docstatus."')");


if($qry)  { ?>
    <script type="text/javascript">
alert("Details are added Successfully !!");

		window.location.href="view_entries.php"; </script> 
<?
	
} else ?>

   <script type="text/javascript">
alert("Something went wrong or Some illegal charecters!!");

		window.location.href="add_entry.php"; </script> 
