<?php
if(isset($_GET['link'])){
$link=$_GET['link'];
}else{ $link="Master";
 }
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
 include('config.php');
 include('template_clinic.html'); 
?>


<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<link href="paging.css" rel="stylesheet" type="text/css" />
<style>
td{border:none;}
</style>
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


        <?php 
		include("newdoctor.php");
		?>

