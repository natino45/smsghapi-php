<?php

# $Id: ApiException.php 224 2013-08-27 10:25:03Z mkwayisi $

class Smsgh_ApiException extends Exception {

    protected $httpStatusCode;
    protected $reason;
    protected $rawBody;
    protected $description;

    public function __construct($message = null, $code = 0, $previous = null) {
        $this->httpStatusCode = 0;
        $this->reason = null;
        $this->rawBody = null;
        $this->description = null;
        parent::__construct($message, $code, $previous);
    }

    public function getHttpStatusCode() {
        return $this->httpStatusCode;
    }

    public function getReason() {
        return $this->reason;
    }

    public function getRawBody() {
        return $this->rawBody;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setHttpStatusCode($statusCode) {
        $this->httpStatusCode = $statusCode;
        return $this;
    }

    public function setReason($reason) {
        $this->reason = $reason;
        return $this;
    }

    public function setRawBody($body) {
        $this->rawBody = $body;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return this;
    }

}
