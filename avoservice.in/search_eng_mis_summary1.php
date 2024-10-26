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
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="callsummary" >
<?php 
 if($_POST['calltype']=='brsummary') { ?>
<tr>

<th rowspan="3">Branch Name</th> 
<th colspan="16" style="text-align:center">Calls Summary</th>
</tr>
<tr>
<th colspan="5" width="10%" style="text-align:center">Service Call</th>
<th colspan="5" width="10%" style="text-align:center">Installation Call</th>
<th rowspan="2" width="10%" style="text-align:center">PM Call</th> 
<th rowspan="2" width="10%" style="text-align:center">Other Call (Inhouse)</th>
<th rowspan="2" width="10%" style="text-align:center">Other Call (Field)</th>
<th rowspan="2" width="10%" style="text-align:center">Total calls</th>
<th rowspan="2" width="10%" style="text-align:center">Average Calls per day</th>
<th rowspan="2" width="10%" style="text-align:center">Points Scored</th>
</tr>
<tr><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th></tr>
<?php


 $sql.="Select distinct(branch_id) from alert where branch_id<>'' ";


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
				
				
 $strsc="SELECT a.atm_id,a.assetstatus FROM `alert` a,alert_progress b where a.branch_id='".$row[0]."' and (a.alert_type='service' or a.alert_type='new temp') and (b.responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY) and b.responsetime<>'0000-00-00 00:00:00' and a.alert_id=b.alert_id";
                                   
 $strins="SELECT a.atm_id FROM `alert` a,alert_progress b where a.branch_id='".$row[0]."' and (a.alert_type='new' or a.alert_type='temp_dere') and (b.responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY) and b.responsetime<>'0000-00-00 00:00:00' and a.alert_id=b.alert_id";
   
 $strpm="SELECT count(*) FROM `alert` a,alert_progress b where a.branch_id='".$row[0]."' and (a.alert_type='temp_pm' or a.alert_type='pm') and (b.responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY) and b.responsetime<>'0000-00-00 00:00:00' and a.alert_id=b.alert_id";
 $strpm1="SELECT count(*) FROM `Pmcalls` where branch_id='".$row[0]."' and (Uptime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY)";
 //=========For  DERE
 $strdere="SELECT count(*) FROM `alert` a,alert_progress b where a.branch_id='".$row[0]."' and (a.alert_type='dere') and (b.responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY) and b.responsetime<>'0000-00-00 00:00:00' and a.alert_id=b.alert_id";
 //=====For Field work
 $str="SELECT count(*),name FROM `eng_mis` where eng_id in(select engg_id from area_engg where area LIKE '".$row[0]."') and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
 
 //====For In house
 $str1="SELECT count(*),name FROM `eng_mis` where eng_id in(select engg_id from area_engg where area LIKE '".$row[0]."') and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
                                														                    		
				$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;$cntdere=0;	
				$a_sc=0;$b_sc=0;$c_sc=0;$d_sc=0;$e_sc=0;	
				$a_ins=0;$b_ins=0;$c_ins=0;$d_ins=0;$e_ins=0;			
				$opencall=mysqli_query($con1,$str);
				$opencall1=mysqli_query($con1,$str1);
				//echo $strsc ."<br>";
                                $opencallsc=mysqli_query($con1,$strsc);
                                $opencallins=mysqli_query($con1,$strins);
                                $opencallpm=mysqli_query($con1,$strpm);
                                $opencallpm1=mysqli_query($con1,$strpm1);
                                $opencalldere=mysqli_query($con1,$strdere); //==for dere
				//echo "<br>".$str;
	  			while($openrow= mysqli_fetch_row($opencall)) //=====For Field work
                                { $cnt+=$openrow[0];
                                $ps=mysqli_query($con1,"select points from activity where id=".$openrow[1]);
                                $rps= mysqli_fetch_row($ps);
                                $pts+=$openrow[0]*$rps[0];
                                }
	  			while($openrow1= mysqli_fetch_row($opencall1))  //====For In house
                                { $cnt1+=$openrow1[0];
                                $ps=mysqli_query($con1,"select points from activity where id=".$openrow1[1]);
                                $rps= mysqli_fetch_row($ps);
                                $pts+=$openrow1[0]*$rps[0];
                                }
                                while($openrowsc= mysqli_fetch_row($opencallsc))
                                { $cntsc++;
                               /* if(startsWith($openrowsc[0], 'temp_'))
                                $ps=mysqli_query($con1,"select cat from tempsites where atmid='".$openrowsc[0]."'");*/
                                if($openrowsc[1]=='site')
                                $ps=mysqli_query($con1,"select cat from atm where track_id=".$openrowsc[0]);
                                else
                                $ps=mysqli_query($con1,"select CAT from Amc where AMCID=".$openrowsc[0]);
                                if(mysqli_num_rows($ps)==0)
                                {
                                $pts+=1.0;
                                $a_sc+=1;
                                }
                                else{
                                $rps= mysqli_fetch_row($ps);
                                if($rps[0]=='')
                                {
                                $pts+=1.0;
                                $a_sc+=1;
                                }
                                else if($rps[0]=='A')
                                {
                                $pts+=1.0;
                                $a_sc+=1;
                                }
                                else if($rps[0]=='B')
                                {
                                $pts+=1.5;
                                $b_sc+=1;
                                }
                                else if($rps[0]=='C')
                                {
                                $pts+=2.0;
                                $c_sc+=1;
                                }
                                else if($rps[0]=='D')
                                {
                                $pts+=2.5;
                                $d_sc+=1;
                                }
                                else if($rps[0]=='E')
                                {
                                $pts+=3.0;
                                $e_sc+=1;
                                }
                                else 
                                {
                                $pts+=1.0;
                                $a_sc+=1;
                                }
                                   }
                                }
                                while($openrowins= mysqli_fetch_row($opencallins))
                                { $cntins++;
                                $ps=mysqli_query($con1,"select cat from atm where track_id=".$openrowins[0]);
                              //  echo "select cat from atm where track_id=".$openrowins[0];
                              //  echo "-".mysqli_num_rows($ps)."<br>";
                                if(mysqli_num_rows($ps)==0)
                                {
                                $pts+=2.0;
                                $b_ins+=1;
                                }
                                else{
                                $rps= mysqli_fetch_row($ps);
                                if($rps[0]=='')
                                {
                                $pts+=2.0;
                                $b_ins+=1;
                                }
                                else if($rps[0]=='A')
                                {
                                $pts+=1.5;
                                $a_ins+=1;
                                }
                                else if($rps[0]=='B')
                                {
                                $pts+=2.0;
                                $b_ins+=1;
                                }
                                else if($rps[0]=='C')
                                {
                                $pts+=2.5;
                                $c_ins+=1;
                                }
                                else if($rps[0]=='D')
                                {
                                $pts+=3.0;
                                $d_ins+=1;
                                }
                                else if($rps[0]=='E')
                                {
                                $pts+=4.0;
                                $e_ins+=1;
                                }
                                else 
                                {
                                $pts+=2.0;
                                $b_ins+=1;
                                }
                                    
                                    }
                                }
                                $openrowpm= mysqli_fetch_row($opencallpm);
                                $openrowpm1= mysqli_fetch_row($opencallpm1);
                                $cntpm=$openrowpm[0]+$openrowpm1[0];                                
                                $pts+=$cntpm;                                    
                                
		?>
<tr>
<!--=== Branch name ===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
 ?></td>

<!--===Service Call===-->   
<td  valign="top">
<?php echo $a_sc;
 ?>
</td>
<td  valign="top">
<?php echo $b_sc;
 ?>
</td>
<td  valign="top">
<?php echo $c_sc;
 ?>
</td>
<td  valign="top">
<?php echo $d_sc;
 ?>
</td>
<td  valign="top">
<?php echo $e_sc;
 ?>
</td>

<!--===Installation Call===-->   
<td  valign="top"><?php echo $a_ins; ?></td>
<td  valign="top"><?php echo $b_ins; ?></td><td  valign="top"><?php echo $c_ins; ?></td>
<td  valign="top"><?php echo $d_ins; ?></td><td  valign="top"><?php echo $e_ins; ?></td>

<!--===PM Call===-->
<td  valign="top"><?php echo $cntpm; ?></td>

<!--===Other Call (Inhouse)===-->
<td  valign="top"><?php echo $cnt1;  ?></td>

<!--===Other Call (Field)===-->
<td  valign="top"><?php echo $cnt;  ?></td>

<!--===Total calls===-->
<td  valign="top"><?php echo $cnt1+$cnt+$cntsc+$cntins+$cntpm;  ?></td>

<!--===Average Calls per day===-->
<td  valign="top"><?php echo round(($cnt1+$cnt+$cntsc+$cntins+$cntpm)/($diff+1),2); ?></td>

<!--===Points Scored===-->
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
//==============================Engineer wise========================================================
 }else{ ?>
 <tr>

<th rowspan="3" width="10%">Engineer Name</th>
<th rowspan="3" width="10%">Branch</th>
 <th style="text-align:center">Attendance</th>
<th colspan="16" style="text-align:center">Calls Summary</th>

</tr>

<tr>
<th rowspan="2" width="10%" style="text-align:center">No. of Days Present</th>
<th colspan="5" width="10%" style="text-align:center">Service Call</th>
<th colspan="5" width="10%" style="text-align:center">Installation/DeRe Call</th>
<th rowspan="2" width="10%" style="text-align:center">PM Call</th> 
<th rowspan="2" width="10%" style="text-align:center">Other Call (Inhouse)</th>
<th rowspan="2" width="10%" style="text-align:center">Other Call (Field)</th>
<th rowspan="2" width="10%" style="text-align:center">Total calls</th>
<th rowspan="2" width="10%" style="text-align:center">Average Calls per day</th>
<th rowspan="2" width="10%" style="text-align:center">Points Scored</th>
</tr>
<tr><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th></tr>
<?php
	//$ctype=$_POST['calltype'];
	//$ctyp1=explode(',',$ctype);
	//$alert_type=$_POST['openall'];
	
 if(isset($_POST['branch']) && $_POST['branch']!='')
 $sql.="SELECT engg_id,engg_name,area,loginid FROM `area_engg` where area='".$_POST['branch']."' and deleted=0 and status=1";
 else
 $sql.="SELECT engg_id,engg_name,area,loginid FROM `area_engg` where deleted=0 and status=1";



$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center"><!--Total number of Records :<b><?php echo $Num_Rows; ?></b>-->
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
//echo $sql;
$table=mysqli_query($con1,$sql);
$frm=str_replace("/","-",$_POST['fromdt']); //echo $frm;
$to=str_replace("/","-",$_POST['todt']); //echo $to;
 //echo date('d-m-Y ',strtotime($frm)); 
$d1 = new DateTime($frm);
$d2 = new DateTime($to);
$diff=$d1->diff($d2)->days; 
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$sn=1;
//$gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];

while($row= mysqli_fetch_row($table))
{$pts=0;	
  $engbr=mysqli_query($con1,"select name from avo_branch where id='".$row[2]."'");                          	
  $engbrrow= mysqli_fetch_row($engbr);
  $engbranch=$engbrrow[0];

 //============= while loop for open call =========================
				//echo "<br>SELECT count(*),call_status FROM `alert` where state LIKE '".$row[0]."' and ( call_status = 'Pending' or call_status='1')  group by state";
				 $stratn="SELECT distinct(attend_date) FROM `avo_attendence` where eng='".$row[1]."' and branch_id='".$row[2]."' and attend_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') and present='P'";   
				$alerts='';
				$engqry=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$row[0]."'");                          
				while($engrow= mysqli_fetch_row($engqry)){
				$alerts=$alerts.$engrow[0].',';
				}
				$alerts=substr($alerts,0,strlen($alerts)-1);
				// echo $stratn;         
				$strsc="SELECT atm_id,alert_id,assetstatus FROM `alert` where alert_id in(".$alerts.") and (alert_type='service' or alert_type='new temp') and (responsetime<>'0000-00-00 00:00:00' or close_date<>'0000-00-00 00:00:00') and responsetime<>'1970-01-01 00:00:00' ";  
				//$strsc="SELECT a.atm_id FROM `alert` a,alert_progress b where a.alert_id in(".$alerts.") and (a.alert_type='service' or a.alert_type='new temp') and (b.responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY) and b.responsetime<>'0000-00-00 00:00:00' and a.alert_id=b.alert_id";                                  
 $strins="SELECT atm_id,alert_id FROM `alert` where alert_id in(".$alerts.") and (alert_type='new' or alert_type='temp_dere') and (responsetime<>'0000-00-00 00:00:00' or close_date<>'0000-00-00 00:00:00') and responsetime<>'1970-01-01 00:00:00' ";                                    
 $strpm="SELECT count(*) FROM `alert` where alert_id in(".$alerts.") and (alert_type='temp_pm' or alert_type='pm') and (responsetime<>'0000-00-00 00:00:00' or close_date<>'0000-00-00 00:00:00') and responsetime<>'1970-01-01 00:00:00' ";  
 $strpm1="SELECT count(*) FROM `Pmcalls` where engId='".$row[3]."' and (Uptime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY)";
//$strins="SELECT a.atm_id FROM `alert` a,alert_progress b where a.alert_id in(".$alerts.") and a.alert_type='new' and (b.responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY) and b.responsetime<>'0000-00-00 00:00:00' and a.alert_id=b.alert_id";
   
 //$strpm="SELECT count(*) FROM `alert` a,alert_progress b where a.alert_id in(".$alerts.") and (a.alert_type='temp_pm' or a.alert_type='pm') and (b.responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY) and b.responsetime<>'0000-00-00 00:00:00' and a.alert_id=b.alert_id";   
                                
 $str="SELECT count(*),name FROM `eng_mis` where eng_id='".$row[0]."' and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
 $str1="SELECT count(*),name FROM `eng_mis` where eng_id='".$row[0]."' and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
                                			
				//========================================From Date to Date============
									
                      $strsc.=" and (responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY)";				
              $strins.=" and (responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY)";				
          $strpm.=" and (responsetime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY or close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY)";				

				//echo $strsc;
				$atn=0;$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;	
				$a_sc=0;$b_sc=0;$c_sc=0;$d_sc=0;$e_sc=0;	
				$a_ins=0;$b_ins=0;$c_ins=0;$d_ins=0;$e_ins=0;			
				$atncall=mysqli_query($con1,$stratn);
				$opencall=mysqli_query($con1,$str);
				$opencall1=mysqli_query($con1,$str1);
                                $opencallsc=mysqli_query($con1,$strsc);
                                $opencallins=mysqli_query($con1,$strins);
                                $opencallpm=mysqli_query($con1,$strpm);
                                $opencallpm1=mysqli_query($con1,$strpm1);
                            //    echo $strpm;
				//echo "<br>".$str;
				$atnrow=mysqli_num_rows($atncall);
				$atn=$atnrow;
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
                                if($openrowsc[2]=='site')
                                $ps=mysqli_query($con1,"select cat from atm where track_id=".$openrowsc[0]);
                                else
                                $ps=mysqli_query($con1,"select CAT from Amc where AMCID=".$openrowsc[0]);
                              //  $ps=mysqli_query($con1,"select cat from atm where track_id=".$openrowsc[0]);
                                $nops=mysqli_query($con1,"select count(*) from alert_progress where alert_id=".$openrowsc[1]." and engg_id='".$row[3]."' and responsetime between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY");
                            //    echo "select count(*) from alert_progress where alert_id=".$openrowsc[1]." and engg_id='".$row[3]."' and responsetime between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
                                $rnops= mysqli_fetch_row($nops);
                                $ccc=$rnops[0];
                                if($ccc==0)$ccc=1;
                                if(mysqli_num_rows($ps)==0)
                                {
                                $pts+=$ccc*1.0;
                                $a_sc+=1;
                                }
                                else{
                                $rps= mysqli_fetch_row($ps);
                                if($rps[0]=='')
                                {
                                $pts+=$ccc*1.0;
                                $a_sc+=1;
                                }
                                else if($rps[0]=='A')
                                {
                                $pts+=$ccc*1.0;
                                $a_sc+=1;
                                }
                                else if($rps[0]=='B')
                                {
                                $pts+=$ccc*1.5;
                                $b_sc+=1;
                                }
                                else if($rps[0]=='C')
                                {
                                $pts+=$ccc*2.0;
                                $c_sc+=1;
                                }
                                else if($rps[0]=='D')
                                {
                                $pts+=$ccc*2.5;
                                $d_sc+=1;
                                }
                                else if($rps[0]=='E')
                                {
                                $pts+=$ccc*3.0;
                                $e_sc+=1;
                                }
                                else 
                                {
                                $pts+=$ccc*1.0;
                                $a_sc+=1;
                                }
                                   }
                                }
                                while($openrowins= mysqli_fetch_row($opencallins))
                                { $cntins++;
                                $ps=mysqli_query($con1,"select cat from atm where track_id=".$openrowins[0]);
                                if(mysqli_num_rows($ps)==0)
                                {
                                $pts+=2.0;
                                $b_ins+=1;
                                }
                                else{
                                $rps= mysqli_fetch_row($ps);
                                if($rps[0]=='')
                                {
                                $pts+=2.0;
                                $b_ins+=1;
                                }
                                else if($rps[0]=='A')
                                {
                                $pts+=1.5;
                                $a_ins+=1;
                                }
                                else if($rps[0]=='B')
                                {
                                $pts+=2.0;
                                $b_ins+=1;
                                }
                                else if($rps[0]=='C')
                                {
                                $pts+=2.5;
                                $c_ins+=1;
                                }
                                else if($rps[0]=='D')
                                {
                                $pts+=3.0;
                                $d_ins+=1;
                                }
                                else if($rps[0]=='E')
                                {
                                $pts+=4.0;
                                $e_ins+=1;
                                }
                                else 
                                {
                                $pts+=2.0;
                                $b_ins+=1;
                                }
                                    }
                                }
                                $openrowpm= mysqli_fetch_row($opencallpm);
                                $openrowpm1= mysqli_fetch_row($opencallpm1);
                                $cntpm=$openrowpm[0]+$openrowpm1[0];                                
                                $pts+=$cntpm;                                    
		?>
