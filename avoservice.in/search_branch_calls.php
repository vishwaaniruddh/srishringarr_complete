<?php
session_start();  
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

?>
<table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="callsummary" >
<tr>

<th rowspan="2">Branch Name</th> 
<th colspan="2" style="text-align:center">Service Calls</th>
<th colspan="2" style="text-align:center">Installation Calls</th>
<th colspan="2" style="text-align:center">PM Calls</th>
<th colspan="2" style="text-align:center">DERE Calls</th>
<th colspan="2" style="text-align:center">Total Calls</th>
<th colspan="2" style="text-align:center">Hold Calls</th>
<th rowspan="2" style="text-align:center">Attended Calls</th>
<th rowspan="2" style="text-align:center">Rejected today</th>
</tr>
<tr>
<th width="6%" style="text-align:center">Open</th>
<th width="6%" style="text-align:center">Closed</th>
<th width="6%" style="text-align:center">Open</th> 
<th width="6%" style="text-align:center">Closed</th>
<th width="6%" style="text-align:center">Open</th>
<th width="6%" style="text-align:center">Closed</th>
<th width="6%" style="text-align:center">Open</th> 
<th width="6%" style="text-align:center">Closed</th>
<th width="6%" style="text-align:center">Open</th> 
<th width="6%" style="text-align:center">Closed</th>
<th width="6%" style="text-align:center">Service</th>
<th width="6%" style="text-align:center">Inst</th>


</tr>
<?php
	
 $sql.="Select id from avo_branch ";


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
$sql.=" order by `name` LIMIT $Page_Start , $Per_Page";

$to=str_replace("/","-",$_POST['todt']); //echo $to;


$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
if(isset($_POST['todt']) && $_POST['todt']!='')
{

$todt=$_POST['todt'];
 $sc=0;$ic=0;$pc=0;$dc=0;$ac=0;
while($row= mysqli_fetch_row($table)) { 
    
    $pts=0;		
$opnsc="SELECT atm_id FROM `alert` where branch_id='".$row[0]."' and cust_id !=96 and (alert_type='service' or alert_type='new temp') and call_status in ('0', 'Pending', '1' ,'2' ,'Delegated') and status in ('0', 'Pending','delegated', '1') ";
$strsc="SELECT atm_id FROM `alert` where branch_id='".$row[0]."' and (alert_type='service' or alert_type='new temp') and  date(close_date)=STR_TO_DATE('$todt','%d/%m/%Y') ";

//=========Inst call================ 
$opnins="SELECT atm_id FROM `alert` where branch_id='".$row[0]."' and alert_type='new' and call_status in ('0', 'Pending', '1' ,'2' ,'Delegated') and status in ('0', 'Pending','delegated', '1') ";
$strins="SELECT atm_id FROM `alert` where branch_id='".$row[0]."' and alert_type='new' and date(close_date)=STR_TO_DATE('$todt','%d/%m/%Y')";

//=========PM calls
$opnpm="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and (alert_type='temp_pm' or alert_type='pm') and call_status in ('0', 'Pending', '1' ,'2' ,'Delegated') and status in ('0', 'Pending','delegated', '1') ";
$strpm="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and (alert_type='temp_pm' or alert_type='pm') and date(close_date)=STR_TO_DATE('$todt','%d/%m/%Y')";
//=========For  DERE
 $opndere="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and (alert_type='dere' or alert_type='temp_dere') and call_status in ('0', 'Pending', '1' ,'2' ,'Delegated') and status in ('0', 'Pending','delegated', '1') ";
 $strdere="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and (alert_type='dere' or alert_type='temp_dere') and date(close_date)=STR_TO_DATE('$todt','%d/%m/%Y')";
 
 //=====For Field work
 //$str="SELECT count(*),name FROM `eng_mis` where eng_id in(select engg_id from area_engg where area LIKE '".$row[0]."') and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
  //====For In house
 //$str1="SELECT count(*),name FROM `eng_mis` where eng_id in(select engg_id from area_engg where area LIKE '".$row[0]."') and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
 //=============Attended All  Calls=========                               														                  // For attended calls
 $stratd="SELECT a.atm_id FROM `alert` a,alert_progress b where a.branch_id='".$row[0]."' and (date(b.responsetime)=STR_TO_DATE('$todt','%d/%m/%Y') and a.close_date='0000-00-00 00:00:00') and a.alert_id=b.alert_id";
 
 //===============Hold Calls=============
 $holdqry="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and call_status='onhold' and (alert_type='service' or alert_type='new temp') ";
 
 $holdinstqry="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and call_status='onhold' and alert_type='new' ";
 
 //===============Rejected Calls=============
 $rejectqry="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and call_status='Rejected' and date(Reject_date)=STR_TO_DATE('$todt','%d/%m/%Y')";
 
                        														                   		
				$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;$cntdere=0;$cntatd=0; $cnthold=0;				
				//===============Closed call Data============
                                $closesc=mysqli_query($con1,$strsc);
                                $closeins=mysqli_query($con1,$strins);
                                $closepm=mysqli_query($con1,$strpm);
                                $closedere=mysqli_query($con1,$strdere); //==for dere
                                $opencallatd=mysqli_query($con1,$stratd);
				                
				                $rowsc= mysqli_num_rows($closesc);
                                $cntsc=$rowsc;
                                
                                $rowins= mysqli_num_rows($closeins);
                                $cntins=$rowins;
                                
                                $rowdere= mysqli_fetch_row($closedere);
                                $cntdere=$rowdere[0];
                                
                                $rowpm= mysqli_fetch_row($closepm);
                                $cntpm=$rowpm[0]; 
                                
                                $openrowatd= mysqli_num_rows($opencallatd);
                                $cntatd=$openrowatd;
                                
                                $holdrowqry=mysqli_query($con1,$holdqry);
                                $holdrow= mysqli_fetch_row($holdrowqry);
                               $holdcnt=$holdrow[0];
                               
                               $holdinstqrr=mysqli_query($con1,$holdinstqry);
                                $holdinstrow= mysqli_fetch_row($holdinstqrr);
                               $holdinstcnt=$holdinstrow[0];
                               
                               $rejectrowqry=mysqli_query($con1,$rejectqry);
                                $rejrow= mysqli_fetch_row($rejectrowqry);
                               $rejcnt=$rejrow[0];
                                                                    
                              $sc+=$cntsc; $ic+=$cntins; $pc+=$cntpm; $dc+=$cntdere; $ac+=$cntatd; $hold+=$holdcnt; $rej+=$rejcnt;$holdinst+=$holdinstcnt;
                              
    //===================Open Calls data=================  
    $opnsccnt=0;$opninscnt=0;$opnderecnt=0;$opnpmcnt=0;
    
                        $opencallsc=mysqli_query($con1,$opnsc);
                        $opencallins=mysqli_query($con1,$opnins);
                        $opencallpm=mysqli_query($con1,$opnpm);
                        $opencalldere=mysqli_query($con1,$opndere);      
                    
                        $opnsccnt= mysqli_num_rows($opencallsc);
                        $opninscnt= mysqli_num_rows($opencallins);
                        
                        $rowdererow= mysqli_fetch_row($opencalldere);
                        $opnderecnt=$rowdererow[0];
                                
                        $opnrowpm= mysqli_fetch_row($opencallpm);
                        $opnpmcnt=$opnrowpm[0]; 
                        
            $osc+=$opnsccnt; $oic+=$opninscnt; $opm+=$opnpmcnt; $odere+=$opnderecnt;

?>
<tr>
<!--=== Branch name ===-->


<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];

 ?></td>

<!--===Service Call===-->   
<td  valign="top"> <?php echo $opnsccnt;  ?> </td>
<td  valign="top"> <?php echo '<a onclick=opennew('.$branch1[0].',"sc") >'.$cntsc.'</a>';  ?> </td>

<!--===Installation Call===-->   
<td  valign="top"> <?php echo $opninscnt;  ?> </td>
<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"ins") >'.$cntins.'</a>'; ?></td>

