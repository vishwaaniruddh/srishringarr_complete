<?

include("functions.php");

$login="nileshd";
$password="dosooye";

$check=checkpassword($login,$password);

$lid=getloginid($login);

echo "<br>Check : $check<br>";
echo "LID : $lid<br>";


?>