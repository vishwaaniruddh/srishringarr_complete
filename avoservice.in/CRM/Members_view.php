<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<body class="sidebar-pinned">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> view Members
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">
<?php include("config.php");
  //  $View="select * from Leads_table where leadEntryef='".$_SESSION['id']."'";
 	  $View="select * from Members  where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') ";
      $qrys=mysqli_query($conn,$View);

?>
                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table   " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th>Card Number</th>
                                        <th> Title</th>
                                         <th> First Name</th>
                                          <th> Last Name</th>
                                          <th> Name on the Card</th> 
                                          <th> Photo</th>
                                         <th>Spouse Name</th>
                                          <th> Mobile Number</th> 
                                          <th> Membership Level</th>
                                          <th> Member Since</th>
                                           <th> Validity</th>
                                           <th> Mobile Number 2</th>
                                           <th> Contact 1</th>
                                        
                                         <th>Contact 2</th>
                                          <th> Contact 3</th> 
                                          <th>Email ID</th>
                                          <th>Email ID 2 (Gmail)</th>
                                           <th> Company Name</th>
                                           <th> Designation</th>
                                           <th> Address Type 1</th>
                                           <th> Address</th>
                                           <th>City</th>
                                          <th> State</th> 
                                          <th>Country</th>
                                          <th>Pin Code</th>
                                           <th>Date of Birth</th>
                                           <th>Marital Status</th>
                                           <th>Action</th>
                                           <th>Edit</th>
                                           <th>Member Cancel</th>
                                         
                                                                         
                                    </tr>
                                    </thead>
                                    <tbody>
                                        	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{
	$sql2="select * from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
	
	
	$sql3="SELECT * FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	//echo $sql2;
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);



	
	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row['MembershipDetails_Level']."' ";

	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
  ?>
                             <tr>
    <td><?php echo $srn;?></td>
	<td><?php echo $_row['GenerateMember_Id']; ?></td>
	<td><?php echo $_row['Primary_Title']; ?></td>
	<td><?php echo $sql2fetch['FirstName']; ?></td>
	<td><?php echo $sql2fetch['LastName']; ?></td>
	<td><?php echo $_row['Primary_nameOnTheCard']; ?></td>
	<td><img src="<?php echo $_row['Primary_PhotoUpload']; ?>" alt="img"</td>
	<td><?php echo $_row['Spouse_FirstName']; ?></td>
	<td><?php echo $sql2fetch['MobileNumber']; ?></td>
	<td><?php echo $sql3fetch['level_name']; ?></td>
	<td><?php echo $_row['entryDate']; ?></td>
	<td><?php echo $sql4fetch['Expiry_month']?></td>

	<td><?php echo $_row['Primary_mob2']; ?></td>
	<td><?php echo $_row['Primary_Contact1']; ?></td>
	<td><?php echo $_row['Primary_Contact2']; ?></td>
	<td><?php echo $_row['Primary_Contact3']; ?></td>
	<td><?php echo $_row['Primary_Email_ID2']; ?></td>

	<td><?php echo $_row['Spouse_GmailMArrid1']; ?></td>
	<td><?php echo $sql2fetch['Company']; ?></td>
	<td><?php echo $sql2fetch['Designation']; ?></td>
	<td><?php echo $_row['Primary_AddressType1']; ?></td>
	<td><?php echo $_row['Primary_BuldNo_addrss'].$_row['Primary_Area_addrss'].$_row['Primary_Landmark_addrss']; ?></td>
	<td><?php echo $sql2fetch['City']; ?></td>
	<td><?php echo $sql2fetch['State'];?></td>
	<td><?php echo $sql2fetch['Country']; ?></td>
	<td><?php echo $sql2fetch['PinCode']; ?></td>

	<td><?php echo $_row['Primary_DateOfBirth']; ?></td>
	<td><?php echo $_row['Primary_MaritalStatus']; ?></td>
		<td><?php if( $_row['dispatched_status']==0){ ?><a href='dispatch_popup.php?id=<?php echo $_row['mem_id'] ?>' class="btn btn-primary" >Dispatch</a><?php } ?></td>
		<td><a href='MemberEdit.php?id=<?php echo $_row['Static_LeadID'] ?>' class="btn btn-primary" >Edit</a></td>
		<td><a href='MemberCancel.php?id=<?php echo $_row['Static_LeadID'] ?>' class="btn btn-primary" >Cancel</a></td>
	

	



	

				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
                                
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                       <th>srno</th>                                      
                                        <th>Card Number</th>
                                        <th> Title</th>
                                         <th> First Name</th>
                                          <th> Last Name</th>
                                          <th> Name on the Card</th> 
                                          <th> Photo</th>
                                         <th>Spouse Name</th>
                                          <th> Mobile Number</th> 
                                          <th> Membership Level</th>
                                          <th> Member Since</th>
                                           <th> Validity</th>
                                           <th> Mobile Number 2</th>
                                           <th> Contact 1</th>
                                        
                                         <th>Contact 2</th>
                                          <th> Contact 3</th> 
                                          <th>Email ID</th>
                                          <th>Email ID 2 (Gmail)</th>
                                           <th> Company Name</th>
                                           <th> Designation</th>
                                           <th> Address Type 1</th>
                                           <th> Address</th>
                                           <th>City</th>
                                          <th> State</th> 
                                          <th>Country</th>
                                          <th>Pin Code</th>
                                           <th>Date of Birth</th>
                                           <th>Marital Status</th>
                                           <th>Action</th>
                                           <th>Edit</th>
                                           <th> Member Cancel</th>
                                         
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php include('belowScript.php');?><script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>
</body>
</html>