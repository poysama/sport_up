<?php
  //get class into the page
  require_once('classes/tc_calendar.php');

  $date1_default = date("Y-m-d H:i:s");
  $date2_default = date("Y-m-d H:i:s");

  $myCalendar = new tc_calendar("date1", true, true);
  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
  $myCalendar->setDate(date('d', strtotime($date1_default))
          , date('m', strtotime($date1_default))
          , date('Y', strtotime($date1_default)));
  $myCalendar->setPath("calendar/");
  $myCalendar->setYearInterval(1970, 2020);
  $myCalendar->setAlignment('left', 'bottom');
  $myCalendar->setDatePair('date1', 'date2', $date2_default);
  echo "<b><div style='position: relative; float: left;'><input type=checkbox name=date_from_check>From or Date:&nbsp;</div></b>";
  $myCalendar->writeScript();

  $myCalendar = new tc_calendar("date2", true, true);
  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
  $myCalendar->setDate(date('d', strtotime($date2_default))
         , date('m', strtotime($date2_default))
         , date('Y', strtotime($date2_default)));
  $myCalendar->setPath("calendar/");
  $myCalendar->setYearInterval(1970, 2020);
  $myCalendar->setAlignment('left', 'bottom');
  $myCalendar->setDatePair('date1', 'date2', $date1_default);
  echo "<b><div style='position: relative; float: left;'><input type=checkbox name=date_to_check>To:&nbsp;</div></b>";
  $myCalendar->writeScript();
?>
