<?php
/**
 * Copyright (c) 2024 Fabian Wolf <wolf@ilias.de>
 * GPLv3, see LICENSE
 */

/**
 * Test Page Component plugin
 *
 * @author Fabian Wolf <wolf@ilias.de>
 */
class ilCOPageSpacerPlugin extends ilPageComponentPlugin
{
    /**
     * Get plugin name
     *
     * @return string
     */
    public function getPluginName() : string
    {
        return "COPageSpacer";
    }


    /**
     * Check if parent type is valid
     *
     * @return string
     */
    public function isValidParentType($a_type) : bool
    {
        return true;
    }

    /**
     * This function is called when the page content is cloned
     * @param array 	$a_properties		properties saved in the page, (should be modified if neccessary)
     * @param string	$a_plugin_version	plugin version of the properties
     */
    public function onClone(&$a_properties, $a_plugin_version) : void
    {

    }


    /**
     * This function is called before the page content is deleted
     * @param array  $a_properties
     * @param string $a_plugin_version
     * @param bool   $move_operation
     */
    public function onDelete($a_properties, $a_plugin_version, bool $move_operation = false) : void
    {

    }
}
