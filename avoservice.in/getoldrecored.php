<?php 

	include('config.php');
	include("access.php");
	$brme=$_SESSION['branch'];
	$mis_date=$_GET['recdate'];
	$mis_d=date('Y-m-d',strtotime(str_replace('/','-',$mis_date)));
		
	 ?>
	
                        <table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="" >
                            <tr><th colspan="2"><B style="color:red; font-size:18px; font-weight:bold;">OLD RECORD SHOW HERE:</b></th></tr>
                            <tr>
                            <th width="2%">SN</th> 
                            <th width="10%">Eng Name</th> 
                            <th width="10%">Name of Activity</th>
                            <th width="7%">Customer Name</th>
                            <th width="6%">Location</th>
                            <th width="5%">Date</th>
                            <th width="7%">From Time</th>
                            <th width="7%">To Time</th>   
                             <th width="10%">Branch</th>                            
                            </tr>
                            <?php
							//echo "Branch=".$brme;
 							if($brme=='all'){
								$sql="Select * from `eng_mis` where  `mis_date`='".$mis_d."' ";
								}else{
 									$sql="Select * from `eng_mis` where branch_id = '".$brme."' && `mis_date`='".$mis_d."' "; 
									}
							//echo  $sql;
							$sqlrun=mysqli_query($con1,$sql);
							$sn=1;
							while($row=mysqli_fetch_row($sqlrun)){
 							?>
                           <tr>
                            <!--===SN===-->
                            <td  valign="top" width="200">&nbsp;<?php echo $sn; ?></td>
                            <!--===Eng Name===-->
                            <td  valign="top">&nbsp;<?php 
                            $eng=mysqli_query($con1,"select `engg_name` from `area_engg` where `engg_id`='".$row[2]."'");
                            $eng1=mysqli_fetch_row($eng);
                            echo $eng1[0] ; ?></td>
                            <!--===Name of Activity===-->
                            <td  valign="top">&nbsp;<?php 
                            $name_act=mysqli_query($con1,"select name from activity where id='".$row[4]."'");
                            $name_act1=mysqli_fetch_row($name_act);
                            echo $name_act1[0];
                            ?></td>
                            <!--===Customer Name===-->
                            <td  valign="top">&nbsp;<?php echo $row[5]; ?></td>
                            
                            <!--===Location===-->   
                            <td  valign="top">&nbsp;<?php echo $row[6]; ?></td>
                            <!--===Date===-->
                            <td  valign="top">&nbsp;<?php echo date('d-m-Y ',strtotime($row[1])); ?></td>
                            <!--===From Time===-->
                            <td  valign="top">&nbsp;<?php echo  date('h:i:s.a',strtotime($row[7]));?></td>
                            <!--===To Time===-->
                            <td valign="top">&nbsp;<?php  echo date('h:i:s.a',strtotime($row[8])); ?></td>
                            <!--===To Time===-->
                             <td valign="top">&nbsp;<?php  
													if($row[10]=='all') {
													echo "Masteradmin";
                                                    }else{
                                                      //$br_row=explode(",",$row[10]); 
													  //print_r($br_row[0]);
													  //echo count($br_row);
													  //for($i=0;$i<count($br_row);$i++){
														//echo "select state from state where state_id='$br_row[$i]'";
														//echo "select * from avo_branch where id='".$row[10]."'";
													  	$state=mysqli_query($con1,"select * from avo_branch where id='".$row[10]."'");
													  	//while($state1=mysqli_fetch_row($state)){
															$state1=mysqli_fetch_row($state);
															echo   $state1[1];
													  //}
													 //}
                                                    } ?>
                                                    </td>
                                            
                            </tr>
                        
                        
                        <?php $sn++;
						         } ?>
                        </table>
                        
                      