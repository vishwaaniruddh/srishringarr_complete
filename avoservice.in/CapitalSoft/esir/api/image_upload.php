<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $file_name = $_FILES["image_file"]["name"][0];
    $file_type = $_FILES["image_file"]["type"];
    $temp_name = $_FILES["image_file"]["tmp_name"][0];
   // echo $temp_name;die;
    $file_size = $_FILES["image_file"]["size"];
    $error = $_FILES["image_file"]["error"];
    if (!$temp_name)
    {
        echo "ERROR: Please browse for file before uploading";
        exit();
    }
    function compress_image($source_url, $destination_url, $quality)
    {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
        $ch = imagejpeg($image, $destination_url, $quality);
        echo '<pre>';print_r($ch);echo '</pre>';
       // echo "Image uploaded successfully.";
    }
    if ($error > 0)
    {
        echo $error;
    }
    else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
    {
        $filename = compress_image($temp_name, "uploads/" . $file_name, 20);
    }
    else
    {
        echo "Uploaded image should be jpg or gif or png.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>How to compress an image without losing quality in PHP</title>
</head>

<body>
    <form action='image_upload.php' method='POST' enctype='multipart/form-data'>
        <input name="image_file[]" type="file" accept="image/*">
        <button type="submit">SUBMIT</button>
    </form>
</body>

</html>