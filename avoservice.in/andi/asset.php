<? include("db_conn.php");

$atmid=$_GET['atmid'];
$site=$_GET['sitestatus'];
$responce=[];
$data=[];


if ($site== 'Warranty') {

$qry=mysqli_query($conapp,"select assets_name, assets_spec, quantity, exp_date from site_assets where status=1 and atmid = (select track_id from atm where atm_id='".$atmid."')");


while ($atm=mysqli_fetch_row($qry)) {
$ass_spec=mysqli_query($conapp,"select name from assets_specification where ass_spc_id='".$atm[1]."'");
$aname=mysqli_fetch_array($ass_spec);

// $data=$atm[0].",".$aname[0].",".$atm[2].",".$atm[3];
$data['assets_name']=$atm[0];
$data['assets_specification']=$aname[0];
$data['qty']=$atm[2];
$data['exp_date']=$atm[3];
array_push($responce,$data);


}

}elseif($site=='AMC'){

$amcqry=mysqli_query($conapp,"select assets_name, assetspecid, quantity from amcassets where siteid = (select AMCID from Amc where ATMID='".$atmid."')");

$amc=mysqli_fetch_row($amcqry);

$amc[3]="Within AMC";
 
// $data=$amc[0].",".$amc[1].",".$amc[2].",".$amc[3];    

$data['assets_name']=$amc[0];
$data['assets_specification']=$amc[1];
$data['qty']=$amc[2];
$data['exp_date']=$amc[3];
array_push($responce,$data);
} else {

$data= "Temp Site";
array_push($responce,$data);
}

echo json_encode($responce);
?>
