<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
include('template_clinic.html'); 
include('config.php');

$sql="select * from patient where name<>'' order by name ASC";
$result=mysql_query($sql);
?>
<style>
td{border:none;}
</style>



<script type='text/javascript'>

function diagvalidate(diagform){

 with(diagform)

 {


if(cat.value=="0")
{
	alert("Please Enter Diagnosis Name");
	cat.focus();
	return false;
}

if(appdate.value=="")
{
	alert("Please select Date");
	appdate.focus();
	return false;
}

if(type.value=="0")
{
	alert("Please select Type");
	return false;
}

if(repo.value=="0");
{
	alert("Please select Report");
	return false;
}

}

 return true;

 }

<!--end validation-->



function type1()

{

var xmlhttp;

if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

	//alert(xmlhttp.responseText);

    document.getElementById("rep").innerHTML=xmlhttp.responseText;

    }

  }

 

  var str= document.getElementById("type").value;

 // alert(str);

xmlhttp.open("GET","type.php?type="+str,true);

//alert("type.php?type="+str);

xmlhttp.send();

}

//////////////////////////finding

function finding1()

{

var xmlhttp;

if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }

xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

	//alert(xmlhttp.responseText);

    document.getElementById("sym").innerHTML=xmlhttp.responseText;

    }

  }

 

  var str= document.getElementById("type").value;

 var str1= document.getElementById("report").value;

 // alert(str);

xmlhttp.open("GET","finding.php?type="+str+"&fd="+str1,true);

//alert("type.php?type="+str);

xmlhttp.send();

}

</script>





               <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Diagnosis</p><br>

             
                <form method="post" class="signin" action="new_diag.php" name="diag" onSubmit="return diagvalidate(this)">

                <fieldset class="textbox">

				<table width="500"><tr><td width="123" height="50">

                <label class="category"><span>Patient Name:</span></label></td>

				<td width="365">

                <select name="cat" id="cat" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <option value="0">Select</option>
                <?php while($row=mysql_fetch_row($result)){
                ?>

                <option value="<?php echo $row[3]; ?>"><?php echo $row[6]; ?></option>
                
             <?php } ?>


       </select>

               </td></tr>

                <tr><td height="50">

            	<label class="name">

                <span>Date:</span></label>

				</td><td>

                <input id="appdate" name="appdate" type="text" onClick="displayDatePicker('appdate');">

               

                </td></tr>

				  <tr><td height="50">

            	<label class="name">

                <span>Type:</span></label>

				</td><td>

               <select name="type" id="type" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;" onchange="type1();">

			   <option value="0">Select</option>

			   <option value="X-RAY">X-Ray</option>

			   <option value="USG">USG</option>

			   <option value="LAB">Lab</option>

			   </select>

               

                </td></tr>

				<tr><td height="50">

                

                <label class="Desc">

                <span>Report:</span></label></td>

				<td>

               <div id="rep"><select name="repo" id="repo" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;" onchange="finding1();">

			   <option value="0">Select</option>

			   </select></div>

                </td></tr>

				<tr>


                <td height="50">

                <label class="sym">

                <span>Finding:</span></label></td>

				<td>

                <textarea name="sym" id="sym" cols="26" rows="4" style="resize:none;border:1px #ac0404 solid;"></textarea>

                </td>

                </tr></table>

                <button class="submit formbutton" type="submit">Submit</button>

                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>

                       

                </fieldset>

          </form>


    


