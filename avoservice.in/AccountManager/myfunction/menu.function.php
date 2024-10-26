<?php
// menu of Admin
function masteradmin()
{
    ?>
 <li><a href="#"> Alerts</a>
 <ul>
 <li><a href="view_callalert.php">View Call Alerts</a>
 <li><a href="view_alert.php">View Branch Alerts</a></li>
<li><a href="viewBRF_form.php">view BRF</a></li></ul>
 </li>


 </li>
 <li><a href="#">Site</a>
  <ul>
    <li><a href="newsite.php">Add New </a></li>
    <li><a href="newsite1.php">Add New(form)</a></li>
   <li><a href="view_site.php">View Site</a></li>
   <li><a href="tempsite.php">Temp Sites</a></li>
<li><a href="batteryVender.php">battery Vendor</a></li>
  </ul>
 </li>
 <li><a href="#">Calls </a>
 <ul>
 <li><a href="service.php">Service Call </a></li>
 <li><a href="newalert1.php">New Installation</a></li>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>

 </ul></li>
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
  <li><a href="eng_alert.php">View Alerts</a></li>
   <li><a href="newarea_eng.php">Add New Engineer </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>

  </ul>

 </li>
 <li><a href="#">Reports</a>
 <ul>
 <li><a href="catwiserep.php">Category Wise Report</a></li>
 <li><a href="monthrep.php">Monthly Report</a></li>
 </ul>
 </li>
 <li>
 <?php
include "config.php";
    $cnt = 0;
    $qry = '';
    if ($_SESSION['branch'] != 'all') {
        $br1 = str_replace(",", "','", $br); //echo $br1[0]."/".$br1[1];
        $br1 = "'" . $br1 . "'";
//echo $br1;
        //echo "select state from state where state_id in (".$br1.")";
        //echo "select state from state where state_id in (".$br1.")";
        $src = mysqli_query($con1, "select state from state where state_id in (" . $br1 . ")");
        while ($srcrow = mysqli_fetch_array($src)) {
            $bran[] = $srcrow[0];
        }
        $br3 = implode(",", $bran);
        $br2 = str_replace(",", "','", $br3); //echo $br1[0]."/".$br1[1];
        $br2 = "'" . $br2 . "'";

        $qry = "Select * from transfersites where tobranch in (" . $br2 . ") and approval='0' and status='0'";
    } else {
        $qry = "select * from transfersites where approval='0' and status='0'";
    }

    //echo $qry;
    ?>
 <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysqli_num_rows(mysqli_query($con1, $qry)); ?></sup></font></a></li>
 <?php
}
function Admin()
{
//echo "Admin menu";
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
   <li><a href="view_areaeng.php">View Records</a></li>


  </ul>
 </li>
<?php
include "../config.php";
    $cnt = 0;
    $qry = '';
    if ($_SESSION['user'] != 'admin') {
        $br1 = str_replace(",", "','", $br); //echo $br1[0]."/".$br1[1];
        $br1 = "'" . $br1 . "'";
//echo $br1;
        //echo "select state from state where state_id in (".$br1.")";
        //echo "select state from state where state_id in (".$br1.")";
        $src = mysqli_query($con1, "select state from state where state_id in (" . $br1 . ")");
        while ($srcrow = mysqli_fetch_array($src)) {
            $bran[] = $srcrow[0];
        }
        $br3 = implode(",", $bran);
        $br2 = str_replace(",", "','", $br3); //echo $br1[0]."/".$br1[1];
        $br2 = "'" . $br2 . "'";

        $qry = "Select * from transfersites where tobranch in (" . $br2 . ") and approval='0' and status='0'";
    } else {
        $qry = "select * from transfersites where approval='0' and status='0'";
    }

    //echo $qry;
    ?>
 <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysqli_num_rows(mysqli_query($con1, $qry)); ?></sup></font></a></li>
 <?php

}
// menu of call center
function Call()
{
    ?>
   <li class="current"><a href="view_callalert.php">View Alerts</a></li>

   <li><a href="#">Calls </a>
   <ul>
   <li><a href="service.php">Add New </a></li>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
   <?php if ($_SESSION['user'] == 'Sneha') {?>  <li><a href="newalert.php">New Installation</a></li><?php }?>
 <li><a href="newtempsite.php">New Temporary Sites</a></li>
 </ul>
   </li>
  <li><a href="#">Engineer</a>
  <ul>
  <li><a href="eng_alert.php">View Alerts</a></li>
  <!-- <li><a href="newarea_eng.php">Add New Engineer </a></li>
   <li><a href="view_areaeng.php">View Records</a></li>-->
  </ul>

 </li>
    <?php
}

