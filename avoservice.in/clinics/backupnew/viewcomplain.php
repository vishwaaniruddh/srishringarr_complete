<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header("location: index.html");
 
include('config.php');

?>
<link href="style1.css" rel="stylesheet" type="text/css" />
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<link href="view_master.css" rel="stylesheet" type="text/css" />


<style>


</style>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="paging.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function confirm_deletecomp(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_complaint.php?id="+id;
  }
}
</script>



	<div id="site_title_bar">
    
   	 
        
             <?php include("header_clinic.php")?><!--end of site title-->
            



       <!--View Complaint-->
<?php 
include('config.php');
$result66 = mysql_query("select * from compla");

?>


        

         
                <h2> Complaints</h2>
                
      <table width="956" class="se"><tr><td width="587" height="154">                   
                
			  <table>
          <tr>
		  <td><input type="text" id="name" name="name" placeholder="search by Name" /></td>
		  </tr>
		  </table>
			  <div id="complaint">
				<table width="549" border="1" id="results" style="font-size:13px; text-transform:uppercase;">   
               
                <th style="color:#ac0404; font-size:14px; font-weight:bold;"> ID </th>
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                <th width="54" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                <th width="63" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
                       
                <?php while($row66=mysql_fetch_row($result66))
{  
?>
	<tr>
    
    <td width="68">  <?php  echo  $row66[1]; ?></td>
	<td width="336"> <?php echo $row66[0]; ?></td>
    <td> <a href='edit_complaint.php?id=<?php echo $row66[1]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletecomp(<?php echo $row66[1]; ?>);"> Delete </a></td>
    </tr>
    <?php } ?>
               
    
 </table></div></td>
	   <script>
$("#name").keyup(function(){ 
  $.post("compsearch.php",
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

<!--End of View Complaint-->





<td width="357">
<form method="post" class="signin" action="new_comp.php" >
                <fieldset class="textbox">
                <p>Add New Complaints</p>
                
            	<label class="name">
                <span>Complaint Name :</span>
                <textarea id="compname" name="compname" rows="3" cols="35" style="resize:none;border:1px #ac0404 solid;"></textarea>
                </label>
                
                <button class="submit formbutton" type="submit">Add New</button>
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
    


