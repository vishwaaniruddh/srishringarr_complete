<?php session_start();
ini_set('memory_limit', '-1');
include('config.php');

$FromDat=$_POST['FromDt'];
$Todat=$_POST['ToDt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));

 $array=array();
?>
                       
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                        
                                    <tr>
                                        <th style="color:white"> </th>    
                                        <th>Covers</th>                                      
                                        <th>Food</th>
                                        <th>Soft Beverages</th>
                                        <th>Alcoholic Beverages</th>
                                        <th>Misc. Rev</th>
                                        <th>Gross Revenue</th> 
                                        <th>Discount</th>
                                        <th>Net Revenue</th> 
                                        <th>Discount %</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                                       
                                        
                                        
                                        
                                        
                                        	<?php 
	
	
	$q1=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt  ,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and BillDate BETWEEN '".$FromDt."' AND '".$Todt."'");
	$q2=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and BillDate BETWEEN '".$FromDt."' AND '".$Todt."'");
	$q3=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and BillDate BETWEEN '".$FromDt."' AND '".$Todt."'");
	$q4=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '00:00:00' and '06:59:59' and BillDate BETWEEN '".$FromDt."' AND '".$Todt."'");
//	echo "SELECT count(MiscAmt) as No_of_MiscAmt,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where Time BETWEEN '07:00' and '11:00' and BillDate BETWEEN '".$FromDt."' AND '".$Todt."'";
    $f1=mysqli_fetch_array($q1);
    $f2=mysqli_fetch_array($q2);
    $f3=mysqli_fetch_array($q3);
    $f4=mysqli_fetch_array($q4);


$revenu1=$f1['FoodAmt']+$f1['SoftBevAmt']+$f1['IndianLiqAmt']+$f1['ImpLiqAmt']+$f1['No_of_MiscAmt'];
$revenu2=$f2['FoodAmt']+$f2['SoftBevAmt']+$f2['IndianLiqAmt']+$f2['ImpLiqAmt']+$f2['No_of_MiscAmt'];
$revenu3=$f3['FoodAmt']+$f3['SoftBevAmt']+$f3['IndianLiqAmt']+$f3['ImpLiqAmt']+$f3['No_of_MiscAmt'];
$revenu4=$f4['FoodAmt']+$f4['SoftBevAmt']+$f4['IndianLiqAmt']+$f4['ImpLiqAmt']+$f4['No_of_MiscAmt'];

$discount1=$f1['FoodDiscAmt']+$f1['SoftBevDiscAmt']+$f1['IndianLiqDiscAmt']+$f1['ImpLiqDiscAmt']+$f1['MiscDiscAmt'];
$discount2=$f2['FoodDiscAmt']+$f2['SoftBevDiscAmt']+$f2['IndianLiqDiscAmt']+$f2['ImpLiqDiscAmt']+$f2['MiscDiscAmt'];
$discount3=$f3['FoodDiscAmt']+$f3['SoftBevDiscAmt']+$f3['IndianLiqDiscAmt']+$f3['ImpLiqDiscAmt']+$f3['MiscDiscAmt'];
$discount4=$f4['FoodDiscAmt']+$f4['SoftBevDiscAmt']+$f4['IndianLiqDiscAmt']+$f4['ImpLiqDiscAmt']+$f4['MiscDiscAmt'];



$No_of_CloseTotal=$f1['No_of_paxClose']+$f2['No_of_paxClose']+$f3['No_of_paxClose']+$f4['No_of_paxClose'];
$FoodAmtTotal=$f1['FoodAmt']+$f2['FoodAmt']+$f3['FoodAmt']+$f4['FoodAmt'];
$SoftBevAmtTotal=$f1['SoftBevAmt']+$f2['SoftBevAmt']+$f3['SoftBevAmt']+$f4['SoftBevAmt'];
$No_of_MiscAmtTotal=$f1['No_of_MiscAmt']+$f2['No_of_MiscAmt']+$f3['No_of_MiscAmt']+$f4['No_of_MiscAmt'];
$AlcoLiqTotal=$f1['IndianLiqAmt']+$f1['ImpLiqAmt']+$f2['IndianLiqAmt']+$f2['ImpLiqAmt']+$f3['IndianLiqAmt']+$f3['ImpLiqAmt']+$f4['IndianLiqAmt']+$f4['ImpLiqAmt'];
$revenuTotal=$revenu1+$revenu2+$revenu3+$revenu4;
$discountTotal=$discount1+$discount2+$discount3+$discount4;


 if($revenu1>0){
$percent1 = ($discount1*100)/$revenu1;
$disPer1 = number_format( $percent1 ) . '%';}

 if($revenu2>0){
$percent2 = ($discount2*100)/$revenu2;
$disPer2 = number_format( $percent2 ) . '%';}

 if($revenu3>0){
$percent3 = ($discount3*100)/$revenu3;
$disPer3 = number_format( $percent3 ) . '%';}

 if($revenu4>0){
$percent4 = ($discount4*100)/$revenu4;
$disPer4 = number_format( $percent4 ) . '%';}

 if($revenuTotal>0){
$percent5 = ($discountTotal*100)/$revenuTotal;
$disPer5 = number_format( $percent5 ) . '%';}



$netRevenue1 = $revenu1-$discount1;
$netRevenue2 = $revenu2-$discount2;
$netRevenue3 = $revenu3-$discount3;
$netRevenue4 = $revenu4-$discount4;
$netRevenue5 = $revenuTotal-$discountTotal;



	
  ?>
    <tr>
    <td><b>BREAKFAST</b></td>
	<td><?php echo $f1['No_of_paxClose']; ?></td>
	<td><?php echo $f1['FoodAmt']; ?></td>
	<td><?php echo $f1['SoftBevAmt']; ?></td>
	<td><?php echo $f1['IndianLiqAmt']+$f1['ImpLiqAmt']; ?></td>
	<td><?php echo $f1['No_of_MiscAmt']; ?></td>
	<td><?php echo $revenu1; ?></td>
	<td><?php echo $discount1; ?></td>
	<td><?php echo $netRevenue1; ?></td>
	<td><?php echo $disPer1; ?></td>
    </tr>
	<tr>
    <td><b>LUNCH</b></td>
	<td><?php echo $f2['No_of_paxClose']; ?></td>
	<td><?php echo $f2['FoodAmt']; ?></td>
	<td><?php echo $f2['SoftBevAmt']; ?></td>
	<td><?php echo $f2['IndianLiqAmt']+$f2['ImpLiqAmt']; ?></td>
	<td><?php echo $f2['No_of_MiscAmt']; ?></td>
	<td><?php echo $revenu2; ?></td>
	<td><?php echo $discount2; ?></td>
	<td><?php echo $netRevenue2; ?></td>
	<td><?php echo $disPer2; ?></td>
				</tr>
				<tr>
    <td><b>DINNER</b></td>
	<td><?php echo $f3['No_of_paxClose']; ?></td>
	<td><?php echo $f3['FoodAmt']; ?></td>
	<td><?php echo $f3['SoftBevAmt']; ?></td>
	<td><?php echo $f3['IndianLiqAmt']+$f3['ImpLiqAmt']; ?></td>
	<td><?php echo $f3['No_of_MiscAmt']; ?></td>
	<td><?php echo $revenu3; ?></td>
	<td><?php echo $discount3; ?></td>
	<td><?php echo $netRevenue3; ?></td>
	<td><?php echo $disPer3; ?></td>
				</tr>
					<tr>
    <td><b>MISC</b></td>
    <td><?php echo $f4['No_of_paxClose']; ?></td>
	<td><?php echo $f4['FoodAmt']; ?></td>
	<td><?php echo $SoftBevAmtTotal; ?></td>
	<td><?php echo $f4['IndianLiqAmt']+$f4['ImpLiqAmt']; ?></td>
	<td><?php echo $f4['No_of_MiscAmt']; ?></td>
	<td><?php echo $revenu4; ?></td>
	<td><?php echo $discount4; ?></td>
	<td><?php echo $netRevenue4; ?></td>
	<td><?php echo $disPer4; ?></td>
				</tr>
				<tr>
    <td><b>Total</b></td>
    <td><?php echo $No_of_CloseTotal; ?></td>
	<td><?php echo $FoodAmtTotal; ?></td>
	<td><?php echo $SoftBevAmtTotal; ?></td>
	<td><?php echo $AlcoLiqTotal; ?></td>
	<td><?php echo $No_of_MiscAmtTotal; ?></td>
	<td><?php echo $revenuTotal; ?></td>
	<td><?php echo $discountTotal; ?></td>
	<td><?php echo $netRevenue5; ?></td>
	<td><?php echo $disPer5; ?></td>
				</tr>
				
			
		
	
                                
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                       <th></th>    
                                        <th>Covers</th>                                      
                                        <th>Food</th>
                                        <th>Soft Beverages</th>
                                        <th>Alcoholic Beverages</th>
                                        <th>Misc. Rev</th>
                                        <th>Gross Revenue</th> 
                                        <th>Discount</th>
                                        <th>Net Revenue</th> 
                                        <th>Discount %</th>
                                       
                                    </tr>
                                    </tfoot>
                                </table>
   
             
             
    
                            
  
