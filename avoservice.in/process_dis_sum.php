<?php
session_start();
include 'config.php';
include("access.php");

$fix=50;
$Branch=$_POST['Branch'];
$Employee_name=$_POST['Employee_name'];

if($_SESSION['branch']=="all"){

$abc="select * from area_engg where status='1' and deleted='0'" ;
//echo $abc; 
}else{

$abc="select * from area_engg where status='1' and deleted='0' and area='".$_SESSION['branch']."' " ;
//echo $abc;
}

 

$strPage=$_POST['Page'];


?>
<?php

if($Branch!=""){
$abc.=" and area='".$Branch."'";
// echo $abc;
}


if($Employee_name!=""){
$abc.=" and engg_name like '%".$Employee_name."%'";
//echo $abc;
}


if(isset($_POST['from']) && $_POST['from']!='' && isset($_POST['to']) && $_POST['to']!='')
{
$dt1=str_replace("/","-",$_POST['from']);
$dt2=str_replace("/","-",$_POST['to']);

}

else{
$dt1=date('Y-m-d',strtotime('-1 day'));
$dt2=date('Y-m-d', strtotime('-1 day'));
}

//echo $dt1."<br>".$dt2 ;


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

$abc.=" ORDER BY engg_name ASC LIMIT $Page_Start , $Per_Page ";
	
$qrys=mysqli_query($con1,$abc);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
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

  <table border="1" style="margin-top:10px"  width="100%">
<?php   


$sday1="select distinct(dis_date)  from engg_distances where dis_date between '".$dt1."' and '".$dt2."' ORDER BY dis_date ASC";


$rday1=mysqli_query($con1,$sday1);
 


?>
  <tr>
      
        <th>Sr</th>
    <th>EmployeeName</th>
       <th>Designation</th>
       <th>Employee code</th>
       <th>Branch</th>
    
<?php 

while($row4=mysqli_fetch_array($rday1))
{?>
 <th><?php echo date("d-m", strtotime($row4[0]) );;?></th>
  
 <?php }?>

  </tr>

  <?php 
  
  
   while($row = mysqli_fetch_array($qrys)) {

$testing="select a.engg_name, a.engg_desgn, a.emp_code, b.name  from area_engg a, avo_branch b where a.engg_id='".$row[0]."' and a.area=b.id ";

//echo "select a.engg_name, a.engg_desgn, a.emp_code, b.name  from area_engg a, avo_branch b where a.engg_id='".$row[0]."' and a.area=b.id ";

$testrun=mysqli_query($con1,$testing);
$testrow=mysqli_fetch_array($testrun);
  
  
   ?>
  
 <tr style="background-color:#cfe8c7">
   <td><?php echo $sr;?></td>
   <td><?php echo $testrow["engg_name"];?></td>
   <td><?php echo $testrow["engg_desgn"];?></td>
   <td><?php echo $testrow["emp_code"];?></td>
    <td><?php echo $testrow[3];?></td>
   
   
   <?php
   
   $sday2="select distinct(dis_date)  from engg_distances where dis_date between '".$dt1."' and '".$dt2."'";
 	$rday2=mysqli_query($con1,$sday2);
    
    
    while($row2=mysqli_fetch_array($rday2)){
  
  $dataa="SELECT dis_travelled  FROM engg_distances WHERE dis_date ='".$row2[0]."' and eng_id='".$row[0]."'"; 
    $dataa1=mysqli_query($con1,$dataa);
    //echo $dataa;
   $fatchdata=mysqli_fetch_array($dataa1);?>
    <td> <? echo $fatchdata[0];?></td>
 <?php }?>

    
    
  
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







