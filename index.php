<?php
// This function is to protect the input
    function clean_value($getandpost) 
    { 
    $getandpost = htmlspecialchars($getandpost); 
    $getandpost = str_replace("select","",$getandpost); 
    $getandpost = str_replace("update","",$getandpost); 
    $getandpost = str_replace("insert","",$getandpost); 
    $getandpost = str_replace("where","",$getandpost); 
    $getandpost = str_replace("like","",$getandpost); 
    $getandpost = str_replace("or","",$getandpost); 
    $getandpost = str_replace("and","",$getandpost); 
    $getandpost = str_replace("set","",$getandpost); 
    $getandpost = str_replace("into","",$getandpost);
    $getandpost = str_replace('"',"",$getandpost); 
    $codenumber = str_replace("'", "", $codenumber); 
    $codenumber = str_replace(";", "", $codenumber); 
    $codenumber = str_replace(">", "", $codenumber); 
    $codenumber = str_replace("<", "", $codenumber); 
    $getandpost=strip_tags($getandpost); 
    return $getandpost; 
}




// Time calculation

class CountHour {

function check_time($time) { // check the input time, format must be HH:MM:SS
$pattern = '^([0-9]{2}):([0-9]{2}):([0-9]{2})$';
    if(ereg($pattern,$time)) {
    return true;
    } else {
    die('Error. Format '.$time.' must be HH:MM:SS.');
    }
}
    
function check_time2($time) { // check the input time, format must be H:M:S
    $pattern = '^([0-9]{1,100}):([0-9]{1,2}):([0-9]{1,2})$';
    if(ereg($pattern,$time)) {
    return true;
    } else {
    die('Error. Format '.$time.' must be H:M:S.');
    }
}
    
function seconds($time) { // convert the input time to seconds mode
    $this->check_time($time);
    $time = explode(':',$time);
    $hour = $time[0]*3600;
    $minute = $time[1]*60;
    $second = $time[2];
    $seconds = $hour+$minute+$second;
    return $seconds;
}
    
function std($time) { // convert the seconds mode to 00:00:00
    if($time<0) {
    return 'undefined';
    } elseif($time<3600) {
    $hour = 0;
    $hourr = $time;
    } else {
    $hour = $time/3600;
    $hour = floor($hour);
    $hourr = $time%3600;
    }
    if($hourr<60) {
    $minute = 0;
    $second = $hourr;
    } else {
    $minute = $hourr/60;
    $minute = floor($minute);
    $second = $hourr%60;
    }
    if(strlen($hour)==1) {
    $hour = '0'.$hour;
    } else {
    $hour = $hour;
    }
    if(strlen($minute)==1) {
    $minute = '0'.$minute;
    } else {
    $minute = $minute;
    }
    if(strlen($second)==1) {
    $second = '0'.$second;
    } else {
    $second = $second;
    }
    $time = $hour.':'.$minute.':'.$second;
    return $time;
    }

function diff_seconds($first,$last) { // count time difference in seconds mode
    $first1 = $this->seconds($first);
    $last1 = $this->seconds($last);
    if($last1<$first1 || $last1==$first1) {
    die('error. '.$first.' is greater than '.$last);
    } else {
    return $last1-$first1;
    }
}
    
    
function diff($first,$last) { // count time difference
    $diff = $this->diff_seconds($first,$last);
    return $this->std($diff);
}
    
    
function define_hour($time) { // define hours, minutes and seconds of time
    $this->check_time2($time);
    $time_array = explode(':',$time);
    $hourr = $time_array[0];
    $minutee = $time_array[1];
    $secondd = $time_array[2];
    if($hourr==0) {
    $hourr = '';
    } elseif($hourr==1) {
    $hourr = '1 hour ';
    } elseif($hourr>1 && $hourr<10) {
    $hourr = str_replace('0','',$hourr).' hours ';
    } else {
    $hourr = $hourr.' hours ';
    }
    if($minutee==0) {
    $minutee = '';
    } elseif($minutee==1) {
    $minutee = '1 minute ';
    } elseif($minutee>1 && $minutee<10) {
    $minutee = str_replace('0','',$minutee).' minutes ';
    } else {
    $minutee = $minutee.' minutes ';
    }
    if($secondd==0) {
    $secondd = '';
    } elseif($secondd==1) {
    $secondd = '1 second';
    } elseif($secondd>1 && $secondd<10) {
    $secondd = str_replace('0','',$secondd).' seconds';
    } else {
    $secondd = $secondd.' seconds';
    }
    
    return trim($hourr.$minutee.$secondd);
    
}
    
}
?>

