<?php
     include("datacon.php");
     $my=$_GET['month'];
     if($my==null)$my="JULY 2015";
   // echo date('Y-m-d',(strtotime ( '-1 day' , strtotime ( '2015-05-01') ) ));
   // echo date('Y-m-d',(strtotime ( '+1 day' , strtotime ( '2015-05-01') ) ));
     echo "<br><br><center><h3><u>MONTHLY SALARY REPORT FOR ".$my."</u></H3></center>";
?>
           <br><br><center>
           <form action="generatePayroll.php" >
           <select name="month">
           <option value="JULY 2015" <?php if($my=='JULY 2015')echo "selected"; ?> >JULY 2015</option> 
           <option value="JUNE 2015" <?php if($my=='JUNE 2015')echo "selected"; ?> >JUNE 2015</option> 
           <option value="MAY 2015" <?php if($my=='MAY 2015')echo "selected"; ?> >MAY 2015</option> 
           <option value="APRIL 2015" <?php if($my=='APRIL 2015')echo "selected"; ?> >APRIL 2015</option> 
           <option value="MARCH 2015" <?php if($my=='MARCH 2015')echo "selected"; ?> >MARCH 2015</option> 
           <option value="FEBRUARY 2015" <?php if($my=='FEBRUARY 2015')echo "selected"; ?> >FEBRUARY 2015</option> 
           <option value="JANUARY 2015" <?php if($my=='JANUARY 2015')echo "selected"; ?> >JANUARY 2015</option> 
           <option value="DECEMBER 2014" <?php if($my=='DECEMBER 2014')echo "selected"; ?> >DECEMBER 2014</option>
           </select>
           <input type="submit" name="sub" value="SUBMIT" />
           </form></center>
