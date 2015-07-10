<?php

// Let us test the SDK
require 'Smsgh/Api.php';

$auth = new Smsgh\BasicAuth("user123", "password123");
// instance of ApiHost
$apiHost = new Smsgh\ApiHost($auth);

// instance of AccountApi
$accountApi = new Smsgh\AccountApi($apiHost);
// Get the account profile
// Let us try to send some message
$messagingApi = new Smsgh\MessagingApi($apiHost);
try {
	// Send a quick message
	$messageResponse = $messagingApi->sendQuickMessage("Husby", "+2332432191768", "I love you dearly Honey. See you in the evening...");

	$mesg = new Smsgh\Message();
	$mesg->setContent("I will eat the beautiful Food you have");
	$mesg->setTo("+233244219234");
	$mesg->setFrom("+233204567867");
	$mesg->setRegisteredDelivery(true);

	// Let us say we want to send the message 3 days from today
	$mesg->setTime(date('Y-m-d H:i:s', strtotime('+1 week')));

	$messageResponse = $messagingApi->sendMessage($mesg);

	if ($messageResponse instanceof Smsgh\MessageResponse) {
		echo $messageResponse->getStatus();
	} elseif ($messageResponse instanceof Smsgh\HttpResponse) {
		echo "\nServer Response Status : " . $messageResponse->getStatus();
	}
} catch (Exception $ex) {
	echo $ex->getTraceAsString();
}
