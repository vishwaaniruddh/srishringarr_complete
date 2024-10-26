<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include 'config.php';
date_default_timezone_set('Asia/Calcutta');
$id=$_GET['id'];$did=$_GET['did'];
$sql="select * from  patient where no='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);
$sql1="select * from  doctor where doc_id='$did'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);
?>
<div id="maindiv" >  
<DIV><TABLE><TR><TD><IMG src="images\logo.jpg" height="100" width="250" /></TD><TD align="center"><div align="center"><b>SAI NAMAN HOSPITAL
 </b> </div>
<p align="center"> Run By : Sai Naman Hospital <BR>G.E. ROAD, BHILAI - 490 012 (C.G.)<BR>PHONE: 0788- 4051001 , 4051002 </p>
</TD></TR></TABLE></DIV>
<hr>
<p align="right">Date :<?php echo date("d-m-Y"); ?>   </p>
<p align="left">Patient ID :<?php echo $id; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!--Type:<?php echo $row[16]; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--> Doctor : <?php echo $row1[1]; ?> </p>
<p align="left">Patient Name :<?php if(isset($row[6])) {echo $row[6];} ?>  &nbsp;&nbsp;&nbsp; Sex :<?php echo $row[27]; ?>  &nbsp;&nbsp;&nbsp; Age :<?php echo $row[26]; ?> </p>
<p align="left">Address :<?php echo $row[20]; ?>   </p>
</div>
<p align="center"><a href="#" onclick="divprint()" >print</a></p>
<p align="center"><a href="home.php"  >back</a></p>
<script >
function divprint(){
var data = document.getElementById('maindiv').innerHTML;
//alert(data);
var mywindow = window.open('', 'SNH', 'height=400,width=600');
        mywindow.document.write('<html><head><title>my div</title>');       
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
		}
</script>
<?php } ?>