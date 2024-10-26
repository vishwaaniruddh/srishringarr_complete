<?php session_start();
ini_set('memory_limit', '-1');
include('config.php');

$graph=$_POST['graph'];
$FromDat=$_POST['FromDt'];
$Todat=$_POST['Todt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));

 $data=array();
//=================== get month name and month in number ====
	 $convert_date_From = strtotime($FromDt);
     $From_MonthName = date('F',$convert_date_From);
     $From_Month = date('m',$convert_date_From);
     
     $convert_date_To = strtotime($Todat);
     $From_ToName = date('F',$convert_date_To);
     $From_To = date('m',$convert_date_To);
//===========================================================
if($graph=='graph1'){
	
 
                                        
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
	
	
 $q="SELECT sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where   BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and MONTH(BillDate)='".$i."' ";
 $q1=mysqli_query($conn,$q);
 $f1=mysqli_fetch_array($q1);
   
  if($f1['No_of_Pax']!=""){
      $Visits=$f1['No_of_Pax'];
      $Cover=$f1['No_of_paxClose'];
  }else{
      $Visits="0";
	$Cover="0";
  }

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
    

	

    $data[]= ['MonthName'=>$From_MonthNamenew,'Visits'=>$Visits,'Cover'=>$Cover];

	}
	    
	}

else if($graph=='graph2'){
    
                                        
$j=0; 

 	for($i= $From_Month;$i<=$From_To;$i++){
	
	
	$q1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and MONTH(BillDate)='".$i."' ");
	$q2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and MONTH(BillDate)='".$i."' ");
	$q3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and MONTH(BillDate)='".$i."' ");

    $f1=mysqli_fetch_array($q1);
    $f2=mysqli_fetch_array($q2);
    $f3=mysqli_fetch_array($q3);
	
   
  if($f1['No_of_paxClose']!=""){$Breakfast=$f1['No_of_paxClose'];}else{$Breakfast="0";}
  if($f2['No_of_paxClose']!=""){$Lunch=$f2['No_of_paxClose'];}else{$Lunch="0";}
  if($f3['No_of_paxClose']!=""){$Dinner=$f3['No_of_paxClose'];}else{$Dinner="0";}
    
    
$date = strtotime($FromDt);
$newDate = date("Y-m-d", strtotime("+$j month", $date));
++$j;
	
$date1 = strtotime($newDate);
$From_MonthNamenew = date('F',$date1);
   
    $data[]= ['MonthName'=>$From_MonthNamenew,'Breakfast'=>$Breakfast,'Lunch'=>$Lunch,'Dinner'=>$Dinner];
	}     
}
else if($graph=='graph3'){

$j=0; 

	for($i= $From_Month;$i<=$From_To;$i++){

	
 $q="SELECT sum(No_of_Pax) as No_of_Pax   FROM `POS_table` where   BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and MONTH(BillDate)='".$i."' ";
 $q1=mysqli_query($conn,$q);
 $f1=mysqli_fetch_array($q1);
   
  if($f1['No_of_Pax']!=""){
      $Visits=$f1['No_of_Pax'];
     
  }else{
      $Visits="0";
	
  }


$date = strtotime($FromDt);
$newDate = date("Y-m-d", strtotime("+$j month", $date));
++$j;
	
$date1 = strtotime($newDate);
$From_MonthNamenew = date('F',$date1);
    

	

    $data[]= ['MonthName'=>$From_MonthNamenew,'Visits'=>$Visits];

	}
       }
else if($graph=='graph4'){
    $MonBreakfast="0";$MonLunch="0";$MonDinner="0";
    
        
     //====================For Monday===========================
    $monarray="";
   
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 1) //Monday == 1
     //echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
    $monarray.="'".date('Y-m-d', $i)."'".",";

    }
    $monarray1= substr($monarray, 0, -1);
