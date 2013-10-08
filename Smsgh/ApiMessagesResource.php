<?php # $Id: ApiMessagesResource.php 224 2013-08-27 10:25:03Z mkwayisi $

class Smsgh_ApiMessagesResource {
	
	/**
	 * Data fields.
	 */
	private $apiHost;
	private $apiRequest;

	/**
	 * Primary constructor.
	 */
	public function __construct(Smsgh_SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Initializes apiRequest.
	 */
	private function init() {
		if (!$this->apiRequest) {
			$this->apiRequest =
				new Smsgh_ApiRequest(
					$this->apiHost->hostname(),
					$this->apiHost->port(),
					$this->apiHost->https() ? 'ssl' : 'tcp',
					$this->apiHost->timeout(),
					$this->apiHost->clientId(),
					$this->apiHost->clientSecret()
				);
		}
		return $this->apiRequest;
	}
	
	/**
	 * Sends a message.
	 */
	public function send($mixed, $to = null, $content = null) {
		$apiMessage = null;
		
		if ($mixed instanceof Smsgh_ApiMessage) {
			$apiMessage = $mixed;
		} else if (is_string($mixed) && is_string($to) && is_string($content)) {
			$apiMessage = new Smsgh_ApiMessage;
			$apiMessage->from($mixed)->to($to)->content($content);
		} else throw new Smsgh_ApiException("Invalid parameters for 'send'");
		
		$apiResponse = $this->init()
			->method('POST')
			->uri('/v3/messages')
			->header('accept', 'application/json')
			->header('content-type', 'application/json')
			->send($apiMessage->serialize());
			
		if ($apiResponse->status() > 199 && $apiResponse->status() < 300) {
			if ($object = json_decode($apiResponse->body()))
				return new Smsgh_ApiMessageResponse($object);
			else throw new Smsgh_ApiException(
				"Could not construct ApiMessageResponse from response");
		} else throw new Smsgh_ApiException('Request failed: '
			. $apiResponse->status() . ' ' . $apiResponse->reason());
	}
	
	/**
	 * Schedules a message.
	 */
	public function schedule(Smsgh_ApiMessage $apiMessage, $date) {
		$_date = 0;
		if (is_string($date)) {
			$_date = strtotime($date);
			if ($_date === false || $_date < 0)
				throw new Smsgh_ApiException("Invalid date: '$date'");
		} else if (is_int($date)) {
			$_date = $date;
		} else throw new Smsgh_ApiException(
			"Date must be of type 'string' or 'int'");
		
		$apiMessage->time(date('Y-m-d H:i:s', $_date));
		return $this->send($apiMessage);
	}
	
	/**
	 * Reschedules a message.
	 */
	public function reschedule($messageId, $date) {
		if (!is_string($messageId)) {
			throw new Smsgh_ApiException(
				"Message ID must be of type 'string'");
		}
		
		if (is_string($date)) {
			$_date = strtotime($date);
			if ($_date === false || $_date < 0)
				throw new Smsgh_ApiException("Invalid date: '$date'");
			$date = $_date;
		} else if (!is_int($date)) {
			throw new Smsgh_ApiException(
				"Date must be of type 'string' or 'int'");
		}
		
		$apiResponse = $this->init()
			->method('PUT')
			->uri("/v3/messages/$messageId")
			->header('accept', 'application/json')
			->header('content-type', 'application/json')
			->send('{"Time":"' . date('Y-m-d H:i:s', $date) . '"}');
			
		if ($apiResponse->status() > 199 && $apiResponse->status() < 300) {
			if ($object = json_decode($apiResponse->body()))
				return new Smsgh_ApiMessageResponse($object);
			else throw new Smsgh_ApiException(
				'Could not construct ApiMessageResponse object from response');
		} else throw new Smsgh_ApiException('Request failed: '
			. $apiResponse->status() . ' ' . $apiResponse->reason());
	}
	
	/**
	 * Cancels a scheduled message.
	 */
	public function cancel($messageId) {
		if (!is_string($messageId)) {
			throw new Smsgh_ApiException(
				"Message ID must be of type 'string'");
		}
		
		$apiResponse = $this->init()
			->method('DELETE')
			->uri("/v3/messages/$messageId")
			->header('accept', 'application/json')
			->send();
			
		if ($apiResponse->status() > 199 && $apiResponse->status() < 300) {
			if ($object = json_decode($apiResponse->body()))
				return new Smsgh_ApiMessageResponse($object);
			else throw new Smsgh_ApiException(
				'Could not construct ApiMessageResponse object from response');
		} else throw new Smsgh_ApiException('Request failed: '
			. $apiResponse->status() . ' ' . $apiResponse->reason());
	}
	
	/**
	 * Returns a single message.
	 */
	public function getMessage($id) {
		if (!is_string($id))
			throw new Smsgh_ApiException(
				"Message id must be of type 'string'");
			
		$apiResponse = $this->init()
			->method('GET')
			->uri("/v3/messages/$id")
			->header('accept', 'application/json')
			->send();
			
		if ($apiResponse->status() > 199 && $apiResponse->status() < 300) {
			if ($object = json_decode($apiResponse->body()))
				return new Smsgh_ApiMessage($object);
			else throw new Smsgh_ApiException(
				"Could not construct APIMessage object from response");
		} else throw new Smsgh_ApiException('Request failed: '
			. $apiResponse->status() . ' ' . $apiResponse->reason());
	}
	
	/**
	 * Retrieves messages.
	 */
	public function getMessages($mixed = 0, $limit = null,
		$start = null, $end = null, $pending = null, $direction = null)
	{
		$index = 0;
		$params = array();
		
		if (is_array($mixed)) {
			foreach (array('index', 'limit', 'start',
				'end', 'pending', 'direction') as $key)
			{
				if (isset($mixed[$key]))
					$$key = $mixed[$key];
			}
		} else $index = $mixed;
		
		if (is_int($index)) {
			$params['index'] = $index;
		} else throw new Smsgh_ApiException(
			"Parameter 'index' must be of type 'int'");
			
		if (isset($limit)) {
			if (is_int($limit))
				$params['limit'] = $limit;
			else throw new Smsgh_ApiException(
				"Parameter 'limit' must be of type 'int'");
		}
		
		if (isset($start)) {
			if (is_string($start)) {
				$_start = strtotime($start);
				if ($_start === false || $_start < 0)
					throw new Smsgh_ApiException(
						"Invalid start date: '$start'");
				$start = $_start;
			} else if (!is_int($start))
				throw new Smsgh_ApiException(
					"Parameter 'start' must be of type 'string' or 'int'");
			$params['start'] = date('Y-m-d H:i:s', $start);
		}
		
		if (isset($end)) {
			if (is_string($end)) {
				$_end = strtotime($end);
				if ($_end === false || $_end < 0)
					throw new Smsgh_ApiException(
						"Invalid end date: '$end'");
				$end = $_end;
			} else if (!is_int($end))
				throw new Smsgh_ApiException(
					"Parameter 'end' must be of type 'string' or 'int'");
			$params['end'] = date('Y-m-d H:i:s', $end);
		}
		
		if (isset($pending)) {
			if (is_bool($pending))
				$params['pending'] = $pending ? 'true' : 'false';
			else throw new Smsgh_ApiException(
				"Parameter 'pending' must be of type 'boolean'");
		}
		
		if (isset($direction)) {
			if (is_string($direction)) {
				if ($direction == 'in' || $direction == 'out') {
					$params['direction'] = $direction;
				} else throw new Smsgh_ApiException(
					"Direction must be either 'in' or 'out'");
			} else throw new Smsgh_ApiException(
				"Parameter 'direction' must be of type 'string'");
		}
		
		$uri = "/v3/messages?index=${params['index']}";
		unset($params['index']);
		foreach ($params as $key => $value)
			$uri .= "&$key=" . rawurlencode($value);
			
		$apiResponse = $this->init()
			->method('GET')
			->uri($uri)
			->header('accept', 'application/json')
			->send();
			
		if ($apiResponse->status() > 199 && $apiResponse->status() < 300) {
			$object = json_decode($apiResponse->body());
			if ($object && isset($object->Messages) && is_array($object->Messages)) {
				$apiMessages = array();
				foreach ($object->Messages as $object)
					$apiMessages[] = new Smsgh_ApiMessage($object);
				return $apiMessages;
			} else throw new Smsgh_ApiException(
				"Could not construct APIMessage objects from response");
		} else throw new Smsgh_ApiException('Request failed: '
			. $apiResponse->status() . ' ' . $apiResponse->reason());
	}
}
