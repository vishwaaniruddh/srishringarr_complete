<?php
include('config.php');
$sqlme=$_POST['qr'];
$flag=$_POST['flagdata'];
$sqlme=$sqlme;//.' limit 400';
//echo "test".$flag;
$table=mysqli_query($con1,$sqlme);
//echo mysqli_num_rows($table);
//echo $sqlme;
$contents='';
 $contents.="S.N. \t PO No \t PO Date \t Do No\t DO Date\t SO Datetime\t BANK\t ATM Id\t Delivery/Consignee Address\t CITY\t STATE\t PIN CODE\tSales Person\t Customer\t Buyer Name and address \t Buyer GST No. \t Contact Person\t Contact No.\t Created By \t UPS \t Qty \t Rate PER UNIT \t Buy Back rate per unit\t Battery \t Qty \t Rate PER UNIT \t Buy Back rate per unit \t ISO TRANSFORMER \t Qty \t Rate PER UNIT \t Buy Back rate per unit \t STABILISER \t Qty \t Rate PER UNIT \t Buy Back rate per unit \t AVR \t Qty \t Rate PER UNIT \t Buy Back rate per unit\t Others\t Rate PER UNIT\t Buyback Details\t Buyback Amount\t Remarks Update ";
// ED\t Buyback Details\t Buyback Amount\t Remarks Update\t All Remarks\t
 $cnt=0;
 
$table=mysqli_query($con1,$sqlme);

