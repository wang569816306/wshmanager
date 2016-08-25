<?php
require __DIR__ . '/jg_autoload.php';
use JPush\Client as JPush;
$registration_id = getenv('registration_id');
$client = new JPush("de690f59fbd34939bf194460","9cd77b6d54c4aa1747dcae4d");

