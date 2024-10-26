<?php
include("access.php");
include("config.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
$cl=mysqli_query($con1,"select cust_id,cust_name from customer order by cust_name ASC");
$eng=mysqli_query($con1,"select engg_id,engg_name from area_engg order by engg_name ASC");
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
</head>
<body>
<form name="frm1" method="post" action="<?php $_SERVER['PHP-SELF']; ?>"  enctype="multipart/form-data" align="center">
	<h2 class="style1" align="center">Customer</h2>
	<table border="3" align="center"><tr><td>
	
		
			  <select name="cid" id="cid"  ><option value="">select Client</option>
			   <?php
			   
				while($clro=mysqli_fetch_row($cl))
				{ 
				?>
				   <option value="<?php echo $clro[1]; ?>"<?php if(isset($_POST['cid']) && $_POST['cid']==$clro[1]){ echo "selected"; }  ?> ><?php echo $clro[1]; ?></option>
				   
			   <?php
			    	} 
			    ?>   </select></td>
			    <td>
			    
	
		
			  <select name="eid" id="eid"  ><option value="">select Engineer</option>
			   <?php
			   
				while($engro=mysqli_fetch_row($eng))
				{ 
				?>
				    <option value="<?php echo $engro[1]; ?>"<?php if(isset($_POST['eid']) && $_POST['eid']==$engro[1]){ echo "selected"; }  ?> ><?php echo $engro[1]; ?></option>
				   
			   <?php
			    	} 
			    ?>   </select></td>
			     <td>
			  <input type="submit" name="sub" id="sub" value="Submit" >
			   </td>
			    </tr>
			    </table>
			    </form>
			    </body>
			   

<?php
	if(isset($_POST['sub']))
				 {
				 $engname=$_POST['eid'];
				 $client=$_POST['cid'];
				$qry=mysqli_query($con1,"Insert into custme(engineer,client)values('".$engname."','".$client."'); ");
				 }
				 ?>