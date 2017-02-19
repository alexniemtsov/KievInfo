<?php

class modKievTestHelper
{
    /**
     * Import data from plugin
	 * Data provider: Joomla.Plugin.Test.Kiev
     * @return array() 'temperature'|'currency'
     */    
    public static function renderData()
    {
		JPluginHelper::importPlugin('Test');
		$dispatcher =& JDispatcher::getInstance();
		return $dispatcher->trigger('renderContent');
    }
	
}
