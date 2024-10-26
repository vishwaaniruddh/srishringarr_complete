<?php
include('config.php');
$typenew=$_POST['type'];
if($_POST['type']=='sales'){
$flag='atm';
//$sql="select po,podate,atm_id from atm where po in (select po_no from purchase_order where del_type='site_del') and atm_id not in(select atmid from sales_orders) order by podate DESC "; 
$sql="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atm_id from pending_installations a,atm b where a.status=2 and a.type='sales' and a.del_type='site_del' and a.atmid=b.track_id";
}
else
{
$flag='amc';
 //$sql="select PO,AMC_ST_DATE,ATMID from Amc where PO in (select po_no from purchase_order where del_type='site_del') and ATMID not in(select atmid from sales_orders) order by AMC_ST_DATE DESC "; 

//$sql="select PO,AMC_ST_DATE,ATMID from Amc where PO<>'' and po in (select po_no from purchase_order where del_type='site_del') and ATMID not in(select atmid from sales_orders) order by AMC_ST_DATE DESC "; 

$sql="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atmid from pending_installations a,Amc b where a.status=2 and a.type='AMC' and a.del_type='site_del' and a.atmid=b.amcid";
}
// branchwise
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='' )
         {
          if($flag=="atm")
   	      $sql.=" and b.branch_id ='".$_POST['branch_avo']."'";
          else
              $sql.=" and b.branch ='".$_POST['branch_avo']."'";
         }
         // clientwise
         if(isset($_POST['cid']) && $_POST['cid']!='' )
         {
          $sql.=" and a.cust_id ='".$_POST['cid']."'";
         }
        
//======================================Search Call Date wise
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];
	
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and a.req_date between '".$fromdt."' and '".$todt."'";
	
	
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}

$sql.=" order by a.id desc ";
//echo $sql;
//echo "Select * from alert_customer where state in (".$br2.") order by alert_id DESC";
$table=mysqli_query($con1,$sql);
//$count=0;
//$Num_Rows = mysqli_num_rows ($table);
//echo $sql;
//$qr22=$sql;

//$sqlflag=$_POST['flagdata'];
//$sqlme=$sqlme;//.' limit 400';
//echo "test".$sqlflag;

//echo mysqli_num_rows($table);

$contents='';
 $contents.="S.N. \t PO No \t PO Date \t Do No\t DO Date\t SO Datetime\t BANK\t ATM Id\t Delivery/Consignee Address\t CITY\t STATE\t PIN CODE\t Sales Person\t Customer\t Buyer Name and address \t Buyer GST No. \t Contact Person\t Contact No.\t Created By \t UPS \t Qty \t Rate PER UNIT \t Buy Back rate per unit\t Battery \t Qty \t Rate PER UNIT \t Buy Back rate per unit \t ISO TRANSFORMER \t Qty \t Rate PER UNIT \t Buy Back rate per unit \t STABILISER \t Qty \t Rate PER UNIT \t Buy Back rate per unit \t AVR \t Qty \t Rate PER UNIT \t Buy Back rate per unit\t Others\t Rate PER UNIT\t Buyback Details\t Buyback Amount\t Remarks Update\t Invoice No \t Invoice Date \t Invoice Value \t Courier \t Docket No \t Estimated Date\t Dispatch Date \t Delivery Date \t Invoice Submit Date \t";
// ED\t Buyback Details\t Buyback Amount\t Remarks Update\t All Remarks\t
 $cnt=0;
 
//$table=mysqli_query($con1,$sqlme);

