<?php

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

$source_img = 'yn/uploads/2022/01/16419951244.jpg';
$destination_img = 'testimage/16419951244.jpg';

$d = compress($source_img, $destination_img, 50);

echo $info = getimagesize($source);

?>