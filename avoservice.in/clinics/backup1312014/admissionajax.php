<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
//include('template.html');
include('config.php');

$id=$_GET['id'];
//$aid=$_GET['aid'];
//echo "select * from admission where patient_id='$id'";
$sql="select * from admission where patient_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$Num_Rows = mysql_num_rows ($result);
 
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
 $sql.=" LIMIT $Page_Start , $Per_Page";
 if(mysql_num_rows($result)>0)
 {
	 //echo $sql;
 $adm2=mysql_query($sql);
while($adm3=mysql_fetch_array($adm2))
{
$pat=mysql_query("select * from patient where srno='$id'");
			$pat1=mysql_fetch_row($pat);
			
			$pdoc=mysql_query("select * from doctor where doc_id='$adm3[2]'");
			$doc=mysql_fetch_row($pdoc);
			?>
			
				
				<h1 style="font-size:19px;">Addmission</h1>
                
             <p>
             Patient Id : <b><?php echo $pat1[3]; ?></b>  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Patient Name :<b> <?php echo $pat1[6]; ?></b>&nbsp;&nbsp;
             Doctor Name: <b><?php echo $doc[1]; ?></b></p><br/>
             
             <p>Addmission Date: <b><?php if(isset($adm3[2]) and $adm3[2]!='0000-00-00') echo date('d-m-Y',strtotime($adm3[2])); ?></b>
             
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             
             Addmission Time: <b><?php echo $adm3[3]; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             
             Room No: <b> <?php echo $adm3[6]; ?></b></p><br/>
             
           
             <p>Discharge Date :<b> <?php if(isset($adm3[4]) and $adm3[4]!='0000-00-00') echo date('d-m-Y',strtotime($adm3[4])); ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             
             Discharge Time :<b> <?php echo $adm3[5]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php 
$startDate = strtotime($adm3[2]);
$endDate = strtotime($adm3[4]);

$interval = $endDate - $startDate;
$days = floor($interval / (60 * 60 * 24));

?>           
             Stay In Days :<b> <?php echo $days; ?></b></p><br/>
             
             
             <p>Final Diagnosis : <b> <?php echo $adm3[10]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Allergies :<b> <?php //echo $adm3[10]; ?></b>
              </p><br/>
             
             
             <p>Symptoms of Present Illness :<b> <?php //echo $adm3[11]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Past Illness :<b> <?php echo $adm3[7]; ?></b>
              </p><br/>
             
             
             <p>Systematic Examination :<b> <?php //echo $adm3[13]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Local Examination :<b> <?php //echo $adm3[14]; ?></b>
              </p><br/>
             
             
             <p>Provisional Diagnosis :<b> <?php echo $adm3[13]; ?></b>   </p><br/>
            
            <p>General Examination :    </p><br/>
             
             
             <p>Built :<b> <?php //echo $adm3[16]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Temperature :<b> <?php //echo $adm3[17]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Nourishment :<b> <?php //echo $adm3[18]; ?></b></p><br/>
             
             
             <p>Pulse :<b> <?php //echo $adm3[19]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Anaema :<b> <?php //echo $adm3[20]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Respiration :<b> <?php //echo $adm3[21]; ?></b></p><br/>
             
             <p>Cyanosis :<b> <?php //echo $adm3[22]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           Lying BP Down :<b> <?php //echo $adm3[23]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Oedema :<b> <?php //echo $adm3[24]; ?></b></p><br/>
             
              <p>BP Sitting :<b> <?php //echo $adm3[25]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Jaundice :<b> <?php //echo $adm3[26]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Skin :<b> <?php //echo $adm3[27]; ?></b></p><br/>
             
              <p>Throat :<b> <?php //echo $adm3[28]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Nails :<b> <?php //echo $adm3[29]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Tongue :<b> <?php //echo $adm3[30]; ?></b></p><br/>
             
              <p>Other :<b> <?php //echo $adm3[31]; ?></b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         Lymph Nodes :<b> <?php //echo $adm3[32]; ?></b>
       </p>
            
	
			
			<?php
}
?>
			
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
		echo " <li><a href=\"JavaScript:searchById('OPD','$id2','$Next_Page')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
//echo $Page." ".$Prev_Page." ".$Num_Pages;
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:getrep('OPD','$id2','$Next_Page')\" > Next >></a> ";
}
?>
</font></div>
<?php
}
else
echo "No records Found";

include('footer.html');
}else
{ 
 header("location: index.html");
}

?>