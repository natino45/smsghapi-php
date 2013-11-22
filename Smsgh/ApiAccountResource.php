<?php # $Id: SmsghApi.php 0 1970-01-01 00:00:00Z mkwayisi $

class Smsgh_ApiAccountResource {
	/**
	 * Data fields.
	 */
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(Smsgh_SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Gets account profile.
	 */
	public function getProfile() {
		return new Smsgh_ApiAccountProfile(Smsgh_ApiHelper::getJson
			($this->apiHost, "GET", "/v3/account/profile"));
	}
	
	/**
	 * Gets primary contact.
	 */
	public function getPrimaryContact() {
		return new Smsgh_ApiAccountContact(Smsgh_ApiHelper::getJson
			($this->apiHost, "GET", "/v3/account/primary_contact"));
	}
	
	/**
	 * Gets billing contact.
	 */
	public function getBillingContact() {
		return new Smsgh_ApiAccountContact(Smsgh_ApiHelper::getJson
			($this->apiHost, "GET", "/v3/account/billing_contact"));
	}
	
	/**
	 * Gets technical contact.
	 */
	public function getTechnicalContact() {
		return new Smsgh_ApiAccountContact(Smsgh_ApiHelper::getJson
			($this->apiHost, "GET", "/v3/account/technical_contact"));
	}
	
	/**
	 * Gets all account contacts
	 */
	public function getContacts() {
		$contacts = array();
		$json = Smsgh_ApiHelper::getJson
			($this->apiHost, "GET", "/v3/account/contacts");
		if (is_array($json)) foreach ($json as $contact)
			$contacts[] = new Smsgh_ApiAccountContact($contact);
		return $contacts;
	}
	
	/**
	 * Updates an object.
	 */
	public function update($object) {
		if ($object == null)
			throw new Smsgh_ApiException("Parameter 'object' cannot be null");
		
		// Account contact.
		if ($object instanceof Smsgh_ApiAccountContact) {
			Smsgh_ApiHelper::getData($this->apiHost, 'PUT',
				'/v3/account/contacts/' . $object->getAccountContactId(),
					Smsgh_ApiHelper::toJson($object));
		}
		
		// Account settings.
		else if ($object instanceof Smsgh_ApiSettings) {
			return new Smsgh_ApiSettings(Smsgh_ApiHelper::getJson
				($this->apiHost, 'PUT', '/v3/account/settings',
					Smsgh_ApiHelper::toJson($object)));
		}
		
		// Unknown.
		else throw new Smsgh_ApiException('Bad parameter');
	}
	
	/**
	 * Gets account services.
	 */
	public function getServices($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/account/services', $page, $pageSize);
	}
	
	/**
	 * Gets account settings.
	 */
	public function getSettings() {
		return new Smsgh_ApiSettings(Smsgh_ApiHelper::getJson
			($this->apiHost, 'GET', '/v3/account/settings'));
	}
	
	
	/**
	 * Gets account invoices.
	 */
	public function getInvoices($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/account/invoices', $page, $pageSize);
	}
}
 
