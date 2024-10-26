<?

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

$source_img = 'yn/uploads/2021/02/16145188440.jpg';
$destination_img = 'testimage/uploads/2021/02/16145188440.jpg';

$d = compress($source_img, $destination_img, 60);


?>