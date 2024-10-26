<?php 
include('config.php');

session_start();
$id=$_GET['id'];
$aid=$_GET['aid'];
$inv=$_GET['inv'];
$fd=$_GET['fd'];
$op=$_GET['op'];
$datead=$_GET['datead'];
$datedis=$_GET['datedis'];
$room=$_GET['room'];
$radiotxt=$_GET['radiotxt'];
$hour=$_GET['hour'];
$minn=$_GET['minn'];
$time=$hour.":".$minn;
$hour1=$_GET['hour1'];
$min1=$_GET['min1'];
$time1=$hour1.":".$min1;

$sql="select * from admission where ad_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);



$adid=$row[0];
$sql3="select * from discharge_summary where dis_id='$adid'";
$result3 = mysql_query($sql3);
$row3 = mysql_fetch_row($result3);

$pid=$row[1];

$sql1="select * from patient where no='$pid'";
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
              <table  border="0">
                <tr>
                  <?php
include('discharge1.php');
?>
                </tr>
                <tr>
                  <td width="443" height="24">Name : <?php echo $row1[6]; ?>&nbsp; Reg.No : <?php echo $id; ?></td>
               
                  <td width="443" height="22" >Age/Sex : <?php echo $row1[26]; ?>/<?php echo $row1[27]; ?></td>
                </tr>
                
                <tr>
                <td>Address : <?php echo $row1[20]; ?></td> 
                </tr>
                
                <tr>
                <td>Date of Admission : <?php echo $row[2]; ?></td>
                <td>Time : <?php echo $row[3]; ?></td>
                <td>Room Type : <?php echo $row[6]; ?></td>
                </tr>
                
                 <tr>
                <td>Date of Discharge : <?php echo $row[4]; ?></td>
                <td>Time : <?php echo $row[5]; ?></td>
                <td>Surgeon :</td>
                </tr>
                <tr>
                  <td width="443" height="30" style="border-top:1px #000 solid;" colspan="3"><font size="4"><b><u>Complaints & History :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="30" colspan="3"><?php echo $row[8]; ?></td>
                </tr>
                <tr>
                  <td width="443" height="30"><font size="4"><b><u>Clinical Details :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="30" colspan="3"><?php echo $row[9]; ?></td>
                </tr>
                <tr>
                  <td width="443" height="30"><font size="4"><b><u>Investigations Radiological :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="33" colspan="3"><?php echo $row[11]; ?></td>
                </tr>
                <tr>
                  <td width="443" height="30"><font size="4"><b><u>Diagnosis :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="30" colspan="3"><?php echo $fd; ?></td>
                </tr>
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Name of Operation :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="33" colspan="3"><?php echo $op; ?></td>
                </tr>
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Operation Notes :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="33" colspan="3"><?php echo $adv; ?></td>
                </tr>
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Clinical Findings on Discharge :</u></b></font></td>
                </tr>
               <tr>
                  <td width="443" height="22"><?php echo $fg; ?></td>
                </tr>
               
              </table>
            </div>
            <input type="button" id="cou_btn" value="Print" style="width:100px;"/>