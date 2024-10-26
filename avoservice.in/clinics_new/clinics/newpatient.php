<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

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
	margin:auto; width:1100px;
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


</style>
<script>
	function validate()
{
	
	var fname=document.getElementById('fname').value;
	var age=document.getElementById('age').value;
	var dob=document.getElementById('dob').value;
	var cn=document.getElementById('cn').value;
	var charges=document.getElementById('charges').value;
	
	if(fname.trim()=="")
	{
		
		alert("Enter Name");
		document.getElementById('fname').focus();
		return false;
	}
	else if(age.trim()=="")
	{
		
		alert("Enter Age");
		document.getElementById('age').focus();
		return false;
	
	
	}
	else if(dob.trim()=="")
	{
		
		alert("Enter Birth date");
		document.getElementById('dob').focus();
		return false;
		
	}
	else if(cn.trim()=="")
	{
		
		alert("Enter Contact");
		document.getElementById('cn').focus();
		return false;
		
	}
	else if(charges.trim()=="")
	{
		
		alert("Enter Charges");
		document.getElementById('charges').focus();
		return false;
		
	}
	else if(parseFloat(charges.trim())<=0)
	{
		
		alert("Charges must be greater than 0");
		document.getElementById('charges').focus();
		return false;
		
	}
	else{
		
		
		return true;
	}
}
	
</script>
</head>
<body>
<?php 
include 'config.php';

?>

<div id="login-box" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_patient.php" onSubmit="return validate()" name="form" enctype="multipart/form-data">
                
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Patient</p>
                
                <p align="right"><input id="cdate" name="cdate" type="text" value="<?php echo date( "d/m/Y");?>" style="background-color:#00a4ae; border:none; text-align:right;"></p>
                
                <fieldset class="textbox">
                <table>
                
                <tr> 
            	<td><label class="fname"> Full Name: </label></td>
                <td><input id="fname" name="fname" type="text"> </td>
                
                <td><label class="age"> Date of Birth: </label></td>
                <td><input id="dob" name="dob" type="text" onClick="displayDatePicker('dob');"></td>
                </tr>
				
				
	   <!--<script type="text/javascript">
    function ageCount() {
        var date3 = new Date();
		var date1=date3.format("dd/mm/yy");
		alert(date1);
        var  dob= document.getElementById("dob").value;
        var date2=new Date(dob);
        var pattern = /^\d{1,2}\/\d{1,2}\/\d{4}$/; //Regex to validate date format (dd/mm/yyyy)
        if (pattern.test(dob)) {
			alert(dob);
            var y1 = date1.getFullYear(); //getting current year
			
            var y2 = date2.getFullYear(); //getting dob year
			
            var age = y1 - y2;           //calculating age 
           document.getElementById("age").value= age;
            return true;
        } else {
            alert("Invalid date format. Please Input in (dd/mm/yyyy) format!");
            return false;
        }

    }
</script>-->    
                <tr>
                <td><label class="gender"> Gender: </label></td>
                <td><font color="#FFFFFF"> Male: </font><input name="gen" id="gen" type="radio"  checked="checked" value="M" style="width:20px;" checked/>
                    <font color="#FFFFFF"> Female: </font><input name="gen" id="gen" type="radio" value="F" style="width:20px;"/>
                </td>
                
                <td><label class="age"> Age: </label></td>
                <td><input id="age" name="age" type="text" ></td>
                </tr>
                                
                <tr>
                <td><label class="cn">Contact No.:</label></td>
                <td><input id="cn" name="cn" type="text"></td>
                
                <td><label class="bg">Blood Group:</label></td>
                <td>
                <select name="bg" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="Dont Know">Dont Know</option>
                </select>
                </td>
                </tr>
                             
                <tr>
                <td><label class="add">Address:</label></td>
                <td><textarea name="add" rows="3" cols="26" style="resize:none;border:1px #ac0404 solid;"></textarea></td>
                
                <td><label class="city">City :</label></td>
                <td>
                <select name="city" id="city">
                <?php $city=mysqli_query($con,"select * from city");
                
				while($city1=mysqli_fetch_array($city)){
				?>
                <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                <?php } ?>
                </select></td>
                </tr>
                
                <tr>
                <td><label class="height"> Height:</label></td>
                <td><input id="height" name="height" type="text" placeholder= "Enter height in cms"></td>
                
               <!-- <td><label class="timegiven"> Time Given:</label></td>
                <td>
                <span>Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour" style="background:#fff;border:1px solid #ac0404;width:60px;height:26px;">
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                <select name="min" style="background:#fff;border:1px solid #ac0404;width:60px;height:26px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </td> -->
                </tr>

               

                
 

                
               