<tr>
<!--===SN===-->
<td  valign="top"><?php 
//echo '<a href="#" onclick="opennew('.$row[3].');" >'.$row[1]."</a>";
echo '<a onclick=opennew('.$row[0].') >'.$row[1].'</a>';
 ?></td>
<td  valign="top"><?php 
echo $engbranch;
 ?></td>
<td  valign="top"><?php 
echo $atn;
 ?></td>

<!--===customer name===-->   
<td  valign="top">
<?php 

echo $a_sc;
 ?>
</td>
<td  valign="top">
<?php 

echo $b_sc;
 ?>
</td>
<td  valign="top">
<?php 

echo $c_sc;
 ?>
</td>
<td  valign="top">
<?php 

echo $d_sc;
 ?>
</td>
<td  valign="top">
<?php 

echo $e_sc;
 ?>
</td>

<!--===Open===-->   
<td  valign="top"><?php echo $a_ins;  ?></td>
<td  valign="top"><?php echo $b_ins;  ?></td><td  valign="top"><?php echo $c_ins;  ?></td>
<td  valign="top"><?php echo $d_ins;  ?></td><td  valign="top"><?php echo $e_ins;  ?></td>

<!--===Close===-->
<td  valign="top"><?php echo $cntpm; ?></td>

<!--===Total===-->
<td  valign="top"><?php echo $cnt1;  ?></td>
<td  valign="top"><?php echo $cnt;  ?></td>
<td  valign="top"><?php echo $cnt+$cnt1+$cntsc+$cntins+$cntpm;  ?></td>
<td  valign="top"><?php echo ($cnt+$cnt1+$cntsc+$cntins+$cntpm)/($diff+1);  ?></td>
<td  valign="top"><?php echo $pts;  ?></td>
</tr>
<?php

	$sn++;
	}}
?>


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