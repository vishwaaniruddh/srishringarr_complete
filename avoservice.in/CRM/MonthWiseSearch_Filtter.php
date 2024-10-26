<?php
include('config.php');

$FromDat=$_POST['FromDt'];
$Todat=$_POST['Todt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));

$q="SELECT a.GenerateMember_Id,b.FirstName,b.LastName,a.MembershipDetails_Level,DATE_ADD(a.entryDate, INTERVAL 1 YEAR),b.MobileNumber,a.Primary_DateOfBirth,a.Primary_Anniversary FROM `Members` a JOIN Leads_table b on a.Static_LeadID=b.Lead_id WHERE a.Sample=0 and a.canceledMember=0";
if($FromDt!="" and $Todt!=""){
    $q.=" and DATE(a.entryDate) BETWEEN '".$FromDt."' AND '".$Todt."'";
}

//echo $q;
$QuryGetLead=mysqli_query($conn,$q);

$array=array();

while($_row=mysqli_fetch_array($QuryGetLead)){
   
     if($_row[3]=="1"){
         $lev="Orchid First";
     }else if($_row[3]=="2"){
         $lev="Orchid Gold";
     }
     else if($_row[3]=="3"){
         $lev="Orchid Platinum";
     }
    
    $expiryDt=date('d-m-Y', strtotime($_row[4]));

  $birth=$_row[6];
   $birthDt = date("d-M", strtotime($birth));
 
$Anniver=$_row[7];
$AnniverDt = date("d-M", strtotime($Anniver));
    
    
 $array[]= ['GenerateMember_Id'=>$_row[0],'FirstName'=>$_row[1],'LastName'=>$_row[2],'MembershipDetails_Level'=>$lev,'Expirydate'=>$expiryDt,'MobileNumber'=>$_row[5],'Primary_DateOfBirth'=>$birthDt,'Primary_Anniversary'=>$AnniverDt,'Qry'=>$q];
}
echo json_encode($array);




?>