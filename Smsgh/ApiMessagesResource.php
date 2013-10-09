<?php # $Id: ApiMessagesResource.php 0 1970-01-10 00:00:00Z mkwayisi $

class Smsgh_ApiMessagesResource {
	private $apiHost;

	/**
	 * Primary constructor.
	 */
	public function __construct(Smsgh_SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Sends a message.
	 */
	public function send($mixed, $to = null, $content = null) {
		if ($mixed instanceof Smsgh_ApiMessage) {
			return new Smsgh_ApiMessageResponse(Smsgh_ApiHelper::getJson
				($this->apiHost, 'POST', '/v3/messages',
					Smsgh_ApiHelper::toJson($mixed)));
		}
		
		if (!is_string($mixed))
			throw new Smsgh_ApiException
				("Parameter 'from' must be of type 'string'");
		if (!is_string($to))
			throw new Smsgh_ApiException
				("Parameter 'to' must be of type 'string'");
		if (!is_string($content))
			throw new Smsgh_ApiException
				("Parameter 'content' must be of type 'string'");
		$msg = new Smsgh_ApiMessage;
		$msg->setFrom($mixed)->setTo($to)->setContent($content);
		return $this->send($msg);
	}
	
	/**
	 * Schedules message.
	 */
	public function schedule($message, $time) {
		if ($message instanceof Smsgh_ApiMessage) {
			if (is_int($time)) {
				$message->setTime(date('Y-m-d H:i:s', $time));
				return $this->send($message);
			}
			throw new Smsgh_ApiException
				("Parameter 'time' must be of type 'int'");
		}
		throw new Smsgh_ApiException
			("Parameter 'message' must be of type 'Smsgh_ApiMessage'");
	}
	
	/**
	 * Reschedules message.
	 */
	public function reschedule($messageId, $time) {
		if (!is_string($messageId))
			throw new Smsgh_ApiException
				("Parameter 'messageId' must be of type 'string'");
		if (strlen($messageId) !== 32)
			throw new Smsgh_ApiException
				("Invalid value for parameter 'messageId'");
		if (!is_int($time))
			throw new Smsgh_ApiException
				("Parameter 'time' must be of type 'int'");
		$obj = new stdClass;
		$obj->Time = date('Y-m-d H:i:s', $time);
		return new Smsgh_ApiMessageResponse(Smsgh_ApiHelper::getJson
			($this->apiHost, 'PUT', "/v3/messages/$messageId", json_encode($obj)));
	}
	
	/**
	 * Cancels scheduled message by ID.
	 */
	public function cancel($messageId) {
		if (!is_string($messageId))
			throw new Smsgh_ApiException
				("Parameter 'messageId' must be of type 'string'");
		if (strlen($messageId) !== 32)
			throw new Smsgh_ApiException
				("Invalid value for parameter 'messageId'");
		return new Smsgh_ApiMessageResponse(Smsgh_ApiHelper::getJson
			($this->apiHost, 'DELETE', "/v3/messages/$messageId"));
	}
	
	/**
	 * Gets message.
	 */
	public function get($messageId) {
		if (is_string($messageId)) {
			if (strlen($messageId) === 32)
				return new Smsgh_ApiMessage(Smsgh_ApiHelper::getJson
					($this->apiHost, 'GET', "/v3/messages/$messageId"));
			throw new Smsgh_ApiException
				("Parameter 'messageId' is not a valid message ID");
		}
		throw new Smsgh_ApiException
			("Parameter 'messageId' must be of type 'string'");
	}
	
	/**
	 * Gets messages.
	 */
	public function gets
		($start = -1, $end = -1, $index = -1, $limit = -1,
			$pending = null, $direction = null) {
		$uri = '/v3/messages';
		$hasQ = false;
		
		if (is_int($start)) {
			if ($start > 0) {
				$uri .= '?start='
					. urlencode(date('Y-m-d H:i:s', $start));
				$hasQ = true;
			}
		} else throw new Smsgh_ApiException
			("Parameter 'start' must be of type 'int'");
			
		if (is_int($end)) {
			if ($end > 0) {
				$uri .= ($hasQ ? '&' : '?') . 'end='
					. urlencode(date('Y-m-d H:i:s', $end));
				if (!$hasQ) $hasQ = true;
			}
		} else throw new Smsgh_ApiException
			("Parameter 'end' must be of type 'int'");
			
		if (is_int($index)) {
			if ($index > 0) {
				$uri .= ($hasQ ? '&' : '?') . "index=$index";
				if (!$hasQ) $hasQ = true;
			}
		} else throw new Smsgh_ApiException
			("Parameter 'index' must be of type 'int'");
			
		if (is_int($limit)) {
			if ($limit > 0) {
				$uri .= ($hasQ ? '&' : '?') . 'limit=' . $limit;
				if (!$hasQ) $hasQ = true;
			}
		} else throw new Smsgh_ApiException
			("Parameter 'limit' must be of type 'int'");
			
		if (is_bool($pending)) {
			$uri .= ($hasQ ? '&' : '?') . 'pending='
				. ($pending ? 'true': 'false');
			if (!$hasQ) $hasQ = true;
		} else if ($pending !== null)
			throw new Smsgh_ApiException
				("Parameter 'pending' must be of type 'bool'");
			
		if (is_string($direction)) {
			$uri .= ($hasQ ? '&' : '?') . 'direction='
				. (strtolower($direction) == 'in' ? 'in' : 'out');
		} else if ($direction !== null)
			throw new Smsgh_ApiException
				("Parameter 'direction' must be of type 'string'");
			
		return Smsgh_ApiHelper::getApiList($this->apiHost, $uri, -1, -1);
	}
}
