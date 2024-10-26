<html>
<head><title>My editable page</title>
<script>
function runit()
{
 alert("ok");
 var obj=document.getElementById('printit');
 alert(obj);
}
</script>
</head>
<body bgcolor="#cccccc" text="#000000" link="#000000" alink="#000000" vlink="#000000">
<font face="verdana, arial, helvetica" size=2>

<?PHP 
	if ($_POST['pw']!="") {$pw=$_POST['pw'];}else{$pw=$_GET['pw'];}
	$newcontent=$_POST['newcontent'];
	$filelocation = "mytext.txt";
	if (!file_exists($filelocation)) {
	echo "Couldn't find datafile, please contact administrator!";
	}
	else {
	$newfile = fopen($filelocation,"r");
	$content = fread($newfile, filesize($filelocation));
	fclose($newfile);
	}
	$content = stripslashes($content);
	$content = htmlentities($content);
	$pass="password";
	if (!$pw || $pw != $pass){
	$content = nl2br($content);
	echo $content;
	}
	else {
		if ($newcontent){
			$newcontent = stripslashes($newcontent);
			$newfile = fopen($filelocation,"w");
			fwrite($newfile, $newcontent);
			fclose($newfile);
			echo "Text was edited.<form><input type=\"submit\" value=\"see changes\"></form>";	
			}
				else{
				echo "<form method=\"post\">
		        <textarea name=\"newcontent\" cols=50 rows=15 wrap=\"virtual\">";
				echo $content;
				echo "</textarea><input type=\"hidden\" name=\"pw\" value=\"$pass\"><br><input type=\"submit\" value=\"edit\" onclick=\"runit()\"></form>";
				}
		}	
?>
	
</font>
</body>
</html>
