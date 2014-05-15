<?php

include 'Smsgh/Api.php';

$apiHost = new SmsghApi();
$apiHost->setClientId('pitnnmim');
$apiHost->setClientSecret('btfdtdze');
$apiHost->setContextPath("v3");
$apiHost->setHttps(false);
$apiHost->setPort(80);
$apiHost->setHostname("api.smsgh.com");

try {
    /**
     * Sending a simple message.
     */
    $apiHost->getMessages()
            ->send('SMSGH', '+23324818378', 'Hello world!');

    /**
     * Sending a message with extended properties.
     */
//    $apiMessage = new ApiMessage();
//    $apiMessage->setFrom('SMSGH');
//    $apiMessage->setTo('+2333248183783');
//    $apiMessage->setContent('Hello world!');
//    $apiMessage->setRegisteredDelivery(true);
//    $apiHost->getMessages()->send($apiMessage);

    /**
     * Scheduling a message.
     */
//    $apiMessage = new ApiMessage();
//    $apiMessage->setFrom('SMSGH');
//    $apiMessage->setTo('+233248183783');
//    $apiMessage->setContent('Hello, world!');
//    $apiHost->getMessages()->schedule($apiMessage, 'tomorrow');
} catch (Smsgh_ApiException $ex) {
    echo 'ERROR: ', $ex->getMessage(), "\n";
    echo "HTTP Status Code: " . $ex->getHttpStatusCode() . "\n";
    echo "Body :" . $ex->getRawBody() . "\n";
    echo "Reason :" . $ex->getReason() . "\n";
}
