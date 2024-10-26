<?php

include_once 'select.php';
$select_obj = new select();
$select_obj->select_rows("localhost", "abc", "abc", "atm_site", array($sel_id), $sel_table, $ref_col, $sel_value, array(), "y", "", "");
$select_obj->select_rows("localhost", "abc", "abc", "assign", array("username", "password"), "login", "username", "shilpa", array("Username", "Password"), "n", "username", "d");
$select_obj->select_rows("localhost", "site", "site", "atm_site", array("state_id"), "state", "state", "Maharashtra", array("State_id"), "n", "", "");
$select_obj->select_rows("localhost", "atm123", "atm123", "atm_services", "*", "tech_details", "", "", array("", "", "", ""), "n", "", "");
$select_obj->select_rows('localhost', 'site', 'site', 'atm_site', array("state"), "state", "", "", array("STATE_ID"), "n", "state", "a");
$state = $select_obj->select_rows('localhost', 'site', 'site', 'atm_site', array("state", "state_id"), "state", "", "", array(""), "y", "state", "a");
while ($row = mysqli_fetch_row($state)) {
    echo $row[0] . " " . $row[1];
}
