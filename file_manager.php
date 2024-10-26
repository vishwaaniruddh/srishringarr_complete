<?php
echo $basePath = __DIR__; // Set the base path to the current directory
return ;

function listFoldersAndFiles($basePath) {
    $output = "";
    if (is_dir($basePath)) {
        $folders = scandir($basePath);
        foreach ($folders as $folder) {
            if ($folder != '.' && $folder != '..') {
                $folderPath = $basePath . '/' . $folder;
                $output .= "<h3>$folder</h3>";
                $output .= "<ul>";
                $files = scandir($folderPath);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        $output .= "<li><a href='#' onclick='loadFileContent(\"$folder/$file\")'>$file</a></li>";
                    }
                }
                $output .= "</ul>";
                $output .= listFoldersAndFiles($folderPath); // Recursively list subdirectories
            }
        }
    }
    return $output;
}

if (isset($_GET['file'])) {
    $filePath = $_GET['file'];
    $fileContent = file_get_contents("$basePath/$filePath");
    echo $fileContent;
} else {
    echo listFoldersAndFiles($basePath);
}
?>
