<?php

include('connect.php');

if(isset($_POST['submit'])){
    $eng = $_POST['eng'];
    $branch = $_POST['branch'];
//   echo $eng."<br>";
// echo $branch; 
    if($eng!='' ){
        if($_POST['detailsummary']=='detail'){
        $engsql = mysqli_query($con,"SELECT * FROM `distance_data_amc` WHERE eng_id = '".$eng."' order by distance");
        }else{
            $thirty = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$eng."' and distance<30");
            $thirty = mysqli_fetch_row($thirty);
           
            $sixty = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$eng."' and distance>=30 and distance<60");
            $sixty = mysqli_fetch_row($sixty);
            
            $hundred = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$eng."' and distance>=60 and distance<100");
            $hundred = mysqli_fetch_row($hundred);
            
            $twohun = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$eng."' and distance>=100 and distance<200");
            $twohun = mysqli_fetch_row($twohun);
            
            $above = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$eng."' and distance>=200");
            $above = mysqli_fetch_row($above);
            
        
            
        }
            
    }
    else
    {
        if($_POST['detailsummary']=='detail'){
        $engsql = mysqli_query($con,"SELECT * FROM `distance_data_amc` WHERE eng_id IN (select engg_id from area_engg where branch_id = '".$branch."' and status=1 and deleted=0 and latitude!=0.00)");
        }else{
             $enggid_list = mysqli_query($con,"select engg_id from area_engg where branch_id = '".$branch."' and status=1 and deleted=0 and latitude!=0.00");
               
        }
    }
}






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="refresh" content="1200">
	<link href="style.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
.table, .th, .td {
  border: 1px solid black;
  border-collapse: collapse;
}

.space{
    margin:10px;
}
</style>
<title>Engineer Branch</title>
	<body>
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Inline forms</h4>
					<p class="card-description"> Engineer Branch Filter </p>
					<form class="form-sample" action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group row">
									<label for="branch" class="col-sm-3 col-form-label">Branch</label>
									<div class="col-md-9">
									   
										<select class="form-control" id="branch" name="branch" required onchange="getengineer(this.value)">
											<option value="">Select</option>
											<?php 
											$sql = mysqli_query($con,"SELECT * FROM `avo_branch` GROUP BY id");
										    $option = "<option value=''>".'Select'."</option>";
                                            
                                            while($sql_result = mysqli_fetch_assoc($sql)){
                                            
                                                $option=$option."<option value='".$sql_result['id']."'>".$sql_result['name']."</option>";
                                                $branchid = $sql_result['id'];
                                            }
                                            echo $option;
                                            //   $branchid = $sql_result['id'];
                                               ?>
										</select>
										
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group row">
									<label for="eng" class="col-sm-3 col-form-label">Engineer</label>
									<div class="col-md-9">
									    
										<select class="form-control" id="eng" name="eng" >
											<option value="">Select</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group row">
									<label for="detailsummary" class="col-sm-3 col-form-label">Detail/Summary</label>
									<div class="col-md-9">
										<select class="form-control" id="detailsummary" name="detailsummary" required>
											<option value="detail">Detail</option>
											<option value="summary">Summary</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<br/>
		<div class="col-md-12 stretch-card grid-margin" id="show_detail">
		    <table>
		        <thead>
		            <tr>
		                <th>Engineer ID</th>
		                <th>Atm ID</th>
		                <th>Atm Address</th>
		                <th>Atm City</th>
		                <th>Distance</th>
		            </tr>  
		        </thead>
		        <tbody>
		             <?php
		             if(isset($_POST['submit']) and ($_POST['detailsummary']=='detail') ){
		             if(mysqli_num_rows($engsql)==0){
		                 echo 'No Record Found';
		             }else{
		                while($sqlresult = mysqli_fetch_assoc($engsql)){
		                    $engid= $sqlresult['eng_id'];
		                    $engg_name_sql = mysqli_query($con,"select engg_name from area_engg where engg_id = '".$engid."'");
		                    $engg_detail = mysqli_fetch_row($engg_name_sql);
		                    $engg_name = $engg_detail[0];
		                    $atmid= $sqlresult['atm_id'];
		                    $atm_name_sql = mysqli_query($con,"select atmid,city,address from Amc where amcid = '".$atmid."'");
		                    $atm_detail = mysqli_fetch_row($atm_name_sql);
		                    $atm_name = $atm_detail[0];
		                    $city_name = $atm_detail[1];
		                    $address = $atm_detail[2];
		                    $distance = $sqlresult['distance'];
		                
		            ?>
		            <tr>
		                <td><?echo $engg_name; ?></td>
		                <td><?echo  $atm_name; ?></td>
		                <td><?echo $address; ?></td>
		                <td><?echo  $city_name; ?></td>
		                <td><?echo $distance; ?></td>
		            </tr>
		            <? } } }?>
		        </tbody>
		    </table>
		</div>
		
		<div class="space"></div>
		
		<div class="col-md-12 stretch-card grid-margin" id="show_summary">
		    <table>
		        <thead>
		            <tr>
		                <th>Engineer ID</th>
		                <th>No. of site (0 - 30)</th>
		                <th>No. of site (30 - 60)</th>
		                <th>No. of site (60 - 100)</th>
		                <th>No. of site (100 - 200)</th>
		                <th>No. of site (200 and above)</th>
		                
		            </tr>  
		        </thead>
		        <tbody>
		           <?php
		             if(isset($_POST['submit']) and ($_POST['detailsummary']=='summary')){
		                 if($eng!='' ){ 
		                    $engg_name_sql = mysqli_query($con,"select engg_name from area_engg where engg_id = '".$eng."'");
		                    $engg_detail = mysqli_fetch_row($engg_name_sql);
		                    $engg_name = $engg_detail[0];
		                 ?>
		                 <tr>
    		                    <td><?php echo $engg_name;?></td>
    		                    <td><?php echo $thirty[0]; ?></td>
        		                <td><?php echo $sixty[0]; ?></td>
        		                <td><?php echo $hundred[0]; ?></td>
        		                <td><?php echo $twohun[0]; ?></td>
        		                <td><?php echo $above[0]; ?></td>
		                 </tr>    
		                <?php }else{
            		             if(mysqli_num_rows($enggid_list)==0){
            		                 echo 'No Record Found';
            		             }else{
            		                while($sqlresult_list = mysqli_fetch_assoc($enggid_list)){
            		                    $engid= $sqlresult_list['engg_id'];
            		                    $engg_name_sql = mysqli_query($con,"select engg_name from area_engg where engg_id = '".$engid."'");
            		                    $engg_detail = mysqli_fetch_row($engg_name_sql);
            		                    $engg_name = $engg_detail[0];
            		                    $thirty_sql = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$engid."' and distance<30");
                                        $sixty_sql = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$engid."' and distance>=30 and distance<60");
                                        $hundred_sql = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$engid."' and distance>=60 and distance<100");
                                        $twohun_sql = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$engid."' and distance>=100 and distance<200");
                                        $above_sql = mysqli_query($con,"SELECT count(id) FROM `distance_data_amc` WHERE eng_id = '".$engid."' and distance>=200");
            		                   
            		                    $thirtysql = mysqli_fetch_row($thirty_sql);
            		                    $thirty= $thirtysql[0];
            		                    
            		                    $sixtysql = mysqli_fetch_row($sixty_sql);
            		                    $sixty= $sixtysql[0];
            		                    
            		                    $hundredsql = mysqli_fetch_row($hundred_sql);
            		                    $hundred= $hundredsql[0];
            		                    
            		                    $twohunsql = mysqli_fetch_row($twohun_sql);
            		                    $twohun= $twohunsql[0];
            		                    
            		                    $abovesql = mysqli_fetch_row($above_sql);
            		                    $above= $abovesql[0];
            		             
            		                    
            		                
            		            ?>
            		            <tr>
            		                <td><?php echo $engg_name; ?></td>
            		                <td><?php echo $thirty; ?></td>
            		                <td><?php echo $sixty; ?></td>
            		                <td><?php echo $hundred; ?></td>
            		                <td><?php echo $twohun; ?></td>
            		                <td><?php echo $above; ?></td>
            		                
            		            </tr>
            		            <? } } 
            		      }
            		  }?>
		            
		        </tbody>
		    </table>
		</div>

	<script>
