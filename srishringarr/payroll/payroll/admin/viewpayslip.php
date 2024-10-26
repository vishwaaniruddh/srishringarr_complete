<?
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");
?>
<?

printpayslip($empid,$startdate,$enddate,'0');
 
?>
<? include("footer.php"); ?>