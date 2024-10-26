<?php 
include 'config.php';

session_start();
$id=$_GET['id'];
$pd=$_GET['pd'];
$inv=$_GET['inv'];
$fd=$_GET['fd'];
$jj=$_GET['jj'];
$jjdate=$_GET['jjdate'];
$uc=$_GET['uc'];
$ucdate=$_GET['ucdate'];
$op=$_GET['op'];
$po=$_GET['po'];
$proc=$_GET['proc'];
$add_proc=$_GET['add_proc'];
$treat=$_GET['treat'];
$adv=$_GET['adv'];
$visit=$_GET['visit'];
/*$datead=$_GET['datead'];
$datedis=$_GET['datedis'];
$room=$_GET['room'];
$radiotxt=$_GET['radiotxt'];
$hour=$_GET['hour'];
$minn=$_GET['minn'];
$time=$hour.":".$minn;
$hour1=$_GET['hour1'];
$min1=$_GET['min1'];
$time1=$hour1.":".$min1;*/

$sql="select * from admission where ad_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$sql1="select * from patient where no='$row[1]'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);

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
            
            <h2 align="center">Discharge Summary</h2>
              <table  border="0">

                <tr>
                  <td width="443" height="24">Name : <?php echo $row1[6]; ?>&nbsp; Reg.No : <?php echo $id; ?></td>
               
                  <td width="443" height="22" >Age/Sex : <?php echo $row1[26]; ?>/<?php echo $row1[27]; ?></td>
                </tr>
                
                <tr>
                <td>Address : <?php echo $row1[20]; ?></td> 
                </tr>
                
                <tr>
                <td>Date of Admission : <?php echo $row[3]; ?></td>
                <td>Time : <?php echo $row[4]; ?></td>
                <td>Room Type : <?php echo $row[8]; ?></td>
                </tr>
                
                 <tr>
                <td>Date of Discharge : <?php echo $row[5]; ?></td>
                <td>Time : <?php echo $row[6]; ?></td>
                
                </tr>
                <tr>
                  <td width="443" height="30" style="border-top:1px #000 solid;" colspan="3"><font size="4"><b><u>Provisional Diagnosis :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="30" colspan="3"><?php echo $pd; ?></td>
                </tr>
                <tr>
                  <td width="443" height="30"><font size="4"><b><u>Final Diagnosis :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="30" colspan="3"><?php echo $fd; ?></td>
                </tr>
                <tr>
                  <td width="443" height="30"><font size="4"><b><u>Investigations :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="33" colspan="3"><?php echo $inv; ?></td>
                </tr>
                
                <tr>
                  <td width="443" height="30"><font size="4"><b><u>JJ Stent :</u></b></font> <?php echo $jj; ?></td>
              
                  <td width="443" height="30" colspan="3"><font size="4"><b><u>Removal Date :</u></b></font> <?php echo $jjdate; ?></td>
                </tr>
                
                 <tr>
                  <td width="443" height="30"><font size="4"><b><u>Uiretic Cath :</u></b></font> <?php echo $uc; ?></td>
              
                  <td width="443" height="30" colspan="3"><font size="4"><b><u>Removal Date :</u></b></font> <?php echo $ucdate; ?></td>
                </tr>
                
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Operations :</u></b></font></td>
                </tr>
                <tr>
                  <td width="443" height="33" colspan="3"><?php echo $op; ?></td>
                </tr>
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Post Operative T/t : </u></b></font> <?php echo $po; ?></td>
                </tr>
                
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Procedure :</u></b></font></td>
                </tr>
               <tr>
                  <td width="443" height="22"><?php echo $proc; ?></td>
                </tr>
               
               <tr>
                  <td width="443" height="22"><font size="4"><b><u>Additional Procedure :</u></b></font></td>
                </tr>
               <tr>
                  <td width="443" height="22"><?php echo $add_proc; ?></td>
                </tr>
                
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Treatment on Discharge :</u></b></font></td>
                </tr>
               <tr>
                  <td width="443" height="22"><?php echo $treat; ?></td>
                </tr>
                
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Advice :</u></b></font></td>
                </tr>
               <tr>
                  <td width="443" height="22"><?php echo $adv; ?></td>
                </tr>
                
                <tr>
                  <td width="443" height="22"><font size="4"><b><u>Visit at OPD On :</u></b></font> <?php echo $visit; ?></td>
                </tr>
               
              </table>
            </div>
            <input type="button" id="cou_btn" value="Print" style="width:100px;"/>