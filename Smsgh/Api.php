<?php
namespace Smsgh;

spl_autoload_register(function ($class) {
	$class = str_replace('\\', '/', $class);
	require_once ($class . '.php');
});

if (!function_exists('json_encode')) {
	trigger_error('SmsghApi requires the PHP JSON extension', E_USER_ERROR);
}
