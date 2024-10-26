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

$dim = get_company_pref('use_dimension'); 

///display in word's

$nwords = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety" ); 
function int_to_words($x)
       {
           global $nwords;
           if(!is_numeric($x))
           {
               $w = '#';
           }else if(fmod($x, 1) != 0)
           {
               $w = '#'; 
           }else{
               if($x < 0)
               {
                   $w = 'minus ';
                   $x = -$x;
               }else{
                   $w = '';
               } 
               if($x < 21)
               {
                   $w .= $nwords[$x];
               }else if($x < 100)
               {
                   $w .= $nwords[10 * floor($x/10)];
                   $r = fmod($x, 10); 
                   if($r > 0)
                   {
                       $w .= '-'. $nwords[$r];
                   }
               } else if($x < 1000)
               {
                   $w .= $nwords[floor($x/100)] .' Hundred'; 
                   $r = fmod($x, 100);
                   if($r > 0)
                   {
                       $w .= ' and '. int_to_words($r);
                   }
               } else if($x < 100000) 
               {
                   $w .= int_to_words(floor($x/1000)) .' Thousand';
                   $r = fmod($x, 1000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $w .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               } else if($x < 10000000){
                   $w .= int_to_words(floor($x/100000)) .' Lakh';
                   $r = fmod($x, 100000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }else {
                   $w .= int_to_words(floor($x/10000000)) .' Crore';
                   $r = fmod($x, 10000000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }
           }
           return $w;
       }
$fom=$_POST['from'];
$to=$_POST['to'];

////////display name

$result5=mysql_query("select * from ".$sid."sys_prefs");

$row5 = mysql_fetch_array($result5);

mysql_data_seek($result5,5);
$row6=mysql_fetch_array($result5);

mysql_data_seek($result5,10);
$row7=mysql_fetch_array($result5);

mysql_data_seek($result5,6);
$row8=mysql_fetch_array($result5);

mysql_data_seek($result5,7);
$row9=mysql_fetch_array($result5);
mysql_data_seek($result5,8);
$row10=mysql_fetch_array($result5);

$tab = $sid."_item_codes";
$tab1=$sid."_prices";
$tab2=$sid."_debtors_master";
$tab3=$sid."debtor_trans";
$tab4=$sid."_debtor_trans_details";

?>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           var popupWin = window.open('', '_blank', 'width=900,height=700');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }   
     </script>
  <center>   <a href="#" onclick='PrintDiv();'>Print Invoices</a></center>
<div id="bill" >

<center>
<?php 

$result=mysql_query("SELECT * FROM  `".$cid."_debtor_trans` WHERE TYPE =10 AND  `trans_no` BETWEEN '$from' AND '$to' ");

while($row = mysql_fetch_array($result)){

 if(isset($row[5]) and $row[5]!='0000-00-00') $dt= date('d/m/Y',strtotime($row[5])); 

$nm=mysql_query("SELECT * FROM  `1_debtors_master` where debtor_no='$row[3]'");
$nm1=mysql_fetch_row($nm);
	?>
<table border="0" cellpadding="4" cellspacing="0"><tr><td width="832">
	<table width="100%">
    <tr>
    <td align="center">
    <img src="bill.png" width="408" height="165"/></td></tr>
		<!--<tr>
			<td width="842"><u><b>
		  <center><font size="+1">Shree Ganeshaya Namah</font></center></b></u> <u><b><center>INVOICE</center></b></u></td>
	  	</tr>
		<tr>
			<td height="21"><b>
		  <br><center><font size="+3"><?php //echo $row5[4]; ?></font></center></b></td>
		</tr>
		<tr>
			<td><center>
			<?php //echo $row6[4]; ?>
			</center> <center>State: <?php //echo $row7[4]; ?></center> <center><font size="-1">Phone:<?php //echo $row8[4]; ?>&nbsp<font size="-1">Telefax:<?php //echo $row9[4]; ?></font></center> <center>Email: <font color="#0033FF"><?php //echo $row10[4]; ?>&nbsp;&nbsp;</font>   Web Site: <font color="#0033FF"><u>www.mahamayaminerals.com</u></font></center></td>
		</tr>-->
		<tr><td>
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td width="565" style="border-right:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Invoice No. <?php echo $row[7]; ?></b></font></td>
					<td width="157" style="border-left:none;"><font size="-1"><b>DATE :<?php echo $dt; ?></b></font></td>
				</tr>
			</table>
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td width="297" style="border-bottom:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;M/S,<?php echo $nm1[1]; ?><br/>
                    <table><tr><td style="padding-left:5px;"><?php echo $nm1[3]; ?></td></tr></table></b></font></td>
				    <td width="452" style="border-bottom:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;ECC No.</b></font></td>
				</tr>
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td style="border-bottom:none; border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Commission Rate:</b></font></td>
				</tr>
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td style="border-bottom:none; border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Division:</b></font></td>
				</tr>
				<tr>
					<td height="23" style="border-bottom:none; border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Kind Attn.</b></font></td>
					<td  width="452" style="border-bottom:none; border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Range:</b></font></td>
				</tr>
				<tr>
					<td height="22" style="border-bottom:none; border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Tin No.:<?php echo $nm1[4]; ?></b></font></td>
					<td style="border-bottom:none; border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;CGCT No.:</b></font></td>
				</tr>
				<tr>
					<td height="21" style="border-bottom:none; border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Offer No.(PO)</b></font></td>
					<td style="border-bottom:none; border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;CST No.:</b></font></td>
				</tr>
				<tr>
					<td style="border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Date</b></font></td>
					<td style="border-top:none;"><font size="-1"><b>&nbsp;&nbsp;&nbsp;TIN No.:22603304539</b></font></td>
				</tr>
			</table>
			<table width="100%" border="1" cellpadding="4" cellspacing="0">
				<tr>
					<td width="60"><b>
				    <center>Sr. No.</center></b></td>
					<td width="314"><b>Item Description/Indent No.</b></td>
					<td width="105"><b>
				    <center>Quantity</center></b></td>
					<td width="67"><b>
				    <center>Rate</center></b></td>
					<td width="161"><b>
				    <center>Value</center></b></td>
				</tr>
				<?php 
				$sum=0;
				$i=1;
				$qt=mysql_query("SELECT * FROM  `".$cid."_debtor_trans_details` where debtor_trans_no='$row[0]' and debtor_trans_type=10");
				while($qt1=mysql_fetch_row($qt)){
				?>
				<tr>
					<td height=""><b><?php echo $i++; ?></b></td>
					<td valign="bottom"><b><font size="-1"><?php echo $qt1[4]; ?></font></b></td>
					<td><b><?php echo $qt1[7]; ?></b></td>
					<td><b><?php echo $qt1[5]; ?></b></td>
					<td><b><?php echo $qt1[7]*$qt1[5]; ?></b></td>
				</tr>
				<?php $sum+=$qt1[7]*$qt1[5]; } ?>
				<tr>
					<td>&nbsp;</td>
					<td><font size="-1"><b>Notification No.</b></font></td>
					<td colspan="2"><font size="-1"><b>Total Rs.</b></font></td>
					<td><b>Rs. <?php echo $sum; ?></b></td>
				</tr>
				
				<tr>
					<td style="border-bottom:none;">&nbsp;</td>
					<td rowspan="2"><font size="-1"><b>Ex Duty Payable Exempted</b></font></td>
					<td colspan="2"><font size="-1"><b>C. EX DUTY @</b></font></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;</td>
					<td colspan="2"><font size="-1"><b>CESS DUTY</b></font></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;</td>
					<td><font size="-1"><b>DATE AND TIME OF ISSUE</b></font></td>
					<td colspan="2"><font size="-1"><b>CGCT/VAT @</b></font></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;</td>
					<td><font size="-1"><b>DATE AND TIME OF REMOVAL</b></font></td>
					<td colspan="2"><font size="-1"><b>CST @</b></font></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;</td>
					<td><font size="-1"><b>MODE OF TRANSPORT</b></font></td>
					<td colspan="2">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;</td>
					<td style="border-bottom:none;"><font size="-1"><b>RUPEES (IN WORDS):<br/>
                    <?php $st=int_to_words($sum); echo $st." Only"; ?></b></font>
                    </td>
					<td colspan="2"><font size="-1"><b>FREIGHT</b></font></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;</td>
					<td style="border-top:none; border-bottom:none;">&nbsp;</td>
					<td colspan="2"><font size="-1"><b>SERVICE TAX</b></font></td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<td style="border-top:none;">&nbsp;</td>
					<td style="border-top:none; border-bottom:none;">&nbsp;</td>
					<td colspan="2"><font size="-1"><b>TOTAL AMOUNT Rs.</b></font></td>
					<td><b><?php echo $sum; ?></b></td>
				</tr>
			</table>
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td width="388"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Special Terms & Conditions:-</b></font></td>
					<td width="414"><font size="-1"><b>&nbsp;&nbsp;&nbsp;Other Terms & Conditions:-</b></font></td>
				</tr>
				<tr>
					<td>
					<p>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;1. All disputes are subject to Drug Jurisdiction.</b></font><br/>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;2. Goods once sold will not be taken back.</b></font><br/>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;3. Penalty @ 24% will be charged on all bills remain <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pending after delivery.</b></font><br/>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;4. Our risks and responsibilities ceases goods level our premises</b></font><br/>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;5. Check the goods at your site before unloading, after that we cannot entertain in any case.</b></font></p>
					</td>
					<td>
					<p>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:: Ex-Your works.</b></font><br>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;Taxes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:: as per applicable</b></font><br>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;Exise Duty :: Exempted</b></font><br>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;Transport &nbsp;:: FROM OUR SITE</b></font><br>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;Delivery &nbsp;&nbsp;&nbsp;&nbsp;:: immediate after receipt of purchase order</b></font><br>
					<font size="-1"><b>&nbsp;&nbsp;&nbsp;Payment &nbsp;&nbsp;&nbsp;&nbsp;:: 100% against perform invoice at the time of dispatch</b></font>
					</p>
					</td>
				</tr>
			</table>
			<table width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td width="554" style="border-bottom:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td width="199" style="border-bottom:none;"><font size="-2"><b>For Mahamaya Minerals & Chemicals</b></font></td>
				</tr>
				<tr>
					<td style="border-top:none; border-bottom:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td style="border-top:none; border-bottom:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td style="border-top:none; border-bottom:none;"><font size="-2"><b>Prepared By : </b></font></td>
					<td style="border-top:none; border-bottom:none;"><font size="-2"><b>(Authorized Signatory)</b></font></td>
				</tr>
				<tr>
					<td style="border-top:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td style="border-top:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table>
			</table>
		</td></tr></table><br/><br/>
        
       <?php }?>
        
        </center></div>
<?php
end_page();
?>