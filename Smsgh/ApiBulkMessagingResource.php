<?php # $Id: ApiBulkMessagingResource.php 0 1970-01-01 00:00:00Z mkwayisi $

class Smsgh_ApiBulkMessagingResource {
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(Smsgh_SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Gets senders by page and pageSize.
	 */
	public function getSenders($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/senders', $page, $pageSize);
	}
	
	/**
	 * Gets sender by ID.
	 */
	public function getSender($senderId) {
		if (is_numeric($senderId))
			return new Smsgh_ApiSender(Smsgh_ApiHelper::getJson
				($this->apiHost, 'GET', "/v3/senders/$senderId"));
		throw new Smsgh_ApiException
			("Parameter 'senderId' must of type 'number'");
	}
	
	/**
	 * Creates an object.
	 */
	public function create($object) {
		if ($object instanceof Smsgh_ApiSender)
			return new Smsgh_ApiSender(Smsgh_ApiHelper::getJson
				($this->apiHost, 'POST', '/v3/senders',
					Smsgh_ApiHelper::toJson($object)));
			
		if ($object instanceof Smsgh_ApiTemplate)
			return new Smsgh_ApiTemplate(Smsgh_ApiHelper::getJson
				($this->apiHost, 'POST', '/v3/templates',
					Smsgh_ApiHelper::toJson($object)));
			
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Updates object.
	 */
	public function update($object) {
		if ($object instanceof Smsgh_ApiSender)
			return new Smsgh_ApiSender(Smsgh_ApiHelper::getJson
				($this->apiHost, 'PUT', '/v3/senders/' . $object->getId(),
					Smsgh_ApiHelper::toJson($object)));
			
		if ($object instanceof Smsgh_ApiTemplate)
			return new Smsgh_ApiTemplate(Smsgh_ApiHelper::getJson
				($this->apiHost, 'PUT', '/v3/templates/' . $object->getId(),
					Smsgh_ApiHelper::toJson($object)));
			
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Deletes sender by ID.
	 */
	public function deleteSender($senderId) {
		if (is_numeric($senderId))
			Smsgh_ApiHelper::getData
				($this->apiHost, 'DELETE', "/v3/senders/$senderId");
		else throw new Smsgh_ApiException
			("Parameter 'senderId' must be of type 'number'");
	}
	
	/**
	 * Gets message templates by page and pageSize.
	 */
	public function getTemplates($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/templates', $page, $pageSize);
	}
	
	/**
	 * Gets message template by ID.
	 */
	public function getTemplate($templateId) {
		if (is_numeric($templateId))
			return new Smsgh_ApiTemplate(Smsgh_ApiHelper::getJson
				($this->apiHost, 'GET', "/v3/templates/$templateId"));
		throw new Smsgh_ApiException
			("Parameter 'templateId' must be of type 'number'");
	}
	
	/**
	 * Deletes message template by ID.
	 */
	public function deleteTemplate($templateId) {
		if (is_numeric($templateId))
			Smsgh_ApiHelper::getData
				($this->apiHost, 'DELETE', "/v3/templates/$templateId");
		else throw new Smsgh_ApiException
			("Parameter 'templateId' must be of type 'string'");
	}
}
