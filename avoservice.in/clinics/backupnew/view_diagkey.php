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
function confirm_deleteaction(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_diagkey.php?id="+id;
  }
}
</script>



	<div id="site_title_bar">
    
   	 
        
             <?php include("header_clinic.php")?> <!--end of site title-->
            



       <!--View action plan-->
<?php 
include('config.php');
$result66 = mysql_query("select * from keyword where name<>'' order by name ASC");

?>


    
                <h2>View Diagnosis Keyword</h2>
                
      <table width="913" class="se"><tr><td width="563" height="154">                   
                
			  <table>
          <!--<tr>
		  <td><input type="text" id="name" name="name" placeholder="search by Name" style="border:1px #000 dashed;height:25px;"/></td>
		  </tr>-->
		  </table>
			  <div id="complaint">
				<table width="520" border="1" id="results" style="font-size:13px; text-transform:uppercase;">   
               
                
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                <th width="80" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                <th width="80" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
                       
                <?php while($row66=mysql_fetch_row($result66))
{  
?>
	<tr>
    
    
	<td width="338"> <?php echo $row66[0]; ?></td>
    <td> <a href='edit_diagkey.php?id=<?php echo $row66[1]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deleteaction(<?php echo $row66[1]; ?>);"> Delete </a></td>
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





<td width="338">
<form method="post" class="signin" action="new_diagkey.php"  >
                <fieldset class="textbox">
                <p>Add New Diagnosis Keyword</p>
                
            	<label class="name">
                <span>Diagnosis Keyword :</span>
                <input type="text" name="act" id="act">
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
    



