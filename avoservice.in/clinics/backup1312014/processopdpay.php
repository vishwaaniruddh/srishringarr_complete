<script type="text/javascript">
function sendmsg(){
 //var oo = document.getElementById("hos").value;
 //alert(oo);
 var opener = null;
 if (window.dialogArguments) // Internet Explorer supports window.dialogArguments
        { 
            opener = window.dialogArguments;
        } 
        else // Firefox, Safari, Google Chrome and Opera supports window.opener
        {        
            if (window.opener) 
            {
                opener = window.opener;
				//return true;
            }
        }       
//		alert(opener);
  opener.refreshdiv("done");
}
</script>

<?php
if(isset($_POST['cmdsub']))
{
include("config.php");
$appid=$_POST['appid'];
$amount=$_POST['amount'];
if($amount>0)
{
	//echo "Insert into opd_collection(`appid`,`amt`) Values('".$appid."','".$amount."')";
$qry=mysql_query("Insert into opd_collection(`appid`,`amt`,`patientid`,`paymode`) Values('".$appid."','".$amount."','".$_POST['pid']."','".$_POST['bank_account']."')");

//echo "update appoint set presstat='5' where app_real_id='".$appid."'";

if(!$qry)
echo "Some Error Occurred. Try Again".mysql_error();
else
{
$qry2=mysql_query("update appoint set presstat='5' where app_real_id='".$appid."'");



$dt=$_POST['Datechq'];





/*$qryb=mysql_query("select account_code,account_type from ".$cid."_bank_accounts where id=".$_POST['bank_account']);
$rowb=mysql_fetch_row($qryb);

$bacc=$rowb[0];

$qry3=mysql_query("select max(trans_no) from ".$cid."_bank_trans where type='12'");
$ro3=mysql_fetch_row($qry3);
if($ro3[0]=='null')
$typeno3=1;
else
$typeno3=$ro3[0]+1;
$qry2=mysql_query("INSERT INTO `".$cid."_bank_trans` (`id`, `type`, `trans_no`, `bank_act`, `ref`, `trans_date`, `amount`, `dimension_id`, `dimension2_id`, `person_type_id`, `person_id`, `reconciled`) VALUES (NULL, '12', '".$typeno3."', '".$_POST['bank_account']."','".date('dmy').time()."', STR_TO_DATE('".$dt."','%d/%m/%Y'), '".$_POST['amount']."', '0', '0', '2', NULL, NULL)");
$banktransid=mysql_insert_id();
add_audit_trail('12',$typeno3, $purdt,$cid."_bank_trans");


$dt=$dt;
	

$qry5=mysql_query("select max(type_no) from `".$cid."_gl_trans` where type='12'");
$ro5=mysql_fetch_row($qry5);
if($ro5[0]=='null')
$typeno5=1;
else
$typeno5=$ro5[0]+1;
$qry4=mysql_query("INSERT INTO `".$cid."_gl_trans` (`counter`, `type`, `type_no`, `tran_date`, `account`, `memo_`, `amount`, `dimension_id`, `dimension2_id`, `person_type_id`, `person_id`) VALUES (NULL, '12', '".$typeno5."',  STR_TO_DATE('".$dt."','%d/%m/%Y'), '2050', '', '-".$_POST['amount']."', '0', '0', '2', NULL)");
//add_audit_trail('12',$typeno5, $purdt,$cid."_gl_trans");

$qry7=mysql_query("INSERT INTO `".$cid."_gl_trans` (`counter`, `type`, `type_no`, `tran_date`, `account`, `memo_`, `amount`, `dimension_id`, `dimension2_id`, `person_type_id`, `person_id`) VALUES (NULL, '12', '".$typeno5."',  STR_TO_DATE('".$dt."','%d/%m/%Y'), '".$bacc."', '', '".$_POST['amount']."', '0', '0', '2',  NULL)");
add_audit_trail('12',$typeno5, $purdt,$cid."_bank_trans");
if($rowb[1]!='3')
$qry6=mysql_query("INSERT INTO bank_details(`id`, `banktransno`, `bankname`, `chequeno`, `chkdt`, `person_type_id`,`person_id`, `status`, `prefix`) VALUES (NULL, '".$banktransid."', '".$_POST['bname']."', '".$_POST['chqno']."', '".$_POST['Datechq']."', '2','".$_POST['pid']."', '0', '".$cid."')");*/



























?>
<h2>Please Do Not Refresh this page. Receipt is being generated</h2>
<form name="myForm" id="myForm" action="receipt.php" method="POST">
    <input type="hidden" name="patientid" value="<?php echo $_POST['pid'];  ?>" />
<input type="hidden" name="date" value="<?php echo $_POST['Datechq'];  ?>" />
<input type="hidden" name="mode" value="<?php echo $_POST['bank_account'];  ?>" />

<input type="hidden" name="amt" value="<?php echo $_POST['amount'];  ?>" />
</form>

<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
        alert('test');
          document.forms["myForm"].submit();
		  //window.close();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 10000);
        }
    }
</script>
<!--<script type="text/javascript">
alert("Amount Paid Successfully");
window.close();
sendmsg();
window.close();
</script>-->
<?php
}
}
else
{
?>
<script type="text/javascript">
alert("Invalid Amount");
window.close();
</script>
<?php
}
}
else
{
?>
<script type="text/javascript">
//alert("Invalid Amount");
window.close();
</script>
<?php
}
?>