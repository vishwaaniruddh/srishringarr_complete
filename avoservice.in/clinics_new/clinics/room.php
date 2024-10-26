<?php
   include('config.php');
	$disdate = $_GET['disdate'];
	$addate=$_GET['addate'];
	$qry=mysqli_query($con,"select * from room where no Not IN (SELECT room FROM admission WHERE admit_date <= STR_TO_DATE('".$addate."','%d/%m/%Y') AND dis_date>= STR_TO_DATE('".$disdate."','%d/%m/%Y'))");
	//$qry="SELECT * FROM admission WHERE admit_date<= STR_TO_DATE('".$addate."','%d/%m/%Y') AND dis_date>= STR_TO_DATE('".$disdate."','%d/%m/%Y')";
	//echo "select * from room where no not in(SELECT room FROM admission WHERE admit_date <= STR_TO_DATE('".$addate."','%d/%m/%Y') AND dis_date>= STR_TO_DATE('".$disdate."','%d/%m/%Y'))";
	//if(!$qry)
	//echo mysqli_error();
	?>
    <select name="room">
     <option value="">Select Room</option>
    <?php
	while($row=mysqli_fetch_array($qry))
	{
		?>
        <option value="<?php echo $row[0]; ?>"><?php  echo $row[1];  ?></option>
        <?php
	}
	
?></select>