<?php # $Id: Api.php 0 1970-01-01 00:00:00Z mkwayisi $

require 'SmsghApi.php';
require 'ApiRequest.php';
require 'ApiResponse.php';
require 'ApiException.php';
require 'ApiHelper.php';
require 'ApiList.php';

require 'ApiAccountResource.php';
require 'ApiAccountProfile.php';
require 'ApiAccountContact.php';
require 'ApiService.php';
require 'ApiSettings.php';
require 'ApiChildAccount.php';
require 'ApiInvoice.php';

require 'ApiMessagesResource.php';
require 'ApiMessage.php';
require 'ApiMessageResponse.php';

if (!function_exists('json_encode')) {
	trigger_error('SmsghApi requires the PHP JSON extension', E_USER_ERROR);
}
