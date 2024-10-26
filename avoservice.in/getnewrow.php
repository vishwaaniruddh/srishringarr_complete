<?php 

	include('config.php');
	include("access.php");
	$brme=($_SESSION['branch']);
	$cnt=$_GET['cnt'];
	//echo $cnt;	
	 ?>
	 
     <script type="text/javascript" src="jquery-1.11.1.min.js"></script>


 <!-- ===Mis DATE===--->
 <table id="myTable">
 <tbody>
 <tr>
 <td>
                                     
     <!--<input type="text" name="mis_date[<?php echo $cnt?>]" id="mis_date_<?php echo $cnt?>" value="<?php echo date('d-m-Y');?>"  class="m-wrap span12" readonly=readonly onClick="displayDatePicker('mis_date[<?php echo $cnt?>]');">--> </td>
                                     
                                     <!-- ===Select Eng===--->
                                       <td>
 										<select name="engid[<?php echo $cnt?>]" id="engid_<?php echo $cnt?>"  class="eng_name">
                                                <option value="">Select Eng</option>
                                                <?php 
												if($brme=='all'){
														$sql=mysqli_query($con1,"select * from `area_engg` WHERE `status` = 1 ");
													}else{
														$sql=mysqli_query($con1,"select * from `area_engg` WHERE `area` IN ($brme) AND `status` = 1 ");
													}
												while($sql1=mysqli_fetch_row($sql)){												
												?>
                                                	<option value="<?php echo $sql1[0] ; ?>"> <?php echo $sql1[1] ; ?></option>
                                                <?php } ?>
                                                </select>                                       
                                       </td> 
                                                                 
                                <!-- ===Type of Activity===--->                
      							<td> 	<select name="typact[<?php echo $cnt?>]" id="typact_<?php echo $cnt?>" onchange="getnameact(this.value,this.id);" class="activity" >
                                               	<option value="">select</option>
												<option value="In House">In House</option>
												<option value="Field">Field</option>
                                               
                                  		</select> </td>              
                             	 
                                <!-- ===Name of Activity===--->
                                <td> 
                                <div id="act_<?php echo $cnt?>">
                                <select name="nameact[<?php echo $cnt?>]" id="nameact_<?php echo $cnt?>" class="name_activity" >
                                                <option value="">Select Name Activity</option>
                                                <?php 
												//$sql=mysqli_query($con1,"select * from `activity`");
												//while($sql1=mysqli_fetch_row($sql)){												
												?>
                                                	<option value="<?php echo $sql1[0] ; ?>"> <?php echo $sql1[1] ; ?></option>
                                                <?php //} ?>
                                     </select> </div></td>
                                
                                <!-- ===Customer Name===--->
                                <td> <input type="text" name="cust[<?php echo $cnt?>]" id="cust_<?php echo $cnt?>" value="" class="cust_name" placeholder="Customer Name" > </td>
                                
                                <!-- ===Location===--->
                                <td> <input type="text" name="location[<?php echo $cnt?>]" id="location_<?php echo $cnt?>" value=""  placeholder="Location" > </td>
                                
           <!-- ==============///////////////From Time//////////////////////===============================--->
                                <td> 
            <!--===========For Hour ==========-->
			<select name="frtime[<?php echo $cnt?>]"  id="frtime_<?php echo $cnt?>" class="frtime" >
			<option value="">Select time</option>
			<?php
			for($i=1;$i<=12;$i++) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php }?>
			</select>
           
			<!--===========For Minute ==========-->
			 <select name="frmin[<?php echo $cnt?>]" id="frmin_<?php echo $cnt?>"  class="frmin">
					<option value="">Select Min</option>
					<option value="<?php echo 0 . ":00:00"; ?>">0</option>
					<?php
					for($i=01;$i<=60;$i++)
					{
					?>
					<option value="<?php echo $i.":00:00"; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
				</select>
                
			<!--===========For Meridain ==========-->
			<select name="frmeri[<?php echo $cnt?>]" id="frmeri_<?php echo $cnt?>" class="frmeri">
				<option value="" >Select</option>
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select>
             </td>
                                 
                                
            <!-- ===///////////=========//================To Time=============/////////////////////////////===--->
            
             <td> 
             <!--===========For Hour ==========-->
			<select name="totime[<?php echo $cnt?>]"  id="totime_<?php echo $cnt?>" class="totime">
			<option value="">Select time</option>
			<?php
			for($i=1;$i<=12;$i++) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php }?>
			</select>
           
			<!--===========For Minute ==========-->
			 <select name="tomin[<?php echo $cnt?>]" id="tomin_<?php echo $cnt?>" class="tomin">
					<option value="">Select Min</option>
					<option value="<?php echo 0 . ":00:00"; ?>">0</option>
					<?php
					for($i=01;$i<=60;$i++)
					{
					?>
					<option value="<?php echo $i.":00:00"; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
				</select>
               
			<!--===========For Meridain ==========-->
			<select name="tomeri[<?php echo $cnt?>]" id="tomeri_<?php echo $cnt?>" class="tomeri">
				<option value="" >Select</option>
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select>
             </td>
                                
                                <!-- ===Remarks===--->                                               
                               	<td> <input type="text" name="remark[<?php echo $cnt?>]" id="remark_<?php echo $cnt?>" value=""  placeholder="Remark" ></td>
                                
 						