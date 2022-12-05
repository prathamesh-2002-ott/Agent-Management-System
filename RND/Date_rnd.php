<?php

$time=time()+19800; // Timestamp is in GMT now converted to IST
$date=date('d_m_Y_H_i_s',$time);

$month=date('n',$time)-4;
$curr_year=date('Y',$time);
echo "<BR>";
echo $date;
echo "<BR>";
echo $month;
echo "<BR>";
echo $year;
echo "<BR>";
$next_year=$curr_year+1;
$prev_year=$curr_year-1;


if($month>3){
    $start_date="01-04-$curr_year";
    $end_date="31-03-$next_year";
}else{

    $start_date="01-04-$prev_year";
    $end_date="31-03-$curr_year";    

}

echo $start_date;
echo "<BR>";
echo $end_date;



?>