//menu of Branch Head
function BranchHead()
{?>
<li><a href="view_alert.php"> Alerts</a></li>
 <li><a href="newarea_eng.php">Engineer</a>

 <ul>


   <li><a href="view_areaeng.php">View Records</a></li> </ul>
   <?php
include "config.php";
    $cnt = 0;
    $qry = '';

    $br1 = str_replace(",", "','", $_SESSION['branch']); //echo $br1[0]."/".$br1[1];
    $br1 = "'" . $br1 . "'";
//echo $br1;
    //echo "select state from state where state_id in (".$br1.")";
    //echo "select state from state where state_id in (".$br1.")";
    $src = mysqli_query($con1, "select state from state where state_id in (" . $br1 . ")");
    while ($srcrow = mysqli_fetch_array($src)) {
        $bran[] = $srcrow[0];
    }
    $br3 = implode(",", $bran);
    $br2 = str_replace(",", "','", $br3); //echo $br1[0]."/".$br1[1];
    $br2 = "'" . $br2 . "'";
//echo "Select * from transfersites where state in (".$br2.") and approval='0' and status='0'";
    $qry = "Select * from transfersites where tobranch in (" . $br2 . ") and approval='0' and status='0'";

//echo $qry;
    ?>
<li> <a href="transfercall.php">Tranferred Call <font color="#FF0000"><sup><?php echo mysqli_num_rows(mysqli_query($con1, $qry)); ?></sup></font></a></li>
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

//menu of Engineer
function Engineer()
{
    ?>
    <li><a href="eng_alert.php">View Alerts</a></li>

  <ul>

   <li><a href="view_areaeng.php">View Records</a></li>


  </ul>
    <?php
}

//====================== AccountManager ============================
function AccountManager()
{

    ?>


   <li><a href="#">Site</a>
  		<ul>
   <!--	<li><a href="http://avoservice.in/newsite1.php">Add New site</a></li>
   	    <li><a href="non_deployment.php">Add Non Deploy site</a></li> -->
   	    <li><a href="http://avoservice.in/AccountManager/pending_site.php">Pending Installations</a></li>
   <!-- <li><a href="http://avoservice.in/generateSO.php">Pending AMC</a> -->
   			<li><a href="http://avoservice.in/invoices_new.php">Invoice</a>

  		</ul>

  		      <li><a href="#">Buyer</a>
        <ul>
        	<li><a href="http://avoservice.in/buyers_form.php">Add Buyer</a></li>
        	<li><a href="http://avoservice.in/view_buyers.php">View Buyers</a></li>
        </ul>

         <li><a href="#">Purchase Order</a>
        <ul>
        	<li><a href="http://avoservice.in/add_purchase_order.php">Add Purchase Order</a></li>
        	<li><a href="http://avoservice.in/view_purchase_order.php">View  Purchase Order</a></li>
        </ul>

        <li><a href="#">Sales Orders</a>
        <ul>
            <li><a href="http://avoservice.in/sales.php">Add Sales Order</a></li>
         <!-- 	<li><a href="http://avoservice.in/add_sales_order.php">Add Sales Order</a></li>
      	<li><a href="http://avoservice.in/view_sales_order.php">View Sales Order</a></li> -->
        		<li><a href="http://avoservice.in/sales_ordernew.php">Pending Sales Order</a></li>
        		 	<li><a href="http://avoservice.in/view_sales_order.php">All Sales Order</a></li>
        	<li><a href="http://avoservice.in/so_status.php"> SO Status Report</a></li>
        </ul>
<li><a href="#">New Invoices</a>
        <ul>
    <li><a href="http://avoservice.in/new_invoices.php">Invoices</a></li>
    <li><a href="http://avoservice.in/new_sales_report.php">Sales Report</a></li>

    <li><a href="http://avoservice.in/view_warehouse.php">warehouse-Installations</a></li>
    <li><a href="http://avoservice.in/view_ware_noninstall.php">Warehouse Non Installation</a></li> 
    <li><a href="http://avoservice.in/barcode_status.php">Barcode/ Serial Number</a></li> 
    
    </ul>
 <li><a href="#">Installations</a>
        <ul>
        <li><a href="generatedcalls.php">Installation Calls</a></li>
    <li><a href="http://avoservice.in/view_instsnaps.php">Inst Snaps</a></li>
    <li><a href="http://avoservice.in/snaps_new.php">Inst Snaps - New</a></li>
    <li><a href="http://avoservice.in/inst_report.php">Inst Reports</a></li>
             <li><a href="http://avoservice.in/ir_summary.php">IR Summary</a></li>
    <li><a href="http://avoservice.in/call_report.php">Call Report Data</a></li>
            </ul>
    <li><a href="#">Buyback</a>
   	<ul>
    <!-- <li><a href="view_buyback.php">Buyback</a></li> -->
        <li><a href="http://avoservice.in/new_buyback.php"> New Buyback</a></li>
   	</ul>
 </li>

  <li><a href="#">OEM UW Replacement</a>
  	<ul>
		<li><a href="view_bfr.php">OEM UW Replace Calls</a></li>

  	</ul>
</li>
      <li><a href="#">AMC Sales Orders</a>
  	<ul>
		<li><a href="http://avoservice.in/new_amc_po.php">Add AMC PO </a></li>
       	<li><a href="http://avoservice.in/amc_sales_order.php">AMC Sales Orders</a></li>
     <!--  	<li><a href="view_amcpo.php">AMC Uploads </a></li> -->

  	</ul>
</li>



  <!--      <li><a href="#">Buyback Status</a>
   	<ul>
   <li><a href="http://avoservice.in/view_buyback.php">Buyback Status</a></li>
   	</ul>
  		</li> -->

         <li><a href="#">Customer Contacts</a>
   	<ul>
   <li><a href="http://avoservice.in/add_whatsappno.php">Add Customer WhatsApp Nos</a></li>
   <li><a href="http://avoservice.in/view_whatspp_no.php">View Customer WhatsApp Nos</a></li>
   <li><a href="http://avoservice.in/viewccmails.php">CC mail IDs</a></li>
   	</ul>
  		</li>

  	<li><a href="#">AMC/Warr data</a>
  		<ul>

   			<li><a href="http://avoservice.in/view_site.php">View AMC/Warr Sites</a></li>
  		</ul>

 <!--  <li><a href="#">Amc</a>
        <ul>
        <li><a href="view_amc.php">Amc View</a></li>
        <li><a href="viewamc_pending.php">Amc Pending Installations</a></li>
        </ul>-->


   	<li><a href="summary_call.php" target="_blank">Summary Calls</a></li>

   	 <li><a href="#">Setting</a>
 		<ul>
 		<li><a href="change_pwd.php">Password Change</a></li>
 		</ul>
 	</li>
 	<? }
 	//=================================Accounts======================
 	function Accounts()
{
	?>
   <li><a href="#">Site</a>
  		<ul>
   		<!--	<li><a href="http://avoservice.in/newsite1.php">Add New site</a></li>  -->
   			<!--<li><a href="http://avoservice.in/AccountManager/view_site.php">Pending Installations</a></li>   -->
   			<li><a href="http://avoservice.in/generateSO.php">Generate SO</a></li>
   			<li><a href="http://avoservice.in/invoices.php">Invoices</a></li>
   			<li><a href="http://avoservice.in/buyback.php">Old Buy Back</a></li>

  		</ul>
  		</li>


    <li><a href="#">Sales Order</a>
 		<ul>
   			<li><a href="view_sales_order.php">View Sales Order</a></li>

        </ul>
    <li><a href="#">Operations</a>
 		<ul>

   			<li><a href="new_invoices.php">New Invoices</a></li>

   		    <li><a href="view_warehouse.php">Warehouse - Installation</a></li>
      	  <li><a href="ware_noninstall.php">Warehouse Non Installation</a></li> 
      	   <li><a href="creports.php">Reports</a></li>
  		</ul>
        </li>

    <li><a href="#">AMC Sales Orders</a>
  	<ul>
	<!--	<li><a href="new_amc_po.php">Add AMC PO </a></li> -->
       	<li><a href="amc_sales_order.php">AMC Sales Orders</a></li>
     <!--  	<li><a href="view_amcpo.php">AMC Uploads </a></li> -->

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
             <li><a href="http://avoservice.in/view_instsnaps.php">View Inst. Snaps</a></li>
             <li><a href="http://avoservice.in/inst_report.php">Inst Reports</a></li>
             <li><a href="http://avoservice.in/ir_summary.php">IR Summary</a></li>
              </ul>
</li>

   <li><a href="#">Call Alerts</a>
   	<ul>
   <li><a href="http://avoservice.in/AccountManager/generatedcalls.php">View Inst. Alerts </a></li>
    <li><a href="close_tempcall.php">Closed Temp Calls</a></li>
    <li><a href="rede_call.php">UW/AMC Re-installation Calls</a></li>
   	</ul>
  		</li>

   <li><a href="#">Reports</a>
  		<ul>

   			 <li><a href="so_status.php">SO Status Report</a></li>
   			  <li><a href="so_status_summary.php">SO Status Summary</a></li>
   			 <li><a href="new_sales_report.php">New Sales Report</a></li>


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
  	<!--	<li><a href="expense_entry.php">Engineer Expense Entry</a></li> -->
 		<li><a href="view_expense.php">View Engineer Travel Claims</a></li>
 		<li><a href="view_approved_exp.php">Branch Approved Travel Claims</a></li>
 	<li><a href="view_oth_expense.php">View Engr Other Expenses </a></li>
 	<li><a href="view_app_othexp.php">Branch Approved Other Expenses</a></li>

 		<li><a href="expense_analysis.php">Final Claim details</a></li>
 		<li><a href="expense_status.php">Approval Status Summary Report</a></li>
 		</ul>

  </li>
   <li><a href="#">Setting</a>
        <ul>
        		<li><a href="change_pwd.php">Password Change</a></li>


        <!--<li><a href="http://avoservice.in/AccountManager/viewamc_pending.php">Amc Pending Installations</a></li> -->
        </ul>
 </li>

<?php
}
?>