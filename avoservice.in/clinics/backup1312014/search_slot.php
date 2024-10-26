

<?php
include('config.php');
############# must create your db base connection
 
 $strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
$query='';
$query.="select * from slot where app_date>='".date('Y-m-d')."' ";
	 $result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page = $_REQUEST['num'];   // Records Per Page
 
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

$query.="  ORDER BY  `slot`.`app_date` DESC Limit $Page_Start , $Per_Page";
$res = mysql_query($query) or die(mysql_error());


?>

        
        
<form name="frmslot" method="post" action="deleteslot.php">          
        
        
          <table width="717"  border="1"  id="st" cellpadding="0" cellspacing="0"> 
          <th><select name="pager" id="pager" onChange="searchById('Listing','1','pager')">
          <option value="">Records per page</option>
          <?php
		  for($i=1;$i<=mysql_num_rows($result);$i++)
		  {
		 if($i%10==0)
		 {
		  ?>
          <option value="<?php echo $i; ?>" <?php if($i==$Per_Page){ ?> selected<?php  }  ?>><?php echo $i." /page" ?></option>
          <?php
		 }
		  }
		  ?>
          <option value="<?php echo mysql_num_rows($result); ?>">All</option>
          </select></th>
          <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Block</th>
		  <th width="216" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Hospital</th>
          <th width="95" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Date</th>
          <th width="102" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Start_Time </th>
          <th width="96" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">End_Time</th>
		  <th width="61" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Edit</th>
		  <th width="61" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Delete</th>
          <?php
		  $cnt=0;
		  $counter=0;
		   while($row=mysql_fetch_row($res)){
		   $counter=$counter+1;
			  //echo $row[3]." ".$row[4]; 
			  
		  $stime24=strtotime($row[3]); 
  		  $etime24=strtotime($row[4]); //echo $stime24." ".$etime24;
		  $stime12=date("h:i a",$stime24); 
		  $etime12=date("h:i a",$etime24);?>

	<tr>
    <td><input type="checkbox" name="blockid[<?php echo $cnt; ?>]" id="block<?php echo $cnt; ?>" value="<?php echo $row[0]; ?>" onClick="incre('block<?php echo $cnt; ?>');"> </td>
    <td> <?php echo $row[0]; ?></td>
    <td> <?php echo $row[1]; ?></td>
    <td> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
    <td> <?php echo $stime12; ?></td>
    <td> <?php echo $etime12; ?></td>
	<td><a href='edit_slot.php?slot_id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deleteslot(<?php echo $row[0]; ?>);"> Delete</a></td>
	<?php
	$cnt=$cnt+1;
	 } ?>
    </tr>
    </table><input type="hidden" name="counter" value="<?php echo $counter; ?>"><input type="submit" value="Delete" name="cmddel"></form>
    <div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

if($Prev_Page) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page','pager')\"> << Back</a> </li>";
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
if($Page!=$Num_Pages)
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page','pager')\">Next >></a> </li>";
}
?>
</font></div>
    
    
    <?php } ?>