<?php     
     echo "<br><br><center><table border=1><tr><th bgcolor='#BF00FF'>ID</th><th bgcolor='#BF00FF'>Name</th><th bgcolor='#BF00FF'>10 min</th><th bgcolor='#BF00FF'>30 min</th><th bgcolor='#BF00FF'>1 hr</th><th bgcolor='#BF00FF'>Left Early</th><th bgcolor='#BF00FF'>OT</th><th bgcolor='#BF00FF'>Absent</th><th bgcolor='#BF00FF'>Holiday Work</th><th bgcolor='#BF00FF'>NetSalary</th></tr>";
     
    
    // echo "NOD:".$nod."<br>";
     $result=mysql_query("select * from employee order by ssn");
     while($row=mysql_fetch_row($result))
     {
      $cnt10=0; $cnt30=0; $cnt1=0; $cnteg=0; $salary=0; $present=0; $hw=0; $ot=0;$abs=0;
       if($row[10]>3 and $row[10]!=9){
      //echo $row[10]." ".$row[8]."<br>";
      if($my=='JULY 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-07-01' and '2015-07-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-07-01' and '2015-07-31'");      
       $nod=27;
       $tnod=31;
      }
      if($my=='JUNE 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-06-01' and '2015-06-30'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-06-01' and '2015-06-30'");      
       $nod=26;
       $tnod=30;
      }
      if($my=='MAY 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-05-01' and '2015-05-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-05-01' and '2015-05-31'");      
       $nod=26;
       $tnod=31;
      }
      if($my=='APRIL 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-04-01' and '2015-04-30'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-04-01' and '2015-04-30'");      
       $nod=26;
       $tnod=30;
      }
      if($my=='MARCH 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-03-01' and '2015-03-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-03-01' and '2015-03-31'");      
       $nod=25;
       $tnod=31;
      }
      else if($my=='FEBRUARY 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-02-01' and '2015-02-28'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-02-01' and '2015-02-28'");      
       $nod=24;
       $tnod=28;
      }
      else if($my=='JANUARY 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-01-01' and '2015-01-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-01-01' and '2015-01-31'");      
       $nod=26;$tnod=31;
      }
      else if($my=='DECEMBER 2014'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2014-12-01' and '2014-12-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2014-12-01' and '2014-12-31'");      
       $nod=27;$tnod=31;
      }
      //echo mysql_num_rows($resultx)."<br>";
      while($rowx=mysql_fetch_row($resultx)){
      $resulthw=mysql_query("select * from holiday where hdate='".$rowx[2]."'");      
      if(mysql_num_rows($resulthw)>0){       
      $hw++;
      }   
      else                
                $present++;
      
                if($rowx[5]>=60)$cnt1++;
           else if($rowx[5]>=30)$cnt30++;                            
           else if($rowx[5]>=10)$cnt10++;         
           
                $cnteg+=$rowx[6];      
                $ot+=$rowx[7];          
      
       }
    //   echo $present;
      while($rowy=mysql_fetch_row($resulthol)){
      $yes=date('Y-m-d',(strtotime ( '-1 day' , strtotime ($rowy[0]) ) ));
       $tom=date('Y-m-d',(strtotime ( '+1 day' , strtotime ($rowy[0]) ) ));
       $resultyes=mysql_query("select * from attendance where ID=".$row[10]." and pdate='".$yes."'");      
       $resulttom=mysql_query("select * from attendance where ID=".$row[10]." and pdate='".$tom."'");      
       if(mysql_num_rows($resultyes)==0 and mysql_num_rows($resulttom)==0)
       $abs++;             
      }
       $absent=$nod-$present+$abs;
       
       $result_sal=mysql_query("select baseyear from salary where empid=".$row[10]);
       $row_sal=mysql_fetch_row($result_sal);
       $sal=$row_sal[0]; $sal_day=$row_sal[0]/$tnod; $sal_hday=$sal_day/2; 
       $result_hrly=mysql_query("select hourlyrate from hourly where empid=".$row[0]);
       $row_hrly=mysql_fetch_row($result_hrly);
       $sal_hr=$row_hrly[0]; $sal_min=$sal_hr/60;
       
       $salary=$sal-(intval($cnt10/7)*$sal_hday)-(intval($cnt30/3)*$sal_hday)-($cnt1*$sal_hday)-($cnteg*$sal_min)-($absent*$sal_day)+($hw*$sal_day) ;
       
      echo "<tr><td>".$row[10]."</td><td>".$row[8]."</td><td>".$cnt10."</td><td>".$cnt30."</td><td>".$cnt1."</td><td>".$cnteg."</td><td>".$ot."</td><td>".$absent."</td><td>".$hw."</td><td>".round($salary)."</td></tr>"; 
      }
      else if($row[10]==9)
      {
      if($my=='JULY 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-07-01' and '2015-07-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-07-01' and '2015-07-31'");      
       $nod=27;
       $tnod=31;
      }
      if($my=='JUNE 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-06-01' and '2015-06-30'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-06-01' and '2015-06-30'");      
       $nod=26;
       $tnod=30;
      }
      if($my=='MAY 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-05-01' and '2015-05-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-05-01' and '2015-05-31'");      
       $nod=26;
       $tnod=31;
      }
      if($my=='APRIL 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-04-01' and '2015-04-30'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-04-01' and '2015-04-30'");      
       $nod=26;
       $tnod=30;
      }
      if($my=='MARCH 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-03-01' and '2015-03-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-03-01' and '2015-03-31'");      
       $nod=25;
       $tnod=31;
      }
      else if($my=='FEBRUARY 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-02-01' and '2015-02-28'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-02-01' and '2015-02-28'");      
       $nod=24;
       $tnod=28;
      }
      else if($my=='JANUARY 2015'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2015-01-01' and '2015-01-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2015-01-01' and '2015-01-31'");      
       $nod=26;$tnod=31;
      }
      else if($my=='DECEMBER 2014'){
      $resultx=mysql_query("select * from attendance where ID=".$row[10]." and pdate between '2014-12-01' and '2014-12-31'");
      $resulthol=mysql_query("select hdate from holiday where hdate between '2014-12-01' and '2014-12-31'");      
       $nod=27;$tnod=31;
      }
      //echo mysql_num_rows($resultx)."<br>";
      while($rowx=mysql_fetch_row($resultx))
        {$resulthw=mysql_query("select * from holiday where hdate='".$rowx[2]."'");      
      if(mysql_num_rows($resulthw)>0){       
      $hw++;
      }   
      else
                $present++;
        }
        while($rowy=mysql_fetch_row($resulthol)){
      $yes=date('Y-m-d',(strtotime ( '-1 day' , strtotime ($rowy[0]) ) ));
       $tom=date('Y-m-d',(strtotime ( '+1 day' , strtotime ($rowy[0]) ) ));
       $resultyes=mysql_query("select * from attendance where ID=".$row[10]." and pdate='".$yes."'");      
       $resulttom=mysql_query("select * from attendance where ID=".$row[10]." and pdate='".$tom."'");      
       if(mysql_num_rows($resultyes)==0 and mysql_num_rows($resulttom)==0)
       $abs++;             
      }
            $absent=$nod-$present+$abs;
            $result_sal=mysql_query("select baseyear from salary where empid=".$row[10]);
            $row_sal=mysql_fetch_row($result_sal);
            $sal=$row_sal[0]; $sal_day=$row_sal[0]/$tnod; $sal_hday=$sal_day/2; 
            
            $ded=0;
            if($absent>2)$ded=($absent-2)*$sal_day;
            
            $salary=$sal-$ded ;
            
            echo "<tr><td>".$row[10]."</td><td>".$row[8]."</td><td>".$cnt10."</td><td>".$cnt30."</td><td>".$cnt1."</td><td>".$cnteg."</td><td>".$ot."</td><td>".$absent."</td><td>".$hw."</td><td>".round($salary)."</td></tr>"; 
      }
      
     }
     echo "</table></center>";
?>