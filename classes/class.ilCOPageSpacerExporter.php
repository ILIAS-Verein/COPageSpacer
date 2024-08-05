<?php

/**
 * Copyright (c) 2024 Fabian Wolf <wolf@ilias.de>
 * GPLv3, see LICENSE
 */

/**
 * Exporter class for the TestPageComponent Plugin
 *
 * @author Fabian Wolf <wolf@ilias.de>
 * @version $Id$
 *
 * @ingroup ServicesCOPage
 */
class ilCOPageSpacerExporter extends ilPageComponentPluginExporter
{
    public function init() : void
    {
    }

    /**
     * Get head dependencies
     *
     * @param		string		entity
     * @param		string		target release
     * @param		array		ids
     * @return		array		array of array with keys "component", entity", "ids"
     */
    public function getXmlExportHeadDependencies($a_entity, $a_target_release, $a_ids) : array
    {
        return array();
    }


    /**
     * Get xml representation
     *
     * @param	string		entity
     * @param	string		schema version
     * @param	string		id
     * @return	string		xml string
     */
    public function getXmlRepresentation($a_entity, $a_schema_version, $a_id) : string
    {
        return "";
    }

    /**
     * Get tail dependencies
     *
     * @param		string $a_entity         entity
     * @param		string $a_target_release target release
     * @param		array  $a_ids            ids
     * @return		array		array of array with keys "component", entity", "ids"
     */
    public function getXmlExportTailDependencies($a_entity, $a_target_release, $a_ids) : array
    {
        return array();
    }

    /**
     * Returns schema versions that the component can export to.
     * ILIAS chooses the first one, that has min/max constraints which
     * fit to the target release. Please put the newest on top. Example:
     *
     * 		return array (
     *		"4.1.0" => array(
     *			"namespace" => "http://www.ilias.de/Services/MetaData/md/4_1",
     *			"xsd_file" => "ilias_md_4_1.xsd",
     *			"min" => "4.1.0",
     *			"max" => "")
     *		);
     *
     *
     * @return		array
     */
    public function getValidSchemaVersions($a_entity) : array
    {
        return array(
            '5.3.0' => array(
                'namespace'    => 'http://www.ilias.de/',
                //'xsd_file'     => 'pctpc_5_3.xsd',
                'uses_dataset' => false,
                'min'          => '5.3.0',
                'max'          => ''
            )
        );
    }
}
