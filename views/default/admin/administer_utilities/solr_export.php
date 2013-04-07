<?php
/**
* Profile Manager
*
* Export of profile fields
*
* @package solrsearch
* @author Daniel Scholz
* @copyright ForbiddenRoses
* @link
*/

// echo elgg_view("profile_manager/admin/tabs");
echo elgg_view("solrsearch/export", array("fieldtype" => CUSTOM_PROFILE_FIELDS_PROFILE_SUBTYPE));