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
        $this->content->text   = 'The content of our SimpleHTML block!';
        $this->content->footer = 'Footer here...';
        $this->content->items = array();
        $this->content->icons = array();

        // fetch data of user profile field containing the document ids
        $field = $DB->get_record('user_info_field', array('shortname' => 'documentlinks'));
        $json_documentids = $DB->get_record('user_info_data', array(
                                                              		  'userid'   =>  $USER->id,
                                                              		  'fieldid'  =>  $field->id));
        // JSON decode the into an array
        $docid_arr  = json_decode(	$user_documentlinks->data, true );

        // loop through the object for eac of the documentlinks
        foreach ($docid_arr AS $key => $doc)
        {
            $docid        = $doc["fileId"];
            $documentName = $doc["documentName"];
            $docurl       = 'https://drive.google.com/open?id=' . $docid;
            $this->content->items[] = $docurl;
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
                     'course-view'        => true,
                     'course-view-social' => false,
                     'mod'                => true,
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
