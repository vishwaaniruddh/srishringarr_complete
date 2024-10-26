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

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary1" >
<?php 
 if($_POST['calltype']=='brsummary') { ?>
<tr>

<th rowspan="2">Branch Name</th> 
<th colspan="8" style="text-align:center">Calls Summary</th>
</tr>
<tr>
<th rowspan="1" width="10%" style="text-align:center">Service Call</th>
<th rowspan="1" width="10%" style="text-align:center">Installation Call</th>
<th rowspan="1" width="10%" style="text-align:center">De-Re Inst. Call</th>
<th rowspan="1" width="10%" style="text-align:center">PM Call</th> 
<th rowspan="1" width="10%" style="text-align:center">Other Call (Inhouse)</th>
<th rowspan="1" width="10%" style="text-align:center">Other Call (Field)</th>
<th rowspan="1" width="10%" style="text-align:center">Total calls</th>
<!--<th rowspan="1" width="10%" style="text-align:center">Average Calls per day</th>-->
<!--<th rowspan="1" width="10%" style="text-align:center">Points Scored</th>-->
</tr>

<?php


 $sql.="Select id, name from avo_branch";


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


$qr22=$sql;
//echo $sql;


$sql.=" LIMIT $Page_Start , $Per_Page";


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{

$fromdt=$_POST['fromdt']; //echo $fromdt;
$todt=$_POST['todt']; //echo $todt;

}
else { $fromdt=date('d/m/Y');
    $todt=date('d/m/Y'); }

//echo $sql;

$table=mysqli_query($con1,$sql);
	$sccnt=0; $incnt=0; $dercnt=0; $pmcont=0; $inhscnt=0; $flcnt=0; $tott=0;

while($row= mysqli_fetch_row($table))
{
    $sn=0;
    $pts=0;		
//============= Cled calls =========================
				
 $serviceqry="SELECT count(*) as count FROM `alert` where branch_id='".$row[0]."' and (alert_type='service' or alert_type='new temp') and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by branch_id";
// echo $serviceqry;
 
 //=====New Inst                                  
 $instqry="SELECT count(*) as count FROM `alert` where branch_id='".$row[0]."' and alert_type='new' and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY  group by branch_id";
// echo $instqry;  
      
 $pmqry="SELECT count(*) as count FROM `alert` where branch_id='".$row[0]."' and (alert_type='temp_pm' or alert_type='pm') and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by branch_id ";
 
 //========= App PM++++++++
  //$strpm1="SELECT count(*) FROM `Pmcalls` where branch_id='".$row[0]."' and (Uptime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY) group by branch_id ";
 
//===Dere
   $dereqry="SELECT count(*) as count FROM `alert` where branch_id='".$row[0]."' and (alert_type='dere' or alert_type='temp_dere')  and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by branch_id ";

 //=====For Field work=============
 $fieldqry="SELECT count(*) as count FROM `eng_mis` where eng_id in(select engg_id from area_engg where area ='".$row[0]."') and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')";
// echo $fieldqry;
 
 //====For In house===========
$inhouseqry="SELECT count(*) as count FROM `eng_mis` where eng_id in(select engg_id from area_engg where area ='".$row[0]."') and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')";
                                														                    		
				$servicecnt=0;$instcnt=0;$pmcnt=0;$derecnt=0;$fieldcnt=0;$inhousecnt=0;
				
			
				
				                $service=mysqli_query($con1,$serviceqry);
                                $servicecnt=mysqli_fetch_assoc($service)['count'];
                                
                                $inst=mysqli_query($con1,$instqry);
                                $instcnt=mysqli_fetch_assoc($inst)['count'];
                                
                                $pmres=mysqli_query($con1,$pmqry);
                                $pmcnt=mysqli_fetch_assoc($pmres)['count'];
                                
                                $dere=mysqli_query($con1,$dereqry);
                                $derecnt=mysqli_fetch_assoc($dere)['count'];
                                
                                $field=mysqli_query($con1,$fieldqry);
				                $fieldcnt=mysqli_fetch_assoc($field)['count'];
				                
				                $inhouse=mysqli_query($con1,$inhouseqry);
                                $inhousecnt=mysqli_fetch_assoc($inhouse)['count'];
                                
	  	 
		?>
<tr>
<!--=== Branch name ===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
 ?></td>

<!--===Service Call===-->   

<td  valign="top"><?php $sccnt+=$servicecnt; echo $servicecnt;?></td>

<!--===Installation Call===-->   
<td  valign="top"><?php $incnt+=$instcnt; echo $instcnt;?></td>
<!--===Dere Installation Call===-->  
<td  valign="top"><?php $dercnt+=$derecnt; echo $derecnt;?></td>

<!--===PM Call===-->
<td  valign="top"><?php $pmcont+=$pmcnt; echo $pmcnt; ?></td>

<!--===Other Call (Inhouse)===-->
<td  valign="top"><?php $inhscnt+=$inhousecnt; echo $inhousecnt;  ?></td>

<!--===Other Call (Field)===-->
<td  valign="top"><?php $flcnt+=$fieldcnt; echo $fieldcnt;  ?></td>


<!--===Total calls===-->
<td  valign="top"><?php $tott+=($servicecnt+$instcnt+$derecnt+$pmcnt+$inhousecnt+$fieldcnt); echo $servicecnt+$instcnt+$derecnt+$pmcnt+$inhousecnt+$fieldcnt;  ?></td>

<!--===Average Calls per day===-->
<!--<td  valign="top"><?php echo round(($cnt1+$cnt+$cntsc+$cntins+$cntpm)/($diff+1),2); ?></td>-->

<!--===Points Scored===-->
<!--<td  valign="top"><?php //echo $pts; ?></td>-->
</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total <td><?php echo $sccnt; ?></td> <td><?php echo $incnt;  ?></td> <td><?php echo $dercnt;  ?></td><td><?php echo $pmcont; ?></td><td><?php echo $inhscnt;  ?></td><td><?php echo $flcnt;  ?></td><td><?php echo $tott; ?></td></tr>

</table>


<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}

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
<th rowspan="3" width="6%">Employee Code</th>
<th rowspan="3" width="6%">Designation</th>
<th rowspan="3" width="6%">Date of Join</th>
<th colspan="7" style="text-align:center">Calls Summary</th>

</tr>

<tr>
<th rowspan="2" width="6%" style="text-align:center">Service Call</th>
<th rowspan="2" width="6%" style="text-align:center">Installation Call</th>
<th rowspan="2" width="6%" style="text-align:center">PM Call</th> 
<th rowspan="2" width="6%" style="text-align:center">De-re Install</th>

<th rowspan="2" width="6%" style="text-align:center">Other Call (Field)</th>
<th rowspan="2" width="6%" style="text-align:center">Other Call (Inhouse)</th>
<th rowspan="2" width="6%" style="text-align:center">Total calls</th><!--
<th rowspan="2" width="6%" style="text-align:center">Average Calls per day</th>-->

</tr>

<tr></tr>
<?php
	
	
 if(isset($_POST['branch']) && $_POST['branch']!='')
 $sql.="SELECT engg_id,engg_name,area, loginid,engg_desgn, emp_code,date_join FROM `area_engg` where area='".$_POST['branch']."' and deleted=0 and status=1";
 else 
 $sql.="SELECT engg_id,engg_name,area,loginid, engg_desgn, emp_code,date_join FROM `area_engg` where deleted=0 and status=1";



$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center"><!--Total number of Records :<b><?php echo $Num_Rows; ?></b>-->
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%25==0)
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


