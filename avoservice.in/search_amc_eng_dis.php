<?php
include("access.php");
include("config.php");
session_start();

//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];

//echo $_SESSION['designation'];
$strPage = $_REQUEST['Page'];

$eng = $_POST['Employee_name'];
$branch = $_POST['Branch'];
$status= $_POST['status'];
$table= $_POST['table'];

if($table=='Amc'){
if($status=='detail'){
?>
<body>
<form name="form1" method="post">

<table align="center" width="600" border="2" cellpadding="2" cellspacing="0" style="margin-top:5px;margin-left:20px;" id="custtable">
    <thead>
		            <tr>
		                <th width="5%">S.No</th>
		                <th width="10%">Engineer Name</th>
		                <th width="8%">Designation</th>
		                <th width="8%">Branch</th>
		                <th width="8%">Customer / Vertical</th>
		                <th width="8%">Site ID</th>
		                <th width="10%">End User Name</th>
		                <th width="25%">Site Address</th>
		                <th width="10%">City</th>
		                <th width="10%">State</th>
		                <th width="10%">Distance</th>
		            </tr>  
	 </thead>
	 
<?php

$abc ="SELECT a.* FROM distance_data_amc a, area_engg b  WHERE a.eng_id = b.engg_id and b.status=1 and b.deleted=0 and b.latitude!=0.00";

if($branch!=""){
$abc.=" and b.area='".$branch."'";
// echo $abc;
}


if($Employee_name!=""){
$abc.=" and b.engg_id='".$Employee_name."'";
//echo $abc;
}

//$sql_exp =$abc ;

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

$abc.=" ORDER BY b.engg_id DESC LIMIT $Page_Start , $Per_Page ";
	
echo $abc;

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

$qry=mysqli_query($con1,$abc);
$cnt=1;
while($row=mysqli_fetch_row($qry))
{

$qry3=mysqli_query($con1,"select * from area_engg where engg_id='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);


$amcqry=mysqli_query($con1,"select * from `Amc` where amcid='".$row[2]."'");
$site=mysqli_fetch_row($amcqry);

$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$site[1]."'");
$cust=mysqli_fetch_row($custqry);

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row3[2]."'");
$row2=mysqli_fetch_row($qry2);


?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $cnt; ?></td>
<td class="sticky"><?php echo $row3[1]; ?></td>
<td><?php echo $row3[11]; ?></td>
<td><?php echo $row2[0]; ?></td> 
<td><?php echo $cust[0]; ?></td> 
<td><?php echo $site[3]; ?></td>  <!-- ATM ID -->
<td><?php echo $site[4]; ?></td> 
<td><?php echo $site[9]; ?></td>   <!-- Add-->
<td><?php echo $site[7]; ?></td> <! City -->

<td><?php echo $site[10]; ?></td> 
<td><?php echo $row[3]; ?></td>

</tr>

 <?php
$cnt++;
  ?>
<?php 
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
<!--<form name="frm" method="post" action="export_expence.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sql_exp; ?>" readonly>
<center><input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span></center>
</form> -->
</body>
<? } elseif ($status=='summary'){
    
?>
<body>
<form name="form1" method="post">

<table align="center" width="600" border="2" cellpadding="2" cellspacing="0" id="custtable">
          <tr>
		                <th>Engineer Name</th>
		                <th>Designation</th>
		                <th>Branch</th>
		                <th>Within 30 KMs</th>
		                <th>Within 60 KMs</th>
		                <th>Within 100 KMs</th>
		                <th>Within 200 KMs</th>
		                <th>Above 200 KMs</th>
		                
		            </tr>  
	
<?php

$abc ="SELECT * from area_engg WHERE status=1 and deleted=0 and latitude!=0.00";

if($branch!=""){
$abc.=" and area='".$branch."'";
// echo $abc;
}


if($Employee_name!=""){
$abc.=" and engg_id='".$Employee_name."'";
//echo $abc;
}

//$sql_exp =$abc ;

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

$abc.=" ORDER BY area ASC LIMIT $Page_Start , $Per_Page ";
	
//echo $abc;

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

$qry=mysqli_query($con1,$abc);
$cnt=1;
while($row=mysqli_fetch_row($qry))
{
$dis1=0; $dis2=0; $dis3=0; $dis4=0; $dis5=0; $dis6=0;

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[2]."'");
$row2=mysqli_fetch_row($qry2);

$disqry=mysqli_query($con1,"select distance from `distance_data_amc` where eng_id='".$row[0]."'");

while($distrow=mysqli_fetch_row($disqry)){
	  			
	  			$dist=$distrow[0];
				
				if($dist<30.0)$dis1++;
				else if($dist<60.0)$dis2++;
				else if($dist<100.0)$dis3++;
				else if($dist<200.0)$dis4++;
				else $dis5++;
				          
	  			}


?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td class="sticky"><?php echo $row[1]; ?></td>
<td><?php echo $row[11]; ?></td>
<td><?php echo $row2[0]; ?></td> 

<td><?php echo $dis1; ?></td> 
<td><?php echo $dis2; ?></td> 
<td><?php echo $dis3; ?></td>  
<td><?php echo $dis4; ?></td> <! City -->

<td><?php echo $dis5; ?></td> 

</tr>

 <?php
$cnt++;
  ?>
<?php 
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

<!--<form name="frm" method="post" action="export_expence.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sql_exp; ?>" readonly>
<center><input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span></center> 
</form> -->
</body>
<? 

//===========================Warranty Table==========
}  } elseif ($table=='atm') {
    
if($status=='detail'){
?>
<body>
<form name="form1" method="post">

<table align="center" width="600" border="2" cellpadding="2" cellspacing="0" style="margin-top:5px;margin-left:20px;" id="custtable">
    <thead>
		            <tr>
		                <th width="5%">S.No</th>
		                <th width="10%">Engineer Name</th>
		                <th width="8%">Designation</th>
		                <th width="8%">Branch</th>
		                <th width="8%">Customer / Vertical</th>
		                <th width="8%">Site ID</th>
		                <th width="10%">End User Name</th>
		                <th width="25%">Site Address</th>
		                <th width="10%">City</th>
		                <th width="10%">State</th>
		                <th width="10%">Distance</th>
		            </tr>  
	 </thead>
	 
<?php

$abc ="SELECT a.* FROM distance_data a, area_engg b  WHERE a.eng_id = b.engg_id and b.status=1 and b.deleted=0 and b.latitude!=0.00";

if($branch!=""){
$abc.=" and b.area='".$branch."'";
// echo $abc;
}


if($Employee_name!=""){
$abc.=" and b.engg_id='".$Employee_name."'";
//echo $abc;
}

//$sql_exp =$abc ;

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

$abc.=" ORDER BY b.engg_id DESC LIMIT $Page_Start , $Per_Page ";
	
//echo $abc;

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

$qry=mysqli_query($con1,$abc);
$cnt=1;
while($row=mysqli_fetch_row($qry))
{

$qry3=mysqli_query($con1,"select * from area_engg where engg_id='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row3[2]."'");
$row2=mysqli_fetch_row($qry2);

$amcqry=mysqli_query($con1,"select * from `atm` where track_id='".$row[2]."'");
$site=mysqli_fetch_row($amcqry);

$custqry=mysqli_query($con1,"select cust_name from `customer` where cust_id='".$site[2]."'");
$cust=mysqli_fetch_row($custqry);


?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $cnt; ?></td>
<td class="sticky"><?php echo $row3[1]; ?></td>
<td><?php echo $row3[11]; ?></td>
<td><?php echo $row2[0]; ?></td> 
<td><?php echo $cust[0]; ?></td> 
<td><?php echo $site[1]; ?></td>  <!-- ATM ID -->
<td><?php echo $site[3]; ?></td> 
<td><?php echo $site[9]; ?></td>   <!-- Add-->
<td><?php echo $site[6]; ?></td> <! City -->

<td><?php echo $site[15]; ?></td> 
<td><?php echo $row[3]; ?></td>

</tr>

 <?php
$cnt++;
  ?>
<?php 
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
<!--<form name="frm" method="post" action="export_expence.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sql_exp; ?>" readonly>
<center><input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span></center>
</form> -->
</body>
<? } elseif ($status=='summary'){
    
?>
<body>
<form name="form1" method="post">

<table align="center" width="600" border="2" cellpadding="2" cellspacing="0" id="custtable">
          <tr>
		                <th>Engineer Name</th>
		                <th>Designation</th>
		                <th>Branch</th>
		                <th>Within 30 KMs</th>
		                <th>Within 60 KMs</th>
		                <th>Within 100 KMs</th>
		                <th>Within 200 KMs</th>
		                <th>Above 200 KMs</th>
		                
		            </tr>  
	
<?php

$abc ="SELECT * from area_engg WHERE status=1 and deleted=0 and latitude!=0.00";

if($branch!=""){
$abc.=" and area='".$branch."'";
// echo $abc;
}


if($Employee_name!=""){
$abc.=" and engg_id='".$Employee_name."'";
//echo $abc;
}

//$sql_exp =$abc ;

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

$abc.=" ORDER BY area ASC LIMIT $Page_Start , $Per_Page ";
	
//echo $abc;

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

$qry=mysqli_query($con1,$abc);
$cnt=1;
while($row=mysqli_fetch_row($qry))
{
$dis1=0; $dis2=0; $dis3=0; $dis4=0; $dis5=0; $dis6=0;

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[2]."'");
$row2=mysqli_fetch_row($qry2);

$disqry=mysqli_query($con1,"select distance from `distance_data` where eng_id='".$row[0]."'");

while($distrow=mysqli_fetch_row($disqry)){
	  			
	  			$dist=$distrow[0];
				
				if($dist<30.0)$dis1++;
				else if($dist<60.0)$dis2++;
				else if($dist<100.0)$dis3++;
				else if($dist<200.0)$dis4++;
				else $dis5++;
				          
	  			}


?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td class="sticky"><?php echo $row[1]; ?></td>
<td><?php echo $row[11]; ?></td>
<td><?php echo $row2[0]; ?></td> 

<td><?php echo $dis1; ?></td> 
<td><?php echo $dis2; ?></td> 
<td><?php echo $dis3; ?></td>  
<td><?php echo $dis4; ?></td> <! City -->

<td><?php echo $dis5; ?></td> 

</tr>

 <?php
$cnt++;
  ?>
<?php 
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

<!--<form name="frm" method="post" action="export_expence.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sql_exp; ?>" readonly>
<center><input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span></center> 
</form> -->
</body>
<? 
} 

}