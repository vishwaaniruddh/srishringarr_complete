 <?php
	//echo $opd3[91];
	include("config.php");
	$id=$_GET['id'];
	$str_page=$_GET['Page'];
	//echo "select * from patient_photo where patient_id='$id' and photo<>''";
	function getExtension($str) {
         $a = strrpos($str,".");
         if (!$a) { return ""; }
         $l = strlen($str) - $a;
         $ext = substr($str,$a+1,$l);
         return $ext;
 }
 $qry="select * from patient_photo where patient_id='$id' and photo<>''";
 $pic=mysql_query($qry);
 $numrows=mysql_num_rows($pic);
 $perpage=2;
 $page=$str_page;
 if(!$str_page)
 $page=1;
 $prev_page=$page-1;
 $next_page=$page+1;
 $pagestart=($perpage*$page)-$perpage;
 if($numrows<=$perpage)
 {
 $numpage=1;
 }
 elseif($numrows%$perpage==0)
 {
 $numpage=$numpage/$perpage;
 }
 else
 {
 $numpage=($numpage/$perpage)+1;
 $numpage=int($numpage);
 }
 
	$qry.=" Limit $pagestart, $perpage";
	//echo $qry;
	$photo=mysql_query($qry);
	while($photo1=mysql_fetch_row($photo)){ 
	if($photo1[3]==""){ }else {
		
		
  if ($photo1[3]) 
 	{// echo $image;
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($photo1[3]);
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		//print error message ?>
 			
            <a href="<?php echo $photo1[3]; ?>" target="_blank">Your Pdf</a>

 		<?php 
 		}
 		else
 		{ ?>
  
    
    <a href="<?php echo $photo1[3]; ?>" target="_blank"><img src="<?php echo $photo1[3]; ?>" width="256" height="256" /></a>
    <?php } } } }?>
	<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

if($prev_page) 
{
	echo " <a href=\"JavaScript:getrep('report','$id','$prev_page')\"><< Back</a> ";
}

/*for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('OPD','$id2','$Next_Page')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
//echo $Page." ".$Prev_Page." ".$Num_Pages;
if($page!=$numpage)
{
	echo " <a href=\"JavaScript:getrep('report','$id','$next_page')\" > Next >></a> ";
}
?>
</font></div> 
			