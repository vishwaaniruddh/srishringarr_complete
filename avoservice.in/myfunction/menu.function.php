<?php
include("config.php");
// =============MASTERADMIN MENU---==============================
function masteradmin()
{
//	$qrytmp=mysqli_query($con1,"Select * from tempclosedcall where status=0");
//	$tmpres=mysqli_fetch_row($qrytmp);

?>
 	<li><a href="#"> Alerts</a>
 		<ul>
 		    <li><a href="open_calls.php">Open Calls Status</a></li>
 		    <li><a href="route_plan.php">Route Planning</a></li>
 			<li><a href="view_callalert.php">View Call Alerts</a></li>
 			<li><a href="view_alert.php">View Branch Alerts</a></li>
 			<li><a href="view_alert_20_21.php">Calls Jan20-Dec21</a></li>
 		<!--	<li><a href="view_alert_old.php">Calls Oct18-Dec20</a></li>
 			<li><a href="view_alert_0418_0918.php">Calls Apr18-Sep18</a></li>
 			<li><a href="view_alert_1017_0318.php">Calls Oct17-Mar18</a></li>-->
  			<li><a href="pending_del.php">Pending Delegation Calls</a></li>
  			 <li><a href="Eta_Analysis_Report.php">Eta Analysis Report</a></li>
  			<li><a href="viewBRF_form.php">view BRF</a></li>
  			<li><a href="call_report.php">FSR Data</a></li>
  			<!--<li><a href="tempclosed.php">Temporarily Closed<font color="#FF0000"><sup><?php //echo mysqli_num_rows($qrytmp); ?></sup></font></a></li>-->
   			 
   	<!--		<li><a href="view_alertlocal.php">Local Calls Alerts</a></li>-->
   			<li><a href="repeat_call.php" >Repeat Alerts</a></li>
   		<!--	<li><a href="view_alert_cust.php">View Customer Alerts</a></li>-->
   			<li><a href="view_pmcalls.php">View PM Calls</a></li>
   			<li><a href="snaps_new.php">Inst Snaps - New</a></li> 
   	<!--		<li><a href="view_instsnaps.php">Inst Snaps</a></li>-->
   			<li><a href="inst_report.php">Inst Reports</a></li>
   			<li><a href="ir_summary.php">IR Summary</a></li>
   	<!--		<li><a href="snap_summary.php">Inst Snaps Summary</a></li>-->
   			<li><a href="dist_calc.php">Engg Mapping / Distance</a></li>
   			
   			
            </ul>
 	<!-- </li> -->
 </li>
 
 <!--<li><a href="buyers_form.php">Buyers</a></li>-->
 
 <li><a href="#">Operations</a>
  	<ul>
		<li><a href="buyers_form.php">Add Buyers </a></li>
       	<li><a href="view_buyers.php">View Buyers</a></li>
       	<li><a href="add_purchase_order.php">Add Purchase Orders </a></li>
       	<li><a href="view_purchase_order.php">View Purchase Orders</a></li>
       	<li><a href="sales.php">Add Sales Orders</a></li>
     
       	<li><a href="sales_ordernew.php">Pending Sales Orders</a></li>
       	<li><a href="view_sales_order.php">All Sales Orders</a></li>
       	<li><a href="new_invoices.php">Invoice</a></li>
       	<li><a href="productwise_sales.php">Prouct-wise Sales</a></li>
       	<li><a href="sales_return.php">Sales Return</a></li>
       	<li><a href="zerovalue_sales.php">Zero Value Invoices</a></li>
       	
       	<li><a href="barcode_status.php">Barcode Status</a></li>
       	<li><a href="dispatches.php">Dispatch details</a></li>
      	<li><a href="view_warehouse.php">Warehouse- Installation</a></li>
    <!--  	<li><a href="view_buyback.php">View Buyback</a></li> -->
      	<li><a href="new_buyback.php"> New Buyback</a></li>
      	
      	<li><a href="view_ware_noninstall.php">Warehouse Non Installation</a></li>
      		<li><a href="excel_sales.php">Import Sales Order</a></li>
      	<li><a href="creports.php">Reports</a></li>
      	<li><a href="ops_status.php"> Ops Activity Summary</a></li>
      	<li><a href="ops_tat.php"> Supply Completed TAT Analysis</a></li>
      	<li><a href="ops_ageing.php">Pending Supply Ageing</a></li>
      	<li><a href="ops_openstatus.php"> Supply chain  Status Today</a></li>
      	<li><a href="del_tat.php">Installation Delegation/ETA Timeslot</a></li>
      	<li><a href="salesreport_exec.php">Sales Report - Salesman</a></li>
      	<li><a href="excel_purchase.php">Import Purchase Order</a></li>
      	
  	</ul>
</li>

<li><a href="#">AMC Process</a>
  	<ul>
		<li><a href="new_amc_po.php">Add AMC PO </a></li>
       	<li><a href="amc_sales_order.php">AMC Sales Orders</a></li>
       	<li><a href="view_amcpo.php">AMC Uploads </a></li>
       	<li><a href="email_deactive.php">E-Mail on AMC Deact </a></li>
       	
  	</ul>
</li>

<li><a href="#">Br Expenses</a>
  	<ul>
		<li><a href="log_search.php">Out-ward Logistics Expenses </a></li>
		<li><a href="log_search.php">In-ward Logistics Expenses </a></li>
       	<li><a href="add_adminexp.php">Admin Expenses</a></li>
       	<li><a href="">Office Maint. Exp</a></li>
       	
  	</ul>
</li>


 
 	<li><a href="#">Site</a>
  			<ul>
    			<li><a href="newsite.php">Add New AMC Sites </a></li>
    			<li><a href="deactivate_amc.php">Deactivate AMC Sites </a></li>
    	<!--		<li><a href="newsite1.php">Add New Site</a></li>  -->
   				<li><a href="find_site.php">Search warranty Site </a></li>
   			<li><a href="view_site.php">AMC/Warr Data</a></li>
   			<li><a href="tempsite.php">Temp Sites</a></li>
   			<li><a href="temp_summary.php">Temp Call Summary</a></li>
   			<li><a href="generateSO.php">Generate SO</a></li>
   			<li><a href="site_details_summary.php">Site Details Summary</a></li>
   			<li><a href="amc_eng_distance.php">Site Distances</a></li>
   				<li><a href="view_site_mapp.php">Site Mapp details</a></li>
   				<li><a href="site_mapp_change.php">Change Engineer Mapping</a></li>
   				
   			<li><a href="warr_end_slot.php">Warranty Expiry Slot</a></li>
   			<li><a href="assetwise_sites.php">Product-wise Sites</a></li>
   			<li><a href="engg_site_details.php">Engr Site Details & Log PM</a></li>
                       
   			<!-- engg_site_details<li><a href="invoices.php">Invoices</a>
  			<li><a href="newinstalation_local.php">New Installation(Local)</a></li>-->   
  			</ul>
 	</li>
 
 
 	<li><a href="#">Generate Calls </a>
 		<ul> 
 		<!--	<li><a href="service1.php">Service Call </a></li> -->
 		<li><a href="logcall.php">Generate Service Call </a></li>
 			<li><a href="service1.php">Service Call </a></li>
 			
 		<!--	<li><a href="newalert1.php">New Installation</a></li>-->
 			<li><a href="pendinginstallation.php">New Installation</a>
 			<li><a href="newtempsite.php">New Temporary Sites</a></li>
 			<li><a href="localservice.php">Local Service Call</a></li>
 			<li><a href="pmcalls.php">P.M. Calls</a></li>
 			<li><a href="bulk_pmcall_log.php">Bulk PM call logs</a></li>
 			<li><a href="bulk_servicelog.php">Bulk Service call logs</a></li>
 		</ul>
 	</li>
    
 	<li><a href="#">Users</a>
  		<ul>
  			<li><a href="newcty_head.php">Add New </a></li>
            <li><a href="view_branchs.php">View Branch</a></li>
   			<li><a href="view_cityhead.php">View Users</a></li>
   			<li><a href="addmanager.php">Add Users</a></li> 
                       <!--<li><a href="BRF_form.php">Add BRF form</a></li>-->
            <li><a href="batteryVender.php">Add battery Vendor</a></li>
            <li><a href="branch_exp_entry.php">Branch Exp Entry</a></li>
</ul>
 	</li>

<li><a href="#">HR</a>
  		<ul>


<li><a href="create_department.php">create Department</a>
<li><a href="create_employee.php">Add Employee</a>
<li><a href="view_employee.php">View Employee</a>
<li><a href="AddAttendance.php">Add Attendance to All</a>
<li><a href="add_attendance_dept.php">Add Department-wise Attendance</a>
<li><a href="editattendance.php">Edit Attendance</a>
<li><a href="ViewAttendance.php">View Attendance</a>
<li><a href="AttendanceSummery.php">Attendance Summary</a>

<li><a href="engg_visit_count.php">Engr Site Attendance count</a>

  		</ul>
 	</li>
 
  	<li><a href="#">Products</a>
  		<ul>
   			<li><a href="NewAssets.php">Add New Product </a></li>
   			<li><a href="view_assets.php">View Product List</a></li>  
   			<li><a href="asset_msp.php">Product MSP</a></li>  
  		</ul>
 	</li>
 
 	<li><a href="#">Engineer</a>
  		<ul>
  			
   			<li><a href="newarea_eng.php">Add New Engineer </a></li>
   			<li><a href="view_areaeng.php">View Engg Records</a></li>
   		<!--	<li><a href="eng_alert.php">View Alerts</a></li>
  			<li><a href="engpmalert.php">View PM Alert</a></li>-->
   			<li><a href="eng_day_resp.php">Daily Engr Work Hour</a></li>
        <li><a href="engg_logdetails.php">Engr Start-end day records</a></li>
        <li><a href="Engwise_Calls.php">Engineer Response Timeslot</a></li>
   			<li><a href="deletedengg.php">Deleted Engg IDs</a></li>
   			<li><a href="sitevisit_duration.php">Engr at Site Duration</a></li>
   			<li><a href="travelled_map.php">Engr Calls & travel Map</a></li>
   			<li><a href="engg_first_call.php">Engr First Call & Dist</a></li>
   		<li><a href="pmtoservice_duration.php">PM to Service Duration</a></li>
   	<li><a href="engg_status_today.php">Engr Daily Call Status</a></li>
   	<li><a href="snap_ir_status.php">Snap & IR Status</a></li>
   	<li><a href="engr_calls_day.php">Engr Attendance & Calls</a></li>
   	
   	   		<!--	<li><a href="eng_alert_local.php">Local Alerts</a></li> -->
  		</ul> 
 </li>
 
 	<li><a href="#">Reports</a>
 		<ul>
 	<li><a href="catwiserep.php">Category Wise Report</a></li> 
 			<li><a href="spare_depend.php">Attended Open/Hold Calls</a></li>
 		<!--	<li><a href="monthrep.php">Monthly Report</a></li>
  			<li><a href="delegatetime.php">Delegation Report</a></li> -->
  			<li><a href="delegate_rep.php">Delegation Report</a></li> 
  		<!--	<li><a href="close_calltody.php">Today Close Call</a></li>-->
  			<li><a href="call_flow_status.php">Call Flow status</a></li>
  		
  			<li><a href="viewpmrep.php">PM Report</a></li>
  			<li><a href="allCloseCall.php">CALL MIS</a></li>  			
  <!--	<li><a href="attendence_summary.php">Attendance Summary</a></li>
            <li><a href="call_summary.php">Call Summary</a></li>  -->
            <li><a href="tat.php"> Closed TAT Analysis</a></li>
            <li><a href="ageing-analysis.php">OPEN Service Calls Ageing</a></li>
            <li><a href="instcall_ageing.php">Installation Calls Ageing</a></li>
         <!--   <li><a href="eng_mis_summary.php">Eng MIS Summary</a></li> -->
            <li> <a href="eng_mis_summary_test.php">Eng mis summary</a> </li>
            <li><a href="branch_call_summary.php">Branch Call Summary</a></li>
            <li><a href="engr_call_summary.php">Engr Call Summary</a></li>
            <li><a href="branch_open_call_summary.php">Branch Open Call Summary</a></li>
            <li><a href="engr_open_call_summary.php">Engr Open Call Summary</a></li>
            		
      <!--  <li><a href="service3pcallsmain.php">2+ Service Calls</a></li> -->
       <!--     <li><a href="visit_analysis.php">Visit Analysis</a></li> -->
        <li><a href="daywise_calls.php">Branch Daywise Calls</a></li>
        
    <li><a href="resp_tat_summary.php">Branch Resp Time Slot Summary</a></li>
  		</ul>
 	</li>
   
  <li><a href="#">Eng Oth Activity</a> 
  		<ul>
  		<li><a href="eng_mis.php" target="">Enter Eng Other Activity</a></li>
 		<li><a href="createActivity.php" target="_blank">Create Activity</a></li>
 		<li><a href="activity_report.php">View Eng Other Activity </a></li>
 		</ul>
  
  </li>
  
   
  <li><a href="#">Engr Claims</a>
  		<ul>
  		
  		<li><a href="expense_entry.php">Engineer Expense Entry</a></li>
 		<li><a href="view_expense.php">View Engineer Travel Claims</a></li>
 		<li><a href="view_approved_exp.php">Approved Travel Claims</a></li>
 		<li><a href="expense_analysis.php">Expense Analysis</a></li>
 		<li><a href="expense_status.php">Expense Status</a></li>
 		<li><a href="engg_oth_exp.php">Engr Other Expenses claim form</a></li>
 		<li><a href="view_oth_expense.php">View Engr Other Expense Status</a></li>
 	    <li><a href="view_app_othexp.php">Branch Approved Other Expenses</a></li>	
 		
 		</ul>
  
  </li>
    
 <li><a href="#">Site Issue</a>
 		<ul>
 		<li><a href="site_issue.php" >ADD Site Issues</a></li>
 		<li><a href="view_siteissue.php" >View Site Issues</a></li>
 		
 		</ul>
 	</li>
 
 <li><a href="#">PM Module</a>
 <ul>
<!-- <li> <a href="pmcalls_new.php" target="_new">PM Calls</a></li> -->
 <li> <a href="pm_calls.php" >PM Planning</a></li>
 
 	</ul>
 	</li>
 
<!-- <li>
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
	$src=mysqli_query($con1,"select state from state where state_id in (".$br1.")");
		while($srcrow=mysqli_fetch_array($src))
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
 	<a href="transfercall.php">Tranfer Call <font color="#FF0000"><sup><?php echo mysqli_num_rows(mysqli_query($con1,$qry)); ?></sup></font></a></li>
	 	

<li><a href="inacteng.php" target="_blank">Inactive Eng</a></li> -->
	 	
 	
<li><a href="#">Sum Calls</a>
 	   
    <ul>
        <li><a href="summary_call.php" target="_blank">Summary Call</a></li>
        <li><a href="summary_all_calls.php" target="">Summary All Calls</a></li>
        <li><a href="resol_tatslot.php" target="">Branch Average TATs</a></li>
        <li><a href="engg_close_tatslot.php" target="">Engr Closed Ser TAT slot</a></li>
        <li><a href="engg_avgtat.php" target="">Engr Average TAT</a></li>
        <li><a href="engg_calls_datewise.php" target="">Engr Date-wise calls</a></li>
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
 		<li> <a href="livetrack.php">Live Track</a> </li>
 		<li> <a href="distances.php">Distance Travelled</a> </li>
 		<li> <a href="engg_dis.php">Engineer Travel Distance</a> </li>
 		<li> <a href="viewccmails.php">CC Emails</a> </li>
 		<li> <a href="add_whatsappno.php">Add Customer WhatsApp No </a> </li>
 		<li> <a href="view_whatspp_no.php">View Customer WhatsApp No </a> </li>
 		<li> <a href="view_branchmgr_mail.php">Branch Mgr Emails</a> </li>
        <li> <a href="GPS_panel.php">GPS Panel</a> </li>
        <li> <a href="gps_engg.php">Engineer GPS Panel</a> </li>
 		<li> <a href="gps_timeslot.php">GPS Records Slot</a> </li>
 		<li> <a href="gps_recordcount.php">GPS Records Per Day</a> </li>
 		<li> <a href="change_pwd.php">Change Password</a> </li>
 		
 		<li> <a href="branch_MIS.php">Branch MIS</a> </li>
 		<li> <a href="delegation_summary.php">Delegate Summary</a> </li>
 		<li> <a href="distance_summary.php">Distance Summary</a> </li>
 		<li> <a href="del_type_sum.php">Delegation Type Summary</a> </li>
 	</ul>
 
 	</li>
 <?php
}

