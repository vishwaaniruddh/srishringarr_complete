<?php
include('config.php');

$Ab_Filtter=$_POST['Ab_Filtter'];
$cancel_Filtter=$_POST['cancel_Filtter'];
$FromDat=$_POST['FromDt'];
$Todat=$_POST['Todt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));

$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));


//$q="select * from Members where 1=1 ";
$q="SELECT * FROM `Members` where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5' or Status='8')";
$q1="SELECT * FROM `suplimentoryMember` where 1";

if($cancel_Filtter=="1" ){
   $q.=" and  canceledMember='1' "; 
}

if($Ab_Filtter=="DSR" and $FromDt!="" and $Todt!=""){
    $q.=" and DATE(entryDate) BETWEEN '".$FromDt."' AND '".$Todt."' or date(CancelationDate) BETWEEN '".$FromDt."' AND '".$Todt."' order by entryDate";
    $q1.=" and DATE(entryDate) BETWEEN '".$FromDt."' AND '".$Todt."' order by entryDate";
}

if($Ab_Filtter=="Anniversary" and $FromDt!="" and $Todt!=""){
   $q.=" and Primary_Anniversary   BETWEEN '".$FromDt."' AND '".$Todt."' order by entryDate"; 
}


if($Ab_Filtter=="Birthday" and $FromDt!="" and $Todt!=""){
   $q.=" and  Primary_DateOfBirth BETWEEN '".$FromDt."' AND '".$Todt."' order by entryDate"; 
}






$QuryGetLead=mysqli_query($conn,$q);
$QuryGetsup=mysqli_query($conn,$q1);

$array=array();

while($_row=mysqli_fetch_array($QuryGetLead)){
    
    	$sql2="select * from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
	
	
	$sql3="SELECT * FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);
	
	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
	
	
	$sql5="SELECT state FROM `state` where state_id='".$sql2fetch['State']."' ";
	$runsql5=mysqli_query($conn,$sql5);
	$sql5fetch=mysqli_fetch_array($runsql5);
	
	
	$dd=date('Y-m-d', strtotime($_row['entryDate']));
		$ddd=date('d-m-Y', strtotime($_row['entryDate']));
		$Primary_DateOfBirth=date('d-m-Y', strtotime($_row['Primary_DateOfBirth']));
		$Primary_Anniversary=date('d-m-Y', strtotime($_row['Primary_Anniversary']));
		

	 $d = strtotime("+".$sql4fetch['Expiry_month']." months",strtotime($dd));
     // $R=  date("d-m-Y",$d);
    
    $formattedValue = date("F, Y", $d);
$R=$formattedValue;
   if($_row['canceledMember']==1){ $cnel= "Cancel";}else{$cnel= "";}
    
    
    
 $array[]= ['Primary_nameOnTheCard'=>$_row['Primary_nameOnTheCard'],'Type'=>'Primary','level_name'=>$sql3fetch['level_name'],'GenerateMember_Id'=>$_row['GenerateMember_Id'],'R'=>$R,'booklet_Series'=>$_row['booklet_Series'],'TypeNR'=>'New','MembershipDts_PaymentMode'=>$_row['MembershipDts_PaymentMode'],'MembershipDts_InstrumentNumber'=>$_row['MembershipDts_InstrumentNumber'],'Member_bankName'=>$_row['Member_bankName'],'Recipt'=>'','MembershipDts_NetPayment'=>$_row['MembershipDts_NetPayment'],'MembershipDts_GST'=>$_row['MembershipDts_GST'],'MembershipDts_GrossTotal'=>$_row['MembershipDts_GrossTotal'],'MemshipDts_Remarks'=>$_row['MemshipDts_Remarks'],'entryDate'=>$ddd,'Primary_Anniversary'=>$Primary_Anniversary,'Primary_DateOfBirth'=>$Primary_DateOfBirth,'Qry'=>$q,'FromDat'=>$FromDt1,'Todt'=>$Todt1,'cancel_Filtter'=>$cancel_Filtter,'canceledMember'=>$cnel];
}

while($_row=mysqli_fetch_array($QuryGetsup))
			{		
			    
			    $array[]= ['Primary_nameOnTheCard'=>$_row['NameOnTheCard'],'Type'=>'Supplementary','level_name'=>'','GenerateMember_Id'=>$_row['Memberid'],'R'=>'','booklet_Series'=>'','TypeNR'=>'SUP','MembershipDts_PaymentMode'=>$_row['PaymentMode'],'MembershipDts_InstrumentNumber'=>'','Member_bankName'=>'','Recipt'=>'','MembershipDts_NetPayment'=>$_row['Amount'],'MembershipDts_GST'=>$_row['Amount']*0.18,'MembershipDts_GrossTotal'=>$_row['Amount']*1.18,'MemshipDts_Remarks'=>'','entryDate'=>$_row['entryDate'],'Primary_Anniversary'=>'','Primary_DateOfBirth'=>$_row['DateOfBirth'],'Qry'=>$q1,'FromDat'=>$FromDt1,'Todt'=>$Todt1,'cancel_Filtter'=>'','canceledMember'=>''];
		                         	
			}
echo json_encode($array);




?>