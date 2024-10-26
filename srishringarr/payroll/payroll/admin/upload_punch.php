<?
   session_start();
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<form id="form1" name="form1" method="post" action="process_upload_punch.php" enctype="multipart/form-data" >
<table>
	<tr>
		<td>
			<select name="year" required>
				<option value="">Select Year</option>
				<option value="<?php echo date('Y')-1; ?>" ><?php echo date('Y')-1; ?></option>
				<option value="<?php echo date('Y'); ?>" selected><?php echo date('Y'); ?></option>
				<option value="<?php echo date('Y')+1; ?>" ><?php echo date('Y')+1; ?></option>
			</select>
		</td>
		<td>
			<select name="month" required>
				<option value="">Select Month</option>
				<?php
					for($i=1;$i<=12;$i++)
					{
				?>
				<option value="<?php echo $i; ?>" <?php if($i==(date('m')-1)){ echo "selected"; } ?>><?php echo date('F', mktime(0, 0, 0, $i, 10)); ?></option>
				<?php
					}
				?>
			</selcet>
		</td>
		<td>
			Upload File:<input type="file" name="userfile" id="userfile" />
		</td>
	</tr>
	<tr>
		<td><input type="submit" value="Upload"/></td>
	</tr>
</table>
</form>
