<?php include('config.php');
$et="2015-07-01 05:30:00";

	  			$ct=date('Y-m-d H:i:s'); echo $ct.'<br>';
	  			$to_time = strtotime($ct);
$from_time = strtotime($et);
echo round(abs($to_time - $from_time) / 3600,2). " hours";
	  			//$d1 = new DateTime($et);
                                //$d2 = new DateTime($ct);
				//$diff=$d1->diff($d2)->months; 
				//echo $diff;
				?>