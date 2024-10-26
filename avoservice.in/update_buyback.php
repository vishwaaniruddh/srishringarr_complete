<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
$brmain=$_SESSION['branch'];

$srno=mysqli_query($con1,"select `srno` from login where `username`='".$_SESSION['user']."'");
$srno1=mysqli_fetch_row($srno);
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>

.modal1{
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content1 {
    margin: auto;
    height: 30%;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
left: 0;
    top: 0;
 background-color: #4D9494; 
}


</style>


</head>
<body>

<form action="update_buyback_process.php" method="post" onSubmit="return validation()">

<div class="row">
<div class="col-sm-6" >
<label for="" style="margin-left: 126px;">date:</label>
</div>
<div class="col-sm-6">
<input type="hidden" name="invoiceId" id="invoiceId"  value="<?php echo $_GET['id'];?>"  required/>
<input type="text" name="todt" id="todt" onkeypress="return runScript(event)" style="margin-left: 126px;" readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date" required />
</div>
</div>

<br/>
<div class="row">
<div class="col-sm-6">
  <label for="comment" style="margin-left: 126px;">Buy Back Collected:</label>
  </div>
  
<div class="col-sm-6">
  <textarea class="form-control" rows="15" id="comment" name="comment" style="margin-left: 126px;"></textarea>
</div>
</div><br/><br/>
<input type="submit" value="submit" style="margin-left: 175px;">
</form>
</body>
</html>

<script>

function validation(){

 var todt=document.getElementById("todt").value;
 var comment=document.getElementById("comment").value;
 
		 if(todt==""){
		 alert("Please Select Buy Back Date");
		 return false;
                 }else if(comment==""){
			alert("Please Enter Buy back details ");
			return false;
			}else{
			return true;
			}
			
			
}


</script>