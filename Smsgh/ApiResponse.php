<?php # $Id: ApiResponse.php 224 2013-08-27 10:25:03Z mkwayisi $

class Smsgh_ApiResponse {
	
	// Data fields.
	private $rawdata;
	private $status;
	private $reason;
	private $headers;
	private $body;
	private $locked;
	
	// Primary constructor.
	public function __construct() {
		$this->headers = array();
	}
	
	// Returns status.
	public function status($value = null) {
		if (is_null($value))
			return $this->status;
		else if (!$this->locked)
			$this->status = $value;
		else throw new Smsgh_ApiException(
			"Object properties cannot be modified");
		return $this;
	}
	
	// Returns reason.
	public function reason($value = null) {
		if (is_null($value))
			return $this->reason;
		else if (!$this->locked)
			$this->reason = $value;
		else throw new Smsgh_ApiException(
			"Object properties cannot be modified");
		return $this;
	}
	
	// Returns rawdata.
	public function rawdata($value = null) {
		if (is_null($value))
			return $this->rawdata;
		else if (!$this->locked)
			$this->rawdata = $value;
		else throw new Smsgh_ApiException(
			"Object properties cannot be modified");
		return $this;
	}
	
	// Returns header.
	public function header($name, $value = null) {
		if (is_string($name)) {
			$name = strtolower($name);
			if (is_null($value)) {
				return isset($this->headers[$name]) ?
					$this->headers[$name] : null;
			} else if (!$this->locked) {
				$this->headers[$name] = $value;
			} else throw new Smsgh_ApiException(
				"Object properties cannot be modified");
		} else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Returns body.
	public function body($value = null) {
		if (is_null($value))
			return $this->body;
		else if (!$this->locked)
			$this->body = $value;
		else throw new Smsgh_ApiException(
			"Object properties cannot be modified.");
		return $this;
	}
	
	// Locks the properties of this object.
	public function lock() {
		$this->locked = true;
		return $this;
	}
}
