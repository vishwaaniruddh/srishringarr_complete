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

     $convert_date_From = strtotime($FromDt);
     $From_MonthName = date('F',$convert_date_From);
     $From_Month = date('m',$convert_date_From);
     
     $convert_date_To = strtotime($Todat);
     $From_ToName = date('F',$convert_date_To);
     $From_To = date('m',$convert_date_To);


if($FromDt<=$Todt){

?>
                       
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                        
                                    <tr>
                                        <th style="color:white"> </th>  
                                        <th>Visits</th>
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
$j=0; 
$No_of_paxTotal="0";
$No_of_CloseTotal="0";
$FoodAmtTotal="0";
$SoftBevAmtTotal="0";
$AlcoLiqTotal="0";
$No_of_MiscAmtTotal="0";
$revenuTotal="0";
$discountTotal="0";
$netRevenue5="0";
$disPer5="0";
 

	for($i= $From_Month;$i<=$From_To;$i++){
	$revenu1="";
	$disPer1="";
	$percent1="";
	$netRevenue1="";
	
 $q="SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt  ,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where   BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and MONTH(BillDate)='".$i."' ";
 $q1=mysqli_query($conn,$q);
 $f1=mysqli_fetch_array($q1);
   

$revenu1=$f1['FoodAmt']+$f1['SoftBevAmt']+$f1['IndianLiqAmt']+$f1['ImpLiqAmt']+$f1['No_of_MiscAmt'];
$discount1=$f1['FoodDiscAmt']+$f1['SoftBevDiscAmt']+$f1['IndianLiqDiscAmt']+$f1['ImpLiqDiscAmt']+$f1['MiscDiscAmt'];



 if($revenu1>0){
$percent1 = ($discount1*100)/$revenu1;
$disPer1 = number_format( $percent1 ) . '%';
     
 }

$netRevenue1 = $revenu1-$discount1;



$date = strtotime($FromDt);
$newDate = date("Y-m-d", strtotime("+$j month", $date));
++$j;
	
$date1 = strtotime($newDate);
$From_MonthNamenew = date('F',$date1);
    
?>

<tr>
    <td><b><?php echo $From_MonthNamenew;?></b></td>
    <td><?php  if($f1['No_of_Pax']!=""){echo $f1['No_of_Pax'];}else{echo "0";} ?></td>
	<td><?php  if($f1['No_of_paxClose']!=""){echo $f1['No_of_paxClose']; }else{echo "0";}?></td>
	<td><?php  if($f1['FoodAmt']!=""){echo $f1['FoodAmt']; }else{echo "0";}?></td>
	<td><?php  if($f1['SoftBevAmt']!=""){echo $f1['SoftBevAmt']; }else{echo "0";}?></td>
	<td><?php  if($f1['IndianLiqAmt']!=""){echo $f1['IndianLiqAmt']+$f1['ImpLiqAmt'];}else{echo "0";} ?></td>
	<td><?php  if($f1['No_of_MiscAmt']!=""){echo $f1['No_of_MiscAmt']; }else{echo "0";}?></td>
	<td><?php  if($revenu1!=""){echo $revenu1; }else{echo "0";}?></td>
	<td><?php  if($discount1!=""){echo $discount1; }else{echo "0";}?></td>
	<td><?php  if($netRevenue1!=""){echo $netRevenue1; }else{echo "0";}?></td>
	<td><?php  if($disPer1!=""){echo $disPer1;}else{echo "0";} ?></td>
    </tr>

				
 
         <?php 
         $No_of_paxTotal+=$f1['No_of_Pax'];
         $No_of_CloseTotal+=$f1['No_of_paxClose'];
         $FoodAmtTotal+=$f1['FoodAmt'];
         $SoftBevAmtTotal+=$f1['SoftBevAmt'];
         $AlcoLiqTotal+=$f1['IndianLiqAmt'];
         $No_of_MiscAmtTotal+=$f1['No_of_MiscAmt'];
         $revenuTotal+=$revenu1;
         $discountTotal+=$discount1;
         $netRevenue5+=$netRevenue1;
         $disPer5+=$disPer1;
         }?>
         
         			<tr>
    <td><b>Total</b></td>
    <td><?php echo $No_of_paxTotal; ?></td>
    <td><?php echo $No_of_CloseTotal; ?></td>
	<td><?php echo $FoodAmtTotal; ?></td>
	<td><?php echo $SoftBevAmtTotal; ?></td>
	<td><?php echo $AlcoLiqTotal; ?></td>
	<td><?php echo $No_of_MiscAmtTotal; ?></td>
	<td><?php echo $revenuTotal; ?></td>
	<td><?php echo $discountTotal; ?></td>
	<td><?php echo $netRevenue5; ?></td>
	<td><?php echo $disPer5. '%'; ?></td>
				</tr>
				
          </tbody>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Visits</th>
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
   
         
       <?php  }else { ?>                   
   <table id="example" class="table" style="width:100%">
                                    <tr>
                                        <th >Date Filter Not valid </th> 
                                    </tr>
                                    </table>


<?php
	}


	
  ?>
    