if($monarray1!=""){

     
        $Monq1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and  BillDate IN(".$monarray1.")  ");
    	$Monq2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and  BillDate IN(".$monarray1.")  ");
    	$Monq3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and  BillDate IN(".$monarray1.")  ");
    $Monf1=mysqli_fetch_array($Monq1);
    $Monf2=mysqli_fetch_array($Monq2);
    $Monf3=mysqli_fetch_array($Monq3);
	
     if($Monf1['No_of_paxClose']!=""){$MonBreakfast=$Monf1['No_of_paxClose'];}else{$MonBreakfast="0";};
     if($Monf2['No_of_paxClose']!=""){$MonLunch=$Monf2['No_of_paxClose'];}else{$MonLunch="0";};
     if($Monf3['No_of_paxClose']!=""){$MonDinner=$Monf3['No_of_paxClose'];}else{$MonDinner="0";};
}
 //==========================================================      
        
   //====================For Tuesday===========================     
    $Tuearray="";
   $TueBreakfast="0";$TueLunch="0";$TueDinner="0";
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 2) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
    $Tuearray.="'".date('Y-m-d', $i)."'".",";

    }
    $Tuearray1= substr($Tuearray, 0, -1);
if($Tuearray1!=""){
        $Tueq1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and  BillDate IN(".$Tuearray1.")  ");
    	$Tueq2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and  BillDate IN(".$Tuearray1.")  ");
    	$Tueq3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and  BillDate IN(".$Tuearray1.")  ");

    $Tuef1=mysqli_fetch_array($Tueq1);
    $Tuef2=mysqli_fetch_array($Tueq2);
    $Tuef3=mysqli_fetch_array($Tueq3);
	
     if($Tuef1['No_of_paxClose']!=""){$TueBreakfast=$Tuef1['No_of_paxClose'];}else{$TueBreakfast="0";};
     if($Tuef2['No_of_paxClose']!=""){$TueLunch=$Tuef2['No_of_paxClose'];}else{$TueLunch="0";};
     if($Tuef3['No_of_paxClose']!=""){$TueDinner=$Tuef3['No_of_paxClose'];}else{$TueDinner="0";};
}  
         //==========================================================      
        
   //====================For Wednesday===========================     
    $Wedarray="";
   $WedBreakfast="0";$WedLunch="0";$WedDinner="0";
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 3) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
    $Wedarray.="'".date('Y-m-d', $i)."'".",";

    }
    $Wedarray1= substr($Wedarray, 0, -1);

if($Wedarray1!=""){
   $Wedq1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and  BillDate IN(".$Wedarray1.")  ");
    	$Wedq2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and  BillDate IN(".$Wedarray1.")  ");
    	$Wedq3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and  BillDate IN(".$Wedarray1.")  ");

    $Wedf1=mysqli_fetch_array($Wedq1);
    $Wedf2=mysqli_fetch_array($Wedq2);
    $Wedf3=mysqli_fetch_array($Wedq3);
	
     if($Wedf1['No_of_paxClose']!=""){$WedBreakfast=$Wedf1['No_of_paxClose'];}else{$WedBreakfast="0";};
     if($Wedf2['No_of_paxClose']!=""){$WedLunch=$Wedf2['No_of_paxClose'];}else{$WedLunch="0";};
     if($Wedf3['No_of_paxClose']!=""){$WedDinner=$Wedf3['No_of_paxClose'];}else{$WedDinner="0";};
}      
            //==========================================================      
        
   //====================For Thursday===========================     
    $Thursarray="";
   $ThurBreakfast="0";$ThurLunch="0";$ThurDinner="0";
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 4) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
  $Thurarray.="'".date('Y-m-d', $i)."'".",";

    }
    $Thurarray1= substr($Thurarray, 0, -1);

if($Thurarray1!=""){
     $Thurq1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and  BillDate IN(".$Thurarray1.")  ");
    	$Thurq2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and  BillDate IN(".$Thurarray1.")  ");
    	$Thurq3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and  BillDate IN(".$Thurarray1.")  ");

    $Thurf1=mysqli_fetch_array($Thurq1);
    $Thurf2=mysqli_fetch_array($Thurq2);
    $Thurf3=mysqli_fetch_array($Thurq3);
	
     if($Thurf1['No_of_paxClose']!=""){$ThurBreakfast=$Thurf1['No_of_paxClose'];}else{$ThurBreakfast="0";};
     if($Thurf2['No_of_paxClose']!=""){$ThurLunch=$Thurf2['No_of_paxClose'];}else{$ThurLunch="0";};
     if($Thurf3['No_of_paxClose']!=""){$ThurDinner=$Thurf3['No_of_paxClose'];}else{$ThurDinner="0";};
  }
  //==========================================================      
        
   //====================For Fridday===========================     
    $Friarray="";
   $FriBreakfast="0";$FriLunch="0";$FriDinner="0";
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 5) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
  $Friarray.="'".date('Y-m-d', $i)."'".",";

    }
    $Friarray1= substr($Friarray, 0, -1);

