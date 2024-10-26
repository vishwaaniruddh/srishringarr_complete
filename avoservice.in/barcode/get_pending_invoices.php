<?php
error_reporting(-1);
include("../config.php");

$srno = $_GET['id'];

$result = mysqli_query($con1, "select * from login where srno='".$srno."'");

if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_row($result);
    $str = array();
    if($row[4]==7 && ($row[3] !='' or $row[3] !=0 )) {

        $sql1 = mysqli_query($con1, "Select * from so_order where status=1 and avo_branch='".$row[3]."'");
      
        while ($so_det = mysqli_fetch_row($sql1)) {
                
                $atmqry = mysqli_query($con1, "select * from demo_atm where so_id='".$so_det[1]."' ");
                $atm = mysqli_fetch_row($atmqry);
                   
                
                
                $cl = mysqli_query($con1, "select cust_id,cust_name from customer where cust_id='".$so_det[14]."' ");
                $cust_name = "";
                if (mysqli_num_rows($cl) > 0) {
                    $clro = mysqli_fetch_row($cl);
                    $cust_name = $clro[1];
                }
                $brqry = mysqli_query($con1, "select id,name from avo_branch where id='".$so_det[13]."' ");
                $br_name = "";
                if (mysqli_num_rows($brqry) > 0) {
                    $brro = mysqli_fetch_row($brqry);
                    $br_name = $brro[1];
                }

               
    $str[] = array('so_id' => $so_det[1], 'siteid' => htmlspecialchars($atm[1]), 'invno' => htmlspecialchars($so_det[2]), 'branch' => $br_name, 'cust' => $cust_name, 'enduser' => $atm[6], 'address' => htmlspecialchars($atm[11]) );
            }
        
       }
       $data = ['code'=>200,'data'=>$str];
        
    } else {
        //====Login failed
        $str = -1;
        $data = ['code'=>201];
    }
    
    echo json_encode($data);
    