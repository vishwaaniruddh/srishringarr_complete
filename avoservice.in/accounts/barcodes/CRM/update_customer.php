<?php
include('config.php');
$id=$_POST['id'];
$cname=$_POST['cname'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$add=$_POST['add'];
$pin=$_POST['pin'];
$motor=$_POST['motor'];
$oldimg==$_POST['oldomg'];
//inserting a new image
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
	  unlink("modelphoto/".$oldimg);
	}
	
	}
	
	}
       else {
?><script>alert("INVALID IMAGE");
window.location="newcustomer.php";
</script><?php
}
}
else
{
	$new=$oldimg;
}




//echo "update `phppos_service` set name ='".$cname."',contact ='".$cont."',email ='".$email."',address ='".$add."',pincode ='".$pin."' where cust_id='$id'";
$sql="update `phppos_service` set name ='".$cname."',contact ='".$cont."',email ='".$email."',address ='".$add."',pincode ='".$pin."', item_id='".$_POST['item']."',motor='".$motor."',image='$new' where cust_id='$id'";
$result=mysql_query($sql);

if($result)
{
?>	<script>
	window.location="cust_service.php";</script><?php
}
else
echo "Error Updating Data";
?>