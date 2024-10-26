<?php
include('config.php');
//include_once('class_files/filter.php');

$username = $_POST['uname'];
$password = $_POST['password'];

//$sel=new filter();
//$result=$sel->filter_by('localhost','site','site','atm_site',array("*"),"login",array("username","password"),array($username,$password),"","");
//echo $username." /".$password;
//$sel_obj=new select();
//$result=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"login","email_id",$username,array(""),"y","city","a");

$result = mysqli_query($con1,"select * from login where username='$username' and password='$password' ");

if(mysqli_num_rows($result)>0)
   {
   $row=mysqli_fetch_row($result);   
   session_start();
   $_SESSION['user']=$username;
   
//   if($row[2]!=''){
//         $_SESSION['branch']=$row[2];    
//   }else {
//         $_SESSION['branch']='';
//   }
   $_SESSION['branch']=$row[2];    
//   if($row[3]!=''){
//         $_SESSION['designation']=$row[3];
//   }else{
//         $_SESSION['designation']='';   
//   }
    $_SESSION['designation']=$row[3];

if($row[3]=="Engineer") { header("location: eng_alert.php"); }
else if($row[3]=="call_centre") { header("location: view_callalert.php"); }
else{ header("location: view_alert.php?br=".$row[2]); }
   }
else
   header("location: index.php");
?>