<?php
//function select(){
//include_once ('join_table_select.php');
//$j_s_o=new join_table_select();
//$j_s_o->select_from_join(array("y.tech_id"),$j_s_o->select_from_join(array("y.tech_id"),"atm_details","join","tech_area_details","area_id","area_id","atm_id","a101",array("tech_id"),"n"),"join",$j_s_o->select_from_join(array("y.tech_id"),"tech_service_details","join","tech_area_details","tech_id","tech_id","service_id","1",array("tech_id"),"n"),"tech_id","tech_id","tech_id","1",array("Technician ID"),"n");
//$j_s_o->select_from_join("tech_id",$j_s_o->select_from_join("tech_id","atm_details","join","tech_area_details","area_id","area_id",""
////$j_s_o->select_from_join("tech_id","atm_details","join","tech_area_details","area_id","area_id","atm_id","a101",array("Tech ID"),"n");
//$j_s_o->select_from_join(array("y.tech_id"),"atm_details","join","tech_area_details","area_id","area_id","atm_id","a101",array("TECH ID"),"n");
//
//$j_s_o->select_from_join(array("y.tech_id"),"tech_service_details","join","tech_area_details","tech_id","tech_id","service_id","1",array("TECHNNNNID"),"n");
////$j_s_o->name_table("",array("techsndv","idvn","iasdv"),"n");
////$con_obj->close_connection();
//}
//select();
include_once ('join_table_select.php');
$join_sel_obj=new join_table_select();
//$bool=$join_sel_obj->select_from_join(array("y.tech_id"),"atm_details","join","tech_area_details","area_id","area_id","x.atm_id","a101",array("TECH_ID"),"n");
//if($bool) echo "SUCCESS";
//else echo "FAILURE";

$bool2=$join_sel_obj->select_from_join("localhost","atm","atm","atm_service_management",array("y.tech_id"),$join_sel_obj->select_from_join("localhost","atm","atm","atm_service_management",array("y.tech_id"),"atm_details","join","tech_area_details","area_id","area_id","x.atm_id","a101",array("tech_id"),"y"),"join",$join_sel_obj->select_from_join("localhost","atm","atm","atm_service_management",array("y.tech_id"),"tech_service_details","join","tech_area_details","tech_id","tech_id","x.service_id","1",array("tech_id"),"y"),"tech_id","tech_id","x.tech_id"
,"1",array("TECH ID"),"n","");
if($bool2)echo "joined";
else echo "try again";



?>