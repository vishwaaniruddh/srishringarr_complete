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
<style>
.formbutton { 
	background: -moz-linear-gradient(center top, #ac0404, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#ac0404), to(#dddddd));
	background:  -o-linear-gradient(top, #ac0404, #dddddd);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ac0404', EndColorStr='#dddddd');
	border-color:#ac0404; 
	border-width:1px;
        border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;

        -webkit-border-radius: 4px;
	color:#fff;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:100px;
}
</style>
</head>

<body>
<button type="button" id="cou_btn"  style="width:100px;" class="submit formbutton"/>Print </button>
 <div id="cou_box">
 <br><br><br><br><br><br><br><br><br><hr>
 <h3 align="center">DOCTOR'S LIST </h3>
<table width="1102"  border="1" id="results" cellpadding="4" cellspacing="0" style="text-transform:uppercase;font-size:11px;" align="center">
  
       
                   <tr><th width='50' style='color:#ac0404; font-size:11px; font-weight:bold;'>Doc_id</th>
          <th width='200' style='color:#ac0404; font-size:11px; font-weight:bold;'>Name</th>
          <th width='120' style='color:#ac0404; font-size:11px; font-weight:bold;'>City</th>
          <th width='70' style='color:#ac0404; font-size:11px; font-weight:bold;'>Contact</th>
          <th width='130' style='color:#ac0404; font-size:11px;font-weight:bold;'>category</th>
		  <th width='130' style='color:#ac0404; font-size:11px;font-weight:bold;'>Specialist</th>
          
</tr>

<?php
include('config.php');
if (isset($_GET['name']))
{$name=$_GET['name'];
	$query ="select * from doctor where name like '$name%'order by doc_id ASC";
	}else{
$query ="select * from doctor order by doc_id ASC";
}
$result = mysql_query($query) or die(mysql_error());

while($row= mysql_fetch_row($result))
{
	 
?>
<tr>
    <td><?php echo  $row[0]; ?></td>
	<td width='110'><?php echo  $row[1]; ?></td>
    <td width='105'><?php echo  $row[3]; ?></td>
    <td><?php echo  $row[6]; ?></td>
    <td><?php echo  $row[8]; ?></td>
	 <td><?php echo  $row[9]; ?></td>
    
    </tr>



	<?php
			
		}
		
	?></table>
    </div>
            
</body>
</html>