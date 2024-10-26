<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table cellspacing="0" cellpadding="0">
  <col width="92" />
  <col width="74" />
  <col width="82" />
  <col width="149" />
  <col width="124" />
  <col width="65" />
  <col width="60" />
  <col width="64" />
  <tr height="21">
    <td colspan="8" height="21" width="710">SAI NAMAN HOSPITAL</td>
  </tr>
  <tr height="20">
    <td colspan="8" height="20">G.E. ROAD, BHILAI-3 , &ndash; 490 021 (C.G.)</td>
  </tr>
  <tr height="20">
    <td colspan="8" height="20">TEL &ndash; 0788 &ndash;    4051001, 4051002</td>
  </tr>
  <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="3" height="20">GDH/ESIC/2011/056</td>
    <td></td>
    <td></td>
    <td></td>
    <td>Dated: 22 Dec 2011</td>
    <td></td>
    </tr>
    <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td height="20">To,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="3" height="20">SMC Chattisgarh,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="3" height="20">Regional Office,    ESIC,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="3" height="20">18, South Avenue,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="3" height="20">Choubey Colony,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="3" height="20">RAIPUR (CG)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td height="20" colspan="4">Sub    :&nbsp; REIMBURSEMENT OF    MEDICAL BILLS</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td height="20" colspan="5">Ref.    : Agreement Letter No. SMC/Chattisgarh/5-2/2010 dated    08/01/2010</td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="2" height="20">Dear Sir/Madam,</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td height="20" colspan="6">Please    find enclosed herewith Bills for reimbursement as per details given below :</td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="46">
    <td height="46" width="92">Bill No.</td>
    <td width="74">Registration No.</td>
    <td width="82">Employee Card No.</td>
    <td width="149">Employee Name</td>
    <td width="124">Patient Name</td>
    <td width="65">Date of Admission</td>
    <td width="60">Date of Discharge</td>
    <td width="64">Amount</td>
    </tr>
  <?php $hostname='localhost'; //// specify host, i.e. 'localhost'
$user='root'; //// specify username
$pass=''; //// specify password
$dbase='satyavan_clinicmgt'; //// specify database name
$connection = mysqli_connect("$hostname" , "$user" , "$pass") 
or die ("Can't connect to MySQL");
mysqli_select_db($dbase , $connection) or die ("Can't select database.");
$tsum=0;
	    $from=$_POST['from'];
        $to = $_POST['to'];
        for($i=$from; $i<=$to ; $i++)
		{
         $result=mysqli_query($con,"select * from admission where ad_id='$i'");
		 $row=mysqli_fetch_row($result);
		 $cust_id=$row[1];	
		 $result1=mysqli_query($con,"select * from patient where no='$cust_id'");
		 $row1=mysqli_fetch_row($result1);
		 $result3=mysqli_query($con,"select * from discharge where ad_id='$i'");
		 $row3=mysqli_fetch_row($result3);
		 $tempsum=0;
		 $tempsum=$tempsum+$row3[4]+$row3[5]+$row3[6]+$row3[10];
		 $tsum=$tsum+$tempsum;
		 ?>
    <tr height="20">
    <td height="20"><?php echo $i; ?></td>
    <td></td>
    <td><?php echo $row1[39]; ?></td>
    <td><?php echo $row1[40]; ?></td>
    <td><?php echo $row1[6]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php echo $row[5]; ?></td>
    <td><?php echo $tempsum; ?></td>
    </tr>
        <?php } ?>
    <tr height="20">
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>TOTAL &gt;&gt;</td>
    <td><?php echo $tsum; ?></td>
    </tr>
    <tr height="20">
    <td colspan="8" height="20">(RS.   )</td>
    </tr>
    <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="8" height="20">Kindly do the    needful as early as possible.</td>
    </tr>
    <tr height="20">
    <td colspan="8" height="20">Thanking You,</td>
    </tr>
    <tr height="20">
    <td colspan="8" height="20">Yours faithfully,</td>
    </tr>
    <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="8" height="20">For Gindodi Devi    Memorial Charitable&nbsp;</td>
    </tr>
    <tr height="20">
    <td colspan="8" height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hospital &amp; Research Centre,</td>
    </tr>
    <tr height="20">
    <td height="20"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="3" height="20">(TRUSTEE)</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr height="20">
    <td colspan="8" height="20">Encls&nbsp; :&nbsp; as    above</td>
    </tr>
    </table>
</body>
</html>
