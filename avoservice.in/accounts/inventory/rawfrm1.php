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
 ?>

<script type="text/javascript">
function total()
{
//alert("hi");
if(document.getElementById('meters').value!='')
{
var cnt=document.getElementById('count').value;
var i;
var tot=0;
for(i=0;i<cnt;i++)
{
//alert(i);

if(document.getElementById('ratio'+i).value=='')
$rat=0;
else
rat=Number(document.getElementById('ratio'+i).value);

tot=tot+rat;
}
document.getElementById('totratio').value=Math.round(tot);
}
else
{
alert("Quantity field is empty");
document.getElementById('meters').focus();
var cnt=document.getElementById('count').value;
var i;
var tot=0;
for(i=0;i<cnt;i++)
{
//alert(i);
document.getElementById('ratio'+i).value=0;
}
document.getElementById('totratio').value=0;
}
}

function calratio(id,piece)
{
//alert("hii"+id+" "+piece);
var meters=Number(document.getElementById('meters').value);
var tot=Number(document.getElementById('totratio').value);
var val=Number(document.getElementById(id).value);
//alert(meters+" "+tot+" "+val);
var aver=0;
aver=(val/100.00)*meters;
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
<center><form action="processrawfrm1.php" method="post">
<table border='1' style="width:900px">
<tr>
<th colspan="13"  align="center"><h2>Raw Material</h2><a href="viewcuttingfrm.php">View Cutting Quantity</a> </th></tr><tr>
<th rowspan="1" align="center">Quantity in meters :</th>
<td colspan="13"><input type="text" name="meters" id="meters"></td></tr>
<th rowspan="1" align="center">Average Quantity Required :</th>
<td colspan="13"><input type="text" name="avgquan" id="avgquan"></td></tr>
<tr><td>Select Category:</td><td colspan="13">
<?php //echo "select * from ".$cid."_stock_category"; ?>
<select name="category" id="category"><option value="">-Select-</option><?php 

$qry=mysql_query("select * from ".$cid."_stock_category");
while($row=mysql_fetch_array($qry))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php
}
  ?></select></td></tr>
<th rowspan="1" align="center">Credentials :</th><?php
$cnt=0;
$i=28;
 while($i<=50)
{
?>
<th width="20px"><input type="hidden" name="cred[]" id="cred" width="20px" value="<?php echo $i; ?>"><?php echo $i; ?></th>
<?php
$i=$i+2;
$cnt=$cnt+1;
}
 ?></tr>
 <tr><td rowspan="<?php //echo $cnt; ?>">Cutting Ratio :</td><?php 
 for($i=0;$i<$cnt;$i++)
 {
 ?>
 <td><input type="text" name="ratio[]" id="ratio<?php echo $i; ?>" value="0" onKeyUp="total();" onBlur="calratio(this.id,'piece<?php echo $i; ?>')" width="20px"></td>
 <?php
 }
  ?><td><input type="text" readonly name="totratio" id="totratio" value="0"></td></tr>
  <tr><td rowspan="<?php //echo $cnt; ?>">Estimated Pieces :</td><?php 
 for($i=0;$i<$cnt;$i++)
 {
 ?>
 <td><input type="text" readonly name="piece[<?php $i ?>]" id="piece<?php echo $i; ?>" width="20px"></td>
 <?php
 }
  ?><td><input type="text" name="totpiece" id="totpiece<?php echo $i; ?>" width="20px" value="0"></td></tr>
  <tr><th colspan="14"><input type="hidden" name="count" id="count" value="<?php echo $cnt; ?>"><input type="submit" name="submit" value="Submit"></th></tr>
</table>
</form>
