 <?php include('config.php');
 
        if(isset($_POST['createfolder']))
		$dirname = $_POST['createfolder'];
		//echo $dirname;
        $filename = $dirname ;

if (!file_exists($filename)) {
    mkdir($dirname, 0777);
    echo "The directory $dirname was successfully created.";
	
	$sql="insert into `catfolder`(`cat_name`) values('".$filename."')";
	$result = mysql_query($sql);
    exit;
} else {
    echo "The directory $dirname exists.";
}
	
	
	
	
	/*
	$year = date("Y");   
$month = date("m");   
$filename = "../".$year;   
$filename2 = "../".$year."/".$month;

if(file_exists($filename)){
    if(file_exists($filename2)==false){
        mkdir($filename2,0777);
    }
}else{
    mkdir($filename,0777);
}*/
	
	
	
  ?>