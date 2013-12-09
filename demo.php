<?php

include 'Smsgh/Api.php';

$apiHost = new SmsghApi();
$apiHost->setClientId('user123');
$apiHost->setClientSecret('secret');
$apiHost->setContextPath("v3");
$apiHost->setHttps(true);
$apiHost->setHostname("api.smsgh.com");

try {
	/**
	 * Sending a simple message.
	 */
	$apiHost->getMessages()
		->send('SMSGH', '+233248183783', 'Hello world!');
		
	/**
	 * Sending a message with extended properties.
	 */
	$apiMessage = new ApiMessage();
	$apiMessage->setFrom('SMSGH');
	$apiMessage->setTo('+233248183783');
	$apiMessage->setContent('Hello world!');
	$apiMessage->setRegisteredDelivery(true);
	$apiHost->getMessages()->send($apiMessage);
	
	/**
	 * Scheduling a message.
	 */
	$apiMessage = new ApiMessage();
	$apiMessage->setFrom('SMSGH');
	$apiMessage->setTo('+233248183783');
	$apiMessage->setContent('Hello, world!');
	$apiHost->getMessages()->schedule($apiMessage, 'tomorrow');
} catch (Smsgh_ApiException $ex) {
	echo 'ERROR: ', $ex->message(), "\n";
}
