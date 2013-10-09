<?php # $Id: ApiContactsResource.php 0 1970-01-01 00:00:00Z mkwayisi $

class Smsgh_ApiContactsResource {
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(Smsgh_SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Gets contact by ID or number.
	 */
	public function get($idNumber) {
		if (is_string($idNumber))
			$idNumber = preg_replace('/[^\\d]/', '', $idNumber);
		if (!is_numeric($idNumber))
			throw new Smsgh_ApiException
				("Parameter value must be of type 'number'");
		return new Smsgh_ApiContact(Smsgh_ApiHelper::getJson
			($this->apiHost, 'GET', '/v3/contacts/' . $idNumber));
	}
	
	/**
	 * Gets contacts by groupId, filter, page and pageSize.
	 */
	public function gets
		($groupId = -1, $filter = null, $page = -1, $pageSize = -1) {
		if (!is_numeric($groupId))
			throw new Smsgh_ApiException
				("Parameter 'groupId' must be of type 'number'");
		if (!($filter === null || is_string($filter)))
			throw new Smsgh_ApiException
				("Parameter 'filter' must be of type 'string'");
		$uri = '/v3/contacts';
		if ($groupId > 0)
			$uri .= '?GroupId=' . $groupId;
		if ($filter !== null)
			$uri .= ($groupId > 0 ? '&' : '?') . 'Filter=' . urlencode($filter);
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, $uri, $page, $pageSize, strpos($uri, '&') !== false);
	}
	
	/**
	 * Creates new object.
	 */
	public function create($object) {
		if ($object instanceof Smsgh_ApiContact) {
			return new Smsgh_ApiContact(Smsgh_ApiHelper::getJson
				($this->apiHost, 'POST', '/v3/contacts',
					Smsgh_ApiHelper::toJson($object)));
		}
		
		else if ($object instanceof Smsgh_ApiContactGroup) {
			return new Smsgh_ApiContactGroup(Smsgh_ApiHelper::getJson
				($this->apiHost, 'POST', '/v3/contacts/groups',
					Smsgh_ApiHelper::toJson($object)));
		}
		
		else throw new Smsgh_ApiException('Bad parameter type');
	}
	
	/**
	 * Updates an object.
	 */
	public function update($object) {
		if ($object instanceof Smsgh_ApiContact) {
			Smsgh_ApiHelper::getData($this->apiHost,
				'PUT', '/v3/contacts/' . $object->getContactId(),
					Smsgh_ApiHelper::toJson($object));
		}
		
		else if ($object instanceof Smsgh_ApiContactGroup) {
			Smsgh_ApiHelper::getData($this->apiHost,
				'PUT', '/v3/contacts/' . $object->getGroupId(),
					Smsgh_ApiHelper::toJson($object));
		}
		
		else throw new Smsgh_ApiException('Bad parameter type');
	}
	
	/**
	 * Deletes contact by ID.
	 */
	public function deleteContact($contactId) {
		if (!is_numeric($contactId))
			throw new Smsgh_ApiException
				("Parameter 'contactId' must be of type 'number'");
		Smsgh_ApiHelper::getData($this->apiHost,
			'DELETE', '/v3/contacts/' . ($contactId + 0));
	}
	
	/**
	 * Gets contact groups by page and pageSize.
	 */
	public function getGroups($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/contacts/groups', $page, $pageSize);
	}
	
	/**
	 * Gets contact group by ID.
	 */
	public function getGroup($groupId) {
		if (is_numeric($groupId)) {
			return new Smsgh_ApiContactGroup(Smsgh_ApiHelper::getJson
				($this->apiHost, 'GET', '/v3/contacts/groups/' . ($groupId + 0)));
		}
		throw new Smsgh_ApiException("Parameter value must be of type 'string'");
	}
	
	/**
	 * Deletes contact group by ID.
	 */
	public function deleteGroup($groupId) {
		if (is_numeric($groupId)) {
			Smsgh_ApiHelper::getData($this->apiHost,
				'DELETE', '/v3/contacts/groups/' . ($groupId + 0));
		} else throw new Smsgh_ApiException
			("Parameter value must be of type 'number'");
	}
}
