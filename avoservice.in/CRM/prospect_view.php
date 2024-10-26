<?php session_start();
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
   

    <!-- jQuery library -->

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<script>
    
 function expfunc()
{//alert("hii")

$('#formf').attr('action', 'delegation.php').attr('target','_self');
$('#formf').submit();

   
}   


function toggle(source){
    
    chkboxes=document.getElementsByName('check[]');
    for(var i=0,n=chkboxes.length;i<n;i++){
        chkboxes[i].checked=source.checked;
        
    }
    
}




</script>

</head>
<body class="sidebar-pinned">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> View Prospect
                        </h4>
                        

                    </div>
                </div>
            </div>
        </div>
 <form  method="post" id="formf" action="delegation.php">
        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php include("config.php");
  //  $View="select * from Leads_table where leadEntryef='".$_SESSION['id']."'";
  
  if($_SESSION['usertype']=='Admin' || $_SESSION['usertype']=='Fulfillment Team'  ){
 	  $View="select * from Leads_table where Status!='3' ";
  }else{
      $View="select * from Leads_table where Status!='3' and leadEntryef='".$_SESSION['id']."'";
  }
      $qrys=mysqli_query($conn,$View);

?>                 



<div class="card-body">
     
                               
    <?php  if($_SESSION['usertype']=='Admin'){ ?>
   
                       
                       
                       
                            </div><? } ?>
                       <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th>Full Name</th>
                                        <th>Email-Id</th>
                                        <th>Mobile Number</th>
                                        <th>Office Number</th>
                                        <th>State</th> 
                                        <th>City</th>
                                        <th>Lead Source</th> 
                                        <th>Company</th>
                                        <th>Designation</th>
                                        
                                        
      <?php  if($_SESSION['usertype']=='Admin'){ ?><th>Associate Status</th><?php }?>
                                        <th>Delegate Status</th>
      <?php if($_SESSION['usertype']=='Admin'){ ?><th>Delegate</th> <?php }?>
                                        <th>Edit</th>
      <?php if($_SESSION['usertype']=='Admin'){ ?><th>Convert To Member</th> <?php }?>
                                        
                                       
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                                        	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{

	
	$sql3="select Name from Lead_Sources where SourceId='".$_row['LeadSource']."'";
	$runsql3=mysqli_query($conn,$sql3);
	$sql2fetch3=mysqli_fetch_array($runsql3);
	
	
  ?>
                             <tr>
<td><?php echo $srn;?></td>
	<td><?php echo $_row['FirstName']." ".$_row['LastName']; ?></td>
	<td><?php echo $_row['EmailId']; ?></td>
	<td><?php echo $_row['MobileNumber']; ?></td>
	<td><?php echo $_row['ContactNo1']; ?></td>
	<td><?php echo $_row['State']; ?></td>
	<td><?php echo $_row['City']; ?></td>
	<td><?php echo $sql2fetch3['Name']; ?></td>
	<td><?php echo $_row['Company']; ?></td>
	<td><?php echo $_row['Designation']; ?></td>

	
 <?php  if($_SESSION['usertype']=='Admin'){ ?>	<td><?php 
        
        	
            if($_row['Status']=='1'){ echo "Open" ;}
        	 if($_row['Status']=='2'){ echo "Closed" ;}
        	 if($_row['Status']=='3'){ echo "Suspense" ;} 
    	     if($_row['Status']=='4'){ echo "Payment Received";}
    	     if($_row['Status']=='5'){ echo "Member" ;}
    	      if($_row['Status']=='6'){ echo "Payment in Process.." ;}
    	         if($_row['Status']=='7'){ echo "Ready For Payment" ;}
    	     ?>
    	     
	</td><? }?>
    <td><?php if($_row['Status']!='0'){echo "Delegated";}else{echo "Pending"; }?></td>
   
   
    <?php  if($_SESSION['usertype']=='Admin'){  if($_row['Status']=='0'){?> <td><input type="checkbox" name="check[]" value="<?php echo $_row['Lead_id'];?>"></td>
    <?php }else{?><td> </td> <?php }}?>
    
   

   <td><?php if($_row['Status']=='0'){?><input type="button" class="btn btn-primary" onclick="window.open('lead_entry1.php?id=<?php echo $_row['Lead_id'];?>&excelid=0','_self');" value="Edit"><?php } ?> </td>



<?php if($_SESSION['usertype']=='Admin'){ ?><td><?php   if($_row['Status']=='4'){?><input type="button" class="btn btn-primary" onclick="window.open('MemberCreation.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Convert To Member"><? } ?>  </td><?php }?>

	
				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
                                
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th>Full Name</th>
                                        <th>Email-Id</th>
                                        <th>Mobile Number</th>
                                        <th>Office Number</th> 
                                        <th>State</th> 
                                        <th>City</th>
                                         <th>Lead Source</th> 
                                        <th>Company</th>
                                        <th>Designation</th> 
    <?php  if($_SESSION['usertype']=='Admin'){ ?> <th>Associate Status</th><? } ?>
                                        <th>Delegate Status</th>
    <?php  if($_SESSION['usertype']=='Admin'){ ?> <th> Delegate</th> <? } ?>
                                        <th>Edit</th>
     <?php if($_SESSION['usertype']=='Admin'){ ?> <th>Convert To Member</th> <? } ?>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>  <?php  if($_SESSION['usertype']=='Admin'){ ?>	<div align="center" > <button id="myButtonControlID" class="btn btn-primary" onClick="expfunc();">Delegate</button></div><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>

</main>


<!--page specific scripts for demo-->
<!--<script src="https://avoservice.in/assets/vendor/DataTables/datatables.min.js"></script>-->
<!--<script src="https://avoservice.in/assets/js/datatable-data.js"></script>-->


</body>
</html>