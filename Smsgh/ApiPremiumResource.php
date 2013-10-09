<?php # $Id: ApiPremiumResource.php 0 1970-01-01 00:00:00Z mkwayisi $

class Smsgh_ApiPremiumResource {
	private $apiHost;
	
	/**
	 * Primary constructor.
	 */
	public function __construct(Smsgh_SmsghApi $apiHost) {
		$this->apiHost = $apiHost;
	}
	
	/**
	 * Gets number plans by page and pageSize.
	 */
	public function getNumberPlans($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/numberplans', $page, $pageSize);
	}
	
	/**
	 * Gets shared number plans by page and pageSize.
	 */
	public function getSharedNumberPlans($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/numberplans/shared', $page, $pageSize);
	}
	
	/**
	 * Gets not-shared number plans by page and pageSize.
	 */
	public function getNotSharedNumberPlans($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/numberplans/notshared', $page, $pageSize);
	}
	
	/**
	 * Gets number plan keywords by number plan ID.
	 */
	public function getNumberPlanKeywords
		($numberPlanId, $page = -1, $pageSize = -1) {
		if (is_numeric($numberPlanId))
			return Smsgh_ApiHelper::getApiList($this->apiHost,
				"/v3/numberplans/$numberPlanId/keywords", $page, $pageSize);
		throw new Smsgh_ApiException
			("Paramater 'numberPlanId' must be of type 'number'");
	}
	
	/**
	 * Gets campaigns by page and pageSize.
	 */
	public function getCampaigns($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/campaigns', $page, $pageSize);
	}
	
