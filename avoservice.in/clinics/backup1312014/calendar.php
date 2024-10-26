<?php $strt_date = date('d-m-Y');
$end_date = date('d-m-Y',strtotime('+1 month',$strt_date));
$date_array = array();
$date_array = explode('-',$strt_date);
$back_strt_date = $date_array[2]."-".$date_array[0]."-".$date_array[1];// YYYY-MM-DD
$front_strt_date = $date_array[1]."-".$date_array[0]."-".$date_array[2];// MM-DD-YYYY
$date_array = array();
$date_array = explode('-',$end_date);
$back_bk_date = $date_array[2]."-".$date_array[0]."-".$date_array[1]; // YYYY-MM-DD
$front_end_date = $date_array[1]."-".$date_array[0]."-".$date_array[2]; // MM-DD-YYYY
// fetching data for selected date interval
//$rs_couse_cnt = get_course_cnt($back_strt_date,$back_bk_date);
if(isset($rs_couse_cnt) =='No record Found'){
    echo "No Records Found.";
    exit;
}
// converting string in to TIMESTAMP
$sdate = strtotime($front_strt_date);
$edate = strtotime($front_end_date);

//getting starting and ending month of date...
$st_dt = array();
$en_dt = array();
    // exploding date string in to array
    $st_dt = explode('-',$strt_date); 
    $en_dt = explode('-',$end_date); 

    // assigning month value to variables...
    $st_mon = $st_dt[0];
    $en_mon = $en_dt[0];

    // calculating month diff..
    $mon_diff = $en_mon - $st_mon;

    // assinging year value to variables....
    $st_year = $st_dt[2];
    $en_year = $en_dt[2];

//converting TIMESTAMP into desired date format...
$st_date = date('F jS Y',$sdate);
$en_date = date('F jS Y',$edate);

