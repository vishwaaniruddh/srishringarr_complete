<?php
include_once('sql/include/DB.php');
	include('Home/header.php');
	$accno=$_GET['acno'];
	$qry=mysql_query("select * from primarymember where acno='".$accno."'");
$row=mysql_fetch_row($qry);
	$i=0;
	$ser="select * from service";
	?>
  <!--<script src="js/libs/1.11.1/jquery.min.js"></script>-->
<td class='logoutBarRight'><img id='ajaxmark' src='../Image/ajax-loader.gif' align='center' style='visibility:hidden;'></td>  <td class='logoutBarRight'>&nbsp;&nbsp;
  <a class='shortcut' href='../../admin/change_current_user_password.php?selected_id=admin'>Change password</a>&nbsp;&nbsp;&nbsp;
<img src='../Image/login.gif' width='14' height='14' border='0' alt='Logout'>&nbsp;&nbsp;<a class='shortcut' href='logout.php'>Logout</a>&nbsp;&nbsp;&nbsp;</td></tr><tr><td colspan=3></td></tr></table></td></tr></table><center><table id='title'><tr>
      <td width='100%' class='titletext'>Member Details</td><td align=right></td></tr></table></center><div id='msgbox'></div><div id='_page_body'>
      


<form name="ajaxform" id="ajaxform" method="post" action="procfacility.php">
<table border="0" cellpadding="0" cellspacing="0">
<tr><td>Member <?php echo $i=$i+1; ?> :</td><td colspan="3"><?php echo $row[1]." ".$row[2]." ".$row[3]; ?></td></tr>
<tr><td>Service:</td><td><select name="service[]" id="service[]"><option value="">Select service</option><?php $service=mysql_query($ser);
while($servro=mysql_fetch_array($service))
{
?>
<option value="<?php echo $servro[1]; ?>"><?php echo $servro[1]; ?></option>
<?php
}
 ?></select></td>
 <td>Amount</td>
 <td><input type="text" name="amt[]" id="amt[]" />
 <input type="hidden" name="dur[]" id="dur[]" value="0" />
 <input type="hidden" name="type[]" id="type[]" value="primary" />
 <input type="hidden" name="id[]" id="id[]" value="<?php echo $row[0]; ?>" />
 </td>
 </tr>
 
 <?php
 $ass=mysql_query("select * from assmem where pmid='".$row[0]."' and status=0");
while($assro=mysql_fetch_array($ass))
{
?>
<tr><td colspan="4"><br /></td></tr>
<tr><td>Member <?php echo $i=$i+1; ?> :</td><td colspan="3"><?php echo $assro[2]." ".$assro[3]." ".$assro[4]; ?></td></tr>
<tr><td>Service:</td><td><select name="service[]" id="service[]"><option value="">Select service</option><?php $service=mysql_query($ser);
while($servro=mysql_fetch_array($service))
{
?>
<option value="<?php echo $servro[1]; ?>"><?php echo $servro[1]; ?></option>
<?php
}
 ?></select></td>
 <td>Amount</td>
 <td><input type="text" name="amt[]" id="amt[]" />
 <input type="hidden" name="dur[]" id="dur[]" value="0"/><input type="hidden" name="type[]" id="type[]" value="assc" />
 <input type="hidden" name="id[]" id="id[]" value="<?php echo $assro[0]; ?>" />
 </td>
 </tr>
<?php
}
 ?>
 <tr><td colspan="4" align="center"><input type="hidden" name="acno" id="acno" value="<?php echo $acno; ?>">
      <input type="button"  id="simple-post" value="Submit" /></td></tr>
</table>
</form><div id="frmpart">
</div>
   
        
     
</div>

<script>
$(document).ready(function()
{

	
$("#simple-post").click(function()
{
	$("#ajaxform").submit(function(e)
	{
		$("#msgbox").html("<center><img src='loader.gif'/></center>");
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(data, textStatus, jqXHR) 
			{
				$("#msgbox").html('<pre><code class="prettyprint">'+data+'</code></pre>');

			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
				$("#msgbox").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
			}
		});
	    e.preventDefault();	//STOP default action
	    e.unbind();
	});
		
	$("#ajaxform").submit(); //SUBMIT FORM
});

});
</script>

	<?php
	include('Home/footer.php');
	?>
	