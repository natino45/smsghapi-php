<?php # $Id: Api.php 224 2013-08-27 10:25:03Z mkwayisi $

require 'ApiHost.php';
require 'ApiRequest.php';
require 'ApiResponse.php';
require 'ApiException.php';

require 'ApiMessagesResource.php';
require 'ApiMessage.php';
require 'ApiMessageResponse.php';

if (!function_exists('json_encode')) {
	trigger_error('SmsghApi requires the PHP JSON extension', E_USER_ERROR);
}
