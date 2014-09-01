<?php

// Let us test the SDK


require './Smsgh/Api.php';

$hostname = "api.smsgh.local";
$contextPath = "";
$timeout = -1;
$port = -1;
$auth = new BasicAuth("hqikydyh", "kakdxpvd");
// instance of ApiHost
$apiHost = new ApiHost($auth, $hostname, $port, $contextPath, $timeout);

$contentApi = new ContentApi($apiHost);

try {
    // Let us fetch some content medias
    $medias = $contentApi->getContentMedias();
    echo "\n";
    echo "Medias Total Pages " . $medias->getTotalPages();
    echo "\nMedias Count " . $medias->getCount();
    // Instance media info
//    $mediaInfo = new MediaInfo();
//
//    $mediaInfo->contentName = "Test SDK 17";
//    $mediaInfo->displayText = "Play [CONTENT]";
//    $mediaInfo->libraryId = "9327e44b-2810-49f0-90fc-ae3ebbccb883";
//    $mediaInfo->drmProtect = "true";
//    $filePath = "C:\\Users\\smsgh\\Music\\CeCe Winans\\Comforter _Cece Winans.mp3";
//
//    $response = $contentApi->addContentMedia($filePath, $mediaInfo);
//
//
//    if ($response != null) {
//        echo "\nFile Uploaded\n";
//        echo $response->getId();
//    } else {
//        echo "File not upload";
//    }
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}