if($Friarray1!=""){
      $Frirq1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and  BillDate IN(".$Friarray1.")  ");
    	$Frirq2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and  BillDate IN(".$Friarray1.")  ");
    	$Frirq3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and  BillDate IN(".$Friarray1.")  ");

    $Frirf1=mysqli_fetch_array($Frirq1);
    $Frirf2=mysqli_fetch_array($Frirq2);
    $Frirf3=mysqli_fetch_array($Frirq3);
	
     if($Frirf1['No_of_paxClose']!=""){$FriBreakfast=$Frirf1['No_of_paxClose'];}else{$FriBreakfast="0";};
     if($Frirf2['No_of_paxClose']!=""){$FriLunch=$Frirf2['No_of_paxClose'];}else{$FriLunch="0";};
     if($Frirf3['No_of_paxClose']!=""){$FriDinner=$Frirf3['No_of_paxClose'];}else{$FriDinner="0";};
  }
  //==========================================================      
        
   //====================For Saturday===========================     
    $satarray="";
   $satBreakfast="0";$satLunch="0";$satDinner="0";
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 6) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
  $satarray.="'".date('Y-m-d', $i)."'".",";

    }
    $satarray1= substr($satarray, 0, -1);

if($satarray1!=""){
     	$satq1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and  BillDate IN(".$satarray1.")  ");
    	$satq2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and  BillDate IN(".$satarray1.")  ");
    	$satq3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and  BillDate IN(".$satarray1.")  ");

    $satf1=mysqli_fetch_array($satq1);
    $satf2=mysqli_fetch_array($satq2);
    $satf3=mysqli_fetch_array($satq3);
	
     if($satf1['No_of_paxClose']!=""){$satBreakfast=$satf1['No_of_paxClose'];}else{$satBreakfast="0";};
     if($satf2['No_of_paxClose']!=""){$satLunch=$satf2['No_of_paxClose'];}else{$satLunch="0";};
     if($satf3['No_of_paxClose']!=""){$satDinner=$satf3['No_of_paxClose'];}else{$satDinner="0";};
}       
              //==========================================================      
        
   //====================For Sunday===========================     
    $sunarray="";
   $sunBreakfast="0";$sunLunch="0";$sunDinner="0";
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 7) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
  $sunarray.="'".date('Y-m-d', $i)."'".",";

    }
    $sunarray1= substr($sunarray, 0, -1);

