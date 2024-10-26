<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
include('template.html');
include('config.php');

$sql="select * from patient where name<>'' order by name ASC";
$result=mysql_query($sql);

$sql12="SELECT * FROM  `diagnose` where d_id='$id'";
$result12=mysql_query($sql12);
$row12=mysql_fetch_row($result12);
?>


<style>
td{border:none;}
</style>



<script type='text/javascript'>



function diagvalidate(diagform){

 with(diagform)

 {


if(name.value=="")

{
	alert("Please Enter Diagnosis Name");
	name.focus();
	return false;
}

if(appdate.value=="")
{
	alert("Please select Date");
	appdate.focus();
	return false;
}

if(cat.value=="")
{
	alert("Please select category");
	return false;
}

if(report.value=="")
{
	alert("Please select report");
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

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<script language="javascript" type="text/javascript">

///dob
window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dob",
			dateFormat:"%d/%m/%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		no();
	};
</script>
<link href="jsDatePick_ltr.min.css" rel="stylesheet" type="text/css" />
<script src="jsDatePick.min.1.3.js" type="text/javascript" charset="utf-8"></script>


<body onload="createList();">

    
       

         <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Edit Diagnosis</p>

             


                <form method="post" class="signin" action="update_diag.php" name="diag" onSubmit="return diagvalidate(this)">

                <fieldset class="textbox">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<br /><table><tr><td height="38">

               Patient Name:</td>

				<td>

                <select name="cat" id="cat" style="width:235px;height:26px;border:1px #ac0404 solid;">
 <?php while($row=mysql_fetch_row($result)){
                ?>

                <option value="<?php echo $row[3]; ?>" <?php if($row12[0]==$row[3]){ echo "selected"; }?>><?php echo $row[6]; ?></option>
                
             <?php } ?>
		</select>

               </td></tr>

                <tr><td height="35">

            	Date:

				</td><td>

<input id="appdate" name="appdate" type="text" onClick="displayDatePicker('appdate');" value="<?php if(isset($row12[2]) and $row12[2]!='0000-00-00') echo date('d/m/Y',strtotime($row12[2])); ?>">

               

                </td></tr>

				  <tr><td height="35">

            	Type:

				</td><td>

               <select name="type" id="type" style="width:235px;height:26px;border:1px #ac0404 solid;" onchange="type1();">

			   <option value="X-RAY" <?php if($row12[3]=="X-RAY"){ echo "selected"; }?>>X-Ray</option>

			   <option value="USG" <?php if($row12[3]=="USG"){ echo "selected"; }?>>USG</option>

			   <option value="LAB" <?php if($row12[3]=="LAB"){ echo "selected"; }?>>Lab</option>

			   </select>

               

                </td></tr>

				<tr><td height="61">

                

                Report:</td>

				<td>

               <div id="rep"><select name="report" id="report" style="width:235px;height:26px;border:1px #ac0404 solid;" onchange="finding1();">

			   <option value="<?php echo $row12[4]; ?>"><?php echo $row12[4]; ?></option>

			   </select></div>

                </td></tr>

				<tr>

                <td height="61">

                Finding:</td>

				<td>

                <textarea name="sym" id="sym" cols="26" rows="4" style="resize:none;border:1px #ac0404 solid;"><?php echo $row12[5]; ?></textarea>

                </td>

                </tr></table>

                <button class="submit formbutton" type="submit">Submit</button>

                <a href="view_diag.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_diag.php';">Cancel</button></a>

                       

                </fieldset>

          </form>



<?php 
include('footer.html');
}else
{ 
 header("location: index.html");
}

?>