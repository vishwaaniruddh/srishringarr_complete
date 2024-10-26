<?php 
include('config.php');

session_start();
$id=$_GET['id'];
$addate=$_GET['addate'];
$disdate=$_GET['disdate'];
$final=$_GET['final'];
$comptxt=$_GET['comptxt'];
$clitxt=$_GET['clitxt'];
$finaltxt=$_GET['finaltxt'];
$radiotxt=$_GET['radiotxt'];
$pathtxt=$_GET['pathtxt'];
$protxt=$_GET['protxt'];
$occu=$_GET['occu'];
$admit=$_GET['admit'];
$addr=$_GET['addr'];
$room=$_GET['room'];

$sql="select * from admission ";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$pid=$row[1];

$sql1="select * from patient where no='$id'";
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
            <h3 align="center">ADMISSION RECORD </h3>
              <table width="640" height="737" border="0" align="center">
               
                <tr>
                  <td width="634" height="22"><?php echo $row1[6]; ?>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row1[26]; ?>/<?php echo $row1[27]; ?></td>
                </tr>
                <tr>
                  <td width="634" height="22" >Admission Date : <?php echo $addate; ?>&nbsp;&nbsp;&nbsp;&nbsp; Discharge Date : <?php echo $disdate; ?></td>
                </tr>
                 <tr>
                  <td width="634" height="24" style="border-bottom:1px #000 solid;"> Room Type : <?php echo $room; ?></td>
                </tr>
                <tr>
                  <td width="634" height="22"><font size="4"><b><u>Past History :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="22" colspan="3"><?php echo $final; ?><br><br></td>
                </tr>
                <tr>
                  <td width="634" height="25"><font size="4"><b><u>Radiological Investigations :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="27" colspan="3"><?php echo $radiotxt; ?><br><br></td>
                </tr>
                <tr>
                  <td width="634" height="22"><font size="4"><b><u>Chief Complaints :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="33" colspan="3"><?php echo $comptxt; ?><br><br></td>
                </tr>
                <tr>
                  <td width="634" height="22"><font size="4"><b><u>Pathological; Investigations :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="22" colspan="3"><?php echo $pathtxt; ?><br><br></td>
                </tr>
                <tr>
                  <td width="634" height="22"><font size="4"><b><u>Clinical Details :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="33" colspan="3"><?php echo $clitxt; ?><br><br></td>
                </tr>
                <tr>
                  <td width="634" height="22"><font size="4"><b><u>Provisional Diagnosis :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="33" colspan="3"><?php echo $protxt; ?><br><br></td>
                </tr>
				<tr>
                  <td width="634" height="22"><font size="4"><b><u>Final Diagnosis :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="33" colspan="3"><?php echo $finaltxt; ?><br><br></td>
                </tr>
				<tr>
                  <td width="634" height="22"><font size="4"><b><u>Occupation :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="33" colspan="3"><?php echo $occu; ?><br><br></td>
                </tr>
				<tr>
                  <td width="634" height="22"><font size="4"><b><u>Admitted By :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="33" colspan="3"><?php echo $admit; ?><br><br></td>
                </tr>
				<tr>
                  <td width="634" height="22"><font size="4"><b><u>Address :</u></b></font></td>
                </tr>
                <tr>
                  <td width="634" height="33" colspan="3"><?php echo $addr; ?><br><br></td>
                </tr>
              </table>
            </div>
            <input type="button" id="cou_btn" value="Print" style="width:100px;"/>