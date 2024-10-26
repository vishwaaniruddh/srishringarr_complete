<?php
$cid=$_GET['cid'];
?>
<form id="overlay_form" action="procfeedback.php" method="post">
	<input type="hidden" name="cid" value="<?php echo $cid; ?>">
	<label>Feedback: <textarea name="feed" /></textarea></label>
	<br><input type="submit" value="Update"  name="updfeed"/>
	<input type="button" value="Cancel"  name="cancel" onClick="hidediv('<?php echo $cid; ?>');"/>
</form>