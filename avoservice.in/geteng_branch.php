	<?php 
	include('config.php');	
	$br=$_SESSION['branch'];
	$br_id=$_GET['br_id'];		
	 ?>
     
         <table >                                      		                             
               
                <tr>
                  <th>Eng Name </th>
                  <th>Present</th>
                  <th>Leave</th>
                  <th>Absent</th>                    
              </tr>                                                                                
                                     	
     				<input type="hidden" name="theValue" id="theValue" value="1"/>
      				<input type="hidden" name="myval" id="myval" value=""/>
                                           				
                                                <?php 
													$sql_eng=mysqli_query($con1,"select `engg_name` from `area_engg` WHERE `area`= '".$br_id."'  AND `status` = 1 ");
													$cnt=0;
													while($eng_name1=mysqli_fetch_row($sql_eng)){	
																						
												?>
                                                	
                    
                             <tr>
                                    
                                 <!--=============Eng Name======-->                                             
 								<td>
                                <input type="checkbox" class="eng_ckbox" name="eng_ckbox[<?php echo $cnt;?>]" id="eng_ckbox" value="" />
                                <input type="text" name="engname[]" id="engname" value="<?php echo $eng_name1[0]; ?>" readonly="readonly"/> </td>                                                                                                     
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
                         
     
     
     
     
     
     
     
	
                        
                        
                      