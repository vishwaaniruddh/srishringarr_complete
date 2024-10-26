<?php
session_start();  
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];

	
	$ddl_branch=$_POST['ddl_branch'];
	

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="callsummary" >
<tr>

<th rowspan="2">Engr Name</th> 
<th rowspan="2">Designation</th>
<th rowspan="2">Emp Code</th>
<th rowspan="2">City</th>
<th rowspan="2">Branch</th>
<th colspan="5" style="text-align:center">Open Calls Summary</th>
</tr>
<tr>

<th width="10%" style="text-align:center">Service Call</th>
<th width="10%" style="text-align:center">Installation Call</th>
<th width="10%" style="text-align:center">PM Call</th> 
<th width="10%" style="text-align:center">DERE Call</th>
<th width="10%" style="text-align:center">Total calls</th>
</tr>
<?php
 $sql.="Select branch_id,engg_name,engg_id, engg_desgn, city, emp_code from area_engg where status=1 and `deleted` = 0 ";

if($ddl_branch!=""){
  $sql.=" and branch_id='".$ddl_branch."' ";
}


$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
<option value="<?php echo $Num_Rows; ?>" ><?php echo "All"; ?></option>
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
 
 </select>
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
//$Per_Page =$_POST['perpg'];   // Records Per Page
$Per_Page = $Num_Rows;
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
$sql.="  LIMIT $Page_Start , $Per_Page";

//echo $sql;
 
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;

 $sc=0;$ic=0;$pc=0;$dc=0;
 
 while($row= mysqli_fetch_row($table))
{$pts=0;		
//============= while loop for open call =========================

       /*         $alerts='';
				$engqry=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$row[2]."'");                          
				while($engrow= mysqli_fetch_row($engqry)){
				$alerts=$alerts.$engrow[0].',';
				}
				$alerts=substr($alerts,0,strlen($alerts)-1); */
				
				
$strsc="SELECT count(*) as count FROM `alert` where alert_id in(select alert_id from alert_delegation where engineer='".$row[2]."') and (alert_type='service' or alert_type='new temp') and status IN ('Pending','Delegated') and call_status IN ('1','Pending') and branch_id <> '' ";


//echo $strsc;

$strins="SELECT count(*) as count FROM `alert` where alert_id in(select alert_id from alert_delegation where engineer='".$row[2]."') and alert_type='new' and status IN ('Pending','Delegated') and call_status IN ('1','Pending') ";

$strpm="SELECT count(*) as count FROM `alert` where alert_id in(select alert_id from alert_delegation where engineer='".$row[2]."') and (alert_type='temp_pm' or alert_type='pm') and status IN ('Pending','Delegated') and call_status IN ('1','Pending') ";
   

$strdere="SELECT count(*) as count FROM `alert` where alert_id in(select alert_id from alert_delegation where engineer='".$row[2]."') and (alert_type='dere' or alert_type='temp_dere') and status IN ('Pending','Delegated') and call_status IN ('1','Pending') ";

           if($ddl_branch!="")   {
             $strsc.= " and branch_id='".$ddl_branch."' "; 
             $strins.=" and branch_id='".$ddl_branch."' ";
             $strpm.= " and branch_id='".$ddl_branch."' ";
             $strdere.= " and branch_id='".$ddl_branch."' ";
          
           }                  												
             												
         // echo   $strsc;                  														                   		
		
				$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;$cntdere=0;		
				
                               $service=mysqli_query($con1,$strsc);
                                $cntsc=mysqli_fetch_assoc($service)['count'];
                                
                                $inst=mysqli_query($con1,$strins);
                                $cntins=mysqli_fetch_assoc($inst)['count'];
                                
                                $pmres=mysqli_query($con1,$strpm);
                                $cntpm=mysqli_fetch_assoc($pmres)['count'];
                                
                                $dere=mysqli_query($con1,$strdere);
                                $cntdere=mysqli_fetch_assoc($dere)['count'];
            
                                                                    
                              $sc+=$cntsc; $ic+=$cntins; $pc+=$cntpm; $dc+=$cntdere; 
		?>
<tr>
<!--=== Branch name ===-->
<?php $branch=mysqli_query($con1,"select name from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);

$cityqry=mysqli_query($con1,"select city from `cities` where city_id='".$row[4]."'");
$city=mysqli_fetch_row($cityqry);

?>
 
 
 <td><?php echo $row[1]; ?></td>
 <td><?php echo $row[3]; ?></td>
 <td><?php echo $row[5]; ?></td>
 
 <td><?php echo $city[0]; ?></td>
 
 <td><?php echo $branch1[0];?></td>

<!--===Service Call===-->  

<td  valign="top">
<?php echo $cntsc;  ?> </td>

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
//}
	$sn++;
	}
?>

<tr><td ><font color="red" >Grand Total </font></td> <td></td><td></td><td></td> <td></td> <td><font color="red" ><?php echo $sc; ?></font></td> <td><font color="red" ><?php echo $ic; ?></font></td> <td><font color="red" ><?php echo $pc; ?></font></td><td><font color="red" ><?php echo $dc; ?></font></td><td><font color="red" ><?php  echo $sc+$ic+$pc+$dc; ?></font></td></tr>

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