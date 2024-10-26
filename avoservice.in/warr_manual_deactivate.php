<?php
include("access.php");
include('config.php');

$date=date('Y-m-d');
$exp=date('Y-m-d', strtotime("-1 days $date"));
//echo $exp."---".$date;

//die;

$qry=mysqli_query($con1,"select track_id from atm where cust_id in(41,40) and active='Y'");

$num=mysqli_num_rows($qry);

echo $num."<br>";
$cnt=1;
while($row1=mysqli_fetch_row($qry)) {

echo "<br> update site_assets set exp_date='".$exp."', status=0 where atmid='".$row1[0]."' ";

mysqli_query($con1,"update site_assets set exp_date='".$exp."', status=0 where atmid='".$row1[0]."'"); 
$insert=mysqli_query($con1,"update atm set active='N',expdt='".$exp."' where track_id = '".$row1[0]."'");
    

//mysqli_query($con1,"update site_assets set exp_date='".$exp."' where site_ass_id='".$row[0]."'"); 
//mysqli_query($con1,"update atm set active='Y', expdt='".$exp."' where track_id='".$row[3]."'"); 



$cnt++;
} 




/* $qry=mysqli_query($con1,"select track_id from atm where bank_name like'Assam Gramin%'");

while($row=mysqli_fetch_row($qry)) {

 echo "<br>update site_assets set status='0' where atmid = '".$row[0]."'";

$asstqry=mysqli_query($con1,"update site_assets set status='0' where atmid = '".$row[0]."'"); 

$insert=mysqli_query($con1,"update atm set active='N' where track_id = '".$row[0]."'");

}

$qry=mysqli_query($con1,"select * from atm where so_id=100005 ");


while($row=mysqli_fetch_row($qry)) {
    
$asstqry=mysqli_query($con1,"select * from site_assets where atmid='".$row[0]."'");

if(mysqli_num_rows($asstqry)==0){
 
 echo "<br>insert into site_assets set cust_id='".$row[2]."', po='".$row[11]."', assets_name='UPS',assets_spec='1',valid='36,months', quantity='1',atmid='".$row[0]."',serialno='1',type='Ware',rate='0',status='1',callid=0, so_id='100005', atm_trackid='".$row[0]."' ,start_date='2023-02-11' ,po_date='2023-01-11' ,exp_date='2025-02-11' ,alert_id=0 ";   
    
$insert=mysqli_query($con1,"insert into site_assets set cust_id='".$row[2]."', po='".$row[11]."', assets_name='UPS',assets_spec='1',valid='36,months', quantity='1',atmid='".$row[0]."',serialno='1',type='Ware',rate='0',status='1',callid=0, so_id='100005', atm_trackid='".$row[0]."' ,start_date='2023-02-11' ,po_date='2023-01-11' ,exp_date='2025-02-11' ,alert_id=0 ");    

$insert1=mysqli_query($con1,"insert into site_assets set cust_id='".$row[2]."', po='".$row[11]."', assets_name='UPS',assets_spec='49',valid='24,months', quantity='1',atmid='".$row[0]."',serialno='1',type='Ware',rate='0',status='1',callid=0, so_id='100005', atm_trackid='".$row[0]."' ,start_date='2023-02-11' ,po_date='2023-01-11' ,exp_date='2025-02-11' ,alert_id=0 "); 

$insert2=mysqli_query($con1,"insert into site_assets set cust_id='".$row[2]."', po='".$row[11]."', assets_name='Battery',assets_spec='6',valid='24,months', quantity='1',atmid='".$row[0]."',serialno='1',type='Ware',rate='0',status='1',callid=0, so_id='100005', atm_trackid='".$row[0]."' ,start_date='2023-02-11' ,po_date='2023-01-11' ,exp_date='2025-02-11' ,alert_id=0 "); 

$update=mysqli_query($con1,"update atm set active='Y' where track_id='".$row[0]."'");
    
}
else echo "Alreay Done";

} */

mysqli_close($con);
mysqli_close($con2);    

?>
