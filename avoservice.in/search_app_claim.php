<?php
include("access.php");
$strPage = $_REQUEST['Page'];
?>
<body>
<form name="form1" method="post">

<table class="center" width="100%" border="2" cellpadding="2" cellspacing="0" style="margin-top:15px;margin-left:2%;" class="res" id="custtable">
<tr>
<th width="5%" style="text-align:center">S.No</th>
<th width="15%">Engineer Name</th>
<th width="5%">Branch</th>
<th width="5">Designation</th>
<th width="5%">Claim Date</th>
<th width="5%">Calls Attended</th>
<th width="5%">Portal Call Count</th>
<th width="5%">Other Calls/Visits</th>
<th width="5%">Purpose of Other Visits</th>
<th width="5%">Travelled KMs</th>
<th width="5%">Company Vehicle Travel KMs</th>
<th width="10%">Portal KMs</th>

<th width="5%">Bike Expense</th>
<th width="5%">Cab / Auto</th>
<th width="5%">Bus/ Train</th>
<th width="5%">Food Exp</th>
<th width="5%">Lodging</th>
<th width="5%">Mobile</th>
<th width="5%">Room Rent</th>



<th width="5%">Claimed Amount</th>
<th width="5%">Approved Amount</th>
<th width="5%">Approved By</th>

<!--<th width="5%">Approved Date</th> -->
<th width="5%">Approved Remarks</th>
<!--<th width="5%">Verify Status</th>
<th width="3%">Verify Amount</th>
<th width="5%">Verify Remarks</th>

<?php
//if(isset($_POST['status']) && $_POST['status']=='1'){ ?>

<th width="5%">Submit</th>
<? //} else { ?>
<th width="5%">Verified By</th> -->
<?// } ?>

</tr>


<?php

$count=0;
include("config.php");

$br=$_SESSION['branch'];
$fix=25;
$Branch=$_POST['Branch'];
$Employee_name=$_POST['Employee_name'];
$from =$_POST['from'];
$to = $_POST['to'];
$status=$_POST['status'];

$strPage=$_POST['Page'];

//echo $from;
//echo "Hiii".$status;
//echo $to;

$abc="select * from approved_expenses where 1 " ;


?>
<?php

if($Branch!="" && $Employee_name =="" ){
$abc.=" and branch_id='".$Branch."'";
// echo $abc;
}


if($Employee_name!=""){
$abc.=" and engg_id ='".$Employee_name."'";
//echo $abc;
}

if(isset($_POST['status']) && $_POST['status']!='')
{ $abc.=" and status='".$status."'" ; }


if(isset($_POST['from']) && $_POST['from']!='' && isset($_POST['to']) && $_POST['to']!='')
{

$abc.=" and claim_date Between '".$from."' AND '".$to."'  ";


}

$app=$abc;

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

$abc.=" ORDER BY claim_date DESC LIMIT $Page_Start , $Per_Page ";
	

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

$qry=mysqli_query($con1,$abc);

while($row=mysqli_fetch_row($qry))

{
//$count=$count+1;

//echo "select * from daily_expenses where id='".$row[1]."'";

$qry1=mysqli_query($con1,"select * from daily_expenses where id='".$row[1]."'");
$row1=mysqli_fetch_row($qry1);

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[3]."'");
$row2=mysqli_fetch_row($qry2);

$qry3=mysqli_query($con1,"select * from area_engg where engg_id='".$row[2]."'");
$row3=mysqli_fetch_row($qry3);

$timestamp = strtotime($row[4]);
$date = date('d/m/Y', $timestamp);

?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $count; ?></td>
<td class="sticky"><?php echo $row3[1]; ?></td> <!-- Engr Name -->
<td><?php echo $row2[0]; ?></td> <!Branch -->
<td><?php echo $row3[11]; ?></td> <!design -->
<td><?php echo $row1[3]; ?></td><!date -->
<td><?php echo $row1[4]; ?></td>  <!Engr Calls -->

<td><a style="color:red; font-size:15px; font-weight:bold;" href="check_alert.php?eid=<?php echo $row3[8]; ?>&date=<?php echo $row[4]; ?>" target="_new"> <?php echo $row[5]; ?> 
</a></td>

<td><?php echo $row1[5]; ?></td> <!other call -->
<td><?php echo $row1[21]; ?></td>
<td><?php echo $row1[18]; ?></td> <!engr KM -->
<td><?php echo $row1[20]; ?></td> <!Company Vehivle KM -->
<td><?php echo $row[7]; ?> </br>
<a style="color:red; font-size:15px; font-weight:bold;" href="test_distance3.php?id=<?php echo $row[2]; ?>&date=<?php echo $date; ?>" target="_new">Engg-site Map</a></br>
<a style="color:Yellow; font-size:15px; font-weight:bold;" href="travellingmap.php?eid=<?php echo $row[2]; ?>&date=<?php echo $row[4]; ?>" target="_new">View GPS Map</a>

</td> 

<td><?php echo $row1[7]; ?></td> <!Bike amount -->
<td><?php echo $row1[9]; ?></td> <!Cab amount -->
<td><?php echo $row1[11]; ?></td> <!public tr -->
<td><?php echo $row1[12]; ?></td> <!food amount -->
<td><?php echo $row1[13]; ?></td> <!lodge amount -->
<td><?php echo $row1[16]; ?></td> <!mobile amount -->
<td><?php echo $row1[23]; ?></td> <!room amount -->


<td><?php echo $row1[19]; ?></td> <!Claim amount -->
<td><?php echo $row[6]; ?></td>   <! Approv amount-->
<td><?php echo $row[9]; ?></td> <!approved by -->
<!--<td><?php echo $row[11]; ?></td> approved date -->
<td><?php echo $row[10]; ?></td>



<!-- <div id="subdiv<?php echo $row[0]; ?>" >

<td> 
<?php if($row[8]=='1'){ ?>
    
    
   	
    <select name="reason<?php echo $row[0]; ?>" id="reason<?php echo $row[0]; ?>" >

        <option value=""> Select </option>
        <option value="2">Verified </option>
        <option value="0">Rejected</option>
        
</select>
	
<?php }else if ($row[8]=='2'){ echo "Verified";} 

else if ($row[8]=='0'){ echo "Rejected";} ?>
</td>
    

<td>
  <?php if($row[8]=='1'){ ?>   
    
    <input type="number" min="0" max="5000" name="amount<?php echo $row[0]; ?>" id="amount<?php echo $row[0]; ?>" value="<?php echo $row[6]; ?>"   onkeyup="if(parseInt(this.value)>5000){ this.value =0; return false; }" />

 <?php  }else  { echo $row[12];} ?>               
                </td>

</td>


<td>
  <?php if($row[8]=='1'){ ?>     
 
<input type="text" name="remarks<?php echo $row[0]; ?>" id="remarks<?php echo $row[0]; ?>"  />
                
 <?php }else{ echo $row[13];} ?>               
                </td>


<td>		
<?php if($row[8]=='1'){ ?>  

<input type="button" name="submission" value="submit" onclick="setSubmit(<?php echo $row[0]; ?>)" />
<?php }else{ echo $row[14];} ?>  



</td>	
</div> -->

	


</tr>

 <?php
$count++;
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

<form name="frm" method="post" action="export_verify_expense.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $app; ?>" readonly>
<center><input type="submit" name="cmdsub" value="Export" > <span>(Alert: You can Export MAX 3000 Record at one Time.)</span></center>
</form>

</body>





