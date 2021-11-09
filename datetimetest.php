<?php
date_default_timezone_set('Asia/Jakarta');


function tambahWaktu ($awalWaktu, $minutes_to_add) {
  // $timestamp = strtotime($waktuBatas);  
  // $dateTime = new DateTime($awalWaktu);
  // $minutesToAdd = $waktuBatas;
  // $dateTime->modify("+{$minutesToAdd} minutes");
  // $dateTime->setTimestamp($waktuBatas);
  // date("d", strtotime($_GET[$awalWaktu]));
  // echo $dateTime->format("m/d/Y h:i:s A");

  $time = new DateTime($awalWaktu);
  $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

  $stamp = $time->format('Y-m-d H:i');
//   var_dump($awalWaktu);
//   var_dump($minutes_to_add);
  var_dump($time);
  var_dump($stamp);
}

tambahWaktu("2021-11-07 23:59:00", "15");

