<?php
 include('config.php');
/*$id=$_GET['id']; 
if(isset($_GET['link'])){
$link=$_GET['link'];
}

*/
 $strPage = $_REQUEST['Page'];

$id2=$_GET['id']; 


//echo "select * from pre-investigation where p_id='$id' order by current_date";
/*if (strpos($id2, '-') !== false)
    echo 'true';
$id3=explode("-",$id2);
if(id3[1]=='')
$id=$id2;
else
$id=$id3[1];*/
echo "select * from opd where patient_id='$id2'";
$qry="select * from opd where patient_id='$id2'";
$opd=mysql_query($qry);
//$num=mysql_num_rows($opd);
$Num_Rows = mysql_num_rows ($opd);
 
########### pagins

$Per_Page = 1;   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
//echo "hello";
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
 $qry.=" order by opddate DESC LIMIT $Page_Start , $Per_Page";
?>
	

	<script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
		
    </script>

<center>
<!--<table width="904" height="46" border="1" ><tr><td width="712"><input type="button" style="width:100px; height:30px; color:#ac0404;" <?php if($link=='detail') { ?>onClick="javascript:location.href = '../patient_detail.php?id=<?php echo $id; ?>';"<?php } if($link=='detail1') { ?>onClick="javascript:location.href = '../view_patient.php';" <?php } else{  ?>onClick="javascript:location.href = '../view_opd.php';"<?php } ?> value="Go Back" />
<input type="button" style="width:110px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'horizontal.php?id=<?php echo $id; ?>';" value="Pre Investigation" />
<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'opd_his.php?id=<?php echo $id; ?>';" value="OPD" />

<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'admission.php?id=<?php echo $id; ?>';" value="Admission" />
<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'surgery.php?id=<?php echo $id; ?>';" value="Surgery" />


<input type="button" value="Print" onClick="javascript:printDiv('issues')" style="width:100px; height:30px; color:#ac0404;"/></td>
<td width="176"><h1>History </h1></td></tr></table>--></center>

		
		
      
            <!----------------------------------OPD--------------------------------------------------------------------------------------------------->
             <?php
		//echo $qry;
			// echo "select * from opd where patient_id='$id' order by opddate";
			$opd2 = mysql_query($qry) or die(mysql_error());

			// $opd2=mysql_query("select * from opd where patient_id='$id' order by opddate");
		while($opd3=mysql_fetch_row($opd2)){
		$newsrno=$opd3[91];
			$comp=$opd3[29];
			$findin=$opd3[73];
			$invest=$opd3[64];
			$diag=$opd3[30];
			$adv=$opd3[36];
			$date1=$opd3[76];
			$patid=$id2;
			$tp='ajaxopd';
		include('clinic2_print.php');
    } ?>
			
		<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:getrep('OPD','$id2','$Prev_Page')\"><< Back</a> ";
}

/*for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <a href=\"JavaScript:searchById('OPD','$id2','$Next_Page')\">$i</a> ";
	}
	else
	{
		echo "<b> $i </b>";
	}
}*/
//echo $Page." ".$Prev_Page." ".$Num_Pages;
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:getrep('OPD','$id2','$Next_Page')\" > Next >></a> ";
}
?>
</font></div>
</div
