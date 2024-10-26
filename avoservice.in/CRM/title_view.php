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
                                <i class="mdi mdi-table "></i></span> view Title
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
 	  $View="select * from Title ";
      $qrys=mysqli_query($conn,$View);

?>
                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table   " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th>Title Name</th>
                                       
                                        <th>Edit</th>                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{
  ?>
                             <tr>
    <td><?php echo $srn;?></td>
	<td><?php echo $_row['titleName']; ?></td>
	
	


<td><input type="button" onclick="window.open('title.php?id=<?php echo $_row['title_id'];?>','_self');" value="Edit Title">  </td>
<!--<td><input type="button" id="qtnview<?php echo $srn;?>" onclick="window.open('leadupdate.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Lead Update">  </td>
<?php if($_row['Status']=='0'){?>
<!--<td><input type="checkbox" name="check[]" value="<?php echo $_row['Lead_id'];?>"></td>
<?php }else{?>
<td> </td>
<?php }?>-->
	

				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	
                                
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>srno</th>                                      
                                        <th>Brand Name</th>
                                        <th>Edit</th>         
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