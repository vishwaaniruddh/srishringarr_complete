<?php
set_time_limit(0);
ini_set('memory_limit', '512M');

$sourcePath = $_POST['source_path'];
$quality = 75;
$batchSize = 50; // Number of images to process per batch
$currentBatch = (int)$_POST['current_batch'];

function getAllImages($sourcePath) {
    $images = [];

    // Recursive directory iterator to get all images
    $directoryIterator = new RecursiveDirectoryIterator($sourcePath);
    $iterator = new RecursiveIteratorIterator($directoryIterator);

    foreach ($iterator as $file) {
        if ($file->isFile() && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file->getFilename())) {
            $images[] = $file->getPathname();
        }
    }
    return $images;
}

function compressImageBatch($images, $quality, $currentBatch, $batchSize) {
    $batchImages = array_slice($images, $currentBatch, $batchSize);
    foreach ($batchImages as $imagePath) {
        $destinationPath = str_replace("yn/uploads", "compress_image", $imagePath);
        
        // Ensure the destination directory exists
        $destinationDir = dirname($destinationPath);
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0777, true);
        }

        compress($imagePath, $destinationPath, $quality);
    }
    return count($batchImages);
}

function compress($source, $destination, $quality) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    } elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    } else {
        return false;
    }

    $newWidth = 200;
    $newHeight = 200;

    $width = imagesx($image);
    $height = imagesy($image);

    $aspectRatio = min($newWidth / $width, $newHeight / $height);
    $targetWidth = (int)($width * $aspectRatio);
    $targetHeight = (int)($height * $aspectRatio);

    $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);

    if ($info['mime'] == 'image/png' || $info['mime'] == 'image/gif') {
        imagecolortransparent($resizedImage, imagecolorallocatealpha($resizedImage, 0, 0, 0, 127));
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
    }

    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
    imagejpeg($resizedImage, $destination, $quality);

    imagedestroy($image);
    imagedestroy($resizedImage);

    return true;
}

$images = getAllImages($sourcePath);
$totalImages = count($images);

if ($totalImages === 0) {
    echo json_encode(['status' => 'error', 'message' => 'No images found in source path']);
    exit;
}

$processedCount = compressImageBatch($images, $quality, $currentBatch, $batchSize);
$currentBatch += $batchSize;

if ($currentBatch < $totalImages) {
    echo json_encode(['status' => 'continue', 'current_batch' => $currentBatch, 'processed' => $currentBatch, 'total' => $totalImages]);
} else {
    echo json_encode(['status' => 'completed', 'processed' => $totalImages, 'total' => $totalImages]);
}
?>