echo " <center><h2>$st_date - $en_date</h2></center>";
//echo " <br />start month is $st_mon & end month is $en_mon & month diff is $mon_diff";
//echo " <br />start year is $st_year & end year is $en_year";
$ttl_cnt =0;
for($i=$st_mon;($st_year<=$en_year);$i++){
    $end = $en_mon+1;
    if($i == $end && $st_year == $en_year){
        break;
    }
    // this will continue until all months are completed
    $st_mon_time_stamp = mktime(0,0,0,$i,1,$st_year);
    echo "<br /><br /><center> <h3> ".date("F Y",$st_mon_time_stamp)."</h3></center>";
    $no_of_days = date("t",$st_mon_time_stamp);
    $str_cal ='<table border="1px" width="100%">
                <thead>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </thead>
                <tbody>';
    $cnt = 1;
    $week = 0;
    $mon_cnt = 0;
    for($j=1;$j<=$no_of_days;$j++){
        if($cnt >= $no_of_days){
            break;
        }
        if($cnt == 1){
            // for first row....
            $time_stamp = mktime(0,0,0,$i,$cnt,$st_year);
            $str_cal .='<tr>';
            if(date("l",$time_stamp) == 'Sunday'){
                $space = 0;
            }
            else if(date("l",$time_stamp) == 'Monday'){
                $space = 1;
            }
            else if(date("l",$time_stamp) == 'Tuesday'){
                $space = 2;
            }
            else if(date("l",$time_stamp) == 'Wednesday'){
                $space = 3;
            }
            else if(date("l",$time_stamp) == 'Thursday'){
                $space = 4;
            }
            else if(date("l",$time_stamp) == 'Friday'){
                $space = 5;
            }
            else if(date("l",$time_stamp) == 'Saturday'){
                $space = 6;
            }
            $dis = 7 - $space; //exit;
            while($space != 0){
                // this will display spaces in first row...
                $str_cal .='<td>&nbsp;</td>';
                $space--; 
            }
            while($dis != 0){
                // this will display calender date in first row...
                if(strlen($i) == 1 && strlen($cnt)==1){
                    $date = $st_year.'-0'.$i.'-0'.$cnt;
                }
                else{
                    $date = $st_year.'-'.$i.'-'.$cnt;
                }
                $flg = 0;
                for($rs=0;$rs<count($rs_couse_cnt);$rs++){                      
                    if($rs_couse_cnt[$rs]['EnrolledDate'] == $date){
                        $time_stmp = strtotime($date);
                        $str_cal .='<td>'.date('j S',$time_stmp).'<br /><br />Count : <a href="light_box_course.php" onClick="$.showAkModal(\'light_box_course.php?type=list&session_id='.$session_id.'&campus_id='.$campus_id.'&strt_date='.$rs_couse_cnt[$rs]['EnrolledDate'].'&end_date='.$rs_couse_cnt[$rs]['EnrolledDate'].'\',\'\',500,500);return false;">'.$rs_couse_cnt[$rs]['CourseCount'].'</a></td>';       
                        $cnt++;
                        $mon_cnt += $rs_couse_cnt[$rs]['CourseCount'];
                        $flg = 1;
                        break;
                    }
                }

                if($flg == 0){
                    $time_stmp = strtotime($date);
                    $str_cal .='<td>'.date('j S',$time_stmp).'<br /><br />&nbsp;</td>'; 
                    $cnt++;
                }
                $dis--;
            }           
            $str_cal .='</tr>';     
        }
        else{
            // for rest of the rows...
            $str_cal .='<tr>';
            for($w=0;$w<7;$w++){
                if($cnt<=$no_of_days){
                    if(strlen($i) == 1){
                        $date = $st_year.'-0'.$i.'-'.$cnt;
                    }
                    else{
                        $date = $st_year.'-'.$i.'-'.$cnt;
                    }
                    $flg = 0;
                    for($rs=0;$rs<count($rs_couse_cnt);$rs++){
                        if($rs_couse_cnt[$rs]['EnrolledDate'] == $date){ 
                            $time_stmp = strtotime($date);
                            $str_cal .='<td>'.date('j S',$time_stmp).'<br /><br />Count :<a href="light_box_course.php" onClick="$.showAkModal(\'light_box_course.php?type=list&session_id='.$session_id.'&campus_id='.$campus_id.'&strt_date='.$rs_couse_cnt[$rs]['EnrolledDate'].'&end_date='.$rs_couse_cnt[$rs]['EnrolledDate'].'\',\'\',500,500);return false;">'.$rs_couse_cnt[$rs]['CourseCount'].'</a></td>';        
                            $flg = 1;
                            $cnt++;
                            $mon_cnt += $rs_couse_cnt[$rs]['CourseCount'];
                            break;
                        }
                    }
                    if($flg == 0){
                        $time_stmp = strtotime($date);
                        $str_cal .='<td>'.date('j S',$time_stmp).'<br /><br />&nbsp;</td>';
                        $cnt++;
                    }
                }
                else{
                    $str_cal .='<td>&nbsp;</td>';
                }
            }
            $str_cal .='</tr>';
        }
    }
    $ttl_cnt += $mon_cnt;
    if($mon_cnt != 0){
        $str_cal .='<tr>
                        <td> Monthly Count :</td> 
                        <td colspan="6"><a href="light_box_course.php" onClick="$.showAkModal(\'light_box_course.php?type=list&session_id='.$session_id.'&campus_id='.$campus_id.'&strt_date='.$st_year."-".(strlen($i)==1?"0".$i:$i)."-"."01".'&end_date='.$st_year."-".(strlen($i)==1?"0".$i:$i)."-".$no_of_days.'\',\'\',500,500);return false;">'.$mon_cnt.'</td>
                    </tr>';
    }else{
        $str_cal .='<tr>
                        <td> Monthly Count :</td> 
                        <td colspan="6">'.$mon_cnt.'</td>
                    </tr>';
    }
        $str_cal .='</tbody>
                </table>';
    if($i == 12){
        $i=0;
        $st_year ++;
    }
    echo $str_cal;  
}
?>