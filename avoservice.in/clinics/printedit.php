<?php
if(isset($_POST['saveedit']))
{
include("config.php");
//echo $_POST['complain']."<br>";
if(isset($_POST['comp'])!='' || $_POST['comp']!='')
$comp=$_POST['comp'];
else
$comp=$_POST['complain'];

//echo $comp."<br>";
//echo $_POST['diagnosis']."<br>----".$_POST['comp']."<br>";
//echo $_POST['investigation']."<br>";
//echo $_POST['treatment']."<br>";
//echo $_POST['detail']."<br>";
if(isset($_POST['diag'])!='' || $_POST['diag']!='')
$diag=$_POST['diag'];
else
$diag=$_POST['diagnosis'];
//echo $diag."<br>";

if(isset($_POST['invst'])!='' || $_POST['invst']!='')
$invest=$_POST['invst'];
else
$invest=$_POST['investigation'];

//echo $invest."<br>";
if(isset($_POST['treat'])!='' || $_POST['treat']!='')
$treat=$_POST['treat'];
else
$treat=$_POST['treatment'];
//echo $treat."<br>";
if(isset($_POST['det'])!='' || $_POST['det']!='')
$det=$_POST['det'];
else
$det=$_POST['detail'];
//echo $det."<br>";
//echo "Update opd set complaint='".$comp."', clinical='".$det."',advise='".$treat."', diagnosis='".$diag."',invadvise='".$invest."' where opd_real_id='".$_POST['opdid']."' ";
$qry=mysql_query("Update opd set complaint='".$comp."', clinical='".$det."',advise='".$treat."', diagnosis='".$diag."',invadvise='".$invest."' where opd_real_id='".$_POST['opdid']."' ");
if(!$qry)
echo "failed".mysql_error();

$qr=mysql_query("select * from opd where opd_real_id='".$_POST['opdid']."'");
$qrrow=mysql_fetch_row($qr);
include('getagemonth.php');

}
?>
<html><head><title></title>
<script language="javascript" type="text/javascript">
        function printDiv(divID,tp) {
            //Get the HTML of div
			var type=document.getElementById(tp).value;
			var patid=document.getElementById('pat').value;
			document.getElementById('btn').style.display='none';
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
//document.getElementById('btn').style.display='block';
//alert(type);
		if(type=='new')
          window.location='View_app.php';
		  else if(type='edit')
		  window.location='view_opd.php';
		   else if(type=='ajaxopd')
		  window.location='patient_detail.php?id='+patid;
        }
    </script>
</head>
<body onLoad="printDiv('divtoprint','tp')">


<?php
//echo "select * from opd where opd_real_id='".$_POST['opdid']."'";
$sql="select * from opd where opd_real_id='".$_POST['opdid']."'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$pid=$row[1];
$comp2=$row[31];
$adv2=$row[38];
$findin2=$row[75];
$diag2=$row[32];
$invest2=$row[66];
$sql1="select * from patient where srno='$pid'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

$did=$row1[9];
$sql2="select * from doctor where doc_id='$did'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_row($result2);

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript">

                 $(document).ready(function() {

                        $('#cou_btn').click(function(e) {
                          e.preventDefault();

                          w=window.open();
                          var temp=$('#cou_box').html();
                          w.document.write(temp);
                          if (navigator.appName == 'Microsoft Internet Explorer') window.print();
        else w.print();
                         
                          w.close();
                         return false;
                        });
                       });  


            </script>
            <div id="btn">
<input type="button" onClick="window.location.href=view_opd.php" value="cancel/Bo Back">
<input type="text" value="<?php echo $_POST['tp']; ?>" id="tp" name="tp">
<input type="hidden" name="pat" id="pat" value="<?php echo $qrrow[1]; ?>">
</div>
<div id="divtoprint">
            
            <br><br><br><br><br><br>
              <table width="834" height="737" border="0" align="center">
                <tr>
