<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
include('config.php');
include('template_clinic.html'); 
?>
<script>
//////Add New City////////
function newcity()
{
	var city=document.getElementById('city');
	var val=city.options[city.selectedIndex].value;
	if(val=='Other'){
	//alert("hi");
	var tableName1 = document.getElementById("sub");
	var newtr1 = document.createElement("TR");
	var newName1 = document.createElement("TD");
	newName1.setAttribute("colspan", "2");
	newName1.innerHTML="<input type='text'  name='ncity' id='ncity' placeholder='New City'>";
	newtr1.appendChild(newName1);
	tableName1.appendChild(newtr1);
	}
}
</script>
<style>
 td{border:none;}
</style>

<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<div class="M_page">
         <form method="post" class="signin" action="new_directory.php" onSubmit="return telvalidate(this)" name="telform"> 
                <fieldset class="textbox">
                <legend><h1><img src="ddmenu/phone_directory.png" height="50" width="50">Telephone Directory</h1></legend>
                <table id="sub">
                <tr>
                <td><label>Name:</label></td>
                <td> 
                <input id="name" name="name" type="text"  >
                </td></tr>
                
                <tr><td>
                 <label>Address:</label></td>
                 <td><textarea name="add" cols="26" rows="3" ></textarea>
                </td></tr>
                 
                <tr>
                <td><label>City.:</label></td>
                <td>
               <select name="city" id="city"  onchange="newcity()">
                <option value="MUMBAI">MUMBAI</option>
                <?php $city=mysql_query("select * from city where name<>'' order by name ASC");
				while($city1=mysql_fetch_row($city)){
				?>
				
                <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                <?php } ?>
                 <option value="Other">OTHER</option>
                </select>
                </td></tr>
                
                <tr>
                <td><label>Contact No.:</label></td>
                <td>
                <input id="cn" name="cn" type="text">
                </td></tr>
                 
                <tr><td><label>Pincode:</label></td>
                <td><input id="pin" name="pin" type="text">
                </td></tr>
                
                <tr><td><label>Information For:</label></td>
                <td><select name="info" >
				<option value="0">Select</option>
                <option value="Patient">Patient</option>
                <option value="Doctor">Doctor</option>
                </select>
                </td></tr>
          
                <tr><td><button class="submit formbutton" type="submit">Submit</button>
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                                       </td></tr></table>
                </fieldset>
          </form>
          </div>
