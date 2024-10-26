<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
//echo "must create your db base connection";
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];
$id="";
$cid="";
$bank="";
$city="";
$branch="";
//$br="Mumbai";







?>
<html>
<body>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" ><tr>
<th width="10%">ATM ID</th> 
<th width="5%">Customer Name</th>
<th width="5%">Bank Name</th>
<th width="5%">Address</th>
<th width="5%">GPS Location</th>
<th width="5%">State</th>
<th width="5%">Branch</th>
<th width="5%">Date of PM</th>
<th width="5%">Engineer Name</th>
<th width="5%">UPS Cap</th>
<th width="5%">UPS Status</th>
<th width="5%"> Batt Qty</th>
<th width="5%"> Batt Ah</th>
<th width="5%">Batt Make</th>
<th width="5%">Backup Observed</th>
<th width="5%">Batt Status</th>
<th width="5%">Battery Weak Qty</th>
<th width="5%">UPS Make</th>
<th width="5%">EDIT Option</th>
<th width="5%">Delete</th>
</tr>

<?php
include("config.php");

if($_SESSION['designation']=="3")
{
$br=$_SESSION['branch'];
$sql="select * from Pmcalls where branch_id='".$br."'";
}
else
{
$sql="select * from Pmcalls where 1";
}
//=====filter atm id========
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];

$sql.=" and AtmId LIKE '%".$id."%' ";
}

//======filter customer wise========  


if(isset($_POST['cid']) && $_POST['cid']!='')
{
$atm1=array();
$amc1=array();
$cid=$_POST['cid']; //echo $cid;
$atmqry=mysqli_query($con1,"select atm_id from atm where cust_id ='".$cid."'");
//echo "select atm_id from atm where cust_id ='".$cid."'";
while($fetchatmqry=mysqli_fetch_array($atmqry)){
$atm1[]=$fetchatmqry[0];
}
$atm2=implode("','",$atm1);
//$atm2="'".$atm2."'";
$amcqry=mysqli_query($con1,"select ATMID from Amc where CID ='".$cid."'");
//echo "select ATMID from Amc where CID ='".$cid."'";
while($fetchamcqry=mysqli_fetch_array($amcqry))
$amc1[]=$fetchamcqry[0];
$amc2=implode("','",$amc1);
//$amc2="'".$amc2."'";
$sql.=" and Atmid in ('".$atm2."') or  Atmid in('".$amc2."')";

}
//======filter bank wise========  
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$atm3=array();
$amc3=array();
$bank=$_REQUEST['bank'];
$atmqry1=mysqli_query($con1,"select atm_id from atm where bank_name LIKE '%".$bank."%'");
echo "select atm_id from atm where bank_name LIKE '%".$bank."%'";
while($fetchatmqry1=mysqli_fetch_array($atmqry1)){
$atm3[]=$fetchatmqry1[0];
}
$atm4=implode("','",$atm3);
//echo $atm4;
//$atm2="'".$atm2."'";
$amcqry1=mysqli_query($con1,"select ATMID from Amc where BANKNAME LIKE '%".$bank."%'");
//echo "select ATMID from Amc where CID ='".$cid."'";
while($fetchamcqry1=mysqli_fetch_array($amcqry1))
$amc3[]=$fetchamcqry1[0];
$amc4=implode("','",$amc3);
//$amc2="'".$amc2."'";
$sql.=" and Atmid in ('".$atm4."') or  Atmid in('".$amc4."')";


//$sql.=" and Atmid in (select atm_id from atm where bank_name LIKE '%".$bank."%') or Atmid in (select ATMID from Amc where BANKNAME LIKE '%".$bank."%')";
}
//======filter branch wise========  
if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and  `branch_id`='".$branch."'";
}

//======filter date wise========  
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];;
$sql.=" and Uptime Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
}


//echo "final  ".$sql;

$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

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
$sql.=" order by id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{

