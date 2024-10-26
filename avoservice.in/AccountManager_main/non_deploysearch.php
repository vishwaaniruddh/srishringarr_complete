<?php
session_start();
include("config.php");
$what=$_GET['what'];
$val=$_GET['val'];
$type=$_GET['calltype'];
$atmid='';
$qry2='';
$br2='';
$br=$_SESSION['branch'];

/*if($_SESSION['branch']!='all'){
	$br1=str_replace(",","','",$br);
	$br1="'".$br1."'";
	
	$src=mysql_query("select state from state where state_id in (".$br1.")");
	while($srcrow=mysql_fetch_array($src))
	{
		$bran[]=$srcrow[0];
	}
	$br3=implode(",",$bran);
	$br2=str_replace(",","','",$br3);
	$br2="'".$br2."'";
}*/
//echo $what;
if($what=='atmid')
{
	//echo "Select bankname,address,amcid from Amc where atmid LIKE '%".$val."%'";;
	$atmid="Select bankname,address,amcid,atmid,cid,branch from Amc where active='Y' and atmid LIKE '%".trim($val)."%'";
	$qry2="Select bank_name,address,track_id,atm_id,cust_id,branch_id from atm where  active='Y' and atm_id LIKE '%".trim($val)."%'";
}
//=============================SELECTING D
elseif($what=='add')
{
	//echo "Select bankname,address,amcid,atmid,cid,state,state1 from Amc where  active='Y' and address LIKE '%".$val."%'";
	//echo "<br>";
	$atmid="Select bankname,address,amcid,atmid,cid,branch,state1 from Amc where  active='Y' and address LIKE '%".$val."%'";
	$qry2="Select bank_name,address,track_id,atm_id,cust_id,branch_id,state1 from atm where  active='Y' and address LIKE '%".$val."%'";
	//echo "Select bank_name,address,track_id,atm_id,cust_id,state,state1 from atm where  active='Y' and address LIKE '%".$val."%'";
}
if($_SESSION['branch']!='all' && $_SESSION['branch']!='' && $_SESSION['branch']!='0')
{
$atmid.=" and state in($br)";
$qry2.=" and state in($br)";
}
//echo $_SESSION['branch'];
///echo $atmid." ".$qry2;
$qry=mysql_query($atmid);
//==================================================
if(mysql_num_rows($qry)==0)
echo "No result found<br>";
else
while($row=mysql_fetch_array($qry))
{
	?>
<a href="non_deployment.php?id=<?php echo $row[2]; ?>&type=amc&atm=<?php echo $row[3];  ?>&cid=<?php echo $row[4]; ?>"><?php echo $row[0]."-".$row[3]."(Amc Site) ".$row[5];  ?></a></br>
<?php	echo $row[1];  ?><br><br>
    <?php
}
//echo $qry2;
$qr=mysql_query($qry2);
//=====================================================
if(mysql_num_rows($qr)>0)
while($row2=mysql_fetch_array($qr))
{
	?>
<a href="non_deployment.php?id=<?php echo $row2[2];  ?>&type=site&atm=<?php echo $row2[3];  ?>&cid=<?php echo $row2[4]; ?>"><?php echo $row2[0]."-".$row2[3]."(New Site) ".$row2[5];  ?></a></br>
<?php	echo $row2[1];  ?><br><br>
    <?php
}
?>