while($row=mysqli_fetch_row($table))
{
$cnt++;

if($flag=="amc"){
	/*$posql=mysqli_query($con1,"select po_no from purchase_order where del_type='site_del' and po_no='".$row[0]."'");
	if(mysqli_num_rows($posql)>0)
	{*/
        $atm=mysqli_query($con1,"select bankname,atmid,cid,area,city,address,state,pincode from Amc where amcid='".$row[0]."'");
      //  echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where amcid='".$row[0]."'";
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
	//echo "select  bank_name,atm_id,cust_id,area,city,address,state1,pincode from atm where track_id='".$row[0]."'";
	}
	$atmdet=mysqli_fetch_row($atm);

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atmdet[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$tab=mysqli_query($con1,"select buyeraddress,gst,po_date,salesperson from purchase_order where po_no='".$row[1]."'");	
	$row1=mysqli_fetch_row($tab);
	//echo "eng stat".$row[15];
		
//===============sr no.=======

$contents.="\n".$cnt."\t";

//================po no========
$contents.=str_replace($toreplace,' ',preg_replace('/[^A-Za-z0-9\-]/', ' ', $row[1]))."\t";

//===========po date=========

$contents.=$row1[2]."\t";


//===========DO Date=========

$contents.=$row[4]."\t";

//===========DO no=========

$contents.=str_replace($toreplace,' ',preg_replace('/\s+/', ' ', $row[3]))."\t";

$contents.=$row[14]."\t";

//===========BANK=========


$contents.=str_replace($toreplace,' ',preg_replace('/\s+/', ' ', $atmdet[0]))."\t";

//===========ATM Id=========

$contents.=$atmdet[1]."\t";


//==================Delivery/Consignee Address====

$toReplace=array('\n', '"');

$contents.=str_replace($toreplace,' ',preg_replace('/\s+/', ' ', $atmdet[5]))."\t";


//===========CITY=========

$contents.=$atmdet[4]."\t";

//===========STATE=========

$contents.=$atmdet[6]."\t";

//===========PIN CODE=========

$contents.=$atmdet[7]."\t";
$contents.=$row1[3]."\t";
//===========Customer=========

$contents.=$custrow[0]."\t";

//===========Buyer Name and address=========
$toreplace=array('\n', '"');
$contents.=str_replace($toreplace,' ',preg_replace('/\s+/', ' ', $row1[0]))."\t";
//$contents.=$row1[0]."\t";

//===========Buyer GST No.=========

$contents.=$row1[1]."\t";

//===========Contact Person=========
//$contents.=$row[9]."\t";
//$toreplace=array('\n', '"');
$contents.=str_replace($toreplace,"",preg_replace('/\s+/', '', $row[9]))."\t";
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
$contents.=str_replace($toreplace,"",preg_replace('/\s+/', '', $row6[0]))."\t";
//===========Rate PER UNIT========

$contents.=$row6[1]."\t";
//$contents.="\n";
//===========ED========
//$contents.="\t";

echo $engname1[0]; 
$today=date('Y/m/d H:i:s');

//===========Buyback Details========

//$contents.=htmlspecialchars_decode($row[11])."\t";
//$toreplace=array('\n', '"');
$contents.=str_replace($toreplace,"",preg_replace('/\s+/', '', $row[11]))."\t";

//===========Buyback Amount========

$contents.=$row[12]."\t";
 $qry_soupdt=mysqli_query($con1,"select Remarks_update from SO_Update where po_id='".$row[8]."' order by updt_id DESC limit 1");
//echo "select Remarks_update from SO_Update where po_id='".$row[8]."' and date <='".$today."' order by date DESC";
$fetchsoupdt=mysqli_fetch_array($qry_soupdt);

//$contents.=$fetchsoupdt[0]."\t";
//$toreplace=array('\n', '"');
$contents.=str_replace($toreplace,"",preg_replace('/\s+/', '', $fetchsoupdt[0]))."\t";

	
$invoice=mysqli_query($con1,"select inv_no,inv_date,inv_value,courier,docketno,est_date,dis_date,del_date,sub_date from sales_orders where po_id='".$row[8]."'");
   //echo "select inv_no,inv_date,inv_value,courier,docketno,est_date,dis_date,del_date,sub_date from sales_orders where po_id='".$row[0]."'"; 
$invoicedet=mysqli_fetch_row($invoice);
//echo $invoicedet;

//===========Invoice No========

$contents.=$invoicedet[0]."\t";
	
//===========Invoice Date========

$contents.=$invoicedet[1]."\t";
	
	//===========Invoice Value========

$contents.=$invoicedet[2]."\t";
	
	//===========Courier ========

$contents.=$invoicedet[3]."\t";
	
	//===========Docket No========

$contents.=$invoicedet[4]."\t";
	
	//===========Estemated Date========

$contents.=$invoicedet[5]."\t";
	
	//===========Dispatch Date========

$contents.=$invoicedet[6]."\t";
	
	//===========Delivery Date========

$contents.=$invoicedet[7]."\t";
	
	//===========Invoice Submission Date========

$contents.=$invoicedet[8]."\t";
	

 } 
 
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=salesreport.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>