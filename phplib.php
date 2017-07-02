<?php
$service = new Google_CalendarService($client); // successfully connected
$freebusy = new Google_FreeBusyRequest();
$freebusy->setTimeMin('2017-06-29T12:00:00.000-06:00');
$freebusy->setTimeMax('2017-07-01T12:00:00.000-06:00');
$freebusy->setTimeZone('America/Denver');
$freebusy->setGroupExpansionMax(10);
$freebusy->setCalendarExpansionMax(10);
$mycalendars= array("agolla07@gmail.com");
$freebusy->setItems = $mycalendars;
$createdReq = $service->freebusy->query($freebusy);

echo $createdReq->getKind(); // works
echo $createdReq->getTimeMin(); // works
echo $createdReq->getTimeMax(); // works
$s = $createdReq->getCalendars($diekalender);
Print_r($s, true); // doesn't show anything
?>