// 	  function getbranch(val){
// 	       $branch =  $("#branch").val(val);
//                 $.ajax({
//                         type: "POST",
//                         url: 'getbranch.php',
//                         data: 'branchid='+branch,
//                         success:function(msg) {
//                             document.getElementById("branch").innerHTML = '<option value="">Branch</option>';
//                             $("#branch").html(msg);
//                             $('#branch option[value="' + branch + '"]').prop('selected', true);
//                         }
//                     });
          
// 	  }
	    function getengineer(branch){
	    // alert(branch);
	    if(branch!=''){
            $.ajax({

                type: "POST",
                url: 'getengineer.php',
                data: 'branchid='+branch,
                success:function(msg) {
                    console.log(msg);
                    // alert(msg);
                    debugger;
                    var obj = JSON.parse(msg);
                  //  alert(obj);
                //    var name = obj['name'];
                //    alert(name);
               var enghtml = '<option value="">Select Engineer</option>';
                    for(i=0;i<obj.length;i++)
                    {
                        var engid = obj[i].id;
                        var engname = obj[i].name;
                        if(engname!=''){
                        enghtml += '<option value="'+engid+'">'+engname+'</option>';
                            
                        }
                    }
                    
                    //document.getElementById("eng").innerHTML = '<option value="">Select Engineer</option>';
                    $("#eng").html(enghtml);
                    //$('#eng option[value="' + name + '"]').prop('selected', true);
                }
            });
        }
	    }
        
        // $("#branch").on('change',function(){ debugger;
        //     var branch_id = $("#branch").val
        //     var eng_id = $("#eng").val();
            
        //     $.ajax({

        //         type: "POST",
        //         url: 'getengineer.php',
        //         data: {branch_id : branch_id, eng_id: eng_id },
        //         success:function(msg) {
        //             console.log(msg);
        //             // debugger;
        //             // document.getElementById("branch").innerHTML = '<option value="">Select Branch</option>';
                   
        //             $("#eng").html(msg);
        //         }
        //     });
        // });
	</script>

	</body>
	


</html>
