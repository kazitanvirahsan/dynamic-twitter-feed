<?php
require_once("vendor/autoload.php");
require_once("src/api/config.php");
use Twitter\api\TwitterApiWrapper;

$twitterApiWrapper = new TwitterApiWrapper();
$tweets = $twitterApiWrapper->setQueryField('engineering')->setNumberOfRecord(10)->fetchResult();

// Return JSON Object
header('Content-Type: application/json');
echo !($tweets->statuses === null) ? json_encode($tweets->statuses) : null;