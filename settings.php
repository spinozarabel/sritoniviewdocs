<?php
//
// defines configuration settings for the moodle_block_sritoniviewdocs
// Madhu Avasarala
//
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) 
{
	$settings->add(new admin_setting_configtext('block_sritoniviewdocs/field_shortname', 'Short Name of User Profile Field',
                    'Enter the short name of the user profile field containing JSON encoded data (max 40 chars)', 'documentlinks', PARAM_RAW, 40));
}