<?php 

$result = mysqli_query($con,"select doc_id,name from doctor");
//var_dump ($result);
$result1 = mysqli_query($con,"select doc_id,name from doctor");
?>
            
                <tr>
             <!--   <td><label class="doc"><span>Doctor:</span></label></td>
                <td><select name="doc" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <?php while($row1=mysqli_fetch_row($result1))
                {  ?>
                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
				<?php } ?>
                </select>
                </td> -->
                
                <td><label class="ref"><span>Doctor:</span></label></td>
                <td><select name="ref" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <?php while($row=mysqli_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                
                </select>
                </td>
                </tr>
                
                <tr>
                <td><label class="height"> Aadhar card:</label></td>
                <td><input id="Aadhaar" name="aadhaar" type="number">
                <?php while($row=mysqli_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[13]; ?>"><?php echo $row[1]; ?></option>
				<?php  } ?>
                
                
                </td>
                </tr>
                
                <tr>
                <td><label class="ms"> Marital Status:</label></td>
                <td><select name="ms" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                </select>
                </td>
                
              <!--  <td colspan="2"> 
                Consultation: <input type="radio"  name="follow" style=" width:40px;" value="Consultation"/> 
                Follow Up: <input type="radio"  name="follow" style=" width:40px;" value="Follow"/></td> -->
                </tr>

                <tr>
                <td><label class="ms"> Hospital Name:</label></td>
                <td>
                <select name="hos" style="background:#fff;border:1px solid #ac0404;width:235px;height:27px;">
                 <option value="SNH">SNH</option>
                <?php 
				/*$hos=mysqli_query($con,"select * from hospital");
				while($hos1=mysqli_fetch_row($hos)){?>
               
                <option value="<?php echo $hos1[0]; ?>"><?php echo $hos1[0]; ?></option>
                <?php }*/ ?>
                </select>
                </td>
                
                <td> 
                Email Id:</td><td> <input type="text"  name="email"  /> 
                </td>
                </tr>
                
               <!-- <tr>
                <td>ESI NO.</td><td><input id="esino" name="esino" type="text" /></td>
                <td>ESI NAME</td><td><input id="esiname" name="esiname" type="text" /></td>               
                </tr>-->
            <!--    
                <tr>
                <td>Diagnosis</td><td><input id="diag" name="diag" type="text" /></td>
                <td>Ref.No</td><td><input id="refno" name="refno" type="text" /></td>
                </tr>
              -->
                <!--<tr>
                <td>Relation with IP</td><td><input id="rel" name="rel" type="text" /></td>
				</TR>-->
				
				<tr>
                <td>Charges</td><td><input id="charges" name="charges" type="text" ></td>
                
                </tr>

				
<!-- <td>Referral Date : </td><td><input id="refd" name="refd" type="text" onClick="displayDatePicker('refd');"/></td> --></tr>
                <tr><td><button class="submit " type="submit" name="Submit">Submit</button> </td>
                </tr>  


				
       <tr><td><button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button>
</td></tr>             
                </table>
                </fieldset>
          </form>
</div></body></html>