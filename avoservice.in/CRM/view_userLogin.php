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
    
    var Ab_Filtter=document.getElementById('Ab_Filtter').value;
      var cancel_Filtter=document.getElementById('cancel_Filtter').value;
    var FromDt=document.getElementById('FromDt').value;
    var Todt=document.getElementById('Todt').value;
   
   
   
      if(Ab_Filtter==""){
          swal("Please Select Dropdown");
      }else if(FromDt==""){
          swal("Please Select From Date");
      }else if(Todt==""){
          swal("Please Select To Date");
      }else{
     
             $.ajax({
          
                    type:'POST',
                    url:'DSRsearch_Filtter.php',
                     data:'FromDt='+FromDt+'&Todt='+Todt+'&Ab_Filtter='+Ab_Filtter+'&cancel_Filtter='+cancel_Filtter,
                    
                    success:function(msg){
                       // alert(msg);
                        $('#setTable').empty();
                             var json=$.parseJSON(msg);
                             for(var i=0;i<json.length;++i){
                          //  alert(json[i].FirstName)
                            
                           
                            var srno=i+1;
                            $('#setTable').append('<tr role="row" class="odd" ><td class="sorting_1">'+srno+'</td><td>'+json[i].Primary_nameOnTheCard+'</td><td>'+json[i].Type+'</td><td>'+json[i].level_name+'</td><td>'+json[i].GenerateMember_Id+'</td><td>'+json[i].entryDate+'</td><td>'+json[i].R+'</td><td>'+json[i].Primary_Anniversary+'</td><td>'+json[i].Primary_DateOfBirth+'</td><td>'+json[i].booklet_Series+'</td><td>'+json[i].TypeNR+'</td><td>'+json[i].MembershipDts_PaymentMode+'</td><td>'+json[i].MembershipDts_InstrumentNumber+'</td><td>'+json[i].Recipt+'</td> <td>'+json[i].MembershipDts_NetPayment +'</td>  <td>'+json[i].MembershipDts_GST +'</td> <td>'+json[i].MembershipDts_GrossTotal +'</td><td>'+json[i].canceledMember+'</td> </tr>');
                          }
                     
                      document.getElementById('qr').value="";
                      document.getElementById('qr').value=json['0'].Qry;
                      
                      document.getElementById('qr1').value="";
                      document.getElementById('qr1').value=json['0'].Qry;
                       document.getElementById('From1').value="";
                      document.getElementById('From1').value=json['0'].FromDat;
                       document.getElementById('To1').value="";
                      document.getElementById('To1').value=json['0'].Todt;
               
                      document.getElementById('cancel1').value=json['0'].cancel_Filtter;
               
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
                                <i class="mdi mdi-table "></i></span> view User 
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
 	  $View="SELECT UserName,UserType,permission,Active,roll_id FROM `Users` where 1=1 order by UserType ";
       $qrys=mysqli_query($conn,$View);
 
?>
                        <div class="card-body">
                             <!--<div class="form-group col-md-3" style="display:none">
                                  <select class="form-control" name="Ab_Filtter" id="Ab_Filtter" >
                                  <option value="">Select</option>
                                  <option value="DSR" selected>DSR</option>
                                  </select>
                               </div>-->
                               
                            <!--    <div class="form-row">
                              
                                    <div class="form-group col-md-3" >
                                  <select class="form-control" name="cancel_Filtter" id="cancel_Filtter" >
                                  <option value="">Select</option>
                                  <option value="1">Cancel</option>
                                  </select>
                               </div>
                                   <div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="FromDt" name="FromDt" placeholder="From Date">
                                  </div><div class="form-group col-md-3">
                                  <input type="text" class="js-datepicker form-control" id="Todt" name="Todt" placeholder="To Date">
                                  </div><div class="form-group col-md-3">
                                   <input type="button" class="btn btn-primary" onclick="searchfiltter()" value="Search">
                               </div>
                             
                              </div>-->
                            
                            
                            
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                    <tr>
                                     <th>srno</th>  
                                     <th> User Name</th> 
                                     <th> Role</th> 
                                     <th> Rights Assigned </th>
                                     <th> Active / Inactive</th>
                                     </tr>
                                    </thead>
                                    <tbody id="setTable">
                                        
                                               	<?php 
		$srn=1;
			while($_row=mysqli_fetch_array($qrys))
			{ 
	$sql2="select * from menuAccess where pid in (".$_row['permission'].") ";
	$runsql2=mysqli_query($conn,$sql2);

           ?>
                             <tr>
                                    <td><?php echo $srn;?></td>
                                 	<td><?php echo $_row['UserName']; ?></td>
                                    <td><?php echo $_row['UserType']; ?></td>
                                   <!-- <td><?php while($sql2fetch=mysqli_fetch_array($runsql2)){ echo $sql2fetch['name'];} ?></td>-->
                                   <td><input type="button" value="view permission" id="myBtn"  onclick="getPermission(<?php echo $_row['roll_id'] ?>)"></td>
                                    <td><?php if($_row['Active']==1) { echo "Active"; }else {echo "Inactive";} ?></td>
   
			            	</tr>
			
			<?php 
			
			   $srn++;
			}
			
		?>
	
                                
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                       <th>srno</th>  
                                     <th> User Name</th> 
                                     <th> Role</th> 
                                     <th> Rights Assigned </th>
                                     <th> Active / Inactive</th>
                                   
                                         </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            
                            

<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 40%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #3e4676;
  color: white;
}

.modal-body {padding: 2px 16px;}


</style>


<!-- Trigger/Open The Modal -->


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Rights Assigned</h2>
    </div>
    <div class="modal-body">
      <table >
         <tbody id="setperm">
             
         </tbody>
      </table>
    </div>
    
  </div>

</div>

<script>
function getPermission(per){
    modal.style.display = "block"; 
            $.ajax({
                    type:'POST',
                    url:'getroll.php',
                    data:'per='+per,
                    
                    success:function(msg){
                       
                     $('#setperm').empty();
                             var json=$.parseJSON(msg);
                             var srno=1;
                              for(var i=0;i<json.length;++i){
                                  
                                       $('#setperm').append('<tr><td>'+srno +'</td><td>'+json[i]+'</td> </tr>');
                                  srno++;
                               
                              }
                       
                    }  
                    
                 });
                    
   
}


// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}


</script>



                            
                     
                            
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





