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
			$this->items = array();
			
			foreach ($json as $name => $value)
			switch (strtolower($name)) {
				case 'count':
					$this->count = $value;
					break;
					
				case 'totalpages':
					$this->totalPages = $value;
					break;
					
				case 'actionlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiAction($o);
					break;
					
				case 'campaignlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiCampaign($o);
					break;
					
				case 'childaccountlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiChildAccount($o);
					break;
					
				case 'contactlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiContact($o);
					break;
					
				case 'grouplist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiContactGroup($o);
					break;
					
				case 'invoicestatementlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiInvoice($o);
					break;
					
				case 'messages':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiMessage($o);
					break;
					
				case 'messagetemplatelist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiTemplate($o);
					break;
					
				case 'mokeywordlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiMoKeyWord($o);
					break;
					
				case 'numberplanlist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiNumberPlan($o);
					break;
					
				case 'senderaddresseslist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiSender($o);
					break;
					
				case 'servicelist':
					foreach ($value as $o)
						$this->items[] = new Smsgh_ApiService($o);
					break;
			}
		} else throw new Smsgh_ApiException('Bad ApiList parameter');
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
