<?php
 include('config.php');
 $id2=$_GET['id']; 

 $strPage = $_REQUEST['Page'];

//echo "select * from pre-investigation where p_id='$id' order by current_date";
$id3=explode("-",$id2);
$id=$id3[1];

?>
	
<center>
<!--<table width="904" height="46" border="0" ><tr><td width="595"><input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = '../view_patient1.php';" value="Go Back" />
<input type="button" style="width:110px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'horizontal.php?id=<?php echo $id; ?>';" value="Pre Investigation" />
<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'opd_his.php?id=<?php echo $id; ?>';" value="OPD" />

<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'admission.php?id=<?php echo $id; ?>';" value="Admission" />
<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'surgery.php?id=<?php echo $id; ?>';" value="Surgery" />
</td>
<td width="175"><h1>History </h1></td></tr></table>--></center>

		<ul id="dates"><?php
		//echo "select * from `pre-investigation` where `p_id`='".$id."' order by current_date ASC";
		$qry="select * from `pre-investigation` where `p_id`='".$id."' order by current_date ASC";
        $opd=mysql_query($qry);
		$Num_Rows = mysql_num_rows ($opd);
 
########### pagins

$Per_Page = 1;   // Records Per Page
 
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
$qry.=" LIMIT $Page_Start , $Per_Page";
$result = mysql_query($qry) or die(mysql_error());
		if(mysql_num_rows($result)>0)
		{
       while($opd1=mysql_fetch_array($opd)){
	   //echo "hello";

?>
<li ><a href="#<?php echo $opd1[0]."o"; ?>"><?php if(isset($opd1[3]) and $opd1[3]!='0000-00-00') echo date('d-m-Y',strtotime($opd1[3])); ?> (Pre Investigation)</a>
           </li>
		<?php }
		}
		else
		echo "No Previous Record Found";
		 ?>
        
        
        
			</ul>
		
		
             <?php 
			// echo "select * from `pre-investigation` where p_id='$id' order by current_date";
			 $opd2=mysql_query("select * from `pre-investigation` where p_id='$id' order by current_date");
		while($opd3=mysql_fetch_array($opd2)){
		//echo "select * from patient where no='$id'";
			$pat=mysql_query("select * from patient where no='$id'");
			$pat1=mysql_fetch_row($pat);
			
			$pdoc1=mysql_query("select * from doctor where doc_id='$opd3[2]'");
			$doc1=mysql_fetch_row($pdoc1);
			?>
			
				
				<h1 style="font-size:19px;">Pre Investigation Detail</h1>
             <p> Patient Id : <b><?php echo $pat1[2]; ?></b>  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Patient Name :<b> <?php echo $pat1[6]; ?></b>
             </p><br/>
             
             <p>OPD Date: <b><?php if(isset($opd3[4]) and $opd3[4]!='0000-00-00') echo date('d-m-Y',strtotime($opd3[4])); ?></b>
             
         
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Reference By: <b><?php echo $doc1[1]; ?></b></p><br/>
             
           
            
             
             <p>Complaints : <b> <?php echo $opd3[5]; ?></b></p><br/>
             
           <p> Findings :<b> <?php echo $opd3[6]; ?></b>
              </p><br/>
             
             
         
             
             
             <p>Advised: :<b> <?php echo $opd3[7]; ?></b>   </p><br/>
            
            <p>Diagnosis:  <b><?php echo $opd3[8]; ?> </b>  </p><br/>
             
             
             <p>Medicine Name:<b><?php echo $opd3[9]; ?> </b>
  <p>Reports :</p>
    <?php
	/*$photo=mysql_query("select * from pre_invest_report where patient_id='$id' and pre_id='$opd3[0]'");
	while($photo1=mysql_fetch_row($photo)){ 
	if($photo1[2]==""){ }else {
		
		
  if ($photo1[2]) 
 	{// echo $image;
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($photo1[2]);
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		//print error message ?>
 			
            <a href="../<?php echo $photo1[2]; ?>" target="_blank">Your Pdf</a>

 		<?php 
 		}
 		else
 		{ ?>
  
    
    <a href="../<?php echo $photo1[2]; ?>" target="_blank"><img src="../<?php echo $photo1[2]; ?>" width="256" height="256" /></a>
    <?php } } } } */ ?>
		  
			<?php ?>
			
			
		<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
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
	echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page')\">Next >></a> </li>";
}
?>
</font></div>

