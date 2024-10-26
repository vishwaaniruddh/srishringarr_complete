<?php
include('config.php');
$typenew=$_POST['type'];
if($_POST['type']=='cwise'){
                $fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['fromdt'])));
		$fromdt1=$fromdt.' 00:00:00';
		$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));
		$todt1=$todt.' 23:59:59';	
 $contents='';
 $contents.="S.N. \t Customer \t SO Created \t Invoice raised \t Dispatched \t Delivered \t Invoice Submitted \t";
	
    $cust_sql=mysqli_query($con1,"select cust_id,cust_name from customer");
    $cnt=0;
    while($custrow=mysqli_fetch_row($cust_sql))
    {
    $cnt++;
		//$todt=$_POST['todt'];	
			$so=mysqli_query($con1,"select count(*) from pending_installations where entry_date between '".$fromdt1."' and '".$todt1."' and cust_id='".$custrow[0]."' and del_type!='ware_del'");
			$sorow=mysqli_fetch_row($so);
			$inv=mysqli_query($con1,"select count(*) from sales_orders a,pending_installations b where a.po_id=b.id and (b.status=1 or b.status=2) and a.inv_date between '".$fromdt1."' and '".$todt1."' and b.cust_id='".$custrow[0]."'");
			$invrow=mysqli_fetch_row($inv);
			$dis=mysqli_query($con1,"select count(*) from sales_orders a,pending_installations b where a.po_id=b.id and (b.status=1 or b.status=2) and a.inv_date between '".$fromdt1."' and '".$todt1."' and a.dis_date!='0000-00-00' and b.cust_id='".$custrow[0]."'");
			$disrow=mysqli_fetch_row($dis);
			$del=mysqli_query($con1,"select count(*) from sales_orders a,pending_installations b where a.po_id=b.id and (b.status=1 or b.status=2) and a.inv_date between '".$fromdt1."' and '".$todt1."' and a.del_date!='0000-00-00' and b.cust_id='".$custrow[0]."'");
			$delrow=mysqli_fetch_row($del);
			$sub=mysqli_query($con1,"select count(*) from sales_orders a,pending_installations b where a.po_id=b.id and (b.status=1 or b.status=2) and a.inv_date between '".$fromdt1."' and '".$todt1."' and a.sub_date!='0000-00-00' and b.cust_id='".$custrow[0]."'");
			$subrow=mysqli_fetch_row($sub);
	
$contents.="\n".$cnt."\t";

//================Customer name========
$contents.=$custrow[1]."\t";

//===========po date=========

$contents.=$sorow[0]."\t";
$contents.=$invrow[0]."\t";

//===========DO Date=========

$contents.=$disrow[0]."\t";

//===========DO no=========

$contents.=$delrow[0]."\t";

$contents.=$subrow[0]."\t";

}
 }
 else{
 		$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['fromdt'])));
		$fromdt1=$fromdt.' 00:00:00';
                $todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));
		$todt1=$todt.' 23:59:59';	
 $contents='';
 $contents.="S.N. \t Branch \t SO Created \t Invoice raised \t Dispatched \t Delivered \t Invoice Submitted \t";
	
    $br_sql=mysqli_query($con1,"select id,name from avo_branch");
    $cnt=0;
    while($brrow=mysqli_fetch_row($br_sql))
    {
    $cnt++;
		//$todt=$_POST['todt'];	
		$tags='';
	   $atmsql=mysqli_query($con1,"select track_id as id from atm where branch_id='".$brrow[0]."' union select amcid from Amc where branch='".$brrow[0]."'");
	                while ($atmrow = mysqli_fetch_row($atmsql)) {
    // concatenate all the tags into one string
                   $tags .= $atmrow[0].',';
                    }

                   $tags = substr($tags,0,-1); //echo $tags.'<br>';



			$so=mysqli_query($con1,"select count(*) from pending_installations where entry_date between '".$fromdt1."' and '".$todt1."' and atmid in(".$tags.") and del_type!='ware_del' ");
			$sorow=mysqli_fetch_row($so);
			$inv=mysqli_query($con1,"select count(*) from sales_orders a,pending_installations b where a.po_id=b.id and (b.status=1 or b.status=2) and a.inv_date between '".$fromdt1."' and '".$todt1."' and b.atmid in(".$tags.")");
			$invrow=mysqli_fetch_row($inv);
			$dis=mysqli_query($con1,"select count(*) from sales_orders a,pending_installations b where a.po_id=b.id and (b.status=1 or b.status=2) and a.inv_date between '".$fromdt1."' and '".$todt1."' and a.dis_date!='0000-00-00' and b.atmid in(".$tags.")");
			$disrow=mysqli_fetch_row($dis);
			$del=mysqli_query($con1,"select count(*) from sales_orders a,pending_installations b where a.po_id=b.id and (b.status=1 or b.status=2) and a.inv_date between '".$fromdt1."' and '".$todt1."' and a.del_date!='0000-00-00' and b.atmid in(".$tags.")");
			$delrow=mysqli_fetch_row($del);
			$sub=mysqli_query($con1,"select count(*) from sales_orders a,pending_installations b where a.po_id=b.id and (b.status=1 or b.status=2) and a.inv_date between '".$fromdt1."' and '".$todt1."' and a.sub_date!='0000-00-00' and b.atmid in(".$tags.")");
			$subrow=mysqli_fetch_row($sub);
	
$contents.="\n".$cnt."\t";

//================Customer name========
$contents.=$brrow[1]."\t";

//===========po date=========

$contents.=$sorow[0]."\t";
$contents.=$invrow[0]."\t";

//===========DO Date=========

$contents.=$disrow[0]."\t";

//===========DO no=========

$contents.=$delrow[0]."\t";

$contents.=$subrow[0]."\t";

}
 }   
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=CompletedSOreport.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>