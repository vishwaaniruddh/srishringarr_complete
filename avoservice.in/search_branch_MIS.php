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
<tr>

<th rowspan="2">Branch Name</th> 
<th colspan="7" style="text-align:center">Calls Summary</th>
</tr>
<tr>
<th width="10%" style="text-align:center">Old Pending calls</th>
<th width="10%" style="text-align:center">Todays Log Call</th>
<th width="10%" style="text-align:center">Today Closed Call</th> 
<th width="10%" style="text-align:center">Today Rejected Call</th>
<th width="10%" style="text-align:center">Open Calls</th>
<th width="10%" style="text-align:center">Open/Attended calls</th>
<th width="10%" style="text-align:center">Hold calls</th>
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
//$frm=str_replace("/","-",$_POST['fromdt']); //echo $frm;
//$to=str_replace("/","-",$_POST['todt']); //echo $to;
 //echo date('d-m-Y ',strtotime($frm)); 
/*$d1 = new DateTime($frm);
$d2 = new DateTime($to);
$diff=$d1->diff($d2)->days; */
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$sn=1;

//$fromdt=$_POST['fromdt'];

 $sc=0;$ic=0;$pc=0;$dc=0;$ac=0;
while($row= mysqli_fetch_row($table))
{$pts=0;		
//============= while loop for open call =========================
				//echo "<br>SELECT count(*),call_status FROM `alert` where state LIKE '".$row[0]."' and ( call_status = 'Pending' or call_status='1')  group by state";
				
date_default_timezone_set('Asia/Kolkata');
 $todt=date('Y-m-d');
				
				
 $strsc="SELECT atm_id FROM `alert`  where branch_id='".$row[0]."' and call_status in ('0', 'Pending', '1' ,'2' ,'Delegated')  and status in ('0', 'Pending','delegated', '1') and  date(entry_date) < '".$todt."' "; 
 
 $strSum="SELECT count(*) FROM `alert` where branch_id='1'   and (call_status ='Done' or status ='Done' ) and  date(close_date)='".$todt."'  and  date(entry_date)<'".$todt."' ";
 
 
 $strins="SELECT atm_id FROM `alert`  where branch_id='".$row[0]."' and   DATE(entry_date) = '".$todt."' ";
 

 $strpm= "SELECT count(*) FROM `alert`  where branch_id='".$row[0]."' and (status='Done' or  call_status='Done') and  DATE(close_date) = '".$todt."'";
 

 $strdere= "SELECT count(*) FROM `alert`  where branch_id='".$row[0]."' and (status='Rejected' or  call_status='Rejected') and  DATE(Reject_date) = '".$todt."'";
  
 $strscxxx="SELECT count(*) FROM `alert`  where branch_id='".$row[0]."'  and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and atm_id<>'temp_' and status != 'Done' ";
//echo $strscxxx;
     // For attended calls
    $stratd="SELECT a.atm_id FROM `alert` a,alert_progress b where a.branch_id='".$row[0]."' and date(b.responsetime)='".$todt."' and a.close_date='0000-00-00 00:00:00' and a.alert_id=b.alert_id";
  //   $stratd="SELECT a.atm_id FROM `alert` a,alert_progress b where a.branch_id='".$row[0]."' and (b.responsetime Between dateTR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY and a.close_date='0000-00-00 00:00:00') and a.alert_id=b.alert_id";
  //  echo $stratd;

 $strhold= "SELECT count(*) FROM `alert`  where branch_id='".$row[0]."' and call_status='onhold' ";


				$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;$cntdere=0;$cntatd=0;				
		
                                $opencallsc=mysqli_query($con1,$strsc); $qrysum=mysqli_query($con1,$strSum);
                                $opencallins=mysqli_query($con1,$strins);
                                $opencallpm=mysqli_query($con1,$strpm);
                                $opencallpm1=mysqli_query($con1,$strpm1);
                                $strscRun=mysqli_query($con1,$strscxxx);
                                $opencalldere=mysqli_query($con1,$strdere); //==for dere
                                $opencallatd=mysqli_query($con1,$stratd);
                                $holdcallatd=mysqli_query($con1,$strhold);
		
	  			                $openrowsc= mysqli_num_rows($opencallsc);
	  			                 $fetchSum= mysqli_fetch_row($qrysum);
	  			                
                                $cntsc=$openrowsc+$fetchSum[0];
                                $openrowins= mysqli_num_rows($opencallins);
                                $cntins=$openrowins;
                                $openrowdere= mysqli_fetch_row($opencalldere);
                                $cntdere=$openrowdere[0];
                                $openrowpm= mysqli_fetch_row($opencallpm);
                                $openrowpm1= mysqli_fetch_row($opencallpm1);
                                $cntpm=$openrowpm[0]+$openrowpm1[0]; 
                                
                                $openrowrun= mysqli_fetch_row($strscRun);
                                $cntrun=$openrowrun[0]; 
                                
                                $holdrowrun= mysqli_fetch_row($holdcallatd);
                                $cntholdrun=$holdrowrun[0]; 
                            
                                
                                $openrowatd= mysqli_num_rows($opencallatd);
                                $cntatd=$openrowatd;     
                                
                                
                                                                    
                              $sc+=$cntsc; $ic+=$cntins; $pc+=$cntpm; $dc+=$cntdere;$bc+= $cntrun;$ac+=$cntatd; $hld+= $cntholdrun; 
		?>
<tr>
<!--=== Branch name ===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
//echo '<a href="br_eng_det.php?id='.$branch1[0].'&dt='.$todt.'" >'.$branch1[1].'</a>';
 ?></td>
  
<td  valign="top">
<?php echo '<a onclick=opennew('.$branch1[0].',"sc") >'.$cntsc.'</a>';
 ?>
</td>


<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"ins") >'.$cntins.'</a>'; ?></td>

<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"pm") >'.$cntpm.'</a>'; ?></td>

<!--===DERE Call===-->
<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"dere") >'.$cntdere.'</a>';  ?></td>

<!--===Attended Call (Field)===-->
<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"atd") >'.$cntrun.'</a>';  ?></td>


<!--===Total calls===-->
<td  valign="top"><?php echo $cntatd ?></td>
<td  valign="top"><?php echo $cntholdrun ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td ><font color="red" >Grand Total </font></td><td><font color="red" ><?php echo $sc; ?></font></td> <td><font color="red" ><?php echo $ic; ?></font></td> <td><font color="red" ><?php echo $pc; ?></font></td><td><font color="red" ><?php echo $dc; ?></font></td><td><font color="red" ><?php echo $bc; ?></font></td><td><font color="red" ><?php  echo $ac; ?></font></td><td><font color="red" ><?php  echo $hld; ?></font></td></tr>

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
 
?>
 <!--
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 -->
<div id="bg" class="popup_bg"> </div> 