	/**
	 * Gets campaign by ID.
	 */
	public function getCampaign($campaignId) {
		if (is_numeric($campaignId))
			return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
				($this->apiHost, 'GET', "/v3/campaigns/$campaignId"));
		throw new Smsgh_ApiException
			("Parameter 'campaignId' must be of type 'number'");
	}
	
	/**
	 * Creates new object.
	 */
	public function create($object) {
		if ($object instanceof Smsgh_ApiCampaign) {
			return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
				($this->apiHost, 'POST', '/v3/campaigns',
					Smsgh_ApiHelper::toJson($object)));
		}
		
		else if ($object instanceof Smsgh_ApiMoKeyWord) {
			return new Smsgh_ApiMoKeyWord(Smsgh_ApiHelper::getJson
				($this->apiHost, 'POST', '/v3/keywords',
					Smsgh_ApiHelper::toJson($object)));
		}
		
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Updates object.
	 */
	public function update($object) {
		if ($object instanceof Smsgh_ApiCampaign) {
			return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
				($this->apiHost, 'PUT',
					'/v3/campaigns/' . $object->getCampaignId(),
						Smsgh_ApiHelper::toJson($object)));
		}
		
		else if ($object instanceof Smsgh_ApiMoKeyWord) {
			return new Smsgh_ApiMoKeyWord(Smsgh_ApiHelper::getJson
				($this->apiHost, 'PUT', '/v3/keywords/' . $object->getId(),
					Smsgh_ApiHelper::toJson($object)));
		}
		
		throw new Smsgh_ApiException('Bad parameterized object type');
	}
	
	/**
	 * Deletes campaign by ID.
	 */
	public function deleteCampaign($campaignId) {
		if (is_numeric($campaignId))
			Smsgh_ApiHelper::getData
				($this->apiHost, 'DELETE', "/v3/campaigns/$campaignId");
		else throw new Smsgh_ApiException
			("Parameter 'campaignId' must be of type 'number'");
	}
	
	/**
	 * Gets keywords by page and pageSize.
	 */
	public function getKeywords($page = -1, $pageSize = -1) {
		return Smsgh_ApiHelper::getApiList
			($this->apiHost, '/v3/keywords', $page, $pageSize);
	}
	
	/**
	 * Deletes keyword by ID.
	 */
	public function deleteKeyword($keywordId) {
		if (is_numeric($keywordId))
			Smsgh_ApiHelper::getData
				($this->apiHost, 'DELETE', "/v3/keywords/$keywordId");
		else throw new Smsgh_ApiException
			("Parameter 'keywordId' must be of type 'number'");
	}
	
	/**
	 * Adds keyword to campaign.
	 */
	public function addKeywordToCampaign($campaignId, $keywordId) {
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_numeric($keywordId))
			throw new Smsgh_ApiException
				("Parameter 'keywordId' must be of type 'number'");
		return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
			($this->apiHost, 'PUT', "/v3/campaigns/$campaignId/keywords/$keywordId"));
	}
	
	/**
	 * Removes keyword from campaign.
	 */
	public function removeKeywordFromCampaign($campaignId, $keywordId) {
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_numeric($keywordId))
			throw new Smsgh_ApiException
				("Parameter 'keywordId' must be of type 'number'");
		Smsgh_ApiHelper::getData($this->apiHost,
			'DELETE', "/v3/campaigns/$campaignId/keywords/$keywordId");
	}
	
	/**
	 * Gets campaign actions by ID.
	 */
	public function getActions($campaignId, $page = -1, $pageSize = -1) {
		if (is_numeric($campaignId))
			return Smsgh_ApiHelper::getApiList($this->apiHost,
				"/v3/campaigns/$campaignId/actions", $page, $pageSize);
		throw new Smsgh_ApiException
			("Parameter 'campaignId' must be of type 'number'");
	}
	
	/**
	 * Adds default reply action to campaign.
	 */
	public function addDefaultReplyAction($campaignId, $message) {
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($message))
			throw new Smsgh_ApiException
				("Parameter 'message' must be of type 'string'");
		$obj = new stdClass;
		$obj->message = $message;
		return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
			($this->apiHost, 'POST',
				"/v3/campaigns/$campaignId/actions/default_reply",
					json_encode($obj)));
	}
	
	/**
	 * Adds dynamic URL action to campaign.
	 */
	public function addDynamicUrlAction
		($campaignId, $url, $sendResponse = 'no') {
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($url))
			throw new Smsgh_ApiException
				("Parameter 'url' must be of type 'string'");
		if (!is_string($sendResponse))
			throw new Smsgh_ApiException
				("Parameter 'sendResponse' must be of type 'string'");
		$obj = new stdClass;
		$obj->url = $url;
		$obj->send_response = $sendResponse;
		return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
			($this->apiHost, 'POST',
				"/v3/campaigns/$campaignId/actions/dynamic_url",
					json_encode($obj)));
	}
	
	/**
	 * Adds email address action to campaign.
	 */
	public function addEmailAddressAction($campaignId, $address) {
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($address))
			throw new Smsgh_ApiException
				("Parameter 'address' must be of type 'string'");
		$obj = new stdClass;
		$obj->address = $address;
		return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
			($this->apiHost, 'POST',
				"/v3/campaigns/$campaignId/actions/email",
					json_encode($obj)));
	}
	
	/**
	 * Adds forward to mobile action to campaign.
	 */
	public function addForwardToMobileAction($campaignId, $number) {
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($number))
			throw new Smsgh_ApiException
				("Parameter 'number' must be of type 'string'");
		$obj = new stdClass;
		$obj->number = $number;
		return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
			($this->apiHost, 'POST',
				"/v3/campaigns/$campaignId/actions/phone",
					json_encode($obj)));
	}
	
	/**
	 * Adds forward to SMPP action to campaign.
	 */
	public function addForwardToSmppAction($campaignId, $appId) {
		if (!is_numeric($campaignId))
			throw new Smsgh_ApiException
				("Parameter 'campaignId' must be of type 'number'");
		if (!is_string($appId))
			throw new Smsgh_ApiException
				("Parameter 'appId' must be of type 'string'");
		$obj = new stdClass;
		$obj->app_id = $appId;
		return new Smsgh_ApiCampaign(Smsgh_ApiHelper::getJson
			($this->apiHost, 'POST',
				"/v3/campaigns/$campaignId/actions/smpp",
					json_encode($obj)));
	}
}
