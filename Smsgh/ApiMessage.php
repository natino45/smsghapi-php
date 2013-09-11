<?php # $Id: ApiMessage.php 224 2013-08-27 10:25:03Z mkwayisi $

class Smsgh_ApiMessage {
	
	private $object;
	
	private $id;
	private $direction;
	private $updateTime;
	private $networkId;
	private $units;
	private $rate;
	private $status;
	
	// Primary constructor.
	public function __construct(stdClass $object = null) {
		$this->object = new stdClass;
		if ($object !== null) {
			$readonlies = array(
				'MessageId'  => 'id',
				'Direction'  => 'direction',
				'UpdateTime' => 'updateTime',
				'NetworkId'  => 'networkId',
				'Units'      => 'units',
				'Rate'       => 'rate',
				'Status'     => 'status'
				);
			
			foreach (get_object_vars($object) as $prop => $value) {
				if (isset($readonlies[$prop])) {
					$this->$readonlies[$prop] = $value;
				} else $this->object->$prop = $value;
			}
		}
	}
	
	// Returns ID.
	public function id() {
		return $this->id;
	}
	
	// Returns ID.
	public function messageId() {
		return $this->id;
	}
	
	// Returns direction.
	public function direction() {
		return $this->direction;
	}
	
	// Returns updateTime.
	public function updateTime() {
		return $this->updateTime;
	}
	
	// Returns networkId.
	public function networkId() {
		return $this->networkId;
	}
	
	// Returns units.
	public function units() {
		return $this->units;
	}
	
	// Returns rate.
	public function rate() {
		return $this->rate;
	}
	
	// Returns status.
	public function status() {
		return $this->status;
	}
	
	#=================================================================]]
	
	// Gets or sets apiMessageType.
	public function apiMessageType($value = null) {
		if (is_null($value)) {
			return isset($this->object->ApiMessageType) ?
				$this->object->ApiMessageType : null;
		} else if ($value === false)
			unset($this->object->ApiMessageType);
		else if (is_int($value)) {
			if ($value >= 0 && $value <= 2)
				$this->object->ApiMessageType = $value;
			else throw new Smsgh_ApiException(
				"ApiMessageType must be either 0, 1 or 2");
		} else throw new Smsgh_ApiException(
			"Parameter value must be of type 'int'");
		return $this;
	}
	
	// Gets or sets from.
	public function from($value = null) {
		if (is_null($value)) {
			return isset($this->object->From) ?
				$this->object->From : null;
		} else if (is_string($value))
			$this->object->From = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets to.
	public function to($value = null) {
		if (is_null($value)) {
			return isset($this->object->To) ?
				$this->object->To : null;
		} else if (is_string($value))
			$this->object->To = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets content.
	public function content($value = null) {
		if (is_null($value)) {
			return isset($this->object->Content) ?
				$this->object->Content : null;
		} else if (is_string($value))
			$this->object->Content = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets udh.
	public function udh($value = null) {
		if (is_null($value)) {
			return isset($this->object->Udh) ?
				$this->object->Udh : null;
		} else if ($value === false)
			unset($this->object->Udh);
		else if (is_string($value))
			$this->object->Udh = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets time.
	public function time($value = null) {
		if (is_null($value)) {
			return isset($this->object->Time) ?
				$this->object->Time : null;
		} else if ($value === false)
			unset($this->object->Time);
		else if (is_string($value))
			$this->object->Time = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets clientReference.
	public function clientReference($value = null) {
		if (is_null($value)) {
			return isset($this->object->ClientReference) ?
				$this->object->ClientReference : null;
		} else if ($value === false)
			unset($this->object->ClientReference);
		else if (is_string($value))
			$this->object->ClientReference = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets registeredDelivery.
	public function registeredDelivery($value = null) {
		if (is_null($value)) {
			return isset($this->object->RegisteredDelivery) ?
				$this->object->RegisteredDelivery : null;
		} else if ($value === false)
			unset($this->object->RegisteredDelivery);
		else if ($value === true)
			$this->object->RegisteredDelivery = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'boolean'");
		return $this;
	}
	
	// Gets or sets flashMessage.
	public function flashMessage($value = null) {
		if (is_null($value)) {
			return isset($this->object->FlashMessage) ?
				$this->object->FlashMessage : null;
		} else if ($value === false)
			unset($this->object->FlashMessage);
		else if ($value === true)
			$this->object->FlashMessage = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'boolean'");
		return $this;
	}
	
	// Returns a serialized object.
	public function serialize() {
		return json_encode($this->object);
	}
}
