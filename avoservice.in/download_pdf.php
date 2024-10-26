<?php
 $file = 'filename.pdf';
 if(!file){
     die('Error: file not found');
 }else{
     header("Cache-Control: public");
     header("Content-Description: File Transfer");
     header("Content-Disposition: attachment; filename=$file");
     header("Content-Type: application/pdf");
     header("Content-Transfer-Encoding: binary");
     readfile($file);
 }
 ?>