<?php # $Id: ApiList.php 0 1970-01-01 00:00:00Z mkwayisi $

class Smsgh_ApiList {
	private $count;
	private $totalPages;
	private $items;
	
	/**
	 * Primary constructor.
	 */
	public function __construct($json) {
		if ($json instanceof stdClass) {
			@$this->count = $json->Count + 0;
			@$this->totalPages = $json->TotalPages + 0;
			$this->items = array();
			
			foreach ($json as $name => $value)
			switch (strtolower($name)) {
				
				case 'childaccountlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiChildAccount($o);
					break;
					
				case "invoicestatementlist":
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiInvoice($o);
					break;
					
				case "servicelist":
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiService($o);
					break;
			}
		} else throw new Smsgh_ApiException("Bad parameter");
	}
	
	/**
	 * Gets count.
	 */
	public function getCount() {
		return $this->count;
	}
	
	/**
	 * Gets totalPages.
	 */
	public function getTotalPages() {
		return $this->totalPages;
	}
	
	/**
	 * Gets items.
	 */
	public function getItems() {
		return $this->items;
	}
}
