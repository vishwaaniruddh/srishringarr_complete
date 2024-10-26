 <?php include('config.php');
 
        
		if(isset($_POST['mainfolder']))
		$mainfold=$_POST['mainfolder'];
		if(isset($_POST['subfolder']))
		$dirname =$mainfold.'/'.$_POST['subfolder'];
if (!file_exists($dirname)) {
    mkdir($dirname, 0777);
    echo "The directory $dirname was successfully created.";	
	$sql="insert into `subfolder`(`subcat_name`) values('".$dirname."')";
	$result = mysql_query($sql);
    exit;
} else {
    echo "The directory $dirname exists.";
}

?>