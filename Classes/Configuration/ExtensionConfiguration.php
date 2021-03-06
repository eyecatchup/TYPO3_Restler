<?php
namespace Aoe\Restler\Configuration;

use TYPO3\CMS\Core\SingletonInterface;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 AOE GmbH <dev@aoe.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @package Restler
 */
class ExtensionConfiguration implements SingletonInterface
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * constructor - loading the current localconf configuration for restler extension
     *
     */
    public function __construct()
    {
        $this->configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['restler']);
    }

    /**
     * @return boolean
     */
    public function isCacheRefreshingEnabled()
    {
        return (boolean) $this->get('refreshCache');
    }

    /**
     * @return boolean
     */
    public function isProductionContextSet()
    {
        return (boolean) $this->get('productionContext');
    }

    /**
     * @return boolean
     */
    public function isOnlineDocumentationEnabled()
    {
        return (boolean) $this->get('enableOnlineDocumentation');
    }

    /**
     * @return string
     */
    public function getPathOfOnlineDocumentation()
    {
        return $this->get('pathToOnlineDocumentation');
    }

    /**
     * @return array
     */
    public function getExtensionsWithRequiredExtLocalConfFiles()
    {
        $requiredExtensions = array();
        $extensionList = explode(',', $this->get('extensionsWithRequiredExtLocalConfFiles'));
        foreach($extensionList as $extensionName) {
            $extensionName = trim($extensionName);
            if (false === empty($extensionName)) {
                $requiredExtensions[] = $extensionName;
            }
        }
        return $requiredExtensions;
    }

    /**
     * returns configuration value for the given key
     *
     * @param string $key
     * @return string depending on configuration key
     */
    private function get($key)
    {
        return $this->configuration[$key];
    }
}
