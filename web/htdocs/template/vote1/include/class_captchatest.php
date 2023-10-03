<?php
/**
 * ----------------------------------------------
 * Advanced Poll 2.0.8
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class CaptchaTest {

	var $timeLimit;
	var $secretCode;
	var $timestamp;
	var $keyLength;

	function CaptchaTest() {
		$this->timeLimit = 1200; /* 20 minutes */
		$this->secretCode = __FILE__;
		$this->timestamp = time();
		$this->keyLength = 6;
	}

	function getKey($timestamp=0) {
		$timestamp = intval($timestamp);
		$time = ($timestamp>0) ? $timestamp : $this->timestamp;
		$md5Str = md5($time.$this->secretCode);
		return substr($md5Str, 0 , $this->keyLength);
	}

	function getTime() {
		return $this->timestamp;
	}

	function setTimestamp($timestamp=0) {
		$timestamp = intval($timestamp);
		if ($timestamp > $this->timeLimit) {
			$this->timestamp = $timestamp;
		}
		return $this->timestamp;
	}

	function isValid($key, $timestamp) {
		if (!$this->isValidTime($timestamp)) {
			return false;
		}
		$md5Str = substr(md5($timestamp.$this->secretCode), 0 , $this->keyLength);
		return ($md5Str == $key) ? true : false;
	}

	function isValidTime($timestamp) {
		$timestamp = intval($timestamp);
		if ($timestamp == 0) {
			return false;
		}
		$time = $this->timestamp - $this->timeLimit;
		if ($time > $timestamp) {
			return false;
		}
		if ($timestamp > ($this->timestamp + $this->timeLimit)) {
			return false;
		}
		return true;
	}

}

?>