<?php # $Id: ApiHost.php 224 2013-08-27 10:25:03Z mkwayisi $

class Smsgh_ApiHost {
	
	// Data fields.
	private $clientId;
	private $clientSecret;
	private $hostname;
	private $port;
	private $https;
	private $timeout;
	private $messagesResource;
	
	// Primary constructor.
	public function __construct($clientId = null, $clientSecret = null) {
		$this
			->hostname('api.smsgh.com')
			->port(443)
			->https(true)
			->timeout(15);
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		$this->messagesResource =
			new Smsgh_ApiMessagesResource($this);
	}
	
	// Gets or sets client ID.
	public function clientId($value = null) {
		if (is_null($value))
			return $this->clientId;
		else if (is_string($value))
			$this->clientId = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets client secret.
	public function clientSecret($value = null) {
		if (is_null($value))
			return $this->clientSecret;
		else if (is_string($value))
			$this->clientSecret = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets hostname.
	public function hostname($value = null) {
		if (is_null($value))
			return $this->hostname;
		else if (is_string($value))
			$this->hostname = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'string'");
		return $this;
	}
	
	// Gets or sets https.
	public function https($value = null) {
		if (is_null($value))
			return $this->https;
		else if (is_bool($value)) {
			$this->https = $value;
		} else throw new Smsgh_ApiException(
			"Parameter value must be of type 'bool'");
		return $this;
	}
	
	// Gets or sets port.
	public function port($value = null) {
		if (is_null($value))
			return $this->port;
		else if (is_int($value))
			$this->port = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'int'");
		return $this;
	}
	
	// Gets or sets timeout.
	public function timeout($value = null) {
		if (is_null($value))
			return $this->timeout;
		else if (is_int($value))
			$this->timeout = $value;
		else throw new Smsgh_ApiException(
			"Parameter value must be of type 'int'");
		return $this;
	}
	
	// Returns messagesResource.
	public function messagesResource() {
		return $this->messagesResource;
	}
}
