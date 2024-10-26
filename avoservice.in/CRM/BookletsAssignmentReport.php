<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<script>
    
function searchfiltter(){
    
    var Level_Filtter=document.getElementById('Level_Filtter').value;
    var FromDt=document.getElementById('FromDt').value;
    var Todt=document.getElementById('Todt').value;
   
      if(Level_Filtter==""){
          swal("Please Select Level");
      }else if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }else{
     
             $.ajax({
          
                    type:'POST',
                    url:'BookletsAssignmentSearch_Filtter.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt+'&Level_Filtter='+Level_Filtter,
                    
                    success:function(msg){
                     // alert(msg);
                        $('#setTable').empty();
                             var json=$.parseJSON(msg);
                             for(var i=0;i<json.length;++i){
                          //  alert(json[i].FirstName)
                            
                            if(json[i].MembershipDetails_Level==1){var Lev="Orchid First";}else if(json[i].MembershipDetails_Level==2){var Lev="Orchid Gold";}else if(json[i].MembershipDetails_Level==3){var Lev="Orchid Platinum";}
                           
                            var srno=i+1;
                           
                         if(json[i].canceledMember==1){ var statusSample="Canceled"; } else if(json[i].Sample==1){ var statusSample="Sample"; } else{var statusSample="";}
                            
                           
                            
                            $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+json[i].entryDate+'</td><td>'+Lev+'</td><td>'+json[i].booklet_Series+'</td><td>'+json[i].GenerateMember_Id+'</td><td>'+json[i].Primary_nameOnTheCard+'</td><td>'+statusSample+'</td> </tr>');
                          }
                     
                      document.getElementById('qr').value="";
                      document.getElementById('qr').value=json['0'].Qry;
                      
                      document.getElementById('qr1').value="";
                      document.getElementById('qr1').value=json['0'].Qry;
                       document.getElementById('From1').value="";
                      document.getElementById('From1').value=json['0'].FromDat;
                       document.getElementById('To1').value="";
                      document.getElementById('To1').value=json['0'].Todt;
               
                   
                    }
                })
    
     
      }
}

</script>

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
                                <i class="mdi mdi-table "></i></span> Booklets Assignment Report 
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
 	  $View="SELECT * FROM `Members` where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and  DATE(entryDate)='".date("Y-m-d")."'";
 	
      $qrys=mysqli_query($conn,$View);

?>
                        <div class="card-body">
                            
                                <div class="form-row">
                               <div class="form-group col-md-3">
                                  
                                  <select class="form-control" name="Level_Filtter" id="Level_Filtter" >
                                  <option value="">Select Level</option>
                                   <?php
                                         $levelQry="select * from Level where 1=1";
                                          if($Mainid!=""){ $levelQry .= " and Program_ID=(SELECT Program_ID FROM `Program` where Hotel_id='".$HOtelNameChk."')";  }
                                         
                                          $runlevel=mysqli_query($conn,$levelQry);
                                          while($fetchLevel=mysqli_fetch_array($runlevel)){?>
                                          <option value="<?php echo $fetchLevel['Leval_id'];?>"><?php echo $fetchLevel['level_name'];?></option>
                                          <? } ?>
                                  </select>
                                  
                                  </div>
                                  
                                   <div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="FromDt" name="FromDt" autocomplete="off" placeholder="From Date">
                                  </div><div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="Todt" name="Todt" autocomplete="off" placeholder="To Date">
                                  </div><div class="form-group col-md-3">
                                   <input type="button" class="btn btn-primary" onclick="searchfiltter()" value="Search">
                               </div>
                             
                              </div>
                            
                            
                            
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                     <th>srno</th>  
                                     <th>DSR Date</th> 
                                     <th>Level</th> 
                                     <th>Booklet Number</th>
                                     <th>Card Number</th>
                                     <th> Member Name</th>
                                      <th> Booklet Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                                        <!--
                                               	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{
	$sql2="select * from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
	
	
	$sql3="SELECT * FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);
	
	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
	
	
	$sql5="SELECT state FROM `state` where state_id='".$sql2fetch['State']."' ";
	$runsql5=mysqli_query($conn,$sql5);
	$sql5fetch=mysqli_fetch_array($runsql5);
	
	
	$dd=date('Y-m-d', strtotime($_row['entryDate']));

	 $d = strtotime("+".$sql4fetch['Expiry_month']." months",strtotime($dd));
      $R=  date("d-m-Y",$d);

  ?>
                             <tr>
                                 
                               
                                 
                                    <td><?php echo $srn;?></td>
                                 	<td><?php echo $_row['Primary_nameOnTheCard']; ?></td>
                                 	<td><?php echo ''; ?></td>
                                    <td><?php echo $sql3fetch['level_name']; ?></td>
                                    <td><?php echo $_row['GenerateMember_Id']; ?></td>
                                   	<td><?php echo $R; ?></td>
                                   	<td><?php echo $_row['booklet_Series']; ?></td>
                                   	<td><?php echo 'New'; ?></td>
                                    <td><?php echo $_row['MembershipDts_PaymentMode'] ; ?></td>
                                    <td><?php echo $_row['MembershipDts_InstrumentNumber'] ; ?></td>
                                    <td><?php echo $_row['Member_bankName'];?></td>
                                    <td><?php echo '';?></td>
                                    <td><?php echo $_row['MembershipDts_NetPayment']; ?></td>
                                     <td><?php echo $_row['MembershipDts_GST']; ?></td>
                                    <td><?php echo $_row['MembershipDts_GrossTotal']; ?></td>
                                      <td><?php echo $_row['MemshipDts_Remarks']; ?></td>
   
   
 

				</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	-->
                                
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                      <th>srno</th>  
                                     <th>DSR Date</th> 
                                     <th>Level</th> 
                                     <th>Booklet Number</th>
                                     <th>Card Number</th>
                                     <th> Member Name</th>
                                       <th> Booklet Status</th>
                                     </tr>
                                    </tfoot>
                                </table>
                            </div>
                         <div class="row">   
            <div class="cols-md-8">
        <form name="frm" method="post" action="export_BookletsAssignmentReport.php" target="_new">
<input type="hidden" name="qr" id="qr" value="<?php echo $View; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" class="btn btn-primary"> <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
</div>&nbsp;&nbsp;
 <div class="cols-md-4">
<form name="frm" method="post" action="Leadpdf/BookletsAssignmentReport_PDF.php" target="_new">
<input type="hidden" name="qr1" id="qr1" value="<?php echo $View; ?>" readonly>
<input type="hidden" name="From1" id="From1"  readonly>
<input type="hidden" name="To1" id="To1"  readonly>
<input type="submit" name="cmdsub" value="Generate PDF" class="btn btn-primary">
</form>
</div></div>
        
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
         
        
    </section>

</main>
<?php include('belowScript.php');?><script src="assets/vendor/DataTables/datatables.min.js"></script>
<!--<script src="assets/js/datatable-data.js"></script>-->
</body>
</html>