<!--===PM Call===-->
<td  valign="top"> <?php echo $opnpmcnt;  ?> </td>
<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"pm") >'.$cntpm.'</a>'; ?></td>

<!--===DERE Call===-->
<td  valign="top"> <?php echo $opnderecnt;  ?> </td>
<td  valign="top"><?php echo '<a onclick=opennew('.$branch1[0].',"dere") >'.$cntdere.'</a>';  ?></td>

<!--===Total calls===-->
<td  valign="top"><?php echo $opnsccnt+$opninscnt+$opnpmcnt+$opnderecnt;  ?></td>
<td  valign="top"><?php echo $cntdere+$cntsc+$cntins+$cntpm;  ?></td>

<!--===Hold Calls===-->
<td  valign="top"><?php echo $holdcnt;  ?></td>
<td  valign="top"><?php echo $holdinstcnt;  ?></td>

<!--===Attended Call (Field)===-->
<td  valign="top"><?php echo $cntatd;  ?></td>



<!--===Reject Calls===-->
<td  valign="top"><?php echo $rejcnt;  ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td><font color="red" >Grand Total </font></td><td><font color="red" ><?php echo $osc; ?></font></td><td><font color="red" ><?php echo $sc; ?></font></td> <td><font color="red" ><?php echo $oic; ?></font></td> <td><font color="red" ><?php echo $ic; ?></font></td> <td><font color="red" ><?php echo $opm; ?></font></td><td><font color="red" ><?php echo $pc; ?></font></td><td><font color="red" ><?php echo $odere; ?></font></td><td><font color="red" ><?php echo $dc; ?></font></td> <td><font color="red" ><?php  echo $osc+$oic+$opm+$odere; ?></font></td> <td><font color="red" ><?php  echo $sc+$ic+$pc+$dc; ?></font></td> <td><font color="red" ><?php echo $hold; ?></font></td><td><font color="red" ><?php echo $holdinst; ?></font></td><td><font color="red" ><?php echo $ac; ?></font></td> <td><font color="red" ><?php echo $rej; ?></font></td> </tr>
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

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>

<div id="bg" class="popup_bg"> </div> 