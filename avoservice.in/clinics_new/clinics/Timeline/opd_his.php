<?php
 include('../config.php');
$id=$_GET['id']; 


$opd=mysqli_query($con,"select * from opd where patient_id='$id' order by opddate");
$num=mysqli_num_rows($opd);

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
<table width="904" height="46" border="0" ><tr><td width="595"><input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = '../view_patient.php';" value="Go Back" />
<input type="button" style="width:110px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'horizontal.php?id=<?php echo $id; ?>';" value="Pre Investigation" />
<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'opd_his.php?id=<?php echo $id; ?>';" value="OPD" />

<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = 'admission.php?id=<?php echo $id; ?>';" value="Admission" />

<input type="button" style="width:100px; height:30px; color:#ac0404;" onClick="javascript:location.href = '../view_patient.php';" value="Surgery" />
</td>
<td width="175"><h1>History </h1></td></tr></table></center>
<div id="timeline">
		<ul id="dates">
       <?PHP        
       while($opd1=mysqli_fetch_row($opd)){

?>
			<li ><a href="#<?php echo $opd1[0]."o"; ?>"><?php if(isset($opd1[76]) and $opd1[76]!='0000-00-00') echo date('d-m-Y',strtotime($opd1[76])); ?> (OPD)</a>
             
           </li>
		<?php } ?>
        
        
        
		</ul>
		<ul id="issues">
      
            <!----------------------------------OPD--------------------------------------------------------------------------------------------------->
             <?php $opd2=mysqli_query($con,"select * from opd where patient_id='$id' order by opddate");
		while($opd3=mysqli_fetch_row($opd2)){
			$pat=mysqli_query($con,"select * from patient where no='$id'");
			$pat1=mysqli_fetch_row($pat);
			
			$pdoc1=mysqli_query($con,"select * from doctor where doc_id='$opd3[47]'");
			$doc1=mysqli_fetch_row($pdoc1);
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
	$photo=mysqli_query($con,"select * from patient_photo where patient_id='$id' and opd_id='$opd3[0]'");
	while($photo1=mysqli_fetch_row($photo)){ 
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
			<?php } ?>
			
		</ul>
<div id="grad_left"></div>
		<div id="grad_right"></div>
		<a href="#" id="next">+</a>
		<a href="#" id="prev">-</a>
	</div>

	

</body>
</html>
