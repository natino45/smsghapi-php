<?php # $Id: ApiMessageResponse.php 224 2013-08-27 10:25:03Z mkwayisi $

class Smsgh_ApiMessageResponse {
	private $object;
	
	// Primary constructor.
	public function __construct(stdClass $object) {
		$this->object = $object;
	}
	
	// Returns status.
	public function status() {
		return isset($this->object->Status) ?
			$this->object->Status : 0;
	}
	
	// Returns messageId.
	public function messageId() {
		return isset($this->object->MessageId) ?
			$this->object->MessageId : null;
	}
	
	// Returns rate.
	public function rate() {
		return isset($this->object->Rate) ?
			$this->object->Rate : 0;
	}
	
	// Returns networkId
	public function networkId() {
		return isset($this->object->NetworkId) ?
			$this->object->NetworkId : null;
	}
	
	// Returns clientReference.
	public function clientReference() {
		return isset($this->object->ClientReference) ?
			$this->object->ClientReference : null;
	}
	
	// Returns detail.
	public function detail() {
		return isset($this->object->Detail) ?
			$this->object->Detail : null;
	}
}