$atmdet="";
if(substr($row[1], 0, 4) == 'temp')
{
$watm="select * from tempsites where atmid='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm);
$norrs=mysqli_num_rows($atmdet);

if($norrs=='0')
{
$watm1="select * from tempsites_pm where atmid='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm1);
$norrs1=mysqli_num_rows($atmdet);
}

}
else
{
$watm="select bank_name,address,cust_id,state1 from atm where atm_id='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm);
//echo $watm;
$norrss=mysqli_num_rows($atmdet);

if($norrss==0)
{
$watm1="select bankname,address,cid,state from Amc where atmid='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm1);
$norrss1=mysqli_num_rows($atmdet);
//echo $watm1;
}
/*
if($norrss1=='0')
{
$watm2="select AtmId,pm_address,lat,longi from Pmcalls where AtmId='".$row[1]."'";//get atmid
$atmdet=mysqli_query($con1,$watm2);
$norrss2=mysqli_num_rows($atmdet);
}
*/
}



$detrow=mysqli_fetch_array($atmdet);


$qrybranch=mysqli_query($con1,"select id,name from avo_branch where id='".$row[14]."'");//get Branch name
$br=mysqli_fetch_array($qrybranch);

//$qryatm=mysqli_query($con1,"select cust_id from atm where atm_id='".$row[0]."'");
//$atmr=mysqli_fetch_array($qryatm);

$qrycust=mysqli_query($con1,"select cust_name from customer where cust_id='".$detrow[2]."'");
$ctm=mysqli_fetch_array($qrycust);

$qryeng=mysqli_query($con1,"select engg_name from area_engg where loginid='".$row[10]."'");
$eng=mysqli_fetch_array($qryeng);



?>
<tr>
<td><?php echo $row[1]; ?></td>


<?php
/*
if($norrss >0 || $norrss1 >0){?>
<td><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ',$detrow[1]); ?></td>
<td><?php echo $row[12].",".$row[13]; ?></td>
<?php }else{?>
<td> </td>
<td><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ',$detrow[1]); ?></br><?php echo $detrow[2].",".$detrow[3]; ?></td>
<?php }
*/
?>
<?php 
/*
if($norrss2 >0){
if($detrow[1]==""){?>
<td></td>
<td></td>
<td></td>
<td><?php echo $detrow[2].",".$detrow[3]; ?></td>
<?php }else{?>
<td></td>
<td></td>
<td></td>
<td><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ',$detrow[1]) ;?></td>
<?php }
}else{?>
<td><?php echo $ctm[0]; ?></td>
<td><?php echo $detrow[0]; ?></td>
<td><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ',$detrow[1]); ?></td>
<td><?php echo $row[12].",".$row[13]; ?></td>
<?php
} 
*/
?>
<td><?php echo $ctm[0]; ?></td>
<td><?php echo $detrow[0]; ?></td>
<td><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ',$detrow[1]); ?></td>
<?php 
 if($row[18]==""){?>
<td><?php echo $row[12].",".$row[13]; ?></td> 
<?php } else{?>
<td><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ',$row[18]); ?> </td>
<?php }?>

<?php
/*
if($norrss2 >0){?>
<td><?php echo $detrow[2].",".$detrow[3]; ?></td>
<?php }
*/?>
<?php
/*
if($norrss2 >0){?>
<td></td>


<?php }else{?>
<td><?php echo  $detrow[3]; ?></td>

<?php }
*/
?>

<td><?php echo $detrow[3]?></td>
<td><?php echo $br[1]; ?></td>
<td><?php echo $row[11]; ?></td>
<td><?php echo $eng[0]; ?></td>
<td><?php echo $row[2]; ?></td>
<td><?php echo $row[3]; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php echo $row[5]; ?></td>
<td><?php echo $row[6]; ?></td>
<td><?php echo $row[7]; ?></td>
<td><?php echo $row[8]; ?></td>
<td><?php echo $row[9]; ?></td>
<td><?php echo $row[17]; ?></td>
<td><a href="javascript:void(0);" onclick="window.open('edit_pmcalls.php?id=<?php echo $row[0]?>','edit_pmcalls','width=700px,height=750,left=200,top=40')" class="update">
  Edit</a></td>
<td><a href="delete_pmcalls.php?id=<?php echo $row[0]?>">Delete</a></td>

</tr>

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
//echo $Num_Pages;
//echo "page".$Page;
if($Page!=$Num_Pages)
{
//echo '>>'.$Next_Page;
echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>
<form name="frm" method="post" action="export_pm.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 
<div id="bg" class="popup_bg"> </div> 
</body>
</html>
