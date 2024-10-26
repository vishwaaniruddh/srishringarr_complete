<?php 
include('config.php');

session_start();
$id=$_GET['id'];
$amt1=$_GET['amt1'];
$amt2=$_GET['amt2'];
$amt3=$_GET['amt3'];
$amt4=$_GET['amt4'];
$amt5=$_GET['amt5'];
$amt6=$_GET['amt6'];
$total=$_GET['total'];
$paid=$_GET['paid'];
$opdmast1=$_GET['opdmast1'];
$opdmast2=$_GET['opdmast2'];
$opdmast3=$_GET['opdmast3'];
$opdmast4=$_GET['opdmast4'];
$opdmast5=$_GET['opdmast5'];
$opdmast6=$_GET['opdmast6'];
$billdate=$_GET['billdate'];

$sql="select * from opd where opd_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);


/*
$adid=$row[0];
$sql3="select * from discharge_summary where dis_id='$adid'";
$result3 = mysql_query($sql3);
$row3 = mysql_fetch_row($result3);
*/
$pid=$row[1];

$sql1="select * from patient where no='$pid'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);


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
                <tr><TD align="center" colspan="2">
                  <pre>
                  <font size="+2"> TARAL NAGDA </font>
                  M.S(Orth) D.Ortho(Orth)
                  Speciality Pediatric Orthopaedic
                  Registration No. 69018
                  </pre>
               </TD></tr>
               
                <tr>
                  <td width="399" height="29" align="center" ><b><u> OPD Bill Cum Receipt </u></b></td>
                </tr>
                
                <tr>
                <td colspan="3">Patient : <?php echo $row1[6]; ?></td> 
                </tr>
                
                <tr>
                <td colspan="2">Bill No. : <?php  ?></td>
                <td width="125">Date : <?php echo $billdate; ?></td>
                </tr>
                </table>
                
                <table>
                <tr>
                 <td style="border:1px #000 solid;">SR.No </td> 
                 <td width="248" style="border:1px #000 solid;">Particulars </td>
                 <td width="131" style="border:1px #000 solid;">Amount </td> 
                </tr>
                <tr>
                 <td>1 </td> <td width="248"> <?php echo $opdmast1; ?></td> <td width="131"><?php echo $amt1; ?> </td>
                </tr>
                <tr>
                  <td>2 </td> <td width="248"><?php echo $opdmast2; ?> </td> <td width="131"><?php echo $amt2; ?> </td>
                </tr>
                <tr>
                  <td>3 </td> <td width="248"><?php echo $opdmast3; ?> </td> <td width="131"><?php echo $amt3; ?> </td>
                </tr>
                <tr>
                  <td>4 </td> <td width="248"><?php echo $opdmast4; ?> </td> <td width="131"><?php echo $amt4; ?> </td>
                </tr>
                <tr>
                  <td>5 </td> <td width="248"><?php echo $opdmast5; ?> </td> <td width="131"><?php echo $amt5; ?> </td>
                </tr>
                <tr>
                  <td>6 </td> <td width="248"><?php echo $opdmast6; ?> </td> <td width="131"><?php echo $amt6; ?> </td>
                </tr>
                <tr>
                  <td width="74" height="30"><b>Total :</b></td>
                  <td><?php echo $total; ?></td>
                </tr>
                <tr>
                  <td height="33" ><b> Paid : </b></td><td><?php echo $paid; ?></td>
                </tr>
                
               
              </table>
       </div>
            <input type="button" id="cou_btn" value="Print" style="width:100px;"/>