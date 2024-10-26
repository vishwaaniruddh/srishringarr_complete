<?php 
include('config.php');

session_start();
$id=$_GET['id'];
$comp= $_GET['comp'];
//$comp = nl2br(htmlentities($comp));

$adv=$_GET['adv'];
$diag=$_GET['diag'];
$date1=$_GET['date1'];
$invest=$_GET['invest'];
$med1=$_GET['med1'];
$tak1=$_GET['tak1'];
$dos1=$_GET['dos1'];
$findin=$_GET['findin'];
$sql="select * from opd where opd_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$pid=$row[1];

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


            <div id="cou_box">
            <br><br><br><br><br><br>
              <table width="834" height="737" border="0" align="center">
                <tr>
<td width="375" align="right"></td> 
                </tr>
                <tr>
                  <td height="24" colspan="3">Date : <?php echo $date1; ?> &nbsp;&nbsp;&nbsp;&nbsp; Reg.No : <B><?php echo $id; ?></b></td>
                </tr>
                <tr>
                  <td height="22" colspan="3" ><font style="text-transform:uppercase;font-weight:bold;"><?php echo $row1[6]; ?></font>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row1[26]; ?>/<?php echo $row1[27]; ?></td>
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
                  <td height="22" colspan="3"><div contenteditable="true"><?php
				  echo $comp;
			/*	  $comp2=explode(",",$comp);
				  for($i=0;$i<count($comp2);$i++)
				  {
				   echo (ltrim($comp2[$i]," "))."<br>";
				   
				   } */ ?></div>
				   <br><br></td>
                </tr>
					<?php } if($findin!=""){ ?>
                <tr>
                  <td width="375" height="25"><font size="4"><b><u>Clinical Details :</u></b></font></td>
                </tr>
                <tr>
                  <td height="27" colspan="3"><div contenteditable="true"><?php
				  echo $findin;
				  /* $findin2=explode(",",$findin);
				  for($i=0;$i<count($findin2);$i++)
				  {
				   echo (ltrim($findin2[$i]," "))."<br>";
				   
				   }*/ ?></div>
				  <br><br></td>
                </tr>
					<?php } if($invest!=""){?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Investigations Done :</u></b></font></td>
                </tr>
                <tr>
                  <td height="33" colspan="3"><div contenteditable="true"><?php echo $invest; ?></div><br><br></td>
                </tr>
					<?php } if($diag!=""){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Diagnosis :</u></b></font></td>
                </tr>
                <tr>
                  <td height="22" colspan="3"><div contenteditable="true"><?php 
				  echo $diag;
				  /* $diag2=explode(",",$diag);
				  for($i=0;$i<count($diag2);$i++)
				  {
				   echo (ltrim($diag2[$i]," "))."<br>";
				   
				   }*/
				 // echo strtoupper($diag); ?></div><br><br></td>
                </tr>
					<?php } if($adv!=""){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Treatment Advised :</u></b></font></td>
                </tr>
                <tr>
                  <td height="33" colspan="3"><div contenteditable="true"><?php
				  echo $adv;
				 /* $adv1=explode(',',trim($adv));
				  for($i=0;$i<count($adv1);$i++)
				  {
				  echo ltrim($adv1[$i])."<br>";
				  }*/
				  // echo strtoupper($adv); ?></div><br><br></td>
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
            <input type="button" id="cou_btn" value="Print" style="width:100px;"/>