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

	$settings->add(new admin_setting_configtext('block_sritoniviewdocs/keystring_documentName', 'Key string for Document Name',
				'Enter the key for document name', 'documentName', PARAM_RAW, 40));

	$settings->add(new admin_setting_configtext('block_sritoniviewdocs/keystring_fileId', 'Key String for Google document file ID',
				'Enter the key for Google Document Id', 'fileId', PARAM_RAW, 40));
}
