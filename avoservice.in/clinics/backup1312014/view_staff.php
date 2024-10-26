<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 include('config.php');
?>

<!--Datepicker-->

<script>


function confirm_deletestaff(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_staff.php?id="+id;
  }
}
</script>


<!-- end multiple selection -->


<style>
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

/* You can customize to your needs  */
.login-popup{
	
	background: #00a4ae;
	
	border: 2px solid #ac0404;
	
	font-size: 1.2em;
	position: relative;
	margin:auto; width:1200px;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close { Position the close button
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#fff; 
	font-size:13px; 
	line-height:18px;
} 

form.signin .textbox input{ 
	background:#fff; 
	border-bottom:1px solid #ac0404;
	border-left:1px solid #ac0404;
	border-right:1px solid #ac0404;
	border-top:1px solid #ac0404;
	color:#000; 
        border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:300px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

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

form.signin td{ font-size:12px; }
#banner_box .button a {
	margin: 0 auto;
	background: url(images/button_02.png) no-repeat;
}
#banner_box .button a:hover {
	color: #f8e836;
}
#site_title_bar_wrapper_outter {
	width: 100%;
	height: 50px;
	margin: 0 auto;
	background: url(images/header_bg_wrapper_outter.gif) top repeat-x;
}

td{ padding:0 5px;}

.pg-normal {
                color: black;
                font-weight: normal;
                text-decoration: none;    
                cursor: pointer;    
            }
            .pg-selected {
                color: black;
                font-weight: bold;        
                text-decoration: underline;
                cursor: pointer;
            }


</style>
<link href="style1.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Health Clinic</title>
<script type="text/javascript" src="paging.js"></script>
</head>

<div id="site_title_bar_wrapper_outter">
<div id="site_title_bar_wrapper_inner">

	<div id="site_title_bar">
    
   	 
        
            <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div><!--end of site title-->
            
               
    <a href="home.php"> <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button></a>&nbsp;&nbsp;&nbsp;    <button class="submit formbutton" type="button" onClick="javascript:location.href = 'logout.php';">Log Out</button>


           
    
        
          <!--Start of view staff-->


<?php 
$result = mysql_query("select * from staff");
?>

        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center" id="staff">Staff's Records</p>
          
        
        
          <table width="1027"  border="1" style="border:2px #ac0404 solid;" id="st"> 
          
          <th width="151" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Full Name</th>
		  <th width="70" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Gender</th>
          <th width="48" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Age</th>
          <th width="90" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Contact </th>
          <th width="194" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Address</th>
		  <th width="130" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Post</th>
		  <th width="84" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Daily Hours</th>
		  <th width="94" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Basic Salary</th>
		  <th width="51" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Edit</th>
		  <th width="49" style="color:#ac0404; font-size:14px; font-weight:bold;padding:0 5px;" align="left">Delete</th>
            <?php while($row=mysql_fetch_row($result))
{  ?>

	<tr>
    
	<td> <?php echo $row[0]; ?></td>
    <td> <?php echo $row[3]; ?></td>
    <td> <?php echo $row[1]; ?></td>
    <td> <?php echo $row[5]; ?></td>
    <td> <?php echo $row[4]; ?></td>
	<td> <?php echo $row[15]; ?></td>
	<td> <?php echo $row[14]; ?></td>
	<td> <?php echo $row[16]; ?></td>
	<td><a href='edit_staff.php?id=<?php echo $row[20]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletestaff(<?php echo $row[20]; ?>);"> Delete</a></td>
	<?php } ?>
    </tr>
    </table>
   <div id="pageNavPosition"></div>
          <script type="text/javascript">
        var pager = new Pager('st',5); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
    </script>     

	
<!--End of view staff-->
    



    </div> 
	<!-- end of site_title_bar  -->
    
</div> <!-- end of site_title_bar_wrapper_inner -->
</div> <!-- end of site_title_bar_wrapper_outter  -->

</html>
<?php 
}else
{ 
 header("location: index.html");
}
?>
