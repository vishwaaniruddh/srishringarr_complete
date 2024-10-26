<?php
include('config.php');
$cname=$_POST['cname'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$add=$_POST['add'];
$model=$_POST['model'];
$dop=$_POST['dop'];
$sdate1=$_POST['sdate1'];
$sdate2=$_POST['sdate2'];
$sdate3=$_POST['sdate3'];
$sdate4=$_POST['sdate4'];
$pin=$_POST['pin'];
$motor=$_POST['motor'];
$image=$_FILES['file']['name'];

$new="";
if($image)
{
$target="modelphoto/";
$min_rand=rand(0,1000);
$max_rand=rand(100000000000,10000000000000000);

$name_file=rand($min_rand,$max_rand);//this part is for creating random name for image

$ext2=end(explode(".", $_FILES["file"]["name"]));//gets extension
$ext=strtolower($ext2);
$allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "GIF", "PJPEG", "PNG", "mp3");

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/JPG")
|| ($_FILES["file"]["type"] == "image/GIF")
|| ($_FILES["file"]["type"] == "image/JPEG")
|| ($_FILES["file"]["type"] == "image/PNG")
|| ($_FILES["file"]["type"] == "image/mp3"))
&& ($_FILES["file"]["size"] < 60000000)
&& in_array($ext, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
   // echo "Upload: ".$_FILES["file"]["name"] . "<br />";
    //echo "Type: " . $_FILES["file"]["type"]. "<br />";
    //echo "Size: " . ($_FILES["file"]["size"] / 1258048) . " Kb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	$target=$target.$name_file.".".$ext;
  $row= move_uploaded_file($_FILES["file"]["tmp_name"],$target);
//echo "Stored in: " . "images/gallery/".$name_file.".".$ext;
  if($row)
  {
      //echo "Stored in: " . "images/gallery/".$name_file.".".$ext;
	  $new=$name_file.".".$ext;
	}
	
	}
	
	}
       else {
?><script>alert("INVALID IMAGE");
window.location="newcustomer.php";
</script><?php
}
}

$sql="insert into phppos_service (name,contact,email,address,item_id,purchase_date,service_date1,service_date2,service_date3,service_date4,ctype,pincode,motor,image) values
 ('$cname','$cont','$email','$add','$model',STR_TO_DATE('".$dop."','%d/%m/%Y'),STR_TO_DATE('".$sdate1."','%d/%m/%Y'),STR_TO_DATE('".$sdate2."','%d/%m/%Y'),STR_TO_DATE('".$sdate3."','%d/%m/%Y'),STR_TO_DATE('".$sdate4."','%d/%m/%Y'),'domestic','$pin','$motor','$new')";
$result=mysql_query($sql);

if($result)
{

$mx=mysql_query("SELECT max(id) FROM  `phppos_service`");
$max=mysql_fetch_row($mx);
$newid="C-".$max[0];
mysql_query("update `phppos_service` set cust_id='".$newid."' where id='$max[0]'");
	////header('Location: cust_service.php');
	?>
	
	<table align="center">

	<tr><td width="345" height="50">New Customer Detail</td>
	</tr>
	<tr><td width="345" height="33">Customer Name:<?php echo $cname; ?></td>
	</tr>
	<tr><td height="49"><font size="+1" color="#FF0000">Customer ID:&nbsp;&nbsp;<b><?php echo $newid; ?></b></font></td>
	</tr>
	<tr><td height="49" align="center"><a href="cust_service.php">Go Back</a></td>
	</tr>
        <tr><td height="49" align="center"><input type="button" name="print" value="PRINT WARRANTY LETTER" onclick="window.open('print.php?id=<?php echo $max[0];?>','PRINT WARRANTY')"  ></td></tr>
	</table>
	<?php
}
else
echo "Error Inserting Data";
?>