<?php
 include('config.php');
$id=$_GET['id']; 
 $strPage = $_REQUEST['Page'];
//echo "select * from surgery1 where no='$id'  order by sur_date";
$qry="select * from surgery1 where no='$id' order by sur_date DESC";
$sur=mysql_query($qry);




 $num=mysql_num_rows($sur);
$Num_Rows = mysql_num_rows ($sur);
 
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


        <?php $adm2=mysql_query($qry);
		while($adm3=mysql_fetch_row($adm2)){
			$pat=mysql_query("select * from patient where srno='$id'");
			$pat1=mysql_fetch_row($pat);
			
			$pdoc=mysql_query("select * from doctor where doc_id='$adm3[3]'");
			$doc=mysql_fetch_row($pdoc);
			$time=$adm3[9];
list($hr, $min) = explode(":", $time);

$time1=$adm3[10];
list($hr1, $min1) = explode(":", $time1);

			?>
			
				
				<h1 style="font-size:19px;">Surgery</h1>
                
             <p>
             Patient Id : <b><?php echo $pat1[3]; ?></b>  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Patient Name :<b> <?php echo $pat1[6]; ?></b>&nbsp;&nbsp;
             Doctor Name: <b><?php echo $doc[1]; ?></b></p><br/>
             
             <p>Date: <b><?php if(isset($adm3[5]) and $adm3[5]!='0000-00-00') echo date('d-m-Y',strtotime($adm3[5])); ?></b>
             
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="timein">Time In :</span><b><?php echo $adm3[9]; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="timeout">Time Out :</span><b> <?php echo $adm3[10]; ?></b></p>
             <br/>
           <?php
           $result1 = mysql_query("select doc_id,name from doctor where doc_id='$adm3[7]'");
           $row1=mysql_fetch_row($result1);
           
           $result6 = mysql_query("select doc_id,name from doctor where doc_id='$adm3[3]'");
           $row6=mysql_fetch_row($result6);
           
           $result12=mysql_query("select * from doctor where doc_id='$adm3[3]'");
           $row12=mysql_fetch_row($result12);
           
$result13=mysql_query("select * from doctor where doc_id='$adm[4]'");
$row13=mysql_fetch_row($result13);
           ?>  
           
             <p><span class="an">Anaesthetist </span> :<b> <?php echo $row1[1]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="surgeon1">Surgeon 1:</span><b> <?php echo $row6[1];; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <span class="surgeon2">Surgeon 2:</span><b> <?php echo $row7[1]; ?></b></p><br/>
             
             <p>Type: <b><?php if($row[8]=="LA"){ echo "Local Anaesthetist (LA)"; } ?>
                 <?php if($row[8]=="GA"){ echo "General Anaesthetist (GA)"; } ?> 
                 <?php if($row[8]=="SA"){ echo "Spinal Anaesthetist (SA)"; } ?></b> 
                 
                 </p>
             <p><span class="procedure">Procedure :</span><b> <?php echo $adm3[6]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><br/>
             
             <p >Admission Fees :&nbsp;
                 <?php echo $adm3[30]; ?>
                  </p>
                 <p >  ECG Charges :<?php echo $adm3[20]; ?></p>
                <p >Pulse OX Charges :<?php echo $adm3[13]; ?></p>
                  <p >Pathology Charges :
                 <?php echo $adm3[21]; ?></p>
                <p >OT & Instrument :<?php echo $adm3[12]; ?></p>
                <p >Dressing Charges :<?php echo $adm3[22]; ?></p>
                <p >Material & Drugs :<?php echo $adm3[15]; ?></p>
                  <p >Routine Nursing Charges :<?php echo $adm3[23]; ?></p>
                 <p >Surgery Charges :<?php echo $adm3[14]; ?></p>
                   <p >Spl. Nursing Charges :<?php echo $adm3[18]; ?></p>
                <p >Anaesthesis Charges :<?php echo $adm3[17]; ?></p>
                  <p >Expert Visit Charges :<?php echo $adm3[24]; ?></p>
                 <p >Lithotripsy Charges :<?php echo $adm3[16]; ?></p>
                   <p >Physiotherapy Charges :<?php echo $adm3[25]; ?></p>
                 <p >X-Ray Charges :<?php echo $adm3[19]; ?></p>
                  <p >Ambulance Charges :<?php echo $adm3[27]; ?></p>
                 <p >Misc. Charges :<?php echo $adm3[28]; ?></p>
                   <p >Total : <?php echo $adm3[29]; ?></p>
                 <p >Discount :    <?php echo $adm3[31]; ?></p>
                  <p >Grand Total :
                    <?php echo $adm3[32]; ?></p>
                <br/>
             
           
			
			<?php } ?>
		<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:getrep('surgery','$id','$Prev_Page')\"><< Back</a> ";
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
	echo " <a href=\"JavaScript:getrep('surgery','$id','$Next_Page')\"> Next >></a> ";
}
?>


	

</body>
</html>