//============================================Admin menu=================================
function Admin()
{

?>
 <li><a href="#">Alerts</a>
  <ul>  
     <!--   <li><a href="open_calls.php">Open Calls Status</a>
        
        
        <li><a href="view_alert_old.php">View Archive Calls</a></li> -->
        <li><a href="view_alert.php">View Alerts</a></li>
        <li><a href="view_callalert.php">Call Alerts-master</a>
        <li><a href="route_plan.php">Route Planning</a>
         <li><a href="call_report.php">FSR Data</a></li>
        <li><a href="viewBRF_form.php">view BRF</a></li>
       <li><a href="view_instsnaps.php">Inst Snaps</a></li>
        <li><a href="snaps_new.php">Inst Snaps - New</a></li>
 </ul>
 </li>
 
 <li><a href="#">AMC/Warr Data</a>
  	<ul>
    	
   		<li><a href="view_site.php">View AMC/Warr Site</a></li>
   		<li><a href="dist_calc.php">Engg Mapping / Distance</a></li>
   		
   		<li><a href="find_site.php">Search Site </a></li>
   			<li><a href="engg_site_details.php">Engr Sites-Dist & Log PM</a></li>
    	<li><a href="tempsite.php">Temp Sites</a></li>
    	<li><a href="warr_end_slot.php">Warranty Expiry Slot</a></li>
    	<li> <a href="pm_calls.php" >PM Planning</a></li>
  	</ul>
 </li>
 
<!-- <li><a href="#">Generate Calls </a>
 		<ul> 
 			<li><a href="service1.php">Service Call </a></li>
 			<li><a href="newalert1.php">New Installation</a></li>
 		<li><a href="newtempsite.php">New Temporary Sites</a></li>
 		
 			<li><a href="localservice.php">Local Service Call</a></li>
 			<li><a href="email_deactive.php">E-Mail on AMC Deact </a></li>
 		</ul>
 	</li>
 	
 	<li><a href="#">PM Module</a>
 <ul>
<!-- <li> <a href="pmcalls_new.php" target="_new">PM Calls</a></li> 
 <li> <a href="pm_calls.php" >PM Planning</a></li>
 
 	</ul>
 	</li>
 
 	<li><a href="#">User IDs</a>
  		<ul>
  	<!--	<li><a href="newcty_head.php">Add branch Id </a></li> 
  			<li><a href="addmanager.php">Add Users</a></li> 
        	<li><a href="view_cityhead.php">View Users</a></li> 
  		</ul>
 	</li> -->
 	
 	 <li><a href="#">Sales Order</a>
 		<ul>  
   		
           <li><a href="sales_ordernew.php">Pending Sales Orders</a></li>
           <li><a href="view_sales_order.php">All Sales Orders</a></li>
            <li><a href="export_pend_deli.php">Export Pending Deliveries</a></li>
   			<li><a href="new_invoices.php">New Invoices</a></li>
   			<li><a href="sales_return.php">Sales Return</a></li>
   			<li><a href="zerovalue_sales.php">Zero Value Invoices</a></li>
   			
        </ul>
        </li>
 
 
 		<li><a href="#">Engineer</a>
  			<ul>
   		<!--		<li><a href="newarea_eng.php">Add New </a></li>
   				<li><a href="engpmalert.php">View PM Alert</a></li> -->
   				<li><a href="view_areaeng.php">View Records</a></li>      
  			</ul>
 		</li>
 	<li><a href="#">Daily Reports</a>
  			<ul>
  		<li><a href="call_summary.php">Call Summary</a></li>
        <li><a href="tat.php">Closed Service Call TAT Analysis</a></li>
        <li><a href="ageing-analysis.php">Open Service call Ageing</a></li>	
 		
 	</ul>
 		</li>
 		
 		<li><a href="#">Reports</a>
  			<ul>
  			 <li><a href="engg_status_today.php">Engr Daily Call Status</a></li>   
 	       	<li><a href="spare_depend.php">Attended Open / Hold Calls</a></li>
 	       	<li><a href="close_calltody.php">Today Close Call</a></li>
  			<li><a href="viewpmrep.php">PM Report</a></li>
  			
  	<!--	<li><a href="allCloseCall.php">Closed Call data</a></li>
  	<li><a href="attendence_summary.php">Attendance Summary</a></li>-->  	
  	<li><a href="ViewAttendance.php">View Attendance</a>	
  	    	
            
        <!--    <li><a href="eng_mis_summary.php">Eng MIS Summary</a></li> -->
            <li> <a href="eng_mis_summary_test.php">Eng mis summary</a> </li>
            <li><a href="branch_call_summary.php">Branch Call Summary</a></li>
            <li><a href="engr_call_summary.php">Engr Call Summary</a></li>
            <li><a href="branch_open_call_summary.php">Branch Open Call Summary</a></li>
            <li><a href="engr_open_call_summary.php">Engr Open Call Summary</a></li>
            <li><a href="ir_summary.php">IR Summary</a></li>
            <li><a href="inst_report.php">IR Report Status</a></li>
            	
       <!--     <li><a href="visit_analysis.php">Visit Analysis</a></li> -->
            <li><a href="daywise_calls.php"> Branch Daywise Calls</a></li>
            <li><a href="eng_day_resp.php">Daily Engr Work Hour</a></li>
            <li><a href="Engwise_Calls.php">Engineer Response time slot</a></li>
            <li><a href="resp_tat_summary.php">Branch Resp Time slot Summary</a></li>
            <li><a href="engg_avgtat.php" target="">Engr Average TAT</a></li>
           
            <li><a href="Eta_Analysis_Report.php">ETA Analysis Report</a></li>
            <li><a href="site_details_summary.php">Site Details Summary</a></li>
 		    
 			<li> <a href="branch_MIS.php">Branch MIS</a> </li>
 		</ul>
 		</li>
 		
 	<li><a href="#">Engineer Monitor</a>
 		<ul>
 		    <li><a href="travelled_map.php">Engr Calls & travel Map</a></li>
 			<li><a href="inacteng.php" target="_blank">Inactive Eng</a></li>
 			<li><a href="activity_report.php">Engr MIS Activity</a></li>
 			<li> <a href="track.php">Tracker</a> </li>
 			<li> <a href="livetrack.php">Live Track</a> </li>
 		<li><a href="engg_logdetails.php">Engr Start-end day records</a></li>
 			<li> <a href="distances.php">Distance Travelled</a> </li>
 			<li> <a href="distance_summary.php">Distance Summary</a> </li>
 			<li> <a href="engg_dis.php">Engineer Travel Distance</a> </li>
 			<li> <a href="GPS_panel.php">GPS Panel</a> </li>
 			<li> <a href="gps_engg.php">Engineer GPS Panel</a> </li>
 			<li> <a href="gps_timeslot.php">GPS Records Slot</a> </li>
 			<li> <a href="delegation_summary.php">Delegate Summary</a> </li>
 			<li><a href="engr_calls_day.php" target="">Engr Calls per Day</a></li>
 			<li><a href="activity_report.php">View Eng Other Activity </a></li>	  
 			</ul>
 	</li>
 
 <li><a href="#">Others</a>
 		<ul>
 		    <!--<li><a href="BRF_form.php">Add BRF form</a></li>-->
            <li><a href="batteryVender.php">Add battery Vendor</a></li>	
            <li> <a href="viewccmails.php">CC Emails</a> </li>
            <li> <a href="view_branchmgr_mail.php">Branch Mgr Emails</a> </li>
 		    <li> <a href="change_pwd.php">Change Password</a> </li>
 
 </ul>
 	</li>
<? if($_SESSION['user']=='central_team') { ?> 	
<li><a href="#">Central Monitor</a>
 		<ul>
 		    <li><a href="snap_ir_status.php">Snap & IR Status</a></li>
 		    <li><a href="Engwise_Calls.php">Engineer Response time slot</a></li>
 		    <li><a href="call_flow_status.php">Call Flow status</a></li>
 		    <li><a href="delegate_rep.php">Delegation Report</a></li>
     
 </ul>
 	</li>
 	
<?php
}    
}
// ============------menu of hr------============================
function hr()
{ ?>
 <li><a href="#">Call_alerts </a>
 		<ul> 
 	<li><a href="view_alert.php">View Call Alerts</a></li>
 </ul>
 	</li>
 	
  <li><a href="#">HR Attendance</a>
 		<ul>
 <li><a href="create_department.php">create Department</a></li>
<li><a href="create_employee.php">Add Employee</a></li>
<li><a href="view_employee.php">View Employee</a></li>
<li><a href="AddAttendance.php">Add Attendance to All</a></li>
<li><a href="add_attendance_dept.php">Add Department-wise Attendance</a></li>
<li><a href="editattendance.php">Edit Attendance</a></li>
<li><a href="ViewAttendance.php">View Attendance</a></li>
<li><a href="AttendanceSummery.php">Attendance Summary</a></li>

 </ul>
 	</li>
 
 <li><a href="#">Service Engineers </a>
 		<ul> 
        
        <li><a href="newarea_eng.php">Add New Engineer </a></li>
        <li><a href="view_areaeng.php">View Engineer Records</a></li>
</ul>
 	</li>
 
 <li><a href="#">Engineer Reports</a>
 	<ul>
<li><a href="engg_status_today.php">Engr Daily Call Status</a></li>
<li><a href="engr_calls_day.php" target="">Engr Calls </a></li>

 <li><a href="engg_calls_datewise.php" target="">Engr Date-wise calls</a></li>
 <li> <a href="eng_mis_summary_test.php">Eng Call summary</a> </li>
<li><a href="engg_close_tatslot.php" target="">Engr Closed Ser TAT slot</a></li>
<li><a href="engg_avgtat.php" target="">Engr Average TAT</a></li>
<li><a href="engg_visit_count.php">Engr Site Attendance count</a>
 </ul>
 	</li>
 
 
 <li><a href="#">Engineer Monitor</a>
 	<ul>
 	<li><a href="travelled_map.php">Engr Calls & travel Map</a></li>
 	<li><a href="Engwise_Calls.php">Engineer Response time slot</a></li>
 	<li><a href="sitevisit_duration.php">Engr at Site Duration</a></li>
 			<li> <a href="livetrack.php">Live Track</a> </li>
 			<li> <a href="distances.php">Distance Travelled</a> </li>
 			<li> <a href="engg_dis.php">Engineer Travel Distance</a> </li>
 			<li> <a href="GPS_panel.php">GPS Panel</a> </li>
 		    <li> <a href="gps_engg.php">Engineer GPS Panel</a> </li>
 		<!--	<li> <a href="gps_timeslot.php">GPS Records Slot</a> </li> -->
 			<li><a href="eng_day_resp.php">Daily Engr Work Hour</a></li>
 			<li><a href="engg_logdetails.php">Engr Start-end day records</a></li>
 				  
 			</ul>
 	</li>
 
 <?php
    
}
// =======================------menu of call center------=======================================================================
function Call()
{
	?>
   
	<li><a href="#">Alerts </a>
   		<ul>
   			<li><a href="view_alert.php">View Alerts</a></li>
   			<li><a href="open_calls.php">Open Calls Status</a>
   			<li><a href="pmcalls.php">P.M. Calls</a></li>
    			<li><a href="view_alertlocal.php">Local Calls Alerts</a></li>
    			 <li><a href="call_report.php">FSR Data</a></li>
    			<li><a href="view_alert_cust.php">View Customer Alerts</a></li>
 		</ul>
   	</li>
   
   
   <li><a href="#">Generate Calls </a>
   		<ul>
   			<li><a href="find_site.php">Search Warranty Site & Generate call </a></li>
   			<!--	<li><a href="logcall.php">Generate Service Call </a></li>-->
   		<li><a href="service1.php">Generate Call </a></li>
 			<li><a href="newtempsite.php">New Temporary Call</a></li>
 			<li><a href="email_deactive.php">E-Mail on AMC Deact </a></li>
     
     			<!--<li><a href="newalert.php">New Installation</a></li>
     			<li><a href="pendinginstallation.php">New Installation</a>
		
			<li><a href="newinstalation_local.php">New Installation(Local)</a></li>
			<li><a href="non_deployment.php">Non Deployment</a></li>-->
 		</ul>
   </li>
   
   <li><a href="#">AMC/Warr Data</a>   
  		<ul>  
   		<!--	<li><a href="newsite1.php">Add New site</a></li> -->
   			<li><a href="view_site.php">View AMC/Warr Site</a></li>
 			<li><a href="localservice.php">Local Service Call</a></li>   
  		</ul>
  		
  		<li><a href="#">PM Module</a></li>
 <ul>
<!-- <li> <a href="pmcalls_new.php" target="_new">PM Calls</a></li> -->
 <li> <a href="pm_calls.php" >PM Planning</a></li>
 
 	</ul>
 	</li>
  
  <li><a href="#">Engineer</a>
  		<ul>
  			<li><a href="eng_alert.php">View Alerts</a></li>
  			<!-- <li><a href="newarea_eng.php">Add New Engineer </a></li>-->
   			<li><a href="view_areaeng.php">View Records</a></li>
  		</ul>  
 </li>
 
 	<!--	<li><a href="CRM/welcome.php" target="_new">PM Calls</a></li> -->
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
//	$qrytmp=mysqli_query($con1,"Select * from tempclosedcall where status=0 and branch=(select state from state where state_id='".$_SESSION['branch']."')");
//	$tmpres=mysqli_fetch_row($qrytmp);
//echo "Select * from tempclosedcall where status=0 and branch=(select state from state where state_id='".$_SESSION['branch']."')";
 ?>
 
<li><a href="#"> Alerts</a>
 		<ul>
 			<li><a href="view_alert.php">View Alerts</a></li>
			<!--<li><a href="tempclosed.php">Temporarily Closed<font color="#FF0000"><sup><?php //echo mysqli_num_rows($qrytmp); ?></sup></font></a></li>-->
			<li><a href="open_calls.php">Open Calls Status</a></li>
			<li><a href="route_plan.php">Route Planning</a></li>
 			 <li><a href="call_report.php">FSR Data</a></li>
 			<li><a href="pmcalls.php">P.M. Calls</a></li>
  			<li><a href="view_alertlocal.php">Local Calls</a></li>
            <li><a href="viewBRF_form.php">BRF Calls</a></li>
            <li><a href="view_employee.php">View Employee</a></li>
		</ul>	
        
 <li><a href="#">Engineers Record</a>
 		<ul>
   			<li><a href="view_areaeng.php">View Records</a></li> 
   	<!--		 <li><a href="newarea_eng.php">Add Engineer</a></li> -->
   		</ul>
    </li>
 <li><a href="#">Install Snaps</a>   
   		<ul> 
             <li><a href="view_instsnaps.php">Upload Snaps</a></li> 
             <li><a href="snaps_new.php">Inst Snaps - New</a></li>
             <li><a href="inst_report.php">Upload Inst Reports</a></li>
             <li><a href="ir_summary.php">IR Summary</a></li>
      </ul>
</li> 
 
 <li><a href="#">Eng_MIS</a>   
   		<ul>
   			<li><a href="eng_mis.php">Add MIS</a></li>  
   			<li><a href="activity_report.php">Show MIS</a></li> 
    	</ul>
 </li>
   
   
   
    <li><a href="#">AMC/Warr Data</a>
 		<ul>   
   			<li><a href="view_site.php">View AMC/Warr Site</a></li> 
   			<li><a href="dist_calc.php">Engg Mapping / Distance</a></li>
   			
   			</ul>
   			
   			</li>
   <li><a href="#">Site-Engr Mapping</a>
 		<ul>  
 	<li><a href="engg_site_details.php">Engr Sites-Dis & Log PM </a></li> 
   	<li><a href="view_site_mapp.php">Site Mapp details</a></li>
   	<li><a href="site_mapp_change.php">Change Engineer Mapping</a>
  	</ul>
   			
   			</li> 	
   	
   			
   <?php
 include("config.php");
 $cnt=0;
 $qry='';
 
$br1=$_SESSION['branch'];
$branch=mysqli_query($con1,"select * from avo_branch where id='".$br1."'");
$branch1=mysqli_fetch_row($branch);


//echo "Select * from transfersites where tobranch ='".$branch1[1]."' and approval='0' and status='0'";
$qry="Select * from transfersites where tobranch ='".$branch1[1]."' and approval='0' and status='0'";
 
 
//echo $qry;
  ?>
		<li> <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysqli_num_rows(mysqli_query($con1,$qry)); ?></sup></font></a></li>
		
		<li><a href="#">PM Plan</a>
 <ul>
<!-- <li> <a href="pmcalls_new.php" target="_new">PM Calls</a></li> -->
 <li> <a href="pm_calls.php" >PM Planning</a></li>
 
 	</ul>
 	</li>
        
<!--		<li><a href="pmcalls_new.php" target="_new">PM Calls</a></li> -->
        
		<li><a href="#">Generate Calls</a>        
 		<ul> 
 		<li><a href="find_site.php">Search Warranty Site & Generate call </a></li>
 		<li><a href="service1.php">Generate Call </a></li>
 	<!--	<li><a href="logcall.php">Generate Service Call </a></li> -->
			<!--<li><a href="pendinginstallation.php">Pending Installation</a>-->			
 			<!--<li><a href="newtempsite.php">New Temporary Sites</a></li>
 			<li><a href="localservice.php">Local Service Call Log </a></li> -->
 			<!--<li><a href="newinstalation_local.php">New Installation Calls(Local)</a></li>-->
 		</ul>
 	</li>
 	
 		<li><a href="#">Attendence</a>
 			<ul>
 				<!--<li> <a href="add_attend.php">Add Attendence</a> </li>
 				 <li> <a href="view_attend.php">View Attendence</a> </li>-->
 				 
 				<li><a href="AddAttendance.php">Add Attendance to All</a>
               <li><a href="add_attendance_dept.php">Add Department-wise Attendance</a>
                <li><a href="ViewAttendance.php">View Attendance</a>
                <li><a href="AttendanceSummery.php">Attendance Summary</a>
 				 
 			</ul>
 		</li>
 	 
 	 <li><a href="#"> Engineer Monitor</a>   
 	    	<ul>
 	    	    <li><a href="travelled_map.php">Engr Calls & travel Map</a></li>
 	    	    <li><a href="engg_status_today.php">Engr Daily Call Status</a></li>
 	            <li><a href="GPS_panel.php">GPS Panel</a></li>
 	            <li> <a href="gps_engg.php">Engineer GPS Panel</a> </li>
 	      <li><a href="engg_logdetails.php">Engr Start-end day records</a></li>
 	            <li> <a href="distances.php">Distance Travelled</a> </li>
 	            <li> <a href="engg_dis.php">Engineer Portal Travel Distance</a> </li>
   				<li> <a href="track_eng.php">Engineer Track</a> </li>
   				<li> <a href="distance_summary.php">Distance Summary</a> </li>
 	 	    </ul>
 	 </li>
 	 
 	 <li><a href="#">Engineer Expense</a>   
   		<ul>
   			<li><a href="view_expense.php">Approve Engr Travel Claims</a></li>
   			<li><a href="view_oth_expense.php">Approve Engr Other Expenses</a></li>
   		<li><a href="view_app_othexp.php">Br. Approved Other Expenses</a></li>
   			
    	</ul>
      </li>
 	 
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
<li><a href="#"> Your Calls </a>
    	<ul>
    		<li><a href="eng_alert.php">View Alerts</a></li>
    	<!--	<li><a href="engpmalert.php">View PM Alert</a></li> 
    		<li><a href="eng_alert_local.php">Local Alerts</a></li> -->
  		</ul>
  	</li>
  	
 
 <li><a href="#">Generate PM</a>   
   		<ul> 
           <li><a href="engg_site_details.php">Generate PM Call</a></li> 
       <!--     <li><a href="view_instsnaps.php">Upload Inst Snaps</a></li>
           <li><a href="snaps_new.php">Inst Snaps - New</a></li>
             <li><a href="inst_report.php">Upload Inst Reports</a></li> -->
      </ul>
</li>
  	
  	
 <li><a href="#">Claims </a>
    	<ul>
    		<li><a href="expense_entry.php">Daily Expense Claim</a></li>
    		<li><a href="view_expense.php">View your Travel Claim </a></li>
    		<li><a href="view_approved_exp.php">Your Approved Travel Claims</a></li>
    </ul> 
  	</li>
  	
 <li><a href="#">Other Claims </a>
    	<ul>  <li><a href="engg_oth_exp.php">Other Expenses claim</a></li>
    	<li><a href="view_oth_expense.php">View Other Expenses claim</a></li>
    	</ul> 
    	<li><a href="view_app_othexp.php">Approved Other Expenses</a></li>
  	</li>
    	
    	    
  	<li><a href="#">GPS Panel</a>
    	    <ul>
  	
           <li> <a href="gps_engg.php">Your Location Records</a> </li>
           <li> <a href="livetrack_engg.php">Your Travel Map</a> </li>
  	
  	        </ul> 
  	    </li>
  	    
  	    <li><a href="#">Start-End</a>
    	    <ul>
  	
           <li> <a href="engg_start_end.php">Start-end time Records</a> </li>
           </ul> 
  	    </li>
  	<li><a href="#">Travel Distance</a>
    	<ul>
  	        <li> <a href="engg_dis.php">Your Travel Distance</a> </li>
  	        
  	        </ul> 
  	    </li>
  	        
 <!-- 	 <li><a href="#">Your records</a>
  	        <ul>   
   	
   		<li><a href="view_areaeng.php">View Records</a></li>   
  
  	</ul>
    </li> -->
    <?php
}
//===================-MENU of ACCOUNT MANAGER===========================
function AccountManager()
{	
	?>		
   <li><a href="#">Site</a>   
  		<ul>  
   	<!-- <li><a href="http://avoservice.in/newsite1.php">Add New site</a></li> -->
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
    	<ul> <li><a href="http://avoservice.in/AccountManager/generatedcalls.php">View Inst. Alerts </a></li>  
        	<li><a href="generatedcalls.php">All Generated Calls</a></li>  
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
   		<!--	<li><a href="http://avoservice.in/newsite1.php">Add New site</a></li>  -->
   			<!--<li><a href="http://avoservice.in/AccountManager/view_site.php">Pending Installations</a></li>   -->
   			<li><a href="generateSO.php">Generate SO</a></li>
   			<li><a href="invoices.php">Invoices</a></li>
   			<li><a href="buyback.php">Old Buy Back</a></li>

  		</ul>
  		</li>
  		
  		<li><a href="#">Operations</a>
 		<ul>  
            <li><a href="export_pend_deli.php">Export Pending Deliveries</a></li>
   			<li><a href="new_invoices.php">New Invoices</a></li>
   			<li><a href="sales_return.php">Sales Return</a></li>
   			<li><a href="zerovalue_sales.php">Zero Value Invoices</a></li>
   			<li><a href="productwise_sales.php">Prouct-wise Sales</a></li>
   			<li><a href="barcode_status.php">Barcode Status</a></li>
   		<li><a href="dispatches.php">Dispatch details</a></li>
   		    <li><a href="view_warehouse.php">Warehouse - Installation</a></li>
      	   <li><a href="view_ware_noninstall.php">Warehouse Non Installation</a></li>
      	   <li><a href="creports.php">Reports</a></li> 
  		</ul>
        </li>
        
        <li><a href="#">sales orders</a>
 		<ul>  
            
            <li><a href="sales_ordernew.php">Pending SO</a></li>
   		<!--	<li><a href="pending_so.php">Pending SO</a></li>-->
   			<li><a href="view_sales_order.php">All Sales Orders</a></li>
   			
        </ul>
        </li>
    
    
    <li><a href="#">AMC Sales Orders</a>
  	<ul>
	<!--	<li><a href="new_amc_po.php">Add AMC PO </a></li> -->
       	<li><a href="amc_sales_order.php">AMC Sales Orders</a></li>
     <!--  	<li><a href="view_amcpo.php">AMC Uploads </a></li> -->
       	
  	</ul>
</li>

<li><a href="#">Products</a>
  		<ul>
   			<li><a href="NewAssets.php">Add New Product </a></li>
   			<li><a href="view_assets.php">View Product List</a></li>  
   			<li><a href="asset_msp.php">Product MSP</a></li>  
  		</ul>
 	</li>
    
<li><a href="#">Buyback</a>
   	<ul>
    <!-- <li><a href="view_buyback.php">Buyback</a></li> -->
        <li><a href="new_buyback.php"> New Buyback</a></li>
   	</ul>
 </li>
  
<li><a href="#">Inst. Images</a>   
   		<ul> 
   		<li><a href="snaps_new.php">Inst Snaps - New</a></li>
             <li><a href="view_instsnaps.php">Inst Snaps old</a></li>
             <li><a href="inst_report.php">Inst Reports</a></li>
             <li><a href="ir_summary.php">IR Summary</a></li>
             <li><a href="snap_summary.php">Inst Snaps Summary</a></li>
             <li><a href="call_report.php">Call Report Data</a></li>
              </ul>
</li> 
  		
   <li><a href="#">Call Alerts</a>
   	<ul>
   <li><a href="generatedcalls.php">View Inst. Alerts </a></li>
    <li><a href="close_tempcall.php">Closed Temp Calls</a></li>
    <li><a href="temp_summary.php">Temp Call Summary</a></li>
    <li><a href="rede_call.php">UW/AMC Re-installation Calls</a></li>
   	</ul>
  		</li>
  		
  		<li><a href="#">Site Data</a>
   	<ul>
   	<li><a href="view_site.php">View AMC/Warr sites</a></li>
   		<li><a href="find_site.php">Search Warranty </a></li>
    </ul>
  		</li>

   <li><a href="#">Reports</a>   
  		<ul>  
   			 
   			<li><a href="so_status.php">SO Status Report</a></li>
   			<li><a href="so_status_summary.php">SO Status Summary</a></li>
   			<li><a href="salesreport_exec.php">Sales Report - Salesman</a></li>
   			<li><a href="new_sales_report.php"> Sales Report</a></li>
   			 <li><a href="ops_status.php"> Activity Summary</a></li>
   			 <li><a href="ops_tat.php">Supply Completed TAT Analysis</a></li>
   			 <li><a href="ops_ageing.php">Pending Supply Ageing</a></li>
   			<li><a href="instcall_ageing.php">Installation Calls Ageing</a></li>
   			 <li><a href="del_tat.php">Installation Delegation/ETA Timeslot</a></li>
   		<!--	 <li><a href="ops_openstatus.php"> Supply chain  Status Today</a></li> -->
   		<!--	 <li><a href="sales_report.php">Sales Report</a></li>
   			 <li><a href="sosummary_pending.php">Pending SO</a></li>
			 <li><a href="sosummary_done.php">Completed SO</a></li>

<li><a href="sopending_ageing_analysis.php">SO Pending Ageing Analysis</a></li>
<li><a href="sotat_analysis.php">TAT Analysis</a></li>
<li><a href="close_calltody.php">Today Close Call</a></li> -->
  		</ul>
  		</li>
  		
  		<li><a href="#">Engineer Claims</a>
  		<ul>
  		    <li><a href="travelled_map.php">Engr Travelled Map</a></li>
  	<!--	<li><a href="expense_entry.php">Engineer Expense Entry</a></li> -->
 		<li><a href="view_expense.php">View Engineer Travel Claims</a></li>
 		<li><a href="view_approved_exp.php">Branch Approved Travel Claims</a></li>
 	<li><a href="view_oth_expense.php">View Engr Other Expenses </a></li>
 	<li><a href="view_app_othexp.php">Branch Approved Other Expenses</a></li>
 		
 		<li><a href="expense_analysis.php">Final Claim details</a></li>
 		<li><a href="expense_status.php">Approval Status Summary Report</a></li>
 		</ul>
  
  </li>
  
  <li><a href="#">Branch Expenses</a>
  	<ul>
		<li><a href="log_search.php">Out-ward Logistics Expenses </a></li>
		<li><a href="log_search.php">In-ward Logistics Expenses </a></li>
       	<li><a href="">Admin Expenses</a></li>
       	<li><a href="">Office Maint. Exp</a></li>
       	
  	</ul>
</li>
  
   <li><a href="#">Setting</a>
        <ul>   
        		<li><a href="change_pwd.php">Password Change</a></li>
        		
        
        <!--<li><a href="http://avoservice.in/AccountManager/viewamc_pending.php">Amc Pending Installations</a></li> -->
        </ul>
 </li>
   
 <!--   <li><a href="#">Generated Calls</a>
    	<ul>   
        	<li><a href="http://avoservice.in/AccountManager/generatedcalls.php">All Generated Calls</a></li>  
        </ul>
   	<li><a href="summary_call.php" target="_blank">Summary Calls</a></li>-->
    <?php
}

function logistics()
{	
	?>		
   <li><a href="#">Agents</a>   
  		<ul>  
   		
   			<li><a href="add_agent.php">Add Agent</a></li>
   			<li><a href="view_agent.php">View Agent</a></li>

  		</ul>
  		</li>
  		
  	<li><a href="#">Suppliers</a>   
  		<ul>  
   		
   			<li><a href="add_party.php">Add Supplier / Party</a></li>
   			<li><a href="view_party.php">View Supplier</a></li>

  		</ul>
  		</li>
  		
  		<li><a href="#">Factories</a>   
  		<ul>  
   		
   			<li><a href="add_factory.php">Add Factory</a></li>
   			<li><a href="view_factory.php">View Factories</a></li>

  		</ul>
  		</li>
  		
  	<li><a href="#">Products</a>   
  		<ul>  
   		
   			<li><a href="add_products.php">Add Product Specs/ List</a></li>
   			<li><a href="view_productlist.php">View Product List</a></li>

  		</ul>
  		</li>
    
    
    <li><a href="#">Transactions</a>
 		<ul>  
       <li><a href="add_entry.php">Entries</a></li>
        <li><a href="view_entries.php">View Entries</a></li>
        </ul>
<? } ?>