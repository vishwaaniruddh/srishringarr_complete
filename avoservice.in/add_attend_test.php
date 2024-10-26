<?php
include("access.php");
 $br=$_SESSION['branch'];
 //echo $br;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<script>


//================================get eng. branch wise======================

 function showbranch(d) {
	//alert(d);
	document.getElementById("showmyresul").innerHTML="";		
    document.getElementById("showmyresul").innerHTML ="<center><img src=loader.gif></center>";
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
			//alert("hi");
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		//alert(xmlhttp.responseText);
		
                document.getElementById("showmyresul").innerHTML = xmlhttp.responseText;
            }
        }
		//alert("geteng_branch.php?br_id="+d);
        xmlhttp.open("GET","geteng_branch.php?br_id="+d,true);
        xmlhttp.send();
    
}

  	
//============================== Validation Here===================================

function validation(){
	//alert("hii");
	
	 var eng_ckbox = document.getElementsByClassName('eng_ckbox'); 
   for ( i = 0; i < eng_ckbox.length;i++) {
	   
      if(eng_ckbox[i].checked==false)
     {
	 alert("Please Select Eng. in Row Number "+(i+1));
	 eng_ckbox[i].focus(); 
	 return false; 
	}
	
  }//for loop
	
  if(confirm('Are you sure you want to Enter today Attendence Entry.')) 
   {
    return true;
   }
   else 
   {
    return false;
}  
}//end of function show
		
</script>

<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2 class="h2color">Add Engineer Attendence</h2>
 
 								<h3 style="color:red;">
                                    <?php
                                    	if(isset($_GET['success'])){
											echo $_GET['success'];
										}
										
										if(isset($_GET['attend'])){
											echo $_GET['attend'];
										}
									?>
                                    </h3>
<!--<button>
<a href="javascript:void(0);" onclick="newwin('createActivity.php','display',500,500)">
  Create Activity</a>
  </button>-->

<form action="attend_processtest.php" method="post" name="engform" enctype="multipart/form-data" id="engform" onsubmit="return validation();">

 <input type="hidden" value="0"  name="counter" id="counter">
 
  	
          <table>
                      
                           
           		<?php 
				//echo $brme;
				if($br=='all') {?>
                 <tr>
                   <th colspan="4">
                    <select name="statewise" id="statewise" onchange="showbranch(this.value);">
                    <!--<option value="">Select Branch</option>-->
					<?php		
					
						$mainbranch=mysqli_query($con1,"select * from `avo_branch`");
						while($mainbranch1=mysqli_fetch_row($mainbranch)){
					
						?>
						<option value="<?php echo $mainbranch1[0]; ?>"><?php echo $mainbranch1[1]; ?></option>
						<?php
							}
							?>
            		</select>
                   
                   </th> </tr> 
				   <?php } 
				   else if(strpos($br, ',')){
				        $brs=explode(',',$br); ?>
				        <tr>
                   <th colspan="4">
                    <select name="statewise" id="statewise" onchange="showbranch(this.value);">
                    <!--<option value="">Select Branch</option>-->
					<?php		
											
						for($i=0;$i<count($brs);$i++){
						$mainbranch=mysqli_query($con1,"select name from `avo_branch` where id=".$brs[$i]);
						$mainbranch1=mysqli_fetch_row($mainbranch);					
						?>
						<option value="<?php echo $brs[$i]; ?>"><?php echo $mainbranch1[0]; ?></option>
						<?php
							}
							?>
            		</select>
                   
                   </th> </tr>
				   
			<?php 	   }
			else {
				  ?>
				        <tr>
                   <th colspan="4">
                    <select name="statewise" id="statewise" onchange="showbranch(this.value);">
                    <!--<option value="">Select Branch</option>-->
					<?php		
																	
						$mainbranch=mysqli_query($con1,"select name from `avo_branch` where id=".$br);
						$mainbranch1=mysqli_fetch_row($mainbranch);					
						?>
						<option value="<?php echo $br; ?>"><?php echo $mainbranch1[0]; ?></option>
						
            		</select>
                   
                   </th> </tr>
				   
			<?php 	   }
				   ?> 
				   <tr>
                   <th><input type="text" name="mis_date" id="mis_date" style="color:red; font-size:12px; font-weight:bold;" class="misdate" readonly="readonly" value="<?php echo date('d-m-Y'); ?>"  onClick="displayDatePicker('mis_date');" onblur="showoldrec(this.value);"  ></th>  <th colspan="3">Attendence</th>
                                     
              </tr>           				              
                         </table>            
              <div id="showmyresul">					                         
              
               		<table>
                  
              
               
               
                <tr>
                  <th>Eng Name </th>
                  <th>Present</th>
                  <th>Leave</th>
                  <th>Absent</th>                    
              </tr>
     				<input type="hidden" name="theValue" id="theValue" value="1"/>
      				<input type="hidden" name="myval" id="myval" value=""/>
                                                <?php 
									 		//==============SELECT STATE ID FROM STATE TABLE=====================================
													if($br=='all'){
														//echo "select * from `area_engg` WHERE `status` = '1' and area='1' ";
														$sql_eng=mysqli_query($con1,"select * from `area_engg` WHERE `status` = '1' and area='1' ");
													}else if(strpos($br, ',')){
				        $brs=explode(',',$br); 
				        $sql_eng=mysqli_query($con1,"select * from `area_engg` WHERE `current_area`=".$brs[0]." AND `status` = 1 order by `engg_name` ");
													
													}else{
														//echo "select * from `area_engg` WHERE `area` = '".$br."' AND `status` = 1 order by `engg_name` ";
														$sql_eng=mysqli_query($con1,"select * from `area_engg` WHERE `current_area`=".$br." AND `status` = 1 order by `engg_name` ");
														}
													
													$cnt=0;
													while($eng_name1=mysqli_fetch_row($sql_eng)){	
																						
												?>
                                                	
                    
                             <tr>
                                    
                                 <!--=============Eng Name======-->                                             
 								<td>
                                <input type="checkbox" class="eng_ckbox" name="eng_ckbox[<?php echo $cnt;?>]" id="eng_ckbox" value="" />
                                <input type="text" name="engname[]" id="engname" value="<?php echo $eng_name1[1]; ?>" readonly="readonly"/> </td>                                                                                                     
                                <!-- === present===--->                      							  
                                <td><input type="radio" name="attend[<?php echo $cnt;?>]" id="attend" value="p" />	 </td>              
                             	 
                                <!-- ===Leave===--->                                 
                                <td><input type="radio" name="attend[<?php echo $cnt;?>]" id="attend" value="l" /></td>	
                                
                                
                                <!-- ===Absent===--->
                               <td><input type="radio" name="attend[<?php echo $cnt;?>]" id="attend" checked="checked" value="a" />	 </td>
                             
                                
                                                            
                              </tr>
                                       
                            <?php  $cnt++;
							
							} ?>  
                            
                        
                        
                                  
                     </table>        
                           </div>                   
                       	               
                                      
                         <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $br ; ?>">	              
                      <table><tr><td colspan="9" align="center"><input type="submit"  value="SUBMIT"> </td></tr> </table>                
                                                                 
                                     
				</form>

</center>
</body>
</html>