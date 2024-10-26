<?php
include('config.php');
$typenew=$_POST['type'];
$col=$_POST['col'];


$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['fromdt'])));
		$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));
		$todt1=$todt.' 23:59:59';	
 $contents='';
 $contents.="S.N. \t Customer \t < 1 Days \t < 2 Days \t < 3-5Days \t  6-10 Days \t 11-15 Days \t Above 15 Days  \t";

$tot1=0;
$tot2=0;
$tot3_5=0;
$tot6_10=0;
$tot11_15=0;
$totm15=0;

if($_POST['type']=='cwise')
{
	
    $cust_sql=mysqli_query($con1,"select cust_id,cust_name from customer");
    $cnt=0;
    while($custrow=mysqli_fetch_row($cust_sql))
    {
$cnt1d=0;
$cnt2d=0;
$cnt3_5d=0;
$cnt6_10d=0;
$cnt11_15=0;
$cntm15=0;
    $cnt++;
	
	
$qr="select a.entry_date,b.inv_date,b.del_date,b.sub_date,a.atmid from pending_installations a,sales_orders b where a.status!=0 and entry_date>='".$fromdt."'  and entry_date<='".$todt1."' and cust_id='".$custrow[0]."' and a.id=b.po_id and ".$col."!='0000-00-00' order by a.atmid";

//echo $qr;

$soq=mysqli_query($con1,$qr);
while($sorow=mysqli_fetch_array($soq))
{

$tdd=date("Y-m-d",strtotime($sorow[0]));

//echo $tdd;
$date1 = new DateTime($tdd);

if($col=="inv_date")
{
$date2 = new DateTime($sorow[1]);

}
if($col=="del_date")
{
$date2 = new DateTime($sorow[2]);

}

if($col=="sub_date")
{
$date2 = new DateTime($sorow[3]);
}

//$date2 = new DateTime($dtt);
$days= $date2->diff($date1)->format("%a");
//echo $tdd."----------".$sorow[1]."---------".$days."<br>";
if($days<1)
{
$cnt1d++;
}

if($days>0 & days<=2)
{
$cnt2d++;
}
if($days>2 & days<=5)
{
$cnt3_5d++;
}


if($days>5 & days<=10)
{
$cnt6_10d++;
}

if($days>10 & days<=15)
{
$cnt11_15++;
}

if($days>15)
{
$cntm15++;
}

//echo $sorow[4]."</br>";

}
		

	
$contents.="\n".$cnt."\t";

//================Customer name========
$contents.=$custrow[1]."\t";

$contents.=$cnt1d."\t";
$contents.=$cnt2d."\t";
$contents.=$cnt3_5d."\t";
$contents.=$cnt6_10d."\t";

$contents.=$cnt11_15."\t";
$contents.=$cntm15."\t";
//$contents.=$sorow[4]."\t";


$tot1=$tot1+$cnt1d;
$tot2=$tot2+$cnt2d;
$tot3_5=$tot3_5+$cnt3_5d;
$tot6_10=$tot6_10+$cnt6_10d;
$tot11_15=$tot11_15+$cnt11_15;
$totm15=$totm15+$cntm15;

}


$contents.="\n".""."\t";
$contents.="Total \t";
$contents.=$tot1." \t";
$contents.=$tot2." \t";
$contents.=$tot3_5." \t";
$contents.=$tot6_10." \t";
$contents.=$tot11_15." \t";
$contents.=$totm15." \t";


 }
 else{
  	
    $br_sql=mysqli_query($con1,"select id,name from avo_branch");
    $cnt=0;
    while($brrow=mysqli_fetch_row($br_sql))
    {
  $cnt1d=0;
$cnt2d=0;
$cnt3_5d=0;
$cnt6_10d=0;
$cnt11_15=0;
$cntm15=0;
    $cnt++;


		//$todt=$_POST['todt'];	
		$tags='';
	   $atmsql=mysqli_query($con1,"select track_id as id from atm where branch_id='".$brrow[0]."'");
	                while ($atmrow = mysqli_fetch_row($atmsql)) 
                   {
                   $tags .= $atmrow[0].',';
                    }


$atmsql2=mysqli_query($con1,"select amcid from Amc where branch='".$brrow[0]."'");
	                while ($atmrow2 = mysqli_fetch_row($atmsql2)) 
                   {
                   $tags .= $atmrow2[0].',';
                    }

                   $tags = substr($tags,0,-1); //echo $tags.'<br>';


$qr="select a.entry_date,b.inv_date,b.del_date,b.sub_date,a.atmid from pending_installations a,sales_orders b where a.status!=0 and a.entry_date>='".$fromdt."'  and a.entry_date<='".$todt1."' and a.atmid in(".$tags.") and a.id=b.po_id and ".$col."!='0000-00-00' order by a.atmid";

			$soq=mysqli_query($con1,"$qr");
			while($sorow=mysqli_fetch_array($soq))
{

$tdd=date("Y-m-d",strtotime($sorow[0]));

//echo $tdd;
$date1 = new DateTime($tdd);

if($col=="inv_date")
{
$date2 = new DateTime($sorow[1]);

}
if($col=="del_date")
{
$date2 = new DateTime($sorow[2]);

}

if($col=="sub_date")
{
$date2 = new DateTime($sorow[3]);
}

//$date2 = new DateTime($dtt);
$days= $date2->diff($date1)->format("%a");
//echo $tdd."----------".$sorow[1]."---------".$days."<br>";
if($days<1)
{
$cnt1d++;
}

if($days>0 & days<=2)
{
$cnt2d++;
}
if($days>2 & days<=5)
{
$cnt3_5d++;
}


if($days>5 & days<=10)
{
$cnt6_10d++;
}

if($days>10 & days<=15)
{
$cnt11_15++;
}

if($days>15)
{
$cntm15++;
}

//echo $sorow[4]."</br>";

}


$contents.="\n".$cnt."\t";

$contents.=$brrow[1]."\t";
$contents.=$cnt1d."\t";
$contents.=$cnt2d."\t";
$contents.=$cnt3_5d."\t";
$contents.=$cnt6_10d."\t";

$contents.=$cnt11_15."\t";
$contents.=$cntm15."\t";

$contents.=$sorow[4]."\t";


$tot1=$tot1+$cnt1d;
$tot2=$tot2+$cnt2d;
$tot3_5=$tot3_5+$cnt3_5d;
$tot6_10=$tot6_10+$cnt6_10d;
$tot11_15=$tot11_15+$cnt11_15;
$totm15=$totm15+$cntm15;

}


$contents.="\n".""."\t";
$contents.="Total \t";
$contents.=$tot1." \t";
$contents.=$tot2." \t";
$contents.=$tot3_5." \t";
$contents.=$tot6_10." \t";
$contents.=$tot11_15." \t";
$contents.=$totm15." \t";

}
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
 header("Content-Disposition: attachment; filename=PendingSOreport.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>