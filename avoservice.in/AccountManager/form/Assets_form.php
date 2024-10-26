<?php
function LoginForm()
{
    ?>

<link href="style.css" rel="stylesheet" type="text/css" />
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<table width="291" align="center">
<tr>
<td width="104" height="45">Username : </td>
<td width="175"><input name="uname" type="text" value="<?php if (isset($_POST['uname'])) {echo $_POST['uname'];}?>" /></td>
</tr>

<tr>
<td height="45">Password : </td>
<td><input name="password" type="password" /></td>
</tr>

<tr>
<td></td>
<td height="45" colspan="2"><input type="submit" value="Login" class="readbutton"/></td>
</tr>

</table>
</form>

    <?php
}

?>

<br />


<div id="" style="display:block;">
<table border="0">
<!--<tr><td>
Select Alert Type : </td>
<td width="221" colspan="2">
<select name="alerttype" id="alerttype" onchange="PCB();;" style="width:200px">


<option value="AMC">AMC</option>
<option value="PCB">Per Call Basis</option>


</select>

</td></tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td ><input type="text" name="appby" id="appby" /></td>
<td valign="top">Reason:<textarea name="how" id="how" /></textarea></td>
</tr></div>-->



<?php
include_once 'class_files/select.php';
$sel_obj = new select();
$atm = $sel_obj->select_rows('localhost', 'satyavan_acc', 'Myaccounts123*', 'satyavan_accounts', array("tracker_id"), "atm", "", "", array(""), "y", "tracker_id", "a");
include 'config.php';
?>
<tr><td width="325">
<?php
function ServiceForm()
{
    ?>
	<form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="form" >

<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<table>
<tr>
<td width="142" height="35">Select Assets : </td>
<td width="171"><select id="assets" name="assets">
<option value="0">Select Assets</option>
<?php $qry = mysqli_query($con1, "select * from assets");
    while ($assets = mysqli_fetch_row($qry)) {
        ?>
<option value="<?php echo $assets[0]; ?>"><?php echo $assets[1]; ?></option>
<?php }?>
</select></td>

</tr>

<tr>
<td height="35">Specification: </td>
<td><input type="text" name="spec" id="spec" value="<?php if (isset($_POST['spec'])) {echo $_POST['spec'];}?>"/></td>
</tr>

<tr>
<td height="35">Company Name  : </td>
<td><input type="text" name="cmp" id="cmp" value="<?php if (isset($_POST['cmp'])) {echo $_POST['cmp'];}?>"/></td>
</tr>
<div id="pcbdiv" style="display:none"></div>
<tr>
<td height="35" colspan="2"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</td><td width="260" valign="top">


<table width="100%">
<tr>
<td>
<div>
				<button href="#collapse1" class="nav-toggle">Add New Assets</button>
			</div>
			<div id="collapse1" style="display:none">
				<p><form action="process_assets.php" method="post">
   Assets Name: <input type="text" id="ass_name" name="ass_name"/> <input type="submit" id="submit" name="submit"/>
   </form></p>
			</div>


</td></tr>

</table>

</td></tr></table>
</div>

<?php
}
?>