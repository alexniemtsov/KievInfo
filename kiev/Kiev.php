<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Test.Kiev
 */
defined('_JEXEC') or die;

class plgTestKiev extends JPlugin
{
	/**
	 * Loading language packages
	 */
	function __construct(&$subject, $config) 
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_Test_Kiev', JPATH_ADMINISTRATOR);
		parent::__construct($subject, $config);
	}

	/**
	 * Return array with current rate and temperature
	 * @return  array()	'temperature'|'currency'.
	 */
	public function renderContent()
	{
		return [
			'temperature' => $this->_getWeather($this->params->get('weather_api_key')),
			'currency' => $this->_getCurrency()
		];
	}
	
	/**
	 * Parse json Weather from API
	 * @param   string   $apikey   API authentication key.
	 * @return  string	 Current temperature or error.
	 */
	private function _getWeather($apikey)
	{
		$json = $this->_loadContent("http://api.wunderground.com/api/".$apikey."/geolookup/conditions/q/UA/Kiev.json");
		if($json) {
			$parsed_json = json_decode($json);
			return (int)$parsed_json->{'current_observation'}->{'temp_c'};
		} else {
			return "Error";
		}
	}
	
	/**
	 * Parse json Currency from API
	 * @return  string	 Current rate or error.
	 */
	private function _getCurrency()
	{
		$json = $this->_loadContent("https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode=USD&json");
		if($json) {
			$parsed_json = json_decode($json);
			return round((float)$parsed_json[0]->{'rate'},2);
		} else {
			return "Error";
		}
	}
	
	/**
	 * Get the API content
	 * @param   string   $url   API url.
	 * @return  string	 Page content.
	 */
	private static function _loadContent($url)
	{
		$json_str = @file_get_contents($url);
		if ($json_str === false) 
			return false;
		return $json_str;
	}

}

?>