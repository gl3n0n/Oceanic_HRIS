<?php
	$event1 = array('title'=>'Jimmy\'s Birthday','start'=>'2009-08-01','end'=>'2009-08-01','location'=>'');
	$event2 = array('title'=>'E-Waste Recycle Day','start'=>'2009-08-12T07:00:00-06:00','end'=>'2009-08-13T15:00:00-06:00','location'=>'Recycle Center');
	$event3 = array('title'=>'Breakfast','start'=>'2009-08-18T06:00:00-05:00','end'=>'2009-08-18T07:00:00-05:00','location'=>'');
	$event4 = array('title'=>'Wash Car','start'=>'2009-08-18T08:00:00-05:00','end'=>'2009-08-18T09:00:00-05:00','location'=>'');
	$event5 = array('title'=>'Read Up On Rocket Science','start'=>'2009-08-18T09:00:00-05:00','end'=>'2009-08-18T10:00:00-05:00','location'=>'');
	$event6 = array('title'=>'Build The Projectile','start'=>'2009-08-18T13:00:00-05:00','end'=>'2009-08-18T13:30:00-05:00','location'=>'');
	$event7 = array('title'=>'Launch The Missile','start'=>'2009-08-18T18:00:00-05:00','end'=>'2009-08-18T20:00:00-05:00','location'=>'');
	$event8 = array('title'=>'Labor Day','start'=>'2009-09-07','end'=>'2009-09-07','location'=>'');
	$event9 = array('title'=>'Subliminal Closing Party','start'=>'2009-09-30','end'=>'2009-10-01','location'=>'Pacha - Ibiza, Spain');

	$events = array($event1,$event2,$event3,$event4,$event5,$event6,$event7,$event8,$event9);
	echo json_encode($events);
