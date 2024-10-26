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
<th colspan="6" style="text-align:center">Open Calls Summary</th>
</tr>
<tr>
<th width="10%" style="text-align:center">Service Call</th>
<th width="10%" style="text-align:center">Installation Call</th>
<th width="10%" style="text-align:center">PM Call</th> 
<th width="10%" style="text-align:center">DERE Call</th>
<th width="10%" style="text-align:center">Total calls</th>
</tr>
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
$sql.=" group by `branch_id` LIMIT $Page_Start , $Per_Page";

$to=str_replace("/","-",$_POST['todt']); //echo $to;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;



 $sc=0;$ic=0;$pc=0;$dc=0;
while($row= mysqli_fetch_row($table))
{$pts=0;		
//============= while loop for open call =========================
				
				
 $strsc="SELECT a.atm_id FROM `alert` a where a.branch_id='".$row[0]."' and (a.alert_type='service' or a.alert_type='new temp') and status IN ('Pending','Delegated') and call_status IN ('1','Pending') ";
                                   
 $strins="SELECT a.atm_id FROM `alert` a where a.branch_id='".$row[0]."' and a.alert_type='new' and status IN ('Pending','Delegated') and call_status IN ('1','Pending')";
   
 $strpm="SELECT count(*) FROM `alert` a where a.branch_id='".$row[0]."' and (a.alert_type='temp_pm' or a.alert_type='pm') and status IN ('Pending','Delegated') and call_status IN ('1','Pending')";
 //=========For  DERE
 $strdere="SELECT count(*) FROM `alert` a where a.branch_id='".$row[0]."' and (a.alert_type='dere' or a.alert_type='temp_dere') and status IN ('Pending','Delegated') and call_status IN ('1','Pending')";
 //=====For Field work
 //$str="SELECT count(*),name FROM `eng_mis` where eng_id in(select engg_id from area_engg where area LIKE '".$row[0]."') and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
 
 //====For In house
 //$str1="SELECT count(*),name FROM `eng_mis` where eng_id in(select engg_id from area_engg where area LIKE '".$row[0]."') and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
                                														                  // For attended calls
                                														            //      $stratd="SELECT a.atm_id FROM `alert` a,alert_progress b where a.branch_id='".$row[0]."' and (b.responsetime Between STR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY and a.close_date='0000-00-00 00:00:00') and a.alert_id=b.alert_id";
                                														                   		
				$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;$cntdere=0;				
				//$opencall=mysqli_query($con1,$str);
				//$opencall1=mysqli_query($con1,$str1);
				//echo $strsc ."<br>";
                                $opencallsc=mysqli_query($con1,$strsc);
                                $opencallins=mysqli_query($con1,$strins);
                                $opencallpm=mysqli_query($con1,$strpm);
                                $opencallpm1=mysqli_query($con1,$strpm1);
                                $opencalldere=mysqli_query($con1,$strdere); //==for dere
                               // $opencallatd=mysqli_query($con1,$stratd);
				//echo "<br>".$str;
	  			$openrowsc= mysqli_num_rows($opencallsc);
                                $cntsc=$openrowsc;
                                $openrowins= mysqli_num_rows($opencallins);
                                $cntins=$openrowins;
                                $openrowdere= mysqli_fetch_row($opencalldere);
                                $cntdere=$openrowdere[0];
                                $openrowpm= mysqli_fetch_row($opencallpm);
                                $openrowpm1= mysqli_fetch_row($opencallpm1);
                                $cntpm=$openrowpm[0]+$openrowpm1[0]; 
                              //  $openrowatd= mysqli_num_rows($opencallatd);
                              //  $cntatd=$openrowatd;                               
                                                                    
                              $sc+=$cntsc; $ic+=$cntins; $pc+=$cntpm; $dc+=$cntdere;
		?>
<tr>
<!--=== Branch name ===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
//echo '<a href="br_eng_det.php?id='.$branch1[0].'&dt='.$todt.'" >'.$branch1[1].'</a>';
 ?></td>

<!--===Service Call===-->   
<td  valign="top">
<?php echo '<a onclick=opennew('.$branch1[0].',"sc") >'.$cntsc.'</a>';
 ?>
</td>

<!--===Installation Call===-->   
<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"ins") >'.$cntins.'</a>'; ?></td>

<!--===PM Call===-->
<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"pm") >'.$cntpm.'</a>'; ?></td>

<!--===DERE Call===-->
<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"dere") >'.$cntdere.'</a>';  ?></td>

<!--===Attended Call (Field)===-->


<!--===Total calls===-->
<td  valign="top"><?php echo $cntdere+$cntsc+$cntins+$cntpm;  ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td ><font color="red" >Grand Total </font></td><td><font color="red" ><?php echo $sc; ?></font></td> <td><font color="red" ><?php echo $ic; ?></font></td> <td><font color="red" ><?php echo $pc; ?></font></td><td><font color="red" ><?php echo $dc; ?></font></td><td><font color="red" ><?php  echo $sc+$ic+$pc+$dc; ?></font></td></tr>

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