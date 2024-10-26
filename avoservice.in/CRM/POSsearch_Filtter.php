<?php
include('config.php');

//$Ab_Filtter=$_POST['Ab_Filtter'];
$FromDat=$_POST['FromDt'];
$Todat=$_POST['Todt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));

 $array=array();
$PQry =mysqli_query($conn,"select City from POS_table where 1=1 GROUP BY City ");
while($fQry =mysqli_fetch_array($PQry)){
 
                $q=" SELECT City,count(No_of_Pax) as No_of_Sales,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where City='".$fQry[0]."' ";
                if($FromDat!="" and $Todat!=""){
                    $q.=" and BillDate BETWEEN '".$FromDt."' AND '".$Todt."'";
                }
           
            $QuryGetLead=mysqli_query($conn,$q);
            $_row=mysqli_fetch_array($QuryGetLead);
            if(mysqli_num_rows($QuryGetLead)>0){
             $array[]= ['City'=>$_row['City'],'No_of_Sales'=>$_row['No_of_Sales'],'No_of_Pax'=>$_row['No_of_Pax'],'No_of_paxClose'=>$_row['No_of_paxClose'],'FoodAmt'=>$_row['FoodAmt'],'FoodDiscAmt'=>$_row['FoodDiscAmt'],'SoftBevAmt'=>$_row['SoftBevAmt'],'SoftBevDiscAmt'=>$_row['SoftBevDiscAmt'],'No_of_paxClose'=>$_row['No_of_paxClose'],'IndianLiqAmt'=>$_row['IndianLiqAmt'],'IndianLiqDiscAmt'=>$_row['IndianLiqDiscAmt'],'ImpLiqAmt'=>$_row['ImpLiqAmt'],'ImpLiqDiscAmt'=>$_row['ImpLiqDiscAmt'],'NettAmount'=>$_row['NettAmount']];
            }
    
}

             $q=" SELECT City,count(No_of_Pax) as No_of_Sales,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where 1 ";
                if($FromDat!="" and $Todat!=""){
                    $q.=" and BillDate BETWEEN '".$FromDt."' AND '".$Todt."'";
                }
           // echo $q;
            $QuryGetLead=mysqli_query($conn,$q);
            $_row=mysqli_fetch_array($QuryGetLead);
            if(mysqli_num_rows($QuryGetLead)>0){
             $array[]= ['City'=>'Grand Total','No_of_Sales'=>$_row['No_of_Sales'],'No_of_Pax'=>$_row['No_of_Pax'],'No_of_paxClose'=>$_row['No_of_paxClose'],'FoodAmt'=>$_row['FoodAmt'],'FoodDiscAmt'=>$_row['FoodDiscAmt'],'SoftBevAmt'=>$_row['SoftBevAmt'],'SoftBevDiscAmt'=>$_row['SoftBevDiscAmt'],'No_of_paxClose'=>$_row['No_of_paxClose'],'IndianLiqAmt'=>$_row['IndianLiqAmt'],'IndianLiqDiscAmt'=>$_row['IndianLiqDiscAmt'],'ImpLiqAmt'=>$_row['ImpLiqAmt'],'ImpLiqDiscAmt'=>$_row['ImpLiqDiscAmt'],'NettAmount'=>$_row['NettAmount']];
            }


echo json_encode($array);




?>