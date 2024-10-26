<?php
session_start();

function LoginForm()
{
    ?>

   <link href="../style.css" rel="stylesheet" type="text/css" />
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
<td height="45"><input type="submit" value="Login" class="readbutton"/></td>
</tr>

</table>
</form>

    <?php
}

function newcustomer()
{
    ?>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="custform" id="custform" >
<table>

<tr>
<td height="35">Customer Name : </td>
<td><input type="text" name="cust" id="cust" /></td>
</tr>

<tr>
<td height="35">Phone 1 : </td>
<td><input type="text" name="ph1" id="ph2" /></td>
</tr>

<tr>
<td height="35">Phone 2 : </td>
<td><input type="text" name="ph2" id="ph2" /></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="email" id="email" /></td>
</tr>

<tr>
<td height="35">Contact Person Name : </td>
<td><input type="text" name="conper" id="conper" /></td>
</tr>

<tr>
<td height="35">Contact Person Number : </td>
<td><input type="text" name="percon" id="percon" /></td>
</tr>

<tr>
<td height="35">Address : </td>
<td><textarea name="add" id="add" /></textarea></td>
</tr>

<tr>
<td height="35">City : </td>
<td><input type="text" name="city" id="city" /></td>
</tr>


<tr>
<td height="35">Pin : </td>
<td><input type="text" name="pin" id="pin" /></td>
</tr>

<tr>
<td height="35"><input type="button" value="submit" class="readbutton" name="addnewcust" onclick="validate()"/></td>
</tr>
</table>
</form>
    <?php
}

function ServiceForm($ref, $user, $desig)
{

    include "config.php";
    if ($ref != '' || $ref != null) {
        $re = mysqli_query($conc,"select * from Amc where Ref_id='" . $ref . "' limit 1");
        $refid = mysqli_fetch_row($re);
    }
    $qry2 = mysqli_query($conc,"select srno from login where username='" . $user . "'");
    $qry2ro = mysqli_fetch_row($qry2);

    ?>
	<form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="form" >




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
<tr>
<td height="35" >Subject: <input type="text" name="sub" id="sub"  /></td>
<td colspan="3">Client Docket number:<input type="text" name="docket" id="docket" /></td>
</tr>
<tr><td width="110">
Select Customer : </td>
<td width="190">
<?php
$client = "select cust_id,cust_name from customer where 1";
    if ($desig == '6') {
        //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
        $cust = mysqli_query($conc,"select client from clienthandle where logid='" . $_SESSION['logid'] . "'");
        $cc = array();
        while ($custr = mysqli_fetch_array($cust)) {
            $cc[] = $custr[0];
        }

        $ccl = implode(",", $cc);
        $ccl = str_replace(",", "','", $ccl);
        $ccl = "'" . $ccl . "'";
        $client .= " and cust_name in($ccl)";

    }
    $client .= " order by cust_name ASC";
    //  echo $client;
    ?>
<select name="cust" id="cust" onchange="Po_no();" style="width:150px">
<option value="">select</option>
<?php

    $qry1 = mysqli_query($client);
    while ($row = mysqli_fetch_row($qry1)) {
        ?>
<option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>


<?php }?>
</select>

</td><td>Select PO NO:
<select name="po" onchange="PO(this.value);" id="po_no">
<?php if (isset($_POST['po'])) {
//$asst=    explode("####",$_POST['po']);
        ?>
<option value="<?php echo $_POST['po']; ?>"><?php echo $_POST['po']; ?></option>
<?php }?>
</select>

</td></tr>


<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" />

<?php
include_once 'class_files/select.php';
    $sel_obj = new select();
    $atm = $sel_obj->select_rows('localhost', 'satyavan_acc', 'Myaccounts123*', 'satyavan_accounts', array("tracker_id"), "atm", "", "", array(""), "y", "tracker_id", "a");
    ?>
<tr><td>Atm ID</td><td colspan="3" id="reference">
<select name="ref" id="ref" onchange="">
<?php if (isset($_POST['ref'])) {
        ?>
<option value="<?php echo $_POST['ref']; ?>"><?php echo $_POST['ref']; ?></option>
<?php }?>
</select></td></tr>
<tr>
<td height="35">Assets : </td>
<td id="assets" colspan="3">

</td>
</tr>


<tr>
<td height="35">Bank Name:</td>
<td colspan="3"><input type="text" name="bank" id="bank" value="<?php if (isset($_POST['bank'])) {echo $_POST['bank'];}?>" readonly /></td>
</tr>

<tr>
<td height="35">State Name:</td>
<td colspan="3"><input type="text" name="state" id="state" value="<?php if (isset($_POST['state'])) {echo $_POST['state'];}?>" readonly /></td>
</tr>

<!----================Branch=======----------->
<tr>
<td height="35">Branch:</td>
<td colspan="3">
<?php
include "config.php";
    ?>
<select id="branch" name="branch">

<option value="">Select</option>
<?php
echo "select * from avo_branch";
    $qrystate = mysqli_query($conc,"select * from avo_branch");
    while ($qrystate1 = mysqli_fetch_row($qrystate)) {
        ?>

<option value="<?php echo $qrystate1[0]; ?>" <?php if (($_POST['branch']) == $qrystate1[0]) {?>
selected="selected" <?php }?>><?php echo $qrystate1[1]; ?></option>

<?php }?>

</select>
</td>
</tr>
<tr>
<td height="35">City Name:</td>
<td colspan="3"><input type="text" name="city" id="city" value="<?php if (isset($_POST['city'])) {echo $_POST['city'];}?>" readonly /></td>
</tr>
<tr>
<td height="35">Address:</td>
<td colspan="3"><textarea name="add" id="add"  readonly rows=5 cols=25 /> <?php if (isset($_POST['add'])) {echo $_POST['add'];}?></textarea></td>
</tr>
<tr>
<td height="35">Pin Code:</td>
<td colspan="3"><input type="text" name="pin" id="pin" value="<?php if (isset($_POST['pin'])) {echo $_POST['pin'];}?>" readonly /></td>
</tr>
<tr>
<td height="35">Area Name:</td>
<td colspan="3"><input type="text" name="area" id="area" value="<?php if (isset($_POST['area'])) {echo $_POST['area'];}?>" readonly /></td>
</tr>
<!-- <tr>
<td height="35">Alert Date : </td>
<td><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php if (isset($_POST['adate'])) {echo $_POST['adate'];} else {echo date('d/m/Y');}?>" /></td>
</tr>-->

<tr>
<td height="35">Problem : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"> <?php if (isset($_POST['prob'])) {echo $_POST['prob'];}?></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname" value="<?php if (isset($_POST['cname'])) {echo $_POST['cname'];}?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" value="<?php if (isset($_POST['cphone'])) {echo $_POST['cphone'];}?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="text" name="cemail" id="cemail" value="<?php if (isset($_POST['cemail'])) {echo $_POST['cemail'];}?>"/></td>
</tr>
<tr>
<td height="35">CC Email : </td>
<td colspan="3"><?php

    $cl = mysqli_query($conc,"select client from clienthandle where logid in (select srno from login where username='" . $_SESSION['user'] . "')");
    $clnt = array();
    while ($clntr = mysqli_fetch_array($cl)) {
        $clnt[] = $clntr[0];
    }

    $client = implode(",", $clnt);
    $client = str_replace(",", "','", $client);
    include "config.php";
//echo "select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and c.cust_name in ('$client') order by c.cust_name,e.bank ASC";
    $ccc = mysqli_query($conc,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and c.cust_name in ('$client') order by c.cust_name,e.bank ASC");
//echo mysqli_num_rows($ccc);
    /*while($ccro=mysqli_fetch_row($ccc))
    {
    echo $ccro[0]." ".$ccro[1]." - ".$ccro[2];
    }*/
    $c = array();
    ?>
<input type="checkbox" name="sendmail" id="sendmail" checked>
<select name='cc' id='cc' onchange="fill();">
<option value=""> Select CC Emails</option>
<?php
while ($ccro = mysqli_fetch_row($ccc)) {
        ?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1] . " - " . $ccro[2]; ?></option>
<?php
}
    ?>
</select>
<?php //echo print_r($c); ?>
<textarea name="ccemail" id="ccemail"  rows=5 cols=25><?php if (isset($_POST['ccemail'])) {echo $_POST['ccemail'];}?></textarea></td>
</tr>
<div id="pcbdiv" style="display:none">
<tr><td>Approved By:</td><td colspan="3"><input type="text" name="appby" id="appby" value="<?php if (isset($_POST['appby'])) {echo $_POST['appby'];}?>" /></td></tr><tr>
<td valign="top">Refrence:</td><td colspan="3"><textarea name="how" id="how" /><?php if (isset($_POST['how'])) {echo $_POST['how'];}?></textarea>
<input type="hidden" name="pcbpres" id="pcbpres" value="<?php if (isset($_POST['pcbpres'])) {echo $_POST['pcbpres'];}?>" />
<input type="hidden" name="crby" id="crby" value="<?php echo $qry2ro[0]; ?>" />
</td>

</tr></div>
<tr>
<td height="35" colspan="4"><input type="submit" value="submit" class="readbutton" id="submit" /></td>
</tr>

</table>
</div>
</form>
<?php
}

function RefForm()
{
    ?>

Enter Atm ID : <input type="text" name='re' id="re" value="<?php echo $_POST['re']; ?>">&nbsp;&nbsp;<input type="button" name="refsub" value="Get Detail" onClick="GetRef('re')" >

<?php
}
?>