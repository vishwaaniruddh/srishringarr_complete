<?php
 include('../config.php');
$id=$_GET['id']; 


$adm=mysql_query("select * from admission where patient_id='$id'  order by admit_date");
$opd=mysql_query("select * from opd where patient_id='$id' order by opddate");
$num=mysql_num_rows($opd);
$sur=mysql_query("select * from surgery where no='$id'  order by sur_date");
 function getExtension($str) {
         $a = strrpos($str,".");
         if (!$a) { return ""; }
         $l = strlen($str) - $a;
         $ext = substr($str,$a+1,$l);
         return $ext;
 }
?>
	
<!doctype html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="author" content="Made with ❤ by Jorge Epuñan - @csslab">
	
	<title>jQuery Timeline 0.9.51 - Dando vida al tiempo</title>
	<link rel="stylesheet" href="css/style.css" media="screen" />
	
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.timelinr-0.9.51.js"></script>
	<script>
		$(function(){
			$().timelinr({
				arrowKeys: 'true'
			})
		});
	</script>
</head>

<body><center>
<table width="904" height="46" border="0" ><tr><td width="595"><input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = '../view_patient.php';" value="Go Back" /></td>
<td width="175"><h1>History </h1></td></tr></table></center>
<div id="timeline">
		<ul id="dates">
        <?php while($adm1=mysql_fetch_row($adm)){

?>
			<li ><a href="#<?php echo $adm1[0]."a"; ?>"><?php if(isset($adm1[3]) and $adm1[3]!='0000-00-00') echo date('d-m-Y',strtotime($adm1[3])); ?> (Admit)</a>
           </li>
		<?php } 
        
       while($opd1=mysql_fetch_row($opd)){

?>
			<li ><a href="#<?php echo $opd1[0]."o"; ?>"><?php if(isset($opd1[76]) and $opd1[76]!='0000-00-00') echo date('d-m-Y',strtotime($opd1[76])); ?> (OPD)</a>
           </li>
		<?php } 
        while($sur1=mysql_fetch_row($sur)){

?>
			<li ><a href="#<?php echo $sur1[76]; ?>"><?php if(isset($sur1[7]) and $sur1[7]!='0000-00-00') echo date('d-m-Y',strtotime($sur1[7])); ?> (Srgry)</a>
           </li>
		<?php } ?>
        
        
        
		</ul><!--
		<ul id="issues">
        <?php /* $adm2=mysql_query("select * from admission where patient_id='$id'");
		while($adm3=mysql_fetch_row($adm2)){
			$pat=mysql_query("select * from patient where no='$id'");
			$pat1=mysql_fetch_row($pat);
			
			$pdoc=mysql_query("select * from doctor where doc_id='$adm3[2]'");
			$doc=mysql_fetch_row($pdoc);
			?>
			<li id="<?php echo $adm3[0]."a"; ?>">
				
				<h1 style="font-size:19px;">Addmission</h1>
             <p> Patient Id : <b><?php echo $pat1[2]; ?></b>  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Patient Name :<b> <?php echo $pat1[6]; ?></b>
              &nbsp;&nbsp;
             Doctor Name: <b><?php echo $doc[1]; ?></b></p><br/>
             
             <p>Addmission Date: <b><?php if(isset($adm3[3]) and $adm3[3]!='0000-00-00') echo date('d-m-Y',strtotime($adm3[3])); ?></b>
             
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Addmission Time: <b><?php echo $adm3[4]; ?></b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Room No: <b> <?php echo $adm3[8]; ?></b></p><br/>
             
           
             <p>Dicharge Date :<b> <?php echo $adm3[5]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Dicharge Time :<b> <?php echo $adm3[6]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Stay In Days :<b> <?php echo $adm3[7]; ?></b></p><br/>
             
             
             <p>Final Diagnosis : <b> <?php echo $adm3[9]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Allergies :<b> <?php echo $adm3[10]; ?></b>
              </p><br/>
             
             
             <p>Symptoms of present illness :<b> <?php echo $adm3[11]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Past illness :<b> <?php echo $adm3[12]; ?></b>
              </p><br/>
             
             
             <p>Systematic Examination :<b> <?php echo $adm3[13]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Local Examination :<b> <?php echo $adm3[14]; ?></b>
              </p><br/>
             
             
             <p>Provisional Diagnosis :<b> <?php echo $adm3[15]; ?></b>   </p><br/>
            
            <p>General Examination :    </p><br/>
             
             
             <p>Built :<b> <?php echo $adm3[16]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Temperature :<b> <?php echo $adm3[17]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Nourishment :<b> <?php echo $adm3[18]; ?></b></p><br/>
             
             
             <p>Pulse :<b> <?php echo $adm3[19]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Anaema :<b> <?php echo $adm3[20]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Respiration :<b> <?php echo $adm3[21]; ?></b></p><br/>
             
             <p>Cyanosis :<b> <?php echo $adm3[22]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           Lying BP Down :<b> <?php echo $adm3[23]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Oedema :<b> <?php echo $adm3[24]; ?></b></p><br/>
             
              <p>BP Sitting :<b> <?php echo $adm3[25]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Jaundice :<b> <?php echo $adm3[26]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Skin :<b> <?php echo $adm3[27]; ?></b></p><br/>
             
              <p>Throat :<b> <?php echo $adm3[28]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Nails :<b> <?php echo $adm3[29]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Tongue :<b> <?php echo $adm3[30]; ?></b></p><br/>
             
              <p>Other :<b> <?php echo $adm3[31]; ?></b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         Lymph Nodes :<b> <?php echo $adm3[32]; ?></b>
       </p>
            
	
			</li>
			<?php } ?>
            <!------------------------------------------OPD--------------------------------------------------------------------------------------------------->
             <!--<?php $opd2=mysql_query("select * from opd where patient_id='$id' order by opddate");
		while($opd3=mysql_fetch_row($opd2)){
			$pat=mysql_query("select * from patient where no='$id'");
			$pat1=mysql_fetch_row($pat);
			
			$pdoc1=mysql_query("select * from doctor where doc_id='$opd3[47]'");
			$doc1=mysql_fetch_row($pdoc1);
			?>
			<li id="<?php echo $opd3[0]."o"; ?>">
				
				<h1 style="font-size:19px;">OPD Detail</h1>
             <p> Patient Id : <b><?php echo $pat1[2]; ?></b>  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Patient Name :<b> <?php echo $pat1[6]; ?></b>
             </p><br/>
             
             <p>OPD Date: <b><?php if(isset($opd3[76]) and $opd3[76]!='0000-00-00') echo date('d-m-Y',strtotime($opd3[76])); ?></b>
             
         
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Reference By: <b><?php echo $doc1[1]; ?></b></p><br/>
             
           
            
             
             <p>Complaints : <b> <?php echo $opd3[29]; ?></b></p><br/>
             
           <p> Findings :<b> <?php echo $opd3[77]; ?></b>
              </p><br/>
             
             
            
             
             
           <p>Advised :<b> <?php echo $opd3[36]; ?></b></p><br/>
          
            <p> Diagnosis :<b> <?php echo $opd3[30]; ?></b>
              </p><br/>
             
             
             <p>Advised: :<b> <?php echo $opd3[36]; ?></b>   </p><br/>
            
            <p>Diagnosis:  <b><?php echo $opd3[30]; ?> </b>  </p><br/>
             
             <?php 
			
			 $med = explode(',',$opd3[78]);
$tak= explode(',',$opd3[79]);
$dos = explode(',',$opd3[80]);
for($i = 0; $i < count($med); $i++){ 
?>
             
             <p>Medicine Name:<b><?php echo $med[$i]; ?> </b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            How to Take :<b> <?php echo $tak[$i]; ?></b>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             Dosage :<b> <?php echo $dos[$i]; ?></b></p><br/>
	<?php }    ?>
    <p>Reports :</p>
    <?php
	$photo=mysql_query("select * from patient_photo where patient_id='$id' and opd_id='$opd3[0]'");
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
 			
            <a href="../<?php echo $photo1[3]; ?>" target="_blank">Your Pdf</a>

 		<?php 
 		}
 		else
 		{ ?>
  
    
    <a href="../<?php echo $photo1[3]; ?>" target="_blank"><img src="../<?php echo $photo1[3]; ?>" width="256" height="256" /></a>
    <?php } } } }?>
		  </li>
			<?php } */?>
			
		</ul>-->
<div id="grad_left"></div>
		<div id="grad_right"></div>
		<a href="#" id="next">+</a>
		<a href="#" id="prev">-</a>
	</div>

	

</body>
</html>


