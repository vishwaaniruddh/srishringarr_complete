<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');


?>
<link href="style1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-1.4.2.js"></script>

<!-- Staff validation-->
 <script>
 
function staffvalidate(staffform){
 with(staffform)
 {
  

if(fname.value=="")
{
	alert("Please Enter Name");
	fname.focus();
	return false;
}
 
 if(dob4.value=="")
{
	alert("Please select Birth Date");
	dob4.focus();
	return false;
}

if(add.value=="")
{
	alert("Please Enter Address");
	add.focus();
	return false;
}

if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please enter Telephone No. to continue.");
cn.focus();
return false;
}

if(post.value=="")
{
	alert("Please enter Post");
	post.focus();
	return false;
}

if(bsal.value=="")
{
	alert("Please enter Basic Salary");
	bsal.focus();
	return false;
}

}
 return true;
 }
<!--end validation-->
</script>

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

	padding: 10px; 	

	border: 2px solid #ac0404;

	float: left;

	font-size: 1.2em;

	position: fixed;

	top: 1%; left: 35%;

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

	color:#000; 

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

	width:270px;


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

</style>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<!--Telephone Directory validation-->

<div id="site_title_bar_wrapper_outter">
<div id="site_title_bar_wrapper_inner">

	<div id="site_title_bar">
    
   	 
        
            <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div><!--end of site title-->
            
<?php 

$result = mysql_query("select staff_id,name from staff where name<>''");
?>
      

  <form method="post" class="signin" action="leave_report.php" >
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;">Leave Report</p><br>

			    <table width="369">
            	<tr>
                <td width="84" height="50"><label class="Date">From Date:</label></td>
                <td width="273"><input id="frmdate" name="frmdate" type="text" onclick="displayDatePicker('frmdate');">
                </td>
                </tr>
                
                <tr>
                <td height="50"><label class="Date">To Date:</label></td>
                <td><input id="todate" name="todate" type="text" onclick="displayDatePicker('todate');">
                </td>
                </tr>                
                
                <tr>
                <td height="50"><label class="name"> Name: </label></td>
                <td><select name="name" id="name" style="width:270px;height:27px;border:1px #ac0404 solid;">
                <?php while($row=mysql_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>
                
                <tr>
                <td height="50">
                <label id="remarks">Remarks:</label></td>
                <td> <textarea id="remarks" name="remarks" style="resize:none;border:1px #ac0404 solid;" rows="3" cols="31"></textarea></td>
                </tr>
                
                <tr>
                <td><button class="submit formbutton" type="submit">Submit</button> </td>
                <td> <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a></td>
                </tr>
                
                </table>
                </fieldset>
                </form>
</div> 
	<!-- end of site_title_bar  -->
    
</div> <!-- end of site_title_bar_wrapper_inner -->
</div> <!-- end of site_title_bar_wrapper_outter  -->


<?php 
}else
{ 
 header("location: index.html");
}

?>