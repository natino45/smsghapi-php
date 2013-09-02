<?php

include 'Smsgh/Api.php';

$apiHost = new Smsgh_ApiHost;
$apiHost->clientId('user123');
$apiHost->clientSecret('secret');

try {
	/**
	 * Sending a simple message.
	 */
	$apiHost->messagesResource()
		->send('SMSGH', '+233248183783', 'Hello world!');
		
	/**
	 * Sending a message with extended properties.
	 */
	$apiMessage = new Smsgh_ApiMessage;
	$apiMessage->from('SMSGH');
	$apiMessage->to('+233248183783');
	$apiMessage->content('Hello world!');
	$apiMessage->registeredDelivery(true);
	$apiHost->messagesResource()->send($apiMessage);
	
	/**
	 * Scheduling a message.
	 */
	$apiMessage = new Smsgh_ApiMessage;
	$apiMessage->from('SMSGH');
	$apiMessage->to('+233248183783');
	$apiMessage->content('Hello, world!');
	$apiHost->messagesResource()->schedule($apiMessage, 'tomorrow');
} catch (Smsgh_ApiException $ex) {
	echo 'ERROR: ', $ex->message(), "\n";
}