while($row=mysqli_fetch_row($table))
{
$cnt++;

if($flag=="amc"){
	/*$posql=mysqli_query($con1,"select po_no from purchase_order where del_type='site_del' and po_no='".$row[0]."'");
	if(mysqli_num_rows($posql)>0)
	{*/
        $atm=mysqli_query($con1,"select bankname,atmid,cid,area,city,address,state,pincode from Amc where amcid='".$row[0]."'");
      /*  }
        else
        {
        continue;
        }*/
	}
	else{
	
	//echo "select  bank_name,cid,area,city,address,state1 from atm where atm_id='".$row[1]."'";
	//echo "select  bank_name,atm_id,cust_id,area,city,address,state1 from atm where po='".$row[0]."'";
	$atm=mysqli_query($con1,"select  bank_name,atm_id,cust_id,area,city,address,state1,pincode from atm where track_id='".$row[0]."'");
	}
	$atmdet=mysqli_fetch_row($atm);

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$tab=mysqli_query($con1,"select buyeraddress,gst,po_date,salesperson from purchase_order where po_no='".$row[1]."'");	
	$row1=mysqli_fetch_row($tab);
	//echo "eng stat".$row[15];
		
//===============sr no.=======

$contents.="\n".$cnt."\t";

//================po no========
$contents.=$row[1]."\t";

//===========po date=========

$contents.=$row1[2]."\t";


//===========DO Date=========

$contents.=$row[4]."\t";


//===========DO Date=========

$contents.=$row[3]."\t";
//===========DO Date=========

$contents.=$row[14]."\t";



//===========BANK=========


$contents.=$atmdet[0]."\t";

//===========ATM Id=========

$contents.=$atmdet[1]."\t";


//==================Delivery/Consignee Address====


$contents.=str_replace("\n","",preg_replace('/\s+/', '', $atmdet[5]))."\t";

//===========CITY=========

$contents.=$atmdet[4]."\t";

//===========STATE=========

$contents.=$atmdet[6]."\t";

//===========PIN CODE=========

$contents.=$atmdet[7]."\t";


$contents.= $row1[3]."\t";


//===========Customer=========

$contents.=$custrow[0]."\t";

//===========Buyer Name and address=========
$contents.=str_replace("\n","",preg_replace('/\s+/', '', $row1[0]))."\t";
//$contents.=$row1[0]."\t";

//===========Buyer GST No.=========

$contents.=$row1[1]."\t";

//===========Contact Person=========
$contents.=$row[9]."\t";
//===========Contact No.=========

$contents.=$row[10]."\t";

//===========Created By=========

$contents.=$row[13]."\t";

if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback from amcassets where assets_name='UPS' and callid='".$row[8]."'");	
	$row1=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row1[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row1[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate from site_assets where po='".$row[1]."' and assets_name='UPS' and callid='".$row[8]."'");	
	$row1=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row1[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
}
/*$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."' and assets_name='UPS'");	
	$row1=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row1[2]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
	if($flag=='amc'){
	$qrybb=mysqli_query($con1,"select buyback from amcassets where amcpoid='".$row[0]."' and assets_name='UPS'");	
	$rowbb=mysqli_fetch_row($qrybb);
	$bb=$rowbb[0];
	}*/

//===========UPS=========

$contents.=$rowe[0]."\t";

//===========Qty=========

$contents.=$row1[1]."\t";

//===========Rate PER UNIT=========

$contents.=$row1[2]."\t";

//===========Buy Back rate per unit=========

$contents.=$bb."\t";

if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback from amcassets where assets_name='Battery' and callid='".$row[8]."'");	
	$row2=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row2[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row2[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate from site_assets where po='".$row[1]."' and assets_name='Battery' and callid='".$row[8]."'");	
	$row2=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row2[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
}

/*$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."' and assets_name='Battery'");	
	$row2=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row2[2]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
	if($flag=='amc'){
	$qrybb=mysqli_query($con1,"select buyback from amcassets where amcpoid='".$row[0]."' and assets_name='Battery'");	
	$rowbb=mysqli_fetch_row($qrybb);
	$bb=$rowbb[0];
	}*/

//===========Battery=========

$contents.=$rowe[0]."\t";

//===========Qty=========

$contents.=$row2[1]."\t";

//===========Rate PER UNIT=========

$contents.=$row2[2]."\t";

//===========Buy Back rate per unit=========

$contents.=$bb."\t";

if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback from amcassets where assets_name='Isolation Transformer' and callid='".$row[8]."'");	
	$row3=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row3[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row3[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate from site_assets where po='".$row[1]."' and assets_name='Isolation Transformer' and callid='".$row[8]."'");	
	$row3=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row3[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
}
/*
$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."' and assets_name='Isolation Transformer'");	
	$row3=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row3[2]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
	if($flag=='amc'){
	$qrybb=mysqli_query($con1,"select buyback from amcassets where amcpoid='".$row[0]."' and assets_name='Isolation Transformer'");	
	$rowbb=mysqli_fetch_row($qrybb);
	$bb=$rowbb[0];
	}*/


//===========ISO TRANSFORMER=========

$contents.=$rowe[0]."\t";

//===========Qty=========

$contents.=$row3[1]."\t";

//===========Rate PER UNIT=========

$contents.=$row3[2]."\t";

//===========Buy Back rate per unit=========

$contents.=$bb."\t";

if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback from amcassets where assets_name='Stabilizer' and callid='".$row[8]."'");	
	$row4=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row4[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row4[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate from site_assets where po='".$row[1]."' and assets_name='Stabilizer' and callid='".$row[8]."'");	
	$row4=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row4[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
}
/*
$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."' and assets_name='Stabilizer'");	
	$row4=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row4[2]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
	if($flag=='amc'){
	$qrybb=mysqli_query($con1,"select buyback from amcassets where amcpoid='".$row[0]."' and assets_name='Stabilizer'");	
	$rowbb=mysqli_fetch_row($qrybb);
	$bb=$rowbb[0];
	}*/



//===========STABILISER=========

$contents.=$rowe[0]."\t";

//===========Qty=========

$contents.=$row4[1]."\t";


//===========Rate PER UNIT=========

$contents.=$row4[2]."\t";


//===========Buy Back rate per unit========

$contents.=$bb."\t";


if($flag=="amc"){
$tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback from amcassets where assets_name='AVR' and callid='".$row[8]."'");	
	$row5=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row5[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=$row5[3];
}
else{
$tab=mysqli_query($con1,"select assets_spec,quantity,rate from site_assets where po='".$row[1]."' and assets_name='AVR' and callid='".$row[8]."'");	
	$row5=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row5[0]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
}
/*
$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."' and assets_name='AVR'");	
	$row5=mysqli_fetch_row($tab);
	$qry=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$row5[2]."'");	
	$rowe=mysqli_fetch_row($qry);
	$bb=0;
	if($flag=='amc'){
	$qrybb=mysqli_query($con1,"select buyback from amcassets where amcpoid='".$row[0]."' and assets_name='AVR'");	
	$rowbb=mysqli_fetch_row($qrybb);
	$bb=$rowbb[0];
	}*/

//===========AVR========

$contents.=$rowe[0]."\t";
//===========Qty========

$contents.=$row5[1]."\t";
//===========Rate PER UNIT========

$contents.=$row5[2]."\t";
//===========Buy Back rate per unit========

$contents.=$bb."\t";


if($flag=="amc"){
$tab=mysqli_query($con1,"select assets_name,rate from amcassets where assets_name<>'UPS' and assets_name<>'Battery' and assets_name<>'Isolation Transformer' and assets_name<>'Stabilizer' and assets_name<>'AVR' and callid='".$row[8]."'");	
	$row6=mysqli_fetch_row($tab);
	
}
else{
$tab=mysqli_query($con1,"select assets_name,rate from site_assets where po='".$row[1]."' and assets_name<>'UPS' and assets_name<>'Battery' and assets_name<>'Isolation Transformer' and assets_name<>'Stabilizer' and assets_name<>'AVR' and callid='".$row[8]."'");	
	$row6=mysqli_fetch_row($tab);
	
}
/*
$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."' and assets_name<>'UPS' and assets_name<>'Battery' and assets_name<>'Isolation Transformer' and assets_name<>'Stabilizer' and assets_name<>'AVR'");	
	$row6=mysqli_fetch_row($tab);*/

//===========Others========

//$contents.=$row6[0]."\t";
$contents.=str_replace("\n","",preg_replace('/\s+/', '', $row6[0]))."\t";
//===========Rate PER UNIT========

$contents.=$row6[1]."\t";

$contents.=$row[11]."\t";

$contents.=$row[12]."\t";

 $qry_soupdt=mysqli_query($con1,"select Remarks_update from SO_Update where so_id='".$row[8]."' order by updt_id DESC");
//echo "select Remarks_update from SO_Update where po_id='".$row[8]."' and date <='".$today."' order by date DESC";
$fetchsoupdt=mysqli_fetch_array($qry_soupdt);

$contents.=trim($fetchsoupdt[0])."\t";


//$contents.="\n";
/*//===========ED========
$contents.="\t";

echo $engname1[0]; 
$today=date('Y/m/d H:i:s');

//===========Buyback Details========

$contents.=$row[11]."\t";

//===========Buyback Amount========

$contents.=$row[12]."\t";
*/

 } 
 
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
?>