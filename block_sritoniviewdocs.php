<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
/**
 * sritoniviewdocs block caps.
 *
 * @package    block_sritoniviewdocs
 * @copyright  Madhu Avasarala <info@headstart.edu.in>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
class block_sritoniviewdocs extends block_list {
    function init()
        {
            $this->title = get_string('pluginname', 'block_sritoniviewdocs');
        }
    function get_content()
    {
        global $CFG, $OUTPUT, $DB, $USER;

        if ($this->content !== null)
            {
                return $this->content;
            }

        $this->content = new stdClass();
        $this->content->text   = 'The content of my reports block!';
        $this->content->footer = '===========';
        $this->content->items = array();
        $this->content->icons = array();

        // get the short name of the user profile field from block config settings
        $shortname = get_config('block_sritoniviewdocs', 'field_shortname');

        // get the key string for documentName from config settings
        $keystring_documentName = get_config('block_sritoniviewdocs', 'keystring_documentName');

        // get the key string for fileId from config settings
        $keystring_fileId = get_config('block_sritoniviewdocs', 'keystring_fileId');

        // fetch data of user profile field containing the document ids
        $field = $DB->get_record('user_info_field', array('shortname' => $shortname));
        $json_documentids = $DB->get_record('user_info_data', array(
                                                              		  'userid'   =>  $USER->id,
                                                              		  'fieldid'  =>  $field->id));

        // extract json data if not null, or set to blank json string
        $json_notags = strip_tags(html_entity_decode($json_documentids->data)) ?? "[]";

        // check that this is a string before json_decode
        if ( !is_string($json_notags) )
        {
            // log the bad array_count_values
            error_log("Error - variable json_notags is NOT a string - line 55 block_sritoniviewdocs.php");
            error_log(print_r($json_notags ,true));

            $json_notags = "[]";
        }

        // JSON decode the into an array
        $docid_arr  = json_decode(	$json_notags, true );
        if (json_last_error() != JSON_ERROR_NONE)
        {
            // error in json_decode, log variable and set array to blank
            error_log('string variable json_notags is not proper JSON: ' . $json_notags);
            $docid_arr = [];
        }

        // loop through the object for eac of the documentlinks
        foreach ($docid_arr AS $doc)
        {
            $docid        = $doc[$keystring_fileId];    // obtained from JSON decoded array
            $documentName = format_string($doc[$keystring_documentName]);
            $docurl       = 'https://drive.google.com/open?id=' . $docid;
            $attrs        = ['alt' => $documentName];
            //  create HTML. link($url, $text, array $attributes = null)
            // add as next element in array for displaying as a list
            $this->content->items[] = \html_writer::link($docurl, $documentName, $attrs);
        }

        return $this->content;
    }
    // my moodle can only have SITEID and it's redundant here, so take it away
    public function applicable_formats()
    {
        return array('all'                => false,
                     'my'                 => true,
                     'site'               => true,
                     'site-index'         => true,
                     'course-view'        => false,
                     'course-view-social' => false,
                     'mod'                => false,
                     'mod-quiz'           => false);
    }

    public function instance_allow_multiple()
    {
          return false;
    }

    function has_config()
    {
        return true;
    }
}