if(mysqli_num_rows($table)>0) {
	$sn=1;
//$gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
} else { $fromdt=date('d/m/Y');
        $todt=date('d/m/Y'); }

//echo $fromdt ;
//echo $todt ;

while($row= mysqli_fetch_row($table))
{$pts=0;	
  $engbr=mysqli_query($con1,"select name from avo_branch where id='".$row[2]."'");                          	
  $engbrrow= mysqli_fetch_row($engbr);
  $engbranch=$engbrrow[0];

 //============= while loop for open call =========================
 $serviceqry="SELECT count(*) as count FROM `alert` where alert_id in(select alert_id from alert_delegation where engineer='".$row[0]."' order by id DESC ) and (alert_type='service' or alert_type='new temp') and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY ";

 $instqry="SELECT count(*) as count FROM `alert` where alert_id in(select alert_id from alert_delegation where engineer='".$row[0]."' order by id DESC) and alert_type='new' and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY ";

$pmqry="SELECT count(*) as count FROM `alert` where alert_id in(select alert_id from alert_delegation where engineer='".$row[0]."' order by id DESC) and (alert_type='pm' or alert_type='temp_pm') and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY ";

$dereqry="SELECT count(*) as count FROM `alert` where alert_id in(select alert_id from alert_delegation where engineer='".$row[0]."' order by id DESC) and (alert_type='dere' or alert_type='temp_dere') and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY ";

 //=====For Field work=============
 $fieldqry="SELECT count(*) as count FROM `eng_mis` where eng_id in(select engg_id from area_engg where area ='".$row[0]."') and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')";
// echo $fieldqry;
 
 //====For In house===========
$inhouseqry="SELECT count(*) as count FROM `eng_mis` where eng_id in(select engg_id from area_engg where area ='".$row[0]."') and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')";

		//	echo $serviceqry;
				$fieldcnt=0;$inhousecnt=0;$cntsc=0;$cntins=0;$cntpm=0;$derecnt=0;	
			
				
				
				                $service=mysqli_query($con1,$serviceqry);
                                $cntsc=mysqli_fetch_assoc($service)['count'];
                                
                                $inst=mysqli_query($con1,$instqry);
                                $cntins=mysqli_fetch_assoc($inst)['count'];
                                
                                $pmres=mysqli_query($con1,$pmqry);
                                $cntpm=mysqli_fetch_assoc($pmres)['count'];
                                
                                $dere=mysqli_query($con1,$dereqry);
                                $derecnt=mysqli_fetch_assoc($dere)['count'];
                                
                                $field=mysqli_query($con1,$fieldqry);
				                $fieldcnt=mysqli_fetch_assoc($field)['count'];
				                
				                $inhouse=mysqli_query($con1,$inhouseqry);
                                $inhousecnt=mysqli_fetch_assoc($inhouse)['count'];
		?>
		
<tr>
<!--===Engr name===-->
<td  valign="top"><?php 
echo '<a onclick=opennew('.$row[0].') >'.$row[1].'</a>';
 ?></td>
<!--======= Branch name====--> 
<td  valign="top"><?php echo $engbranch;  ?></td>
<!--======= Employee code====-->  
 <td  valign="top"><?php  echo $row[5];  ?></td>
<!--======= Designation====-->  
 <td  valign="top"><?php echo $row[4];  ?></td>
 
 <!--======= Date of Join====-->  
 <td  valign="top"><?php echo $row[6];  ?></td>
 
<!--===e===-->   
<td  valign="top">
  <?php echo  $cntsc;?>
</td>

<!--===Inst===-->   
<td  valign="top"><?php echo $cntins;?></td>

<!--===PM===-->
<td  valign="top"><?php echo $cntpm; ?></td>

<td  valign="top"><?php echo $derecnt; ?></td>

<!--===Total===-->
<td  valign="top"><?php echo $fieldcnt;  ?></td>
<td  valign="top"><?php echo $inhousecnt;  ?></td>

<td  valign="top"><?php echo $fieldcnt+$inhousecnt+$cntsc+$cntins+$cntpm+$derecnt;  ?></td>
<!--<td  valign="top"><?php //echo ($cnt+$cnt1+$cntsc+$cntins+$cntpm)/($diff+1);  ?></td>-->

</tr>
<?php

	$sn++;
	}}
?>


</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}

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