<?php
$path_to_root="..";
$page_security = 'SA_OPEN';
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/data_checks.inc");
include_once($path_to_root . "/includes/ui.inc");
global $db, $transaction_level, $db_connections;

/*$con = mysql_connect("localhost","satyavan_accounts","Ritesh123*");
              mysql_select_db("satyavan_accounts",$con);*/
           $sid=$db_connections[$_SESSION["wa_current_user"]->company]['tbpref'];
$cid=substr($sid,0,-1);
 //echo $cid;
 $id=$_GET['cutid'];
 //echo "select * from rawmaterial where rawid='".$id."' and prefix='".$cid."'";
 $rawquery=mysql_query("select * from cutmaterial where cutid='".$id."' and prefix='".$cid."'");
 $rawro=mysql_fetch_row($rawquery);
 ?>
 
 <script type="text/javascript">
function total()
{
//alert("hi");

var cnt=document.getElementById('count').value;
var i;
var tot=0;
for(i=0;i<cnt;i++)
{
//alert(i);

if(document.getElementById('piece'+i).value=='')
$rat=0;
else
rat=Number(document.getElementById('piece'+i).value);

tot=tot+rat;
}
document.getElementById('totpiece').value=Math.round(tot);


}

function caldiff(est,id,piece)
{
//alert("hi");
//alert(est+" "+id+" "+piece);
var est=Number(document.getElementById(est).value);

var val=Number(document.getElementById(id).value);
//alert(meters+" "+tot+" "+val);
var aver=0;
aver=(est-val);
document.getElementById(piece).value=Math.round(aver);


}

/*function validate()
{
with form()
{
if(document.getElementById('category').value=='')
alert("Please Select Category");
document.getElementById('category').focus();
return false;
}
return true;
}*/
</script>
<form action="receivewashing.php" method="post">
<input type="hidden" name="cutid" id="cutid" value="<?php echo $id; ?>">
<table width="781" height="381" border="1">
<tr>
		<th  align="center" colspan="3"><h2>Receive Material</h2><a href="viewcuttingfrm.php">View Cutting Quantity</a> </th>
    </tr>
    <!--<tr>
		<th align="center">Quantity in meters :</th>
		<td colspan="3"><input type="text" name="meters" id="meters" value="<?php echo $rawro[2]; ?>"></td>
    </tr>-->
	<tr>
    	<td>Select Category:</td>
        <td colspan="3">
        	<select name="category" id="category">
            	<option value="">-Select-</option><?php 

						$qry=mysql_query("select * from ".$cid."_stock_category");
						while($row=mysql_fetch_array($qry))
						{
?>
				<option value="<?php echo $row[0]; ?>" <?php if($row[0]==$rawro[3]){ ?> selected="selected"<?php  } ?>><?php echo $row[1]; ?></option>
<?php
						}
  ?>
  			</select>
         </td>
      </tr>
      <tr>
      	<td>
      		<table border="1">
            	<tr>
                	<th>Credentials </th><th>Estimated</th><th>Received</th>
                </tr>
                <tr>
                	<td>
                   		 <table border="1" width="100%" height="100%">
                         <?php
                   			 $cnt=0;
							$i=28;
 								while($i<=50)
										{
						?>
							<tr height="20px"><th width="20px"><input type="text" name="cred[]" id="cred" width="20px" readonly value="<?php echo $i; ?>"><?php //echo $i; ?></th></tr>
						<?php
							$i=$i+2;
							$cnt=$cnt+1;
										}
						?><tr height="20px"><td>&nbsp;</td></tr>
                   		 </table>
                    </td>
                    <td>
                    	 <table border="1">
                    
                    <?php 
							 for($i=0;$i<$cnt;$i++)
 										{
 					?>
 						 <tr height="20px"><td><input type="text" name="ratio[]" readonly id="ratio<?php echo $i; ?>" value="<?php echo $rawro[$i+4]; ?>" onBlur="calratio(this.id,'piece<?php echo $i; ?>')" width="20px"></td></tr>
 					<?php
 										}
 					 ?>
                     	<tr height="20px"><td>&nbsp;</td></tr> </table>
                    
                    </td>
                    <td>
                    <table border="1">
                    	<?php 
 								for($i=0;$i<$cnt;$i++)
 									{
						 ?>
 							<tr height="20px"><td><input type="text" name="piece[<?php $i ?>]" id="piece<?php echo $i; ?>" onKeyUp="total();" value="0" onBlur="caldiff('ratio<?php echo $i; ?>',this.id,'diff<?php echo $i; ?>')" width="20px"></td></tr>
 						<?php
 									}
 						 ?>
                     <tr height="20px"><td><input type="text" readonly name="totpiece" id="totpiece"></td></tr></table>
                    </td>
                </tr>
      		</table>
        </td>
         <td>
                    <table border="1">
                    	<?php 
 								for($i=0;$i<$cnt;$i++)
 									{
						 ?>
 							<tr height="20px"><td><input type="text" readonly name="diff[<?php $i ?>]" id="diff<?php echo $i; ?>" value="0" width="20px"></td></tr>
 						<?php
 									}
 						 ?>
                     <tr height="20px"><td><input type="text" readonly name="totpiece" id="totpiece"></td></tr></table>
                    </td>
                </tr>
      		</table>
        </td>
	  </tr>
  <tr><th colspan="3"><input type="hidden" name="count" id="count" value="<?php echo $cnt; ?>"><input type="submit" name="submit" value="Submit"></th></tr>
  </table>
  </form>