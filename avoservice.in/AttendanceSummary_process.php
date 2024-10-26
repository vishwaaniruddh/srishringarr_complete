<?php
 session_start();
include 'config.php';
include("access.php");

$fix=10;
$Branch=$_POST['Branch'];
$Department=$_POST['Department'];

$from=$_POST['from'];
$to=$_POST['to'];

$brch=mysqli_query($con1,"select name from avo_branch where id='".$_SESSION['branch']."'");
$brname=mysqli_fetch_array($brch);
//echo $_SESSION['branch'];


//$abc=" select id from employee where `status` = '0'";

$abc=" select * from employee where `status` = '0'";

$strPage=$_POST['Page'];


?>
<?php



if($Branch!=""){
$abc.=" and branch='".$Branch."'";
 //echo $abc;
}

if($Department!=""){
$abc.=" and department='".$Department."'";
 
}


//echo $abc;
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

$abc.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($con1,$abc);


	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	// echo "ram".($Page_Start* $Page)-$Page_Start;
	   // echo $fix."-".$Page."-".$fix;
	//   $sr=($Page_Start* $Page)-$Page_Start;
	  $sr=($fix* $Page)-$fix;
	  
	   $sr=$sr+1;
	}


  
   ?> 
   
<html>
<head>

</head>

<style>
.space{margin-left:80px;}
.addcolor{font-size:20px; color:#C60000; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
</style>

<body>
<Form>
<center>



<div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>

<!--=================================================-->
 Records Per Page :<select name="perpg" id="perpg" onchange="a('1','perpg');">

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
 
 
<!--=================================================-->


</div></br>

  <table border="1" style="margin-top:30px"  width="100%">
<?php   
//$sday1="select distinct(date)  from Attendance where date between '".$from ."' and '".$to ."'";
//$rday1=mysqli_query($con1,$sday1);
 //$rday7=mysqli_num_rows($rday1);
   //echo  "ram".$rday7;
?>
  <tr>
      
    <th>Sr</th>
    <th>Employee code</th>
    <th>Employee Name</th>
    <th>Branch</th>
    <th>Department</th>
    <th>Present</th>
    <th>Leave</th>
    <th>Absent</th>
    <th>No Entry</th>
    <th>Total Days</th>

  </tr>

 <?php
 
 while($row=mysqli_fetch_array($result)){
 $empdet="select emp_id, empname,branch,department,empcode FROM `Attendance` where emp_id='".$row[0]."'";
 $empqry=mysqli_query($con1,$empdet);
 $det=mysqli_fetch_array($empqry);
 
 if($Branch!="")
 $present="SELECT count(*) FROM `Attendance` where emp_id='".$row[0]."' and attendance='p' and date between '".$from ."' and '".$to ."' and branch='".$Branch."'";
 else
 $present="SELECT count(*) FROM `Attendance` where emp_id='".$row[0]."' and attendance='p' and date between '".$from ."' and '".$to ."'";
 //echo $present;
$prun=mysqli_query($con1,$present);
//$count=mysqli_num_rows($prun);
$count=mysqli_fetch_array($prun);


if($Branch!="")
$Leave="SELECT count(*) FROM `Attendance` where emp_id='".$row[0]."' and attendance='L' and date between '".$from ."' and '".$to ."'and branch='".$Branch."'";
else
$Leave="SELECT count(*) FROM `Attendance` where emp_id='".$row[0]."' and attendance='L' and date between '".$from ."' and '".$to ."'";

$Lrun=mysqli_query($con1,$Leave);
//$Lcount=mysqli_num_rows($Lrun);
$Lcount=mysqli_fetch_array($Lrun);


if($Branch!="")
$absent="SELECT count(*) FROM `Attendance` where emp_id='".$row[0]."' and attendance='A' and date between '".$from ."' and '".$to ."' and branch='".$Branch."'";
else
$absent="SELECT count(*) FROM `Attendance` where emp_id='".$row[0]."' and attendance='A' and date between '".$from ."' and '".$to ."'";

$arun=mysqli_query($con1,$absent);
//$acount=mysqli_num_rows($arun);
$acount=mysqli_fetch_array($arun);

$date1 = new DateTime($from);
$date2 = new DateTime($to);
$dayy  = $date2->diff($date1)->format('%a');
$days =$dayy+1;

$NoEntry=$days-($count[0]+$Lcount[0]+$acount[0]);

   ?>
  
 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $row[2];?></td>
    <td><?php echo $row[1];?></td>
    <td><?php echo $row[6];?></td>
    <td><?php echo $row[4];?></td>
    <td><?php echo $count[0];?></td>
    <td><?php echo $Lcount[0];?></td>
    <td><?php echo $acount[0];?></td>
    <td><?php echo $NoEntry;?></td>
    <td><?php echo $days;?></td>
   
   </tr>	
   


   <?php
$sr++;
  ?>
<?php 
}
?>

</table>



<!--==============================================================-->





<!--===========================================================-->






 <?php 
 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}

?>
</form>


</body>
</html>







