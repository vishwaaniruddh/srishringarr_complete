<?php
 session_start();
include 'config.php';
include("access.php");

$fix=10;
$Branch=$_POST['Branch'];
$Department=$_POST['Department'];
$Employee_name=$_POST['Employee_name'];
$Employee_code=$_POST['Employee_code'];
$status=$_POST['status'];

//echo $Branch ;

$brch=mysqli_query($con1,"select name from avo_branch where id='".$_SESSION['branch']."'");
$brname=mysqli_fetch_array($brch);

//echo $_SESSION['branch'];



if($_SESSION['branch']=="all"){
$abc="select * from employee where 1=1" ; 
}else{

$abc="select * from employee where 1=1 and branch='".$brname[0]."'" ;

}

 

$strPage=$_POST['Page'];


?>
<?php
if($status!=""){
$abc.=" and status='".$status."'";
 //echo $abc;
}


if($Branch!=""){
$abc.=" and branch LIKE '%".$Branch."%'";
 //echo $abc;
}

if($Department!=""){
$abc.=" and department='".$Department."'";
 
}

if($Employee_name!=""){
$abc.=" and EmployeeName LIKE '".$Employee_name."%'";
}

if($Employee_code!=""){
$abc.=" and empcode='".$Employee_code."'";
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

  <table border="1" style="margin-top:5px"  width="100%">
  <tr>
      
        
    <th>Sr No</th>
    <th>EmployeeName</th>
    <th>Empcode</th>
    <th>Grade</th>
    <th>Department</th>
    <th>Branch</th>
    <th>Job Responsible</th>
    <th>Date_of_Joining</th>
    <th>Ser.ID[1-Yes]</th>
    
<?php if($_SESSION['branch']=="all"){?>
    <th>Edit</th>
   <th>Remove Employee</th>
   
   <?php
}else{?>
<?php
}
?>


  </tr>

  <?php  while($row = mysqli_fetch_array($qrys)) {
  
  
   ?>
  
 <tr style="background-color:#cfe8c7">
   <td><?php echo $sr;?></td>
    <!--<td><?php echo $row["id"];?></td>-->
    <td><?php echo $row["EmployeeName"];?></td>
    <!--<td><?php echo $row["Surname"];?></td>-->
    <td><?php echo $row["empcode"];?></td>
    <td><?php echo $row["Grade"];?></td>
    <td><?php echo $row["department"];?></td>
    <td><?php echo $row["branch"];?></td>	
    <td><?php echo $row["Job_Specific"];?></td>
    <td><?php echo $row["Date_of_Joining"];?></td>
    <td><?php echo $row["service_login"];?></td>
    <?php if($_SESSION['branch']=="all" && $row["status"]==0){?>
    <td><input type="button" value="edit"  onclick='window.location.href="editemployee.php?ids=<?php echo $row["id"];?>"'/></td>
    <td><input type="button" value="DeActivate" style="width: 110px;" onclick='window.location.href="delete_employee.php?ids=<?php echo $row["id"];?>"'/></td>
   <?php }else?>
   <?php
    {
    
    }?>
    
    <?php if($_SESSION['branch']=="all" && $row["status"]==1){?>
   <td><input type="button" value="edit"  onclick='window.location.href="editemployee.php?ids=<?php echo $row["id"];?>"'/></td>
    <td><input type="button" value="Activate" style="width: 110px;" onclick='window.location.href="activate_employee.php?ids=<?php echo $row["id"];?>"'/></td>
   <?php }else?>
   <?php
    {
    
    }?>
   </tr>	
   


   <?php
$sr++;
  ?>
<?php 
}
?>

</table>


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







