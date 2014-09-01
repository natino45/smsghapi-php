<?php

// Let us test the SDK


require './Smsgh/Api.php';

$hostname = "api.smsgh.local";
$contextPath = "";
$timeout = -1;
$port = -1;
$auth = new BasicAuth("hqikydyh", "kakdxpvd");
// instance of ApiHost
// instance of AccountApi
$accountApi = new AccountApi($apiHost);
// Get the account profile
// Let us try to send some message
$messagingApi = new MessagingApi($apiHost);
try {
    //$messageResponse = $messagingApi->quickSend("Husby", "+2332432191768", "I love you dearly Honey. See you in the evening...");
    $mesg = new Message();
    $mesg->setContent("I will eat the beautiful Food you have");
    $mesg->setTo("+233244219234");
    $mesg->setFrom("+233204567867");
    $mesg->setRegisteredDelivery(true);

    // Let us say we want to send the message 3 days from today
    $mesg->setTime(date('Y-m-d H:i:s', strtotime('+1 week')));

    $messageResponse = $messagingApi->sendMessage($mesg);

    if ($messageResponse instanceof MessageResponse) {
        echo $messageResponse->getStatus();
    } elseif ($messageResponse instanceof HttpResponse) {
        echo "\nServer Response Status : " . $messageResponse->getStatus();
    }
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}
