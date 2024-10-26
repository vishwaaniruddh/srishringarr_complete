<?php
include("config.php");
// ====================================--MASTERADMIN MENU---=================================================
function masteradmin()
{
	$qrytmp=mysql_query("Select * from tempclosedcall where status=0");
	$tmpres=mysql_fetch_row($qrytmp);

?>
 	<li><a href="#"> Alerts</a>
 		<ul>
 			<li><a href="view_callalert.php">View Call Alerts</a>
 			<li><a href="view_alert.php">View Branch Alerts</a></li>
 			<li><a href="view_alert_old.php">View Archive Data</a></li>
  			<!--<li><a href="tempclosed.php">Temporarily Closed<font color="#FF0000"><sup><?php echo mysql_num_rows($qrytmp); ?></sup></font></a></li>-->
   			<li><a href="view_alertlocal.php">Local Calls Alerts</a></li>
   			<li><a href="view_alert_cust.php">View Customer Alers</a></li>
   			<li><a href="view_pmcalls.php">View PM Calls</a></li>
                         <li><a href="viewBRF_form.php">view BRF</a></li>
                        
  		</ul>
 	</li>
 </li>
 
 <li><a href="buyers_form.php">Buyers</a></li>
 
 
 
 	<li><a href="#">Site</a>
  			<ul>
    			<li><a href="newsite.php">Add New Site in Bulk </a></li>
    			
    			<li><a href="newsite1.php">Add New Site</a></li>  
   			<li><a href="view_site.php">View Site</a></li>
   			<li><a href="tempsite.php">Temp Sites</a>
   			<li><a href="generateSO.php">Generate SO</a>
                       
   			<li><a href="invoices.php">Invoices</a>
                       
   			<!--<li><a href="newinstalation_local.php">New Installation(Local)</a></li>-->   
  			</ul>
 	</li>
 
 
 	<li><a href="#">Generate Calls </a>
 		<ul> 
 			<li><a href="service.php">Service Call </a></li>
 			<!--<li><a href="newalert1.php">New Installation</a></li>-->
 			<li><a href="pendinginstallation.php">New Installation</a>
 			<li><a href="newtempsite.php">New Temporary Sites</a></li>
 			<li><a href="localservice.php">Local Service Call</a></li>
 			<li><a href="pmcalls.php">P.M. Calls</a></li>
 		</ul>
 	</li>
    
 	<li><a href="#">Branch</a>
  		<ul>
  			<li><a href="newcty_head.php">Add New </a></li>
            <li><a href="view_branchs.php">View Branch</a></li>
   			<li><a href="view_cityhead.php">View Users</a></li>
   			<li><a href="addmanager.php">Add Users</a></li> 
                       <!--<li><a href="BRF_form.php">Add BRF form</a></li>-->
                       <li><a href="batteryVender.php">Add battery Vendor</a></li>
<li><a href="create_department.php">create Department</a>
<li><a href="create_employee.php">Add Employee</a>
<li><a href="view_employee.php">View Employee</a>
<li><a href="AddAttendance.php">Add Attendance</a>
<li><a href="editattendance.php">Edit Attendance</a>
<li><a href="ViewAttendance.php">View Attendance</a>
<li><a href="AttendanceSummery.php">Attendance Summary</a>
  		</ul>
 	</li>
 
  	<li><a href="#">Assets</a>
  		<ul>
   			<li><a href="NewAssets.php">Add New Assets </a></li>
   			<li><a href="view_assets.php">View Assets</a></li>  
  		</ul>
 	</li>
 
 	<li><a href="#">Engineer</a>
  		<ul>
  			<li><a href="eng_alert.php">View Alerts</a></li>
  			<li><a href="engpmalert.php">View PM Alert</a></li>
   			<li><a href="newarea_eng.php">Add New Engineer </a></li>
   			<li><a href="view_areaeng.php">View Records</a></li>
   			<li><a href="eng_alert_local.php">Local Alerts</a></li>
  		</ul> 
 </li>
 
 	<li><a href="#">Reports</a>
 		<ul>
 			<li><a href="catwiserep.php">Category Wise Report</a></li>
 			<li><a href="monthrep.php">Monthly Report</a></li>
  			<li><a href="delegatetime.php">Delegation Report</a></li>
  			<li><a href="close_calltody.php">Today Close Call</a></li>
  			<li><a href="viewpmrep.php">PM Report</a></li>
  			<li><a href="allCloseCall.php">CALL MIS</a></li>  			
  			<li><a href="attendence_summary.php">Attendance Summary</a></li>
                       	<li><a href="call_summary.php">Call Summary</a></li>
            		<li><a href="tat.php">CLOSED SERVICE CALL TAT ANALYSIS</a></li>
            		<li><a href="ageing-analysis.php">OPEN SERVICE CALL AGEING ANALYSIS</a></li>
            		<li><a href="eng_mis_summary.php">Eng MIS Summary</a></li>
            		<li><a href="branch_call_summary.php">Branch Call Summary</a></li>
            		<li><a href="engr_call_summary.php">Engr Call Summary</a></li>
            		<li><a href="branch_open_call_summary.php">Branch Open Call Summary</a></li>
            	    <li><a href="engr_open_call_summary.php">Engr Open Call Summary</a></li>
            	
            		
            		<li><a href="service3pcallsmain.php">2+ Service Calls</a></li>
            		<!--<li><a href="visit_analysis.php">Visit Analysis</a></li>-->
<li><a href="daywise_calls.php">Daywise Calls</a></li>
<li><a href="Engwise_Calls.php">Engineerwise Calls</a></li>
<li><a href="Eta_Analysis_Report.php">Eta Analysis Report</a></li>
<li><a href="site_details_summary.php">Site Details Summary</a></li>
 		</ul>
 	</li>
   
  <li><a href="eng_mis.php ">Eng_MIS</a>
  		<ul>
  		<li><a href="eng_mis.php" target="">Create Eng_MIS</a></li>
 		<li><a href="createActivity.php" target="_blank">Create Activity</a></li>
 		<li><a href="activity_report.php">Activity MIS</a></li>
 		</ul>
  
  </li>
    
 <li><a href="site_issue.php">Site Issue</a>
 		<ul>
 		<li><a href="site_issue.php" >ADD Site Issues</a></li>
 		<li><a href="view_siteissue.php" >View Site Issues</a></li>		
 		</ul>
 	</li>
 
 <li><a href="pmcalls_new.php" target="_new">PM Calls</a></li>
 
 <li>
 <?php
 include("config.php");
 $cnt=0;
 $qry='';
 if($_SESSION['branch']!='all')
 {
 	$br1=str_replace(",","','",$br);
 	//echo $br1[0]."/".$br1[1];
	$br1="'".$br1."'";
	//echo $br1;
	//echo "select state from state where state_id in (".$br1.")";
	//echo "select state from state where state_id in (".$br1.")";
	$src=mysql_query("select state from state where state_id in (".$br1.")");
		while($srcrow=mysql_fetch_array($src))
		{
		$bran[]=$srcrow[0];
		}
		$br3=implode(",",$bran);
		$br2=str_replace(",","','",$br3);
		//echo $br1[0]."/".$br1[1];
		$br2="'".$br2."'";

	$qry="Select * from transfersites where tobranch in (".$br2.") and approval='0' and status='0'";
 	}
 	else
 		$qry="select * from transfersites where approval='0' and status='0'";
 		//echo $qry;
 ?>
 	<a href="transfercall.php">Tranfer Call <font color="#FF0000"><sup><?php echo mysql_num_rows(mysql_query($qry)); ?></sup></font></a></li>
	 	<li><a href="inacteng.php" target="_blank">Inactive Eng</a></li>
	 	
 		 <li><a href="summary_call.php" target="_blank">Sum Calls</a>
        		<ul>
        		<li><a href="summary_call.php" target="_blank">Summary Call</a></li>
            		<li><a href="summary_all_calls.php" target="">Summary All Calls</a></li>
        		</ul>
        	</li>
        	
        	<!--<li><a href="#">Attendence</a>
 			<ul>
 				<li> <a href="add_attend.php">Add Attendence</a> </li>
 				 <li> <a href="view_attend.php">View Attendence</a> </li>
 			</ul>
 		</li>-->
 		
 		<li><a href="#">Setting</a>
 			<ul>
 				<li> <a href="track.php">Tracker</a> </li>
 				<li> <a href="add_attend.php">Add Attendence</a> </li>
 				 <li> <a href="view_attend.php">View Attendence</a> </li>
 				<li> <a href="viewccmails.php">CC Emails</a> </li>
                		<li> <a href="view_branchmgr_mail.php">Branch Mgr Emails</a> </li>
                                <li> <a href="GPS_panel.php">GPS Panel</a> </li>
 				 <li> <a href="change_pwd.php">Change Password</a> </li>
 				  <li> <a href="eng_mis_summary_test.php">Eng mis summary test</a> </li>
 				  <li> <a href="branch_MIS.php">Branch MIS</a> </li>
 				  <li> <a href="delegation_summary.php">Delegate Summary</a> </li>
 			</ul>
 	</li>
 <?php
}

