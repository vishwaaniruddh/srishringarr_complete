<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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

</head>

<body>
<input type="button" id="cou_btn" value="Print" style="width:100px;"/>
 <div id="cou_box">
 <br><br><br><br><br><br><br><br><br><hr>
<table width="1102"  border="1" id="results" cellpadding="4" cellspacing="0" style="text-transform:uppercase;font-size:13px;">
  
       
                   <tr> <td width="45" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
          <td width="172" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name </td>
          <td width="99" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="120" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
		    <td width="113" style="color:#ac0404; font-size:14px; font-weight:bold;">Date</td>
			  <td width="126" style="color:#ac0404; font-size:14px; font-weight:bold;">Waiting Date</td>
          <td width="99" style="color:#ac0404; font-size:14px; font-weight:bold;">Number of days</td>
          
</tr>

<?php
include('config.php');

$query ="select * from surgery_wait where waiting='Yes'";

$result = mysql_query($query) or die(mysql_error());

while($row= mysql_fetch_row($result))
{
$result1 = mysql_query("select * from patient where no='$row[1]'");
$row1=mysql_fetch_row($result1);	 
?>
<tr> <td  width='45'><?php echo $row[0]; ?></td>
     <td  width='172'> <?php  echo $row1[6]; ?></td>
    <td  width='99'> <?php  echo $row1[23]; ?></td>
    <td  width='120'> <?php  echo $row1[18]; ?></td>
	 <td  width='113'><?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?></td>
	  <td  width='126'><?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>
     <td  width='99'> <?php  echo $row[3]; ?></td>
     
    
    </tr>



	<?php
			
		}
		
	?></table>
    </div>
            
</body>
</html>