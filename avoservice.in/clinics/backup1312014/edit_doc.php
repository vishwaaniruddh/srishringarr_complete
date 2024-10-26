<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');

include('template_clinic.html');

?>
<style>

</style>
<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<link href="paging.css" rel="stylesheet" type="text/css" />

       
      <?php   include("editdoctor.php"); ?>

<?php 
