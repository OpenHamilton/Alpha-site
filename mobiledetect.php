<?php

/**
 * Detects if a mobile browser is being used.
 * If so, get more detailed information about the environment
 */
function isMobile() {
	$userAgent = $_SERVER['HTTP_USER_AGENT'];

	$isMobile = true;

	$mobileData = array();

	// Go through all the options
	if (stristr($userAgent, 'iPhone')) {
		$mobileData['vender'] = 'Apple';
		$mobileData['device'] = 'iPhone';
		//$mobileData['version'] = '';
	} else if (stristr($userAgent, 'iPod')) {
		$mobileData['vender'] = 'Apple';
		$mobileData['device'] = 'iPod';
		//$mobileData['version'] = '';
	} else if (stristr($userAgent, 'iPad')) {
		$mobileData['vender'] = 'Apple';
		$mobileData['device'] = 'iPad';
		//$mobileData['version'] = '';
	} 
	/**
	 * Android user agent information based on the ``Android Thingies`` section here:
	 * http://www.zytrax.com/tech/web/mobile_ids.html
	 */
	else if (stristr($userAgent, 'Android')) {
		$mobileData['vender'] = 'Google';
		$mobileData['device'] = 'Android';

		$mid = explode(";", 5);
		$mid = explode(" ", $mid[3]);
		$mobileData['version'] = $mid[sizeof($mid)-1];
	} 
	/**
	 * BlackBerry indentification based on information from the following url:
	 * http://supportforums.blackberry.com/t5/Web-and-WebWorks-Development/How-to-detect-the-BlackBerry-Browser/ta-p/559862
	 */
	else if (stristr($userAgent, 'BlackBerry9') || stristr($userAgent, 'BlackBerry8')) {
		$mobileData['vender'] = 'RIM';
		$mobileData['device'] = 'BlackBerry';

		$mid = explode('/', $userAgent);
		$mid = explode(' ', $mid[1]);
		$mobileData['version'] = $mid[0];
	} else if (stristr($userAgent, 'BlackBerry')) {
		$mobileData['vender'] = 'RIM';
		$mobileData['device'] = 'BlackBerry';

		$mid = explode(' ', $userAgent);
		for ($i = 0; $i < sizeof($mid); $i++) {
			if (stristr($mid[$i], 'Version')) {
				$ua = explode('/', $mid[$i]);
				$mobileData['version'] = $ua[1];
			}
		}
	} else if (stristr($userAgent, 'PlayBook')) {
		$mobileData['vendor'] = 'RIM';
		$mobileData['device'] = 'Playbook';

		$mid = explode(";", 5);
		$mid = explode(" ", $mid[3]);
		$mobileData['version'] = $mid[sizeof($mid)-1];
	} else {
		$isMobile = false;
	}

	// Return the data array if this is a mobile
	// Otherwise just return false
	return ($isMobile) ? $mobileData : false;
}
?>