<td width="375" align="right"></td> 
                </tr>
                <tr>
                  <td height="24" colspan="3">Date : <?php echo date('d/m/Y'); ?> &nbsp;&nbsp;&nbsp;&nbsp; Reg.No : <B><?php echo $_POST['opdid']; ?></b></td>
                </tr>
                <tr>
                  <td height="22" colspan="3" ><font style="text-transform:uppercase;font-weight:bold;"><?php echo $row1[6]; ?></font>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo  findage(date('d-m-Y',strtotime($row1[25]))); ?>/<?php echo $row1[27]; ?></td>
                </tr>
                <tr>
                  <td height="22" colspan="3">Tel.No. <?php  echo $row1[23];?>&nbsp;&nbsp;&nbsp;&nbsp; Ref.By: <?php echo $row2[1]; ?></td>
                </tr>
				<tr>
                  <td height="22"  colspan="3"><hr  style="border:1px #000 solid;"/></td>
                </tr>
				<?php if($comp!=""){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Complaints & History :</u></b></font></td>
                </tr>
                <tr>
                  <td height="22" colspan="3"><?php
				  echo nl2br(stripslashes($comp));
			/*	  $comp2=explode(",",$comp);
				  for($i=0;$i<count($comp2);$i++)
				  {
				   echo (ltrim($comp2[$i]," "))."<br>";
				   
				   } */ ?>
				   <br><br></td>
                </tr>
					<?php } if($det!=""){ ?>
                <tr>
                  <td width="375" height="25"><font size="4"><b><u>Clinical Details :</u></b></font></td>
                </tr>
                <tr>
                  <td height="27" colspan="3"><?php
				  echo nl2br(stripslashes($det));
				  /* $findin2=explode(",",$findin);
				  for($i=0;$i<count($findin2);$i++)
				  {
				   echo (ltrim($findin2[$i]," "))."<br>";
				   
				   }*/ ?>
				  <br><br></td>
                </tr>
					<?php } if($invest!=""){?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Investigations Done :</u></b></font></td>
                </tr>
                <tr>
                  <td height="33" colspan="3"><?php echo nl2br(stripslashes($invest)); ?><br><br></td>
                </tr>
					<?php } if($diag!=""){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Diagnosis :</u></b></font></td>
                </tr>
                <tr>
                  <td height="22" colspan="3"><?php 
				  echo nl2br(stripslashes($diag));
				  /* $diag2=explode(",",$diag);
				  for($i=0;$i<count($diag2);$i++)
				  {
				   echo (ltrim($diag2[$i]," "))."<br>";
				   
				   }*/
				 // echo strtoupper($diag); ?><br><br></td>
                </tr>
					<?php } if($treat!=""){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Treatment Advised :</u></b></font></td>
                </tr>
                <tr>
                  <td height="33" colspan="3"><?php
				  echo nl2br(stripslashes($treat));
				 /* $adv1=explode(',',trim($adv));
				  for($i=0;$i<count($adv1);$i++)
				  {
				  echo ltrim($adv1[$i])."<br>";
				  }*/
				  // echo strtoupper($adv); ?><br><br></td>
                </tr>
					<?php } $arr = explode(',',trim($med1));
if($arr[0]!=0 ){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Medicines Prescribed :</u></b></font></td>
                </tr>
                <tr>
                  <td width="375" height="33"><?php echo ($med1); ?></td>
                  <td width="274" height="33"><?php echo ($tak1); ?></td>
                  <td width="171" height="33"><?php echo $dos1; ?></td>
                </tr>
					<?php } ?>
                <tr>
                  <td colspan="3"><br>
                      <br>
                    <br>
                    <br>
                    <br>
                    <br>
                      <b>Confirm appoint on phone no.9320131234/ 9320141234 / 932151234</b> </td>
                </tr>
               
              </table>
            </div>
           <!-- <input type="button" id="cou_btn" value="Print" style="width:100px;"/>-->

</body>

</html>