<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");
 
include('config.php');

?>
<link href="view_master.css" rel="stylesheet" type="text/css" />


<style>


</style>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="paging.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function confirm_deleteaction(id)
{
	//alert(id);
if(confirm("Are you sure you want to delete this entry?"))
  {
	  
    document.location="delete_user.php?id="+id;
  }
}
</script>

<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />


	<div id="site_title_bar">
    
   	 
        
            <?php //include("header_clinic.php")?><!--end of site title-->
            



       <!--View action plan-->
<?php 
include('config.php');
$result66 = mysql_query("select * from login where status='1'");

?>

                <h2>Add New User</h2>
                
      <table width="913" class="se"><tr><td width="563" height="154">                   
                
			  <table>
          <!--<tr>
		  <td><input type="text" id="name" name="name" placeholder="search by Name" style="border:1px #000 dashed;height:25px;"/></td>
		  </tr>-->
		  </table>
			  <div id="complaint">
				<table width="520" border="1" id="results" style="font-size:13px; text-transform:;">   
               
                
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">User Name</th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Password</th>
                <th width="80" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                <th width="80" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
                       
                <?php while($row66=mysql_fetch_array($result66))
{  
?>
	<tr>
	<td width="338"> <?php echo $row66[0]; ?></td>
    <td width="338"> <?php echo $row66[1]; ?></td>
    <td> <a href='edit_user.php?id=<?php echo $row66[0]; ?>'>Edit </a></td>
    <td> <a href="javascript:confirm_deleteaction('<?php echo $row66[0]; ?>');"> Delete </a></td>
    <!--<td> <a href="javascript:confirm_deleteaction(<?php// echo $row66[5]; ?>);"> Delete </a></td>-->
    </tr>
    <?php } ?>
               
    
 </table></div></td>
 
 
	   <script>
$("#name").keyup(function(){ 
  $.post("userCompsearch.php",
  {
    name:$("#name").val(),
	
	
  },
  function(data,status){
   
	$("#complaint").html(data);
  });
});
</script>
			
 
 
 
             <div id="pageNavPosition"></div>
          <script type="text/javascript">
        var pager = new Pager('results',10); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
    </script>    
<script>
	
function formValidation()
{
	

		
if(document.getElementById('act').value=='')
{
	alert("Please Enter Your User Name");
	document.getElementById('act').focus();
	return false;
}

if(document.getElementById('pass').value=='')
{
	alert("Please Enter Your Password");
	document.getElementById('pass').focus();	
	return false;
}
if(document.getElementById('dept').value=='')
{
	alert("Please Select Designation");
	document.getElementById('dept').focus();	
	return false;
}


} 
	</script>
<!--End of View Complaint-->





<td width="338">
<form method="post" class="signin" action="new_user.php" onsubmit="return formValidation()" >
                <fieldset class="textbox">
                <p>Add New User</p>
                
            	<label class="name"> <span>User Name :</span><input type="text" name="act" id="act">
                
                <label class="pass"> <span>User Password :</span><input type="text" name="pass" id="pass">
                <select name="dept" id="dept" required>
                	<option value="">Select Designation</option>
                	<option value="1">Admin</option>
                	<option value="2">Users</option>
                	<option value="3">Pharmacy</option>
                	<option value="4">CHC</option>
                	<option value="5">DOC</option>
                </select>
                
                </label>
                
                <button class="submit formbutton" type="submit">Add User</button>
                <button type="reset" class="submit formbutton">Reset</button>
                       
                </fieldset>
          </form>
</td></tr>


    
     <tr>
     <td>
     <a href="masters.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'masters.php';">Go Back</button></a>
    
     <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Home</button></a>
     </td>
     </tr>
     </table>
</div> 
	<!-- end of site_title_bar  -->
    