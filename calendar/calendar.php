<?php
  //get class into the page
  require_once('classes/tc_calendar.php');

  $date3_default = date("Y-m-d H:i:s");
  $date4_default = date("Y-m-d H:i:s");

  echo "<input type=checkbox name=from_date>From";
  $myCalendar = new tc_calendar("date3", true, false);
  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
  $myCalendar->setDate(date('d', strtotime($date3_default))
          , date('m', strtotime($date3_default))
          , date('Y', strtotime($date3_default)));
  $myCalendar->setPath("calendar/");
  $myCalendar->setYearInterval(1970, 2020);
  $myCalendar->setAlignment('left', 'bottom');
  $myCalendar->setDatePair('date3', 'date4', $date4_default);
  $myCalendar->writeScript();
  echo "<br>";

  echo "<input type=checkbox name=to_date>To";
  $myCalendar = new tc_calendar("date4", true, false);
  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
  $myCalendar->setDate(date('d', strtotime($date4_default))
         , date('m', strtotime($date4_default))
         , date('Y', strtotime($date4_default)));
  $myCalendar->setPath("calendar/");
  $myCalendar->setYearInterval(1970, 2020);
  $myCalendar->setAlignment('left', 'bottom');
  $myCalendar->setDatePair('date3', 'date4', $date3_default);
  $myCalendar->writeScript();
?>
