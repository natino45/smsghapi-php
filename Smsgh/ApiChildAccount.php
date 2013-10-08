<?php # $Id: ApiChildAccount.php 0 1970-01-01 00:00:00Z mkwayisi $

class Smsgh_ApiChildAccount {
	private $object;
	
	/**
	 * Primary constructor.
	 */
	public function __construct($json) {
		$this->object = is_object($json) ? $json : new stdClass;
	}
	
	/**
	 * Gets accountNumber.
	 */
	public function getAccountNumber() {
		return @$this->object->AccountNumber;
	}
	
	/**
	 * Gets balance.
	 */
	public function getBalance() {
		return @$this->object->Balance;
	}
	
	/**
	 * Gets canImpersonate.
	 */
	public function getCanImpersonate() {
		return @$this->object->CanImpersonate;
	}
	
	/**
	 * Gets child.
	 */
	public function getChild() {
		return @$this->object->Child;
	}
	
	/**
	 * Gets credit.
	 */
	public function getCredit() {
		return @$this->object->Credit;
	}
	
	/**
	 * Gets id.
	 */
	public function getId() {
		return @$this->object->Id;
	}
	
	/**
	 * Gets parent.
	 */
	public function getParent() {
		return @$this->object->{'Parent'};
	}
	
	/**
	 * Gets productId.
	 */
	public function getProductId() {
		return @$this->object->ProductId;
	}
	
	/**
	 * Gets productName.
	 */
	public function getProductName() {
		return @$this->object->ProductName;
	}
	
	/**
	 * Gets status.
	 */
	public function getStatus() {
		return @$this->object->Status;
	}
	
	/**
	 * Gets timeCreated.
	 */
	public function getTimeCreated() {
		return @$this->object->TimeCreated;
	}
	
	/**
	 * Gets timeRemoved.
	 */
	public function getTimeRemoved() {
		return @$this->object->TimeRemoved;
	}
}