if($sunarray1!=""){
     		$sunq1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and  BillDate IN(".$sunarray1.")  ");
    	$sunq2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and  BillDate IN(".$sunarray1.")  ");
    	$sunq3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and  BillDate IN(".$sunarray1.")  ");

    $sunf1=mysqli_fetch_array($sunq1);
    $sunf2=mysqli_fetch_array($sunq2);
    $sunf3=mysqli_fetch_array($sunq3);
	
     if($sunf1['No_of_paxClose']!=""){$sunBreakfast=$sunf1['No_of_paxClose'];}else{$sunBreakfast="0";};
     if($sunf2['No_of_paxClose']!=""){$sunLunch=$sunf2['No_of_paxClose'];}else{$sunLunch="0";};
     if($sunf3['No_of_paxClose']!=""){$sunDinner=$sunf3['No_of_paxClose'];}else{$sunDinner="0";};
}      
          //==========================================================     
        
        
        
     
    // $data[]= ['Monday'=>$f1['No_of_Sales'],'Tuesday'=>$f2['No_of_Sales'],'Wednesday'=>$f3['No_of_Sales'],'Thursday'=>$f4['No_of_Sales'],'Friday'=>$f5['No_of_Sales'],'Saturday'=>$f6['No_of_Sales'],'Sunday'=>$f7['No_of_Sales']];
     $data[]= ['Monday'=>'Mon','MonBreakfast'=>$MonBreakfast,'MonLunch'=>$MonLunch,'MonDinner'=>$MonDinner,
               'Tuesday'=>'Tue','TueBreakfast'=>$TueBreakfast,'TueLunch'=>$TueLunch,'TueDinner'=>$TueDinner,
               'Wednesday'=>'Wed','WedBreakfast'=>$WedBreakfast,'WedLunch'=>$WedLunch,'WedDinner'=>$WedDinner,
               'Thursday'=>'Thur','ThurBreakfast'=>$ThurBreakfast,'ThurLunch'=>$ThurLunch,'ThurDinner'=>$ThurDinner,
               'Friday'=>'Fri','FriBreakfast'=>$FriBreakfast,'FriLunch'=>$FriLunch,'FriDinner'=>$FriDinner,
               'Saturday'=>'Sat','SatBreakfast'=>$satBreakfast,'SatLunch'=>$satLunch,'SatDinner'=>$satDinner,
               'Sunday'=>'Sun','SunBreakfast'=>$sunBreakfast,'SunLunch'=>$sunLunch,'SunDinner'=>$sunDinner ];
               
              
           
    
    
    
    
    
    
    /*
    
     //====================For Monday===========================
    $monarray="";
   $mon="";
   $tue="";
   $monarray1="";
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
    $h="1";
     for($k=1;$k<=7;$k++){
         
     
    
     if (date('N', $i) == $k) //Monday == 1
   //  echo date('l', $i); //prints the date only if it's a Monday
    
    if($k=="1"){
        $mon.="'".date('Y-m-d', $i)."'".",";
    }
    else if($k=="2"){
        $tue.="'".date('Y-m-d', $i)."'".",";
    }
    else if($k=="3"){
        $Wed.="'".date('Y-m-d', $i)."'".",";
    }
    else if($k=="4"){
        $Thu.="'".date('Y-m-d', $i)."'".",";
    }
    else if($k=="5"){
        $fri.="'".date('Y-m-d', $i)."'".",";
    }
    else if($k=="6"){
        $sat.="'".date('Y-m-d', $i)."'".",";
    }
    else if($k=="7"){
        $sun.="'".date('Y-m-d', $i)."'".",";
    }
    
   // $monarray.="'".date('Y-m-d', $i)."'".",";
    
    
     }
   
    
    $h++; //   echo $monarray1;
    }
   
    
// $monarray1= substr($mon, 0, -1);
// $tuearray1= substr($tue, 0, -1);
// $Wedarray1= substr($Wed, 0, -1);
//$Thuarray1= substr($Thu, 0, -1);
//$friarray1= substr($fri, 0, -1);
//$satarray1= substr($sat, 0, -1);
//$sunarray1= substr($sun, 0, -1);

//echo $monarray1;
    $value="";
        for($m=1;$m<=2;$m++){
            
            if($m=1){$value= substr($mon, 0, -1);    $monthNm="Mon";}
            elseif($m=2){$value= substr($tue, 0, -1);$monthNm="Tue";} 
            elseif($m=3){$value= substr($Wed, 0, -1);$monthNm="Wed";} 
            elseif($m=4){$value= substr($Thu, 0, -1);$monthNm="Thu";}
            elseif($m=5){$value= substr($fri, 0, -1);$monthNm="Fri";}
            elseif($m=6){$value= substr($sat, 0, -1);$monthNm="Sat";}  
            elseif($m=7){$value= substr($sun, 0, -1);$monthNm="Sun";}
            
    $q1=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '07:00:00' and '10:59:59' and  BillDate IN(".$value.")  ");
	$q2=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '11:00:00' and '16:59:59' and  BillDate IN(".$value.")  ");
	$q3=mysqli_query($conn,"SELECT sum(No_of_paxClose) as No_of_paxClose  FROM `POS_table` where Time BETWEEN '17:00:00' and '23:59:59' and  BillDate IN(".$value.")  ");

    $f1=mysqli_fetch_array($q1);
    $f2=mysqli_fetch_array($q2);
    $f3=mysqli_fetch_array($q3);
	
     if($f1['No_of_paxClose']!=""){$Breakfast=$f1['No_of_paxClose'];}else{$Breakfast="0";}
     if($f2['No_of_paxClose']!=""){$Lunch=$f2['No_of_paxClose'];}else{$Lunch="0";}
     if($f3['No_of_paxClose']!=""){$Dinner=$f3['No_of_paxClose'];}else{$Dinner="0";} 
    
      $data[]= ['MonthName'=>$monthNm,'Breakfast'=>$Breakfast,'Lunch'=>$Lunch,'Dinner'=>$Dinner];
  
    
       }
     //echo $tue."-".$mon;    
     //echo  $monarray1;
*/
       
}
else if($graph=='graph5'){
    
    
    $j=0; 

	for($i= $From_Month;$i<=$From_To;$i++){

	
 	$q1=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where   BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and MONTH(BillDate)='".$i."' ");
    $f1=mysqli_fetch_array($q1);
   
 $revenu1=$f1['FoodAmt']+$f1['SoftBevAmt']+$f1['IndianLiqAmt']+$f1['ImpLiqAmt']+$f1['No_of_MiscAmt'];
 $discount1=$f1['FoodDiscAmt']+$f1['SoftBevDiscAmt']+$f1['IndianLiqDiscAmt']+$f1['ImpLiqDiscAmt']+$f1['MiscDiscAmt'];
 $netRevenue1 = $revenu1-$discount1;
 
 
$date = strtotime($FromDt);
$newDate = date("Y-m-d", strtotime("+$j month", $date));
++$j;
	
$date1 = strtotime($newDate);
$From_MonthNamenew = date('F',$date1);
    $data[]= ['MonthName'=>$From_MonthNamenew,'netRevenue1'=>$netRevenue1];

	}
    
    
    
    
}
else if($graph=='graph6'){



     //====================For Monday===========================
    $monarray="";
   
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 1) //Monday == 1
     //echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
    $monarray.="'".date('Y-m-d', $i)."'".",";

    }
    $monarray1= substr($monarray, 0, -1);


     	$q1=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate IN(".$monarray1.") ");
        $f1=mysqli_fetch_array($q1);
         $revenu1=$f1['FoodAmt']+$f1['SoftBevAmt']+$f1['IndianLiqAmt']+$f1['ImpLiqAmt']+$f1['No_of_MiscAmt'];
        $discount1=$f1['FoodDiscAmt']+$f1['SoftBevDiscAmt']+$f1['IndianLiqDiscAmt']+$f1['ImpLiqDiscAmt']+$f1['MiscDiscAmt'];
        $netRevenue1=$revenu1-$discount1;
 //==========================================================      
        
   //====================For Tuesday===========================     
    $Tuearray="";
   
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 2) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
    $Tuearray.="'".date('Y-m-d', $i)."'".",";

    }
    $Tuearray1= substr($Tuearray, 0, -1);


     	$q2=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate IN(".$Tuearray1.") ");
        $f2=mysqli_fetch_array($q2);
         $revenu2=$f2['FoodAmt']+$f2['SoftBevAmt']+$f2['IndianLiqAmt']+$f2['ImpLiqAmt']+$f2['No_of_MiscAmt'];
        $discount2=$f2['FoodDiscAmt']+$f2['SoftBevDiscAmt']+$f2['IndianLiqDiscAmt']+$f2['ImpLiqDiscAmt']+$f2['MiscDiscAmt'];
        $netRevenue2=$revenu2-$discount2;
        
        
         //==========================================================      
        
   //====================For Wednesday===========================     
    $Wedarray="";
   
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 3) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
    $Wedarray.="'".date('Y-m-d', $i)."'".",";

    }
    $Wedarray1= substr($Wedarray, 0, -1);


     	$q3=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate IN(".$Wedarray1.") ");
        $f3=mysqli_fetch_array($q3);
        $revenu3=$f3['FoodAmt']+$f3['SoftBevAmt']+$f3['IndianLiqAmt']+$f3['ImpLiqAmt']+$f3['No_of_MiscAmt'];
        $discount3=$f3['FoodDiscAmt']+$f3['SoftBevDiscAmt']+$f3['IndianLiqDiscAmt']+$f3['ImpLiqDiscAmt']+$f3['MiscDiscAmt'];
        $netRevenue3=$revenu3-$discount3;
        
            //==========================================================      
        
   //====================For Thursday===========================     
    $Thursarray="";
   
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 4) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
  $Thurarray.="'".date('Y-m-d', $i)."'".",";

    }
    $Thurarray1= substr($Thurarray, 0, -1);


     	$q4=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where  BillDate IN(".$Thurarray1.") ");
        $f4=mysqli_fetch_array($q4);
        $revenu4=$f4['FoodAmt']+$f4['SoftBevAmt']+$f4['IndianLiqAmt']+$f4['ImpLiqAmt']+$f4['No_of_MiscAmt'];
        $discount4=$f4['FoodDiscAmt']+$f4['SoftBevDiscAmt']+$f4['IndianLiqDiscAmt']+$f4['ImpLiqDiscAmt']+$f4['MiscDiscAmt'];
        $netRevenue4=$revenu4-$discount4;
        
           
           
   //====================For Fridday===========================     
    $Friarray="";
   
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 5) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
  $Friarray.="'".date('Y-m-d', $i)."'".",";

    }
    $Friarray1= substr($Friarray, 0, -1);


     	$q5=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where  BillDate IN(".$Friarray1.") ");
        $f5=mysqli_fetch_array($q5);
        $revenu5=$f5['FoodAmt']+$f5['SoftBevAmt']+$f5['IndianLiqAmt']+$f5['ImpLiqAmt']+$f5['No_of_MiscAmt'];
        $discount5=$f5['FoodDiscAmt']+$f5['SoftBevDiscAmt']+$f5['IndianLiqDiscAmt']+$f5['ImpLiqDiscAmt']+$f5['MiscDiscAmt'];
        $netRevenue5=$revenu5-$discount5;
        
        
            
        
   //====================For Saturday===========================     
    $satarray="";
   
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 6) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
  $satarray.="'".date('Y-m-d', $i)."'".",";

    }
    $satarray1= substr($satarray, 0, -1);


     	$q6=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where  BillDate IN(".$satarray1.") ");
        $f6=mysqli_fetch_array($q6);
         $revenu6=$f6['FoodAmt']+$f6['SoftBevAmt']+$f6['IndianLiqAmt']+$f6['ImpLiqAmt']+$f6['No_of_MiscAmt'];
        $discount6=$f6['FoodDiscAmt']+$f6['SoftBevDiscAmt']+$f6['IndianLiqDiscAmt']+$f6['ImpLiqDiscAmt']+$f6['MiscDiscAmt'];
        $netRevenue6 = $revenu6-$discount6;
        
        
              
        
   //====================For Sunday===========================     
    $sunarray="";
   
    for ($i = strtotime($FromDt); $i <= strtotime($Todt); $i = strtotime('+1 day', $i)) {
     if (date('N', $i) == 7) //Monday == 1
   //  echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    
  $sunarray.="'".date('Y-m-d', $i)."'".",";

    }
    $sunarray1= substr($sunarray, 0, -1);


     	$q7=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate IN(".$sunarray1.") ");
        $f7=mysqli_fetch_array($q7);
        $revenu7=$f7['FoodAmt']+$f7['SoftBevAmt']+$f7['IndianLiqAmt']+$f7['ImpLiqAmt']+$f7['No_of_MiscAmt'];
        $discount7=$f7['FoodDiscAmt']+$f7['SoftBevDiscAmt']+$f7['IndianLiqDiscAmt']+$f7['ImpLiqDiscAmt']+$f7['MiscDiscAmt'];
        $netRevenue7 = $revenu7-$discount7;
        
          //==========================================================     
        
        
        
     
     $data[]= ['Monday'=>$netRevenue1,'Tuesday'=>$netRevenue2,'Wednesday'=>$netRevenue3,'Thursday'=>$netRevenue4,'Friday'=>$netRevenue5,'Saturday'=>$netRevenue6,'Sunday'=>$netRevenue7];
     
 



/*
    
       if(date('D')!='Mon') { 
          //take the last monday
            $staticstart = date('Y-m-d',strtotime('last Monday'));    
       }
      for($i=0;$i<7;$i++){
        $d=  date('Y-m-d', strtotime("+$i day", strtotime($staticstart)));
        $day=date('l', strtotime("+$i day", strtotime($staticstart)));
        
     	
     
     	$q1=mysqli_query($conn,"SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount  FROM `POS_table` where  BillDate = '".$d."' ");
        $f1=mysqli_fetch_array($q1);
        
        $revenu1=$f1['FoodAmt']+$f1['SoftBevAmt']+$f1['IndianLiqAmt']+$f1['ImpLiqAmt']+$f1['No_of_MiscAmt'];
        $discount1=$f1['FoodDiscAmt']+$f1['SoftBevDiscAmt']+$f1['IndianLiqDiscAmt']+$f1['ImpLiqDiscAmt']+$f1['MiscDiscAmt'];
        $netRevenue1 = $revenu1-$discount1;
        
     $data[]= [$day=>$netRevenue1];
     
      }*/
       
}





echo json_encode($data);

?>

