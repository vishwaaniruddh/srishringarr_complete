<?php
/**********************************************************************
    Copyright (C) FrontAccounting, LLC.
	Released under the terms of the GNU General Public License, GPL,
	as published by the Free Software Foundation, either version 3
	of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the License here <http://www.gnu.org/licenses/gpl-3.0.html>.
***********************************************************************/
$path_to_root="..";
$page_security = 'SA_OPEN';
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/data_checks.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/reporting/includes/reports_classes.inc");

global $db, $transaction_level, $db_connections;

$con = mysql_connect("localhost","satyavan_acc","Myaccounts123*");
              mysql_select_db("satyavan_accounts",$con);
           $sid=$db_connections[$_SESSION["wa_current_user"]->company]['tbpref'];
$cid=substr($sid,0,-1);



$js = "";
if ($use_date_picker)
	$js .= get_js_date_picker();

add_js_file('reports.js');

page(_($help_context = "Print Invoices Reports"), false, false, "", $js);

$reports = new BoxReports;

$dim = get_company_pref('use_dimension'); ?>

<form action="mahamaya.php" method="post">
<table border="0">
<tr><td width="72">From :</td><td width="116"><select name="from" id="from">
<?php $sql="SELECT * FROM  `".$cid."_debtor_trans` WHERE TYPE =10 order by trans_no ASC";

$result=mysql_query($sql);
while($row=mysql_fetch_row($result)){

$sql1=mysql_query("SELECT * FROM  `".$cid."_debtors_master` where debtor_no='$row[3]' ");
$row1=mysql_fetch_row($sql1);
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[7]." ".$row1[1]; ?></option>
<?php } ?>
</select>
</td></tr>
<td height="53">To : </td><td><select name="to" id="to">
<?php $sql2="SELECT * FROM  `".$cid."_debtor_trans` WHERE TYPE =10 order by trans_no ASC";

$result2=mysql_query($sql2);
while($row2=mysql_fetch_row($result2)){

$sql3=mysql_query("SELECT * FROM  `".$cid."_debtors_master` where debtor_no='$row2[3]' ");
$row3=mysql_fetch_row($sql3);
?>
<option value="<?php echo $row2[0]; ?>"><?php echo $row2[7]." ".$row3[1]; ?></option>
<?php } ?>
</select>
</td></tr>
<tr><td colspan="2" ><input type="submit" value="Print Invoices" /></td></tr></table>
</form>
<?php
end_page();
?>