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
<script type='text/javascript'>

<!--New doc validation-->

function docvalidate(docform){
 with(docform)
 {
  

if(name.value=="")
{
	alert("Please Enter Name");
	name.focus();
	return false;
}

if(city.value=="0")
{
	alert("Please select City");
	city.focus();
	return false;
}

if(cn.value.search(/[0-9]+/)== -1)
  {
alert("Please Enter Contact No. ");
cn.focus();
return false;
}

if(mobile.value=="")
{
	alert("Please enter Mobile No.");
	mobile.focus();
	return false;
}

if(cat.value=="0")
{
	alert("Please select Category");
	cat.focus();
	return false;
}

if(spl.value=="0")
{
	alert("Please selecvt Specialty");
	spl.focus();
	return false;
}
 

if(city.value=="")
{
	alert("Please Enter City");
	city.focus();
	return false;
}

if(email.value.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)==-1)
{
alert("Invalid E-mail Address! Please re-enter.")
email.focus();
return false;
}
<!--end validation-->
}
 return true;
 }
<!--end validation--> 
</script>


<div id="site_title_bar_wrapper_outter">
<div id="site_title_bar_wrapper_inner">

	<div id="site_title_bar">
    
   	 
        
            <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div><!--end of site title-->
            
        

 <form method="post" class="signin" action="new_staffmaster.php"  name="staffform" onsubmit="return staffvalidate(this)">
                
        <p style="color:#ac0404; font-weight:bold; font-size:16px;">New Staff Master</p><br>
                
                <fieldset class="textbox">
                <table width="763">
                
                <tr> 
            	<td width="93"><label class="fname"> Full Name: </label></td>
                <td width="287"> <input id="fname" name="fname" type="text"> </td>
                <td width="86"><label class="gender"> Gender: </label></td>
                <td width="272"><font color="#FFFFFF"> Male: </font><input name="gender" id="gender" type="radio"  checked="checked" value="Male" style="width:20px;"/>
                    <font color="#FFFFFF"> Female: </font><input name="gender" id="gender" type="radio" value="Female" style="width:20px;"/>
                </td>
                </tr>
                               
                <tr>
                <td><label class="dob"> Date of Birth: </label></td>
                <td><input id="dob4" name="dob4" type="text"  onclick="displayDatePicker('dob4');"></td>
                <td><label class="age"> Age: </label></td>
                <td><input id="age" name="age" type="text"></td>
                </tr>
                                
                <tr>
                <td><label class="add">Address:</label></td>
                <td><textarea id="add" name="add" cols="31" rows="3" style="resize: none;border:1px #ac0404 solid;"></textarea></td>
                <td><label class="cn">Contact No.:</label></td>
                <td><input id="cn" name="cn" type="text"></td>
                
                <tr>
                <td><label class="crel">Close Relative: </label></td>
                <td> <input id="crel" name="crel" type="text"> </td>
                <td><label class="rel">Relation: </label></td>
                <td> <input id="rel" name="rel" type="text"> </td>
                </tr>
                
                <tr>
                <td><label class="mem"> Members living in the House: </label></td>
                <td><input id="mem" name="mem" type="text"> </td>
                <td><label class="house" > House: </label></td>
                <td><select name="house" style="width:270px;height:27px;border:1px #ac0404 solid;">
                    <option value="Rented">Rented</option>
                    <option value=""></option>
                    <option value=""></option>
                    </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="kids">Kids Information:</label></td>
                <td><textarea id="kids" name="kids" cols="31" rows="3" style="resize: none;border:1px #ac0404 solid;"></textarea></td>
                <td><label class="relation">Name and Relation of member:</label></td>
                <td><textarea id="relation" name="relation" cols="31" rows="3" style="resize: none;border:1px #ac0404 solid;"></textarea></td>
                </tr>
                
                <tr>
                <td><label class="exp_home">Expenses at home:</label></td>
                <td><input id="amt" name="amt" type="text" ></td>
                <td><label class="sal">Salary Expectations:</label></td>
                <td><input id="sal" name="sal" /></td><td width="1"></textarea>
                </tr>
                
                <tr>
                <td><label class="work">Daily Hours:</label></td>
                <td><input id="work" name="work" /></td>
                <td><label class="post">Post:</label></td>
                <td><input id="post" name="post" /></td>
                </tr>
                              
                <tr>
                <td><label class="basic_salary">Basic Salary:</label></td>
                <td><input id="bsal" name="bsal" /></td>
                <td><label class="ot">OT Rate:</label></td>
                <td><input id="ot" name="ot" /></td>
                </tr>
                                               
                <tr><td><button class="submit formbutton" type="submit">Submit</button></td>
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