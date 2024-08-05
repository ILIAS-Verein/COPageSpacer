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
class ilCOPageSpacerImporter extends ilPageComponentPluginImporter
{
    public function init() : void
    {
    }


    /**
     * Import xml representation
     *
     * @param	string			$a_entity
     * @param	string			$a_id
     * @param	string			$a_xml
     * @param	ilImportMapping	$a_mapping
     */
    public function importXmlRepresentation($a_entity, $a_id, $a_xml, $a_mapping) : void
    {

        $new_id = self::getPCMapping($a_id, $a_mapping);

        $properties = self::getPCProperties($new_id);
        $version = self::getPCVersion($new_id);

        self::setPCProperties($new_id, $properties);
        self::setPCVersion($new_id, $version);
    }
}
