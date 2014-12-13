<?php require_once "TrackUser.php"; ?>

Yo! You have visited a page. Gratz.

<?php

$trackCurrentUserView = new TrackCurrentUserView();
$trackCurrentUserView->execute();
    
?>