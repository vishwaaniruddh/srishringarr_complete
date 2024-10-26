<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
   <!-- <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">-->
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<script>
function searchfiltter(){
    var  FromDt=document.getElementById('FromDt').value;
    var  Todt=document.getElementById('Todt').value;
   
   /*if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }*/
      if(1==2){}
   else{
   
             $.ajax({
                    type:'POST',
                    url:'POSsearch_Filtter.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt,
                    
                    success:function(msg){
                        alert(msg);
                        $('#setTable').empty();
                             var json=$.parseJSON(msg);
                             for(var i=0;i<json.length;++i){
                           var srno=i+1;
                            
                            $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+json[i].City+'</td><td>'+json[i].No_of_Pax+'</td><td>'+json[i].No_of_paxClose+'</td><td>'+json[i].FoodAmt+'</td><td>'+json[i].FoodAmt+'</td><td>'+json[i].FoodDiscAmt+'</td><td>'+json[i].SoftBevAmt+'</td><td>'+json[i].SoftBevDiscAmt+'</td><td>'+json[i].IndianLiqAmt+'</td><td>'+json[i].IndianLiqDiscAmt+'</td><td>'+json[i].ImpLiqAmt+'</td><td>'+json[i].ImpLiqDiscAmt+'</td><td>'+json[i].NettAmount+'</td> </tr>');
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
                                <i class="mdi mdi-table "></i></span> view DER 
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
 	  $View="select Primary_Title,GenerateMember_Id,Static_LeadID,MembershipDetails_Level,entryDate,Spouse_Title,Spouse_FirstName,Spouse_LastName,Primary_MaritalStatus from Members where Static_LeadID IN (SELECT Lead_id FROM `Leads_table` where Status='5') and DATE(entryDate)='".date("Y-m-d")."'";
      $qrys=mysqli_query($conn,$View);

?>
                        <div class="card-body">
                                   <div class="form-row">
                               <div class="form-group col-md-3">
                                  
                                  <select class="form-control" name="Ab_Filtter" id="Ab_Filtter" >
                                  <option value="">Select</option>
                                  <option value="DSR">DSR</option>
                                  <option value="Anniversary">Anniversary</option>
                                  <option value="Birthday">Birthday</option>
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
                                                            
                                                                 
                                         <th> Row Labels</th>
                                         <th> Count of No of Pax</th>
                                         <th> Sum of No of pax close</th> 
                                         <th> Sum of Food Amt</th>
                                         <th> Sum of Food Amt2</th>
                                         <th>Sum of Food Disc Amt</th>
                                         <th> Sum of Soft Bev Amt</th>
                                         <th> Sum of Soft Bev Disc Amt</th> 
                                         <th>Sum of Indian Liq Amt</th>
                                         <th>Sum of Indian Liq Disc Amt</th>
                                         <th>Sum of Imp Liq Amt</th>
                                         <th> Sum of Imp Liq Disc Amt</th>
                                         <th>Sum of Nett Amount</th> 
                                          
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                                        
                                        
                                                                   	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{
			    $sql2="select FirstName,LastName from Leads_table where Lead_id='".$_row['Static_LeadID']."' ";
	//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);
			    
	$sql3="SELECT level_name FROM `Level` where Leval_id='".$_row['MembershipDetails_Level']."' ";
	//echo $sql2;
	$runsql3=mysqli_query($conn,$sql3);
	$sql3fetch=mysqli_fetch_array($runsql3);

	$sql4="SELECT Expiry_month FROM `validity` where Leval_id='".$_row['MembershipDetails_Level']."' ";
  	$runsql4=mysqli_query($conn,$sql4);
	$sql4fetch=mysqli_fetch_array($runsql4);
	

    $dd=date('Y-m-d', strtotime($_row['entryDate']));

	 $d = strtotime("+".$sql4fetch['Expiry_month']." months",strtotime($dd));
    //  $R=  date("d-m-Y",$d);
$formattedValue = date("F, Y", $d);
$R=$formattedValue;


  ?>
                             <tr>
    
    <td><?php echo $_row['Primary_Title']; ?></td>
    <td><?php echo $sql2fetch['FirstName']." ".$sql2fetch['LastName']; ?></td>
	<td><?php echo $_row['GenerateMember_Id']; ?></td>
    <td><?php echo $sql3fetch['level_name']; ?></td>
	<td><?php echo $R; ?></td>


			</tr>
			
			<?php 
			
			   $srn++;
			}			
			?>
	                     </tbody>
                                    
                                </table>
                            </div>    <div class="row">
            
            <div class="cols-md-8">
        <form name="frm" method="post" action="exporDER.php" target="_new">
<input type="hidden" name="qr" id="qr" value="<?php echo $View; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" class="btn btn-primary"> <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
</div>&nbsp;&nbsp;
 <div class="cols-md-4">
<form name="frm" method="post" action="Leadpdf/report.php" target="_new">
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
<?php include('belowScript.php');?>
<script src="assets/vendor/DataTables/datatables.min.js"></script>
<!--<script src="assets/js/datatable-data.js"></script>-->
</body>
</html>