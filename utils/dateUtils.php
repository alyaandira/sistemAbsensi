<?php
date_default_timezone_set('Asia/Jakarta');

function check_in_range($start_date, $end_date, $checkDate)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($checkDate);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

function tambahWaktu($awalWaktu, $minutes_to_add)
{
  try {
    $time = new DateTime($awalWaktu);
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    $stamp = $time->format('Y-m-d H:i');

    return $stamp;
  } catch (Exception $e) {
    return null;
    echo $e->getMessage();
  }
}

//  $interval= $waktuBatas;
//  $yourDate->modify("+{$interval } minutes");  
//  echo $yourDate->format( "Y-m-d H:i");
