<?php
     include("datacon.php");
  function update_all($monid)
  {
  $sdate='2016-'.$monid.'-01';
$edate=date("Y-m-t", strtotime($sdate));
 //    $result_wd=mysql_query("select distinct(p_date) from punches_log_demo where p_date not in (SELECT hdate from holiday) and p_date between '2015-01-01' and '2015-01-31'order by p_date");
     $result_wd=mysql_query("select distinct(p_date) from punches_log where p_date between '".$sdate."' and '".$edate."' order by p_date");
     while($row_wd=mysql_fetch_row($result_wd))
      {
        $result=mysql_query("select ssn from employee order by ssn");
        while($row=mysql_fetch_row($result))
        {
         $shift=mysql_query("select sid from employee_shift where emp_id=".$row[0]);
        // echo "select sid from employee_shift where emp_id=".$row[0];
         if($shift){
         $shift_row=mysql_fetch_row($shift); 
         $emp_shift=mysql_query("select starttime,endtime from shifts where shiftid=".$shift_row[0]);
         
         if($emp_shift){
         $shift_time=mysql_fetch_row($emp_shift); 
         $start=$shift_time[0];        
         $end=$shift_time[1];        
         $result_time=mysql_query("SELECT MIN(p_time),MAX(p_time) FROM `punches_log` where ID=".$row[0]." and p_date='".$row_wd[0]."'");
         $row_time=mysql_fetch_row($result_time);
         if($row_time[0]!=null){
         if($row_time[0]!=$row_time[1])
         {
         $late=0; $bt=0;        
         $time1 = strtotime($start);  
	 $time2 = strtotime($row_time[0]);  
	 if($time2>$time1)
	 $late=($time2 - $time1)/60;
	 else
	 $bt=($time1 - $time2)/60;
	 $leftearly=0; $ot=0;        
         $time2 = strtotime($end);  
	 $time1 = strtotime($row_time[1]);  
	 if($time2>$time1)
	 $leftearly=($time2 - $time1)/60;
	 else
	 $ot=($time1 - $time2)/60;
          mysql_query("insert into attendance(ID,pdate,Intime,Outtime,late,leftearly,OT,BT) values(".$row[0].",'".$row_wd[0]."','".$row_time[0]."','".$row_time[1]."','".$late."','".$leftearly."','".$ot."','".$bt."')");          
         }
         else
         {
          $late=0;         
         $time1 = strtotime($start);  
	 $time2 = strtotime($row_time[0]);  
	 if($time2>$time1)
	 $late=($time2 - $time1)/60;
	 else
	 $bt=($time1 - $time2)/60;
	 //echo $start."-".$row_time[0]."-".$late."<br>";
          mysql_query("insert into attendance(ID,pdate,Intime,late,leftearly,OT,BT) values(".$row[0].",'".$row_wd[0]."','".$row_time[0]."','".$late."','0','0','".$bt."')");          
         }
                               }
                        }
                  }      
        }
      }
      }
      function update_single($empid,$monid)
      {
      
$sdate='2016-'.$monid.'-01';
$edate=date("Y-m-t", strtotime($sdate));
      $result_wd=mysql_query("select distinct(p_date) from punches_log where p_date between '".$sdate."' and '".$edate."'order by p_date");
     while($row_wd=mysql_fetch_row($result_wd))
      {
      
         $shift=mysql_query("select sid from employee_shift where emp_id=".$empid);
        // echo "select sid from employee_shift where emp_id=".$empid;
         if($shift){
         $shift_row=mysql_fetch_row($shift); 
         $emp_shift=mysql_query("select starttime,endtime from shifts where shiftid=".$shift_row[0]);
         
         if($emp_shift){
         $shift_time=mysql_fetch_row($emp_shift); 
         $start=$shift_time[0];        
         $end=$shift_time[1];        
         $result_time=mysql_query("SELECT MIN(p_time),MAX(p_time) FROM `punches_log` where ID=".$empid." and p_date='".$row_wd[0]."'");
         $row_time=mysql_fetch_row($result_time);
         if($row_time[0]!=null){
         if($row_time[0]!=$row_time[1])
         {
         $late=0; $bt=0;        
         $time1 = strtotime($start);  
	 $time2 = strtotime($row_time[0]);  
	 if($time2>$time1)
	 $late=($time2 - $time1)/60;
	 else
	 $bt=($time1 - $time2)/60;
	 $leftearly=0; $ot=0;        
         $time2 = strtotime($end);  
	 $time1 = strtotime($row_time[1]);  
	 if($time2>$time1)
	 $leftearly=($time2 - $time1)/60;
	 else
	 $ot=($time1 - $time2)/60;
         $sss = mysql_query("select * from attendance where ID='".$empid."' and pdate='".$row_wd[0]."'");
         if(mysql_num_rows($sss)>0)
	 mysql_query("update attendance set Intime='".$row_time[0]."',Outtime='".$row_time[1]."',late='".$late."',leftearly='".$leftearly."',OT='".$ot."',BT='".$bt."' where ID='".$empid."' and pdate='".$row_wd[0]."'");
         else
          mysql_query("insert into attendance(ID,pdate,Intime,Outtime,late,leftearly,OT,BT) values(".$empid.",'".$row_wd[0]."','".$row_time[0]."','".$row_time[1]."','".$late."','".$leftearly."','".$ot."','".$bt."')");          
         }
         else
         {
          $late=0;         
         $time1 = strtotime($start);  
	 $time2 = strtotime($row_time[0]);  
	 if($time2>$time1)
	 $late=($time2 - $time1)/60;
	 else
	 $bt=($time1 - $time2)/60;
	 //echo $start."-".$row_time[0]."-".$late."<br>";
         $sss = mysql_query("select * from attendance where ID='".$empid."' and pdate='".$row_wd[0]."'");
         if(mysql_num_rows($sss)>0)
	 mysql_query("update attendance set Intime='".$row_time[0]."',late='".$late."',leftearly='0',OT='0',BT='".$bt."' where ID='".$empid."' and pdate='".$row_wd[0]."'");
         else	
          mysql_query("insert into attendance(ID,pdate,Intime,late,leftearly,OT,BT) values(".$empid.",'".$row_wd[0]."','".$row_time[0]."','".$late."','0','0','".$bt."')");          
         }
                               }
                        }
                  }      
      }
      }?>