//============================================Admin menu=================================
function Admin()
{

?>
 <li><a href="view_alert.php">Home</a></li>
 
 <li><a href="#">Site</a>
  	<ul>
    	<li><a href="newsite.php">Add New </a></li>
   		<li><a href="view_site.php">View Site</a></li>
    	<li><a href="tempsite.php">Temp Sites</a>
  	</ul>
 </li>
 
 	<li><a href="#">Branch</a>
  		<ul>
  			<li><a href="newcty_head.php">Add New </a></li>
   			<li><a href="view_cityhead.php">View Branch</a></li> 
  		</ul>
 	</li>
 
  	<li><a href="#">Assets</a>
  		<ul>
   			<li><a href="NewAssets.php">Add New Assets </a></li>
   			<li><a href="view_assets.php">View Assets</a></li>  
  		</ul>
 	</li>
    
 		<li><a href="#">Engineer</a>
  			<ul>
   				<li><a href="newarea_eng.php">Add New </a></li>
   				<li><a href="engpmalert.php">View PM Alert</a></li>
   				<li><a href="view_areaeng.php">View Records</a></li>      
  			</ul>
 		</li>
<?php
 include("config.php");
 $cnt=0;
 $qry='';
 if($_SESSION['user']!='admin')
 {
 $br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysql_query("select state from state where state_id in (".$br1.")");
while($srcrow=mysql_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";

$qry="Select * from transfersites where tobranch in (".$br2.") and approval='0' and status='0'";
 }
 else
 $qry="select * from transfersites where approval='0' and status='0'";
 
 //echo $qry;
  ?>
 <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysql_num_rows(mysql_query($qry)); ?></sup></font></a></li>
 <?php
    
}
// =======================------menu of call center------=======================================================================
function Call()
{
	?>
   
	<li><a href="#">Alerts </a>
   		<ul>
   			<li><a href="view_alert.php">View Alerts</a></li>
   			<li><a href="pmcalls.php">P.M. Calls</a></li>
    			<li><a href="view_alertlocal.php">Local Calls Alerts</a></li>
    			<li><a href="view_alert_cust.php">View Customer Alers</a></li>
 		</ul>
   	</li>
   
   
   <li><a href="#">Calls </a>
   		<ul>
   			<li><a href="service.php">Add New </a></li>
 			<li><a href="newtempsite.php">New Temporary Sites</a></li>
     			<!--<li><a href="newalert.php">New Installation</a></li>-->
     			<li><a href="pendinginstallation.php">New Installation</a>
			<!-- <li><a href="newtempsite.php">New Temporary Sites</a></li>-->
			<li><a href="newinstalation_local.php">New Installation(Local)</a></li>
			<!--<li><a href="non_deployment.php">Non Deployment</a></li>-->
 		</ul>
   </li>
   
   <li><a href="#">Site</a>   
  		<ul>  
   			<li><a href="newsite1.php">Add New site</a></li>
   			<li><a href="view_site.php">View Site</a></li>
 			<li><a href="localservice.php">Local Service Call</a></li>   
  		</ul>
  
  <li><a href="#">Engineer</a>
  		<ul>
  			<li><a href="eng_alert.php">View Alerts</a></li>
  			<!-- <li><a href="newarea_eng.php">Add New Engineer </a></li>-->
   			<li><a href="view_areaeng.php">View Records</a></li>
  		</ul>  
 </li>
 
 		<li><a href="CRM/welcome.php" target="_new">PM Calls</a></li>
 		<li><a href="summary_call.php" target="_blank">Summary Calls</a></li>
 		
 		<li><a href="#">Setting</a>
 			<ul>
 			<li><a href="change_pwd.php">Password Change</a></li>
 			</ul>
 		</li>
    <?php
}

//========================---------MENU of Branch Head------------========================================================
function BranchHead()
{
	$qrytmp=mysql_query("Select * from tempclosedcall where status=0 and branch=(select state from state where state_id='".$_SESSION['branch']."')");
	$tmpres=mysql_fetch_row($qrytmp);
//echo "Select * from tempclosedcall where status=0 and branch=(select state from state where state_id='".$_SESSION['branch']."')";
 ?>
 
<li><a href="#"> Alerts</a>
 		<ul>
 			<li><a href="view_alert.php">View Alerts</a></li>
			<!--<li><a href="tempclosed.php">Temporarily Closed<font color="#FF0000"><sup><?php echo mysql_num_rows($qrytmp); ?></sup></font></a></li>-->
 			<li><a href="pmcalls.php">P.M. Calls</a></li>
  			<li><a href="view_alertlocal.php">Local Calls</a></li>
<li><a href="viewBRF_form.php">BRF Calls</a></li>
<li><a href="view_employee.php">View Employee</a></li>
		</ul>	
        
 	<li><a href="newarea_eng.php">Engineer</a>
 		<ul>
   			<li><a href="view_areaeng.php">View Records</a></li> 
   			 <!--<li><a href="newarea_eng.php">Add Engineer</a></li>  -->
   			 
    	</ul>
    </li>
   
   <li><a href="#">Eng_MIS</a>   
   		<ul>
   			<li><a href="eng_mis.php">Add MIS</a></li>  
   			<li><a href="activity_report.php">Show MIS</a></li> 
    	</ul>
   
   </li>
   
    <li><a href="#">Site</a>
 		<ul>   
   			<li><a href="view_site.php">View Site</a></li> </ul>
   			<!--<li><a href="summary_call.php" target="_blank">Summary Calls</a></li>-->
   <?php
 include("config.php");
 $cnt=0;
 $qry='';
 
$br1=$_SESSION['branch'];
$branch=mysql_query("select * from avo_branch where id='".$br1."'");
$branch1=mysql_fetch_row($branch);


//echo "Select * from transfersites where tobranch ='".$branch1[1]."' and approval='0' and status='0'";
$qry="Select * from transfersites where tobranch ='".$branch1[1]."' and approval='0' and status='0'";
 
 
//echo $qry;
  ?>
		<li> <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysql_num_rows(mysql_query($qry)); ?></sup></font></a></li>
        
		<li><a href="pmcalls_new.php" target="_new">PM Calls</a></li>
        
		<li><a href="#">Generate Calls</a>        
 		<ul> 
			<!--<li><a href="pendinginstallation.php">Pending Installation</a>-->			
 			<!--<li><a href="newtempsite.php">New Temporary Sites</a></li>-->
 			
 			<li><a href="localservice.php">Local Service Call Log </a></li>
 			<!--<li><a href="newinstalation_local.php">New Installation Calls(Local)</a></li>-->
 		</ul>
 	</li>
 	
 		<li><a href="#">Attendence</a>
 			<ul>
 				<!--<li> <a href="add_attend.php">Add Attendence</a> </li>
 				 <li> <a href="view_attend.php">View Attendence</a> </li>-->
 				 
 				 <li><a href="AddAttendance.php">Add Attendance</a>
                               
                                  <li><a href="ViewAttendance.php">View Attendance</a>
                                  <li><a href="AttendanceSummery.php">Attendance Summary</a>
 				 
 			</ul>
 		</li>
 	 <li><a href="GPS_panel.php" target="_new">GPS Panel</a></li>
 	 <li><a href="#">Setting</a>
 		<ul>

        	<li> 	<li><a href="track.php">Tracker</a></li>
<!--<a href="add_attend.php">Add Attendence</a> </li>
 			<li> <a href="view_attend.php">View Attendence</a> </li>--->
 			<li><a href="change_pwd.php">Password Change</a></li>
 		</ul>
 	</li>
 	
  <!-- <li><a href="#">Engineer</a>
  <ul>
  <li><a href="eng_alert.php">View Alerts</a></li>
	<li><a href="newarea_eng.php">Add New Engineer </a></li>
   	<li><a href="view_areaeng.php">View Records</a></li>
  </ul>
  
 </li>-->
 <?php
   ?>
 
<?php }

//===================================--------------MENU of Engineer------------===========================================================
function Engineer()
{

	?>
	<li><a href="#">Calls </a>
    	<ul>
    		<li><a href="eng_alert.php">View Alerts</a></li>
    		<li><a href="engpmalert.php">View PM Alert</a></li>
    		<li><a href="eng_alert_local.php">Local Alerts</a></li>
  		</ul>
  	</li>
  
  	<ul>   
   		<li><a href="view_areaeng.php">View Records</a></li>   
  	</ul>
    <?php
}
//===================================--------------MENU of ACCOUNT MANAGER------------===========================================================
function AccountManager()
{	
	?>		
   <li><a href="#">Site</a>   
  		<ul>  
   			<li><a href="http://avoservice.in/newsite1.php">Add New site</a></li>
   			<li><a href="http://avoservice.in/AccountManager/view_site.php">View Sites</a></li>  
   			<li><a href="http://avoservice.in/AccountManager/pending_site.php">Pending Installations</a></li>  
   			<!--<li><a href="http://avoservice.in/generateSO.php">Pending AMC</a> -->
  		</ul>
    
   
  <!-- <li><a href="#">Amc</a>
        <ul>   
        	<li><a href="http://avoservice.in/AccountManager/view_amc.php">Amc View</a></li> 
        	<li><a href="http://avoservice.in/AccountManager/viewamc_pending.php">Amc Pending Installations</a></li> 
        </ul>-->

   
    <li><a href="#">Generated Calls</a>
    	<ul>   
        	<li><a href="http://avoservice.in/AccountManager/generatedcalls.php">All Generated Calls</a></li>  
        </ul>
   	<li><a href="summary_call.php" target="_blank">Summary Calls</a></li>
    <?php
}
//===================================--------------MENU of ACCOUNTS------------===========================================================
function Accounts()
{	
	?>		
   <li><a href="#">Site</a>   
  		<ul>  
   			<li><a href="http://avoservice.in/newsite1.php">Add New site</a></li>
   			<!--<li><a href="http://avoservice.in/AccountManager/view_site.php">Pending Installations</a></li>   -->
   			<li><a href="generateSO.php">Generate SO</a></li>
   			<li><a href="invoices.php">Invoices</a></li>
   			<li><a href="buyback.php">Buy Back</a></li>

  		</ul>
  		</li>
    
   <li><a href="#">Reports</a>   
  		<ul>  
   			 <li><a href="sales_report.php">Sales Report</a></li>
   			 <li><a href="sosummary_pending.php">Pending SO</a></li>
			 <li><a href="sosummary_done.php">Completed SO</a></li>
<li><a href="sopending_ageing_analysis.php">SO Pending Ageing Analysis</a></li>
<li><a href="sotat_analysis.php">TAT Analysis</a></li>
<li><a href="close_calltody.php">Today Close Call</a></li>

  		</ul>
  		</li>
 <!--  <li><a href="#">Amc</a>
        <ul>   
        	<li><a href="http://avoservice.in/AccountManager/view_amc.php">Amc View</a></li> 
        	<li><a href="http://avoservice.in/AccountManager/viewamc_pending.php">Amc Pending Installations</a></li> 
        </ul>

   
    <li><a href="#">Generated Calls</a>
    	<ul>   
        	<li><a href="http://avoservice.in/AccountManager/generatedcalls.php">All Generated Calls</a></li>  
        </ul>
   	<li><a href="summary_call.php" target="_blank">Summary Calls</a></li>-->
    <?php
}

?>