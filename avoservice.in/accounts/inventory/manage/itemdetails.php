<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ITEM DETAILS</title>
<script language="javascript" >
function checkMrp() {

    var gw=document.listForm.gw.value;
	var gr=document.listForm.grate.value;
	var dw=document.listForm.dw.value;
	var dr=document.listForm.drate.value;
	var mk=document.listForm.mkr.value;
        var sum = 0;
	var arr = gw*gr+gw*mk+dw*dr;
     
    //var tot=0;
	///alert(arr.length);       
        document.listForm.mrp.value = arr;
    }
</script>
</head>

<body bgcolor="#CCFF33">
<center><h1>ITEM DETAILS</h1><br /><br />
<?php
include("config.php");
$qry=mysql_query("select * from 1_item_codes");
$qrysupp=mysql_query("select * from 1_suppliers");
$sql=mysql_query("select * from current_rates");
$rates=mysql_fetch_row($sql);
?>
Gold : <?php echo $rates[0]; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Diamond : <?php echo $rates[1]; ?>
<form action="process_itemdet.php" method="post" name="listForm">
<input type="hidden" name="grate" value="<?php echo $rates[0]; ?>" />
<input type="hidden" name="drate" value="<?php echo $rates[1]; ?>" />
<table><TR><TD>SELECT ITEM : </TD><TD><select name="item"><option value="-1">select item</option>
                                      <?php while($row=mysql_fetch_row($qry)){
										  ?>
                                          <option value="<?php echo $row[2]; ?>"><?php echo $row[2].'-'.$row[3]; ?></option>
									 <?php }?>
                                      </select></TD></TR>
               <TR><TD>SELECT PARTY : </TD><TD><select name="party"><option value="-1">select party</option>
                                      <?php while($row=mysql_fetch_row($qrysupp)){
										  ?>
                                          <option value="<?php echo $row[2]; ?>"><?php echo $row[1].'-'.$row[2]; ?></option>
									 <?php }?>
                                      </select></TD></TR>                       
               <TR><TD>PURITY : </TD><TD><input type="text" name="purity" /></TD></TR>
               <TR><TD>GOLD WEIGHT : </TD><TD><input type="text" name="gw" onkeyup="checkMrp()"/></TD></TR>
               <TR><TD>NET WEIGHT : </TD><TD><input type="text" name="nw" /></TD></TR>
               <TR><TD>DIAMOND WT : </TD><TD><input type="text" name="dw" onkeyup="checkMrp()"/></TD></TR>
               <TR><TD>DIAMOND WT2 : </TD><TD><input type="text" name="dw2" /></TD></TR>
               <TR><TD>C/S WEIGHT : </TD><TD><input type="text" name="csw" /></TD></TR>
               <TR><TD>MAKING : </TD><TD><input type="text" name="mkr" onkeyup="checkMrp()" /></TD></TR>
               <TR><TD>ITEM TYPE : </TD><TD><select name="itype" >
                                               <option value="RNL" >LADIES RING</option>
                                               <option value="RNG" >GENTS RING</option>
                                               <option value="PN" >PENDANT</option>
                                               <option value="PS" >PENDANT SET</option>
                                               <option value="NK" >NECKLACE</option>
                                               <option value="BN" >BANGLES</option>
                                               <option value="BR" >BRACELET</option>
                                               <option value="CH" >CHAIN</option>
                                               <option value="MS" >MANGALSUTRA</option>
                                               <option value="TM" >TANMANIYA</option>
                                               <option value="NS" >NAECKLACE SET</option>
                                               <option value="NP" >NOSE PIN</option>
                                               <option value="ER" >EARRING</option>
                                               <option value="DRNL" >DLADIES RING</option>
                                               <option value="DRNG" >DGENTS RING</option>
                                               <option value="DPN" >DPENDANT</option>
                                               <option value="DPS" >DPENDANT SET</option>
                                               <option value="DNK" >DNECKLACE</option>
                                               <option value="DBN" >DBANGLES</option>
                                               <option value="DBR" >DBRACELET</option>
                                               <option value="DCH" >DCHAIN</option>
                                               <option value="DMS" >DMANGALSUTRA</option>
                                               <option value="DTM" >DTANMANIYA</option>
                                               <option value="DNS" >DNAECKLACE SET</option>
                                               <option value="DNP" >DNOSE PIN</option>
                                               <option value="DER" >DEARRING</option>
                                               </select></TD></TR>
               <TR><TD>PRODUCT TYPE : </TD><TD><select name="ptype" >
                                               <option value="g" >GOLD</option>
                                               <option value="d" >DIAMOND</option>
                                               </select></TD></TR>                  
               <TR><TD>MRP : </TD><TD><input type="text" name="mrp" /></TD></TR>
               <TR><TD colspan="2" align="center"><input type="submit" name="done" value="submit" /></TD></TR>
        </table>
        </form>
</center>
</body>
</html>