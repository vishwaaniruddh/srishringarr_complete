<?php
if(isset($_POST['addeng']))
{
	include("config.php");
$ename=$_POST['ename'];
$con=$_POST['cont'];	
$email=$_POST['email'];
$qry=mysql_query("INSERT INTO `satyavan_sunrise`.`phppos_engineer` (`id`, `name`, `contact`, `email`) VALUES (NULL, '".$ename."', '".$con."','".$email."')");
if(!$qry)
echo "failed".mysql_error();
else
{
//header('location:engperforma.php');
?>
<script type="text/javascript">
alert("New Engineer has been added successfully");
window.onunload = refreshParent;
        function refreshParent() {
            window.opener.location.reload();
        }
		window.close();
</script>
<?php	
}
}
?>