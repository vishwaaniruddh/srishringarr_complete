<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select * from sms ";

if(isset($_REQUEST['hos']) && $_REQUEST['hos']!="")
{
	
$hos=$_REQUEST['hos'];

$query.=" where `receiver` like('".$hos."%') ";
//echo $query;
}

if(isset($_REQUEST['adate']) && $_REQUEST['adate']!="")
{
  $adate=$_REQUEST['adate'];
  $adatet=str_replace('/','-',$adate);
 $daten=date('Y-m-d',strtotime($adatet));
//$qu =mysql_query("select * from patient where name like('".$fname."%')");
//$ro=mysql_fetch_row($qu);
$query.="where `date_sent`  like ('".$daten."%') ";
//echo $query;
}


$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page = 10;   // Records Per Page
 
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

$query.=" order by date_sent DESC LIMIT $Page_Start , $Per_Page";
//echo $query;
$result = mysql_query($query) or die(mysql_error());

?> 
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<style>

</style>
<table width="" class="results">
 
 <thead      
          <tr>
          <th width="15" >Sr. No</th>
          <th width="57" >Content</th>
          <th width="60" >Date_sent</th>
          <th width="150" >Message</th>
          <th width="84" >receiver</th>
          
          </tr>
</thead>
<?php
$intRows = 0;
$i=1;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{

?>
<tbody>
    <tr>
    <td> <?php echo $i++ ; ?></td>
    <td> <?php echo $row[0]; ?></td>
    <td> <?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?></td>    
    <td> <?php echo $row[2]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    
   
</tr>
</tbody>
<?php
			$intRows++;
	?> 

	<?php
			
		 }
		
	?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<font size="3">Total Records : <?php echo $Num_Rows;?>  </font>
<?php
}
if($Prev_Page) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
}

/*for($i=1; $i<=$Num_Pages; $i++){
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
	echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page')\">Next >></a> </li>";
}
?>
</font></div>
<?php
############
}
else{
echo "<div class='error'>No Records Found!</div>";
}
 
 
 ################ home end

 ?>