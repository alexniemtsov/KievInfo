<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_banners
 * @dataprovider Test.Kiev
 */

defined('_JEXEC') or die;

//including main module class
require_once dirname(__FILE__) . '/helper.php';

//rendering template
$dataprovider = modKievTestHelper::renderData($params);
require JModuleHelper::getLayoutPath('mod_weather');