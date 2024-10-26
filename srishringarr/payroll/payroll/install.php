<?

 $fp=fopen("datacon.php","r");
 $val = fread( $fp, filesize("datacon.php"));
 fclose ($fp);


$val=str_replace("\$password=\"".$password."\";", "\$password=\"".$new_password."\";", $val);
$val=str_replace("\$user=\"".$user."\";", "\$user=\"".$new_user."\";", $val);
$val=stripslashes($val);


 $fp=fopen("datacon.php","w+");
 fputs($fp,$val);
 fclose($fp);

?>