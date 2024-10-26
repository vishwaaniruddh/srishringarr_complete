<?php 
include('config.php');
session_start();

$id=$_GET['id'];
$sql="select * from compla where id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>

<style>

</style>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<link href="view_master_edit.css" rel="stylesheet" type="text/css" />
<link href="view_master.css" rel="stylesheet" type="text/css" />



	<div id="site_title_bar">
    
   	 
        
             <?php include("header_clinic.php")?><!--end of site title-->

           <h2>Edit Complaint</h2> 
       
          <form method="post" class="signin" action="update_complaint.php" onSubmit="return docvalidate(this)" name="docform"><br>
                <fieldset>
                
                
                <label class="id">
                 ID : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <input id="compid" name="compid" type="text" readonly = readonly;  value="<?php echo $row[1]; ?>">
                </label> <br />
                
            	<label class="name">
                 Name : 
                 <input id="compname" name="compname" type="text"  value="<?php echo $row[0]; ?>">
                </label><br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="submit formbutton" type="submit">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'viewcomplain.php';">Cancel</button>
                     
                </fieldset>
          </form>
</div> 
	<!-- end of site_title_bar  -->
    
