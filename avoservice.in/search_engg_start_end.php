<?php
include("access.php");
session_start();
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$SESSION['user'];

//echo $_SESSION['user'];

$strPage = $_REQUEST['Page'];


?>
<body>
<form name="form1" method="post">

<table align="center" border="2" cellpadding="2" cellspacing="0"  style="margin-right:30%;margin-left:30% ;margin-top:15px" width="100%" id="custtable">
<tr>
<th width="5%" style="text-align:center">S.No</th>
<th width="25%">Engineer Name</th>
<th width="10%">Branch</th>
<th width="12">Designation</th>
<th width="12%">Date</th>
<th width="7%">Start Time</th>
<th width="7%">End time</th>
<th width="7%">Work Hours</th>

</tr>


<?php

$count=0;
include("config.php");

$fix=25;

$loginid=$_POST['engg_login'];
$from =$_POST['from'];
$to = $_POST['to'];
$strPage=$_POST['Page'];

$user=$_SESSION['user'];

/*
if($SESSION['designation']==4) 

$enggqry=mysqli_query($con1,"select srno from login where username ='".$user."' ");
$elogin=mysqli_fetch_row($enggqry); */


$abc="select distinct(cdate) from start_end_day where username='".$user."' " ;


if(isset($_POST['from']) && $_POST['from']!='' && isset($_POST['to']) && $_POST['to']!='')
{

$abc.=" and cdate Between '".$from."' AND '".$to."'  ";


}

$sql_exp =$abc ;

 $result=mysqli_query($con1,$abc);
 $Num_Rows=mysqli_num_rows($result);

$Per_Page =$_POST['perpg'];   // Records Per Page

$Page = $strPage;

if($strPage=="")
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

$abc.=" ORDER BY cdate DESC LIMIT $Page_Start , $Per_Page ";
	
$qrys=mysqli_query($con1,$abc);

	$count=mysqli_num_rows($qrys);

$count=1;
	if($Page=="1" or $Page=="")
	{
	$count="1";
	}else
	{
	  $count=($fix* $Page)-$fix;
	  $count=$count+1;
	}


?>



<div align="center">Total Number Of Records :>> <?php echo $Num_Rows; ?>
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
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php

 
//echo $abc;

$logqry=mysqli_query($con1,"select srno from login where username='".$user."'");
$eng=mysqli_fetch_row($logqry);

$engqry=mysqli_query($con1,"select * from area_engg where loginid='".$eng[0]."'");
$engr=mysqli_fetch_row($engqry);

$brqry=mysqli_query($con1,"select name from avo_branch where id='".$engr[2]."'");
$row3=mysqli_fetch_row($brqry);

$qry=mysqli_query($con1,$abc);

while($row=mysqli_fetch_row($qry))
{


?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $count; ?></td>

<td class="sticky"><?php echo $engr[1]; ?></td>
<td><?php echo $row3[0]; ?></td>
<td><?php echo $engr[11]; ?></td>
<td><?php echo $row[0]; ?></td>


<?

$startqry= "select tstamp from start_end_day where username= '".$user."' and etype='S' and cdate ='".$row[0]."' ";
$endqry= "select tstamp from start_end_day where username= '".$user."' and etype='E' and cdate ='".$row[0]."'";

$qry1 =mysqli_query($con1,$startqry);
$start=mysqli_fetch_row($qry1) ;

$qry2 =mysqli_query($con1,$endqry);
$end=mysqli_fetch_row($qry2) ;


if( $start[0]==''){  $time=''; }
else {$time = date("H:i",strtotime($start[0]));} 

if ($end[0]==''){ $ltime=''; }
else {$ltime = date("H:i",strtotime($end[0]));} 

if($start[0] !='' && $end[0]!='') {
$diff = abs(strtotime($ltime) - strtotime($time));

$tmins = $diff/60;
$hours = floor($tmins/60);
$mins = $tmins%60;
$dif= $diff/60/60;} else {$hours=''; $mins=''; }

?>
<td  align="center"><?php echo $time; ?> </td>
<td  align="center"><?php echo $ltime; ?> </td>
<td  align="center"><font color=red> <?php echo $hours.":".$mins ; ?> </td>


</tr>

 <?php
$count++;
  
}
?>

</table>

<?php 
 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back</center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
} 
?>

</form>
</body>
