<?php
session_start();
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];
$id="";
$cid="";
$bank="";
$city="";
$area="";
$state="";

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary" >
<?php 
 if($_POST['calltype']=='brsummary') { ?>
<tr>

<th rowspan="2" width="10%">Branch Name</th> 
<th colspan="9" style="text-align:center">Calls Summary</th>
</tr>
<tr>
<th width="10%" style="text-align:center">Service Call</th>
<th width="10%" style="text-align:center">Installation Call</th>
<th width="10%" style="text-align:center">PM Call</th> 
<th width="10%" style="text-align:center">Other Call (Inhouse)</th>
<th width="10%" style="text-align:center">Other Call (Field)</th>
<th width="10%" style="text-align:center">Total calls</th>
<th width="10%" style="text-align:center">Average Calls per day</th>
<th width="10%" style="text-align:center">Points Scored</th>
</tr>
<?php
	//$ctype=$_POST['calltype'];
	//$ctyp1=explode(',',$ctype);
	//$alert_type=$_POST['openall'];

 $sql.="Select distinct(branch_id) from alert where branch_id<>'' ";

//========================================for open and close call============
	
	//echo $ctyp1[0];
	//echo "<br>".$ctyp1[1];
		
		/*if($ctyp1[0]=='Done')
		{
		$sql.=" and call_status = 'Done'";
		}
		if($ctyp1[1]=='1')
		{
		$sql.=" and `call_status`= 1 or `call_status`='Pending' ";
		}*/
	
//========================================for sate============

/*if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_POST['state'];
$sql.=" and state LIKE '%".$state."%'";
}

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}*/

//echo $sql;
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

//echo $sql;
$qr22=$sql;
$sql.=" group by `branch_id` LIMIT $Page_Start , $Per_Page";
//echo $sql;
$frm=str_replace("/","-",$_POST['fromdt']); //echo $frm;
$to=str_replace("/","-",$_POST['todt']); //echo $to;
 //echo date('d-m-Y ',strtotime($frm)); 
$d1 = new DateTime($frm);
$d2 = new DateTime($to);
$diff=$d1->diff($d2)->days; 
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$sn=1;
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
 
while($row= mysqli_fetch_row($table))
{$pts=0;		
//============= while loop for open call =========================
				//echo "<br>SELECT count(*),call_status FROM `alert` where state LIKE '".$row[0]."' and ( call_status = 'Pending' or call_status='1')  group by state";
 $strsc="SELECT atm_id FROM `alert` where branch_id='".$row[0]."' and (alert_type='service' or alert_type='new temp') and responsetime<>'0000-00-00 00:00:00' and responsetime<>'1970-01-01 00:00:00' ";                                    
 $strins="SELECT atm_id FROM `alert` where branch_id='".$row[0]."' and  alert_type='new' and responsetime<>'0000-00-00 00:00:00' and responsetime<>'1970-01-01 00:00:00' ";                                    
 $strpm="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and (alert_type='temp_pm' or alert_type='pm') and responsetime<>'0000-00-00 00:00:00' and responsetime<>'1970-01-01 00:00:00' ";                                    
 $str="SELECT count(*),name FROM `eng_mis` where eng_id in(select engg_id from area_engg where area LIKE '".$row[0]."') and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
 $str1="SELECT count(*),name FROM `eng_mis` where eng_id in(select engg_id from area_engg where area LIKE '".$row[0]."') and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
                                			
				//========================================From Date to Date============
									
                      $strsc.=" and responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";				
              $strins.=" and responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";				
          $strpm.=" and responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";				
	
				$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;				
				$opencall=mysqli_query($con1,$str);
				$opencall1=mysqli_query($con1,$str1);
                                $opencallsc=mysqli_query($con1,$strsc);
                                $opencallins=mysqli_query($con1,$strins);
                                $opencallpm=mysqli_query($con1,$strpm);
				//echo "<br>".$str;
	  			while($openrow= mysqli_fetch_row($opencall))
                                { $cnt+=$openrow[0];
                                $ps=mysqli_query($con1,"select points from activity where id=".$openrow[1]);
                                $rps= mysqli_fetch_row($ps);
                                $pts+=$openrow[0]*$rps[0];
                                }
	  			while($openrow1= mysqli_fetch_row($opencall1))
                                { $cnt1+=$openrow1[0];
                                $ps=mysqli_query($con1,"select points from activity where id=".$openrow1[1]);
                                $rps= mysqli_fetch_row($ps);
                                $pts+=$openrow1[0]*$rps[0];
                                }
                                while($openrowsc= mysqli_fetch_row($opencallsc))
                                { $cntsc++;
                                $ps=mysqli_query($con1,"select cat from atm where atm_id=".$openrowsc[0]);
                                if(mysqli_num_rows($ps)==0)
                                $pts+=1.0;
                                else{
                                $rps= mysqli_fetch_row($ps);
                                if($rps[0]=='')
                                $pts+=1.0;
                                else if($rps[0]=='A')
                                $pts+=1.0;
                                else if($rps[0]=='B')
                                $pts+=1.5;
                                else if($rps[0]=='C')
                                $pts+=2.0;
                                else if($rps[0]=='D')
                                $pts+=2.5;
                                else if($rps[0]=='E')
                                $pts+=3.0;
                                else 
                                $pts+=1.0;
                                   }
                                }
                                while($openrowins= mysqli_fetch_row($opencallins))
                                { $cntins++;
                                $ps=mysqli_query($con1,"select cat from atm where atm_id=".$openrowins[0]);
                                if(mysqli_num_rows($ps)==0)
                                $pts+=2.0;
                                else{
                                $rps= mysqli_fetch_row($ps);
                                if($rps[0]=='')
                                $pts+=2.0;
                                else if($rps[0]=='A')
                                $pts+=1.5;
                                else if($rps[0]=='B')
                                $pts+=2.0;
                                else if($rps[0]=='C')
                                $pts+=2.5;
                                else if($rps[0]=='D')
                                $pts+=3.0;
                                else if($rps[0]=='E')
                                $pts+=4.0;
                                else 
                                $pts+=2.0;
                                    }
                                }
                                $openrowpm= mysqli_fetch_row($opencallpm);
                                $cntpm=$openrowpm[0];                                
                                $pts+=$cntpm;                                    
                                
		?>
<tr>
<!--===SN===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
 ?></td>

<!--===State===-->   
<td  valign="top">
<?php echo $cntsc;
 ?>
</td>

<!--===Open===-->   
<td  valign="top"><?php echo $cntins; ?></td>

<!--===Close===-->
<td  valign="top"><?php echo $cntpm; ?></td>

<!--===Total===-->
<td  valign="top"><?php echo $cnt1;  ?></td>
<td  valign="top"><?php echo $cnt;  ?></td>
<td  valign="top"><?php echo $cnt1+$cnt+$cntsc+$cntins+$cntpm;  ?></td>
<td  valign="top"><?php echo round(($cnt1+$cnt+$cntsc+$cntins+$cntpm)/($diff+1),2); ?></td>
<td  valign="top"><?php echo $pts; ?></td>
</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total <td><?php  ?></td> <td><?php  ?></td> <td><?php  ?></td><td><?php  ?></td><td><?php   ?></td><td><?php   ?></td><td><?php  ?></td><td><?php ?></td></tr>
<?php } ?>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
//==============================customer wise========================================================
 }else{ ?>
 <tr>

<th rowspan="2">Engineer Name</th>
 <th style="text-align:center">Attendance</th>
<th colspan="8" style="text-align:center">Calls Summary</th>

</tr>

<tr>
<th width="10%" style="text-align:center">No. of Days Present</th>
<th width="10%" style="text-align:center">Service Call</th>
<th width="10%" style="text-align:center">Installation Call</th>
<th width="10%" style="text-align:center">PM Call</th> 
<th width="10%" style="text-align:center">Other Call (Inhouse)</th>
<th width="10%" style="text-align:center">Other Call (Field)</th>
<th width="10%" style="text-align:center">Total calls</th>
<th width="10%" style="text-align:center">Average Calls per day</th>
<th width="10%" style="text-align:center">Points Scored</th>
</tr>
<?php
	//$ctype=$_POST['calltype'];
	//$ctyp1=explode(',',$ctype);
	//$alert_type=$_POST['openall'];

 $sql.="SELECT loginid,engg_name,area FROM `area_engg` where deleted=0 and status=1";

//========================================for open and close call============
	
	//echo $ctyp1[0];
	//echo "<br>".$ctyp1[1];
		
		/*if($ctyp1[0]=='Done')
		{
		$sql.=" and call_status = 'Done'";
		}
		if($ctyp1[1]=='1')
		{
		$sql.=" and `call_status`= 1 or `call_status`='Pending' ";
		}*/
	
//========================================for sate============

/*if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_POST['state'];
$sql.=" and state LIKE '%".$state."%'";
}

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}*/

//echo $sql;
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

//echo $sql;
$qr22=$sql;
$sql.=" LIMIT $Page_Start , $Per_Page";
echo $sql;
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$sn=1;
$gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;
while($row= mysqli_fetch_row($table))
{		
 $hrs2=0;$hrs4=0;$hrs8=0;$hrs12=0;$day1=0;$day2=0;$day3=0;$day5=0;$gt5day=0;
 //============= while loop for open call =========================
				//echo "<br>SELECT count(*),call_status FROM `alert` where state LIKE '".$row[0]."' and ( call_status = 'Pending' or call_status='1')  group by state";
				 $strsc="SELECT atm_id FROM `alert` where branch_id='".$row[0]."' and alert_type='service' and responsetime<>'0000-00-00 00:00:00' and responsetime<>'1970-01-01 00:00:00' ";                                    
 $strins="SELECT atm_id FROM `alert` where branch_id='".$row[0]."' and (alert_type='new temp' or alert_type='new') and responsetime<>'0000-00-00 00:00:00' and responsetime<>'1970-01-01 00:00:00' ";                                    
 $strpm="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and (alert_type='temp_pm' or alert_type='pm') and responsetime<>'0000-00-00 00:00:00' and responsetime<>'1970-01-01 00:00:00' ";                                    
 $str="SELECT count(*),name FROM `eng_mis` where eng_id='".$row[0]."' and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
 $str1="SELECT count(*),name FROM `eng_mis` where eng_id='".$row[0]."' and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
                                			
				//========================================From Date to Date============
									
                      $strsc.=" and responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";				
              $strins.=" and responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";				
          $strpm.=" and responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";				

				
				$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;				
				$opencall=mysqli_query($con1,$str);
				$opencall1=mysqli_query($con1,$str1);
                                $opencallsc=mysqli_query($con1,$strsc);
                                $opencallins=mysqli_query($con1,$strins);
                                $opencallpm=mysqli_query($con1,$strpm);
				//echo "<br>".$str;
	  			while($openrow= mysqli_fetch_row($opencall))
                                { $cnt+=$openrow[0];
                                $ps=mysqli_query($con1,"select points from activity where id=".$openrow[1]);
                                $rps= mysqli_fetch_row($ps);
                                $pts+=$openrow[0]*$rps[0];
                                }
	  			while($openrow1= mysqli_fetch_row($opencall1))
                                { $cnt1+=$openrow1[0];
                                $ps=mysqli_query($con1,"select points from activity where id=".$openrow1[1]);
                                $rps= mysqli_fetch_row($ps);
                                $pts+=$openrow1[0]*$rps[0];
                                }
                                while($openrowsc= mysqli_fetch_row($opencallsc))
                                { $cntsc++;
                                $ps=mysqli_query($con1,"select cat from atm where atm_id=".$openrowsc[0]);
                                if(mysqli_num_rows($ps)>0)
                                $pts+=1.0;
                                else{
                                $rps= mysqli_fetch_row($ps);
                                if($rps[0]=='')
                                $pts+=1.0;
                                else if($rps[0]=='A')
                                $pts+=1.0;
                                else if($rps[0]=='B')
                                $pts+=1.5;
                                else if($rps[0]=='C')
                                $pts+=2.0;
                                else if($rps[0]=='D')
                                $pts+=2.5;
                                else if($rps[0]=='E')
                                $pts+=3.0;
                                else 
                                $pts+=1.0;
                                   }
                                }
                                while($openrowins= mysqli_fetch_row($opencallins))
                                { $cntins++;
                                $ps=mysqli_query($con1,"select cat from atm where atm_id=".$openrowins[0]);
                                if(mysqli_num_rows($ps)>0)
                                $pts+=2.0;
                                else{
                                $rps= mysqli_fetch_row($ps);
                                if($rps[0]=='')
                                $pts+=2.0;
                                else if($rps[0]=='A')
                                $pts+=1.5;
                                else if($rps[0]=='B')
                                $pts+=2.0;
                                else if($rps[0]=='C')
                                $pts+=2.5;
                                else if($rps[0]=='D')
                                $pts+=3.0;
                                else if($rps[0]=='E')
                                $pts+=4.0;
                                else 
                                $pts+=2.0;
                                    }
                                }
                                $openrowpm= mysqli_fetch_row($opencallpm);
                                $cntpm=$openrowpm[0];                                
                                $pts+=$cntpm;                                    
		?>
<tr>
<!--===SN===-->
<td  valign="top" width=""><?php 
echo $row[1];
 ?></td>

<!--===customer name===-->   
<td  valign="top">
<?php 
$gt1+=$hrs2;
echo $hrs2;
 ?>
</td>

<!--===Open===-->   
<td  valign="top"><?php $gt2+=$hrs4; echo $hrs4;  ?></td>

<!--===Close===-->
<td  valign="top"><?php $gt3+=$hrs8; echo $hrs8; ?></td>

<!--===Total===-->
<td  valign="top"><?php $gt4+=$hrs12; echo $hrs12;  ?></td>
<td  valign="top"><?php $gt5+=$day1; echo $day1;  ?></td>
<td  valign="top"><?php $gt6+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt7+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt8+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt9+=$gt5day; echo $gt5day;  ?></td>
</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total <td><?php echo $gt1; ?></td> <td><?php echo $gt2; ?></td> <td><?php echo $gt3;  ?></td><td><?php echo $gt4;  ?></td><td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td><td><?php echo $gt9;  ?></td></tr>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>"; 
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
	 	 	 
	 }
 
?>
 <!--
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 -->
<div id="bg" class="popup_bg"> </div> 