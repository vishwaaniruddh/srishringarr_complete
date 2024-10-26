<?php
include('../config.php');


$login_id = $_GET['login_id']; /// Check It is engg id or login id or username. If username get the srno from login and from it engg_id from area_engg table
$login_id = '2909';
$qry2 = mysqli_query($con1, "select engg_id from area_engg where loginid='" . $login_id . "'");
if(mysqli_num_rows($qry2)>0){
    $ro = mysqli_fetch_row($qry2);
    $engg_id=$ro[0];
    //$engg_id=194; // Test engineer
    
    $sql = "select * from alert where branch_id <>'' and close_date >= '2022-10-18 00:00:01'";
    $sql.=" and alert_type = 'new'";
    $sql.=" and alert_id in (select alert_id from alert_delegation where engineer='".$engg_id."')";
    $sql.=" and (snap_file is null or snap_file='')";
    $table=mysqli_query($con1,$sql);
  
    
    $data_array = array();
    if(mysqli_num_rows($table)>0) {
        while($row= mysqli_fetch_row($table))
        {
            //echo $row[2];die;
            $newdata = array();
            $atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
        	$atmrow=mysqli_fetch_row($atm);
        	
        	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
        	$custrow=mysqli_fetch_row($qry);
        	
 
            $complaint = $row[25]; 
            $alert_id = $row[0]; 
            $newdata['complaint_id'] = $complaint;
            $newdata['alert_id'] = $alert_id;
            
            //=======added by Boopathy==
            $newdata['site_id'] = $atmrow[0];
            $newdata['customer'] = $custrow[0];
            $newdata['enduser'] = $row[3];
            $newdata['address'] = $row[5];
            array_push($data_array,$newdata);
          
        }
        
        $array = array(['code'=>200,'data'=>$data_array]);
    }else{
        $array = array(['code'=>201]);
    }
}else{
    $array = array(['code'=>202]);
}
echo json_encode($array);

//=====Result only one row in the array while this engineer has 2 alert_ids - PLEASE CHECK

//  App Display Complaint_id , Site Id, Customer Name, End User Name, Address, Add Snap*** 
?>