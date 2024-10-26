<?php
include("config.php");
if(isset($_POST['edteng']))
{
$qry=mysql_query("Update phppos_engineer set name='".$_POST['ename']."', contact='".$_POST['cont']."', email='".$_POST['email']."' where id='".$_POST['id']."'");	
if(!$qry)
echo "failed".mysql_error();
else
{
//header('location:engperforma.php');
?>
<script type="text/javascript">
alert("Details Edited Successfully");
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