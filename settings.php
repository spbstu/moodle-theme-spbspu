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
 * Settings for the spbspu theme
 *
 * @package   theme_spbspu
 * @copyright 2010 Caroline Kennedy of Synergy Learning
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

// Logo file setting
$name = 'theme_spbspu/logo';
$title = get_string('logo','theme_spbspu');
$description = get_string('logodesc', 'theme_spbspu');
$setting = new admin_setting_configtext($name, $title, $description, '/theme/spbspu/pix/logo.png', PARAM_URL);
$settings->add($setting);

// Tagline setting
$name = 'theme_spbspu/tagline';
$title = get_string('tagline','theme_spbspu');
$description = get_string('taglinedesc', 'theme_spbspu');
$setting = new admin_setting_configtextarea($name, $title, $description, get_string('defaulttagline', 'theme_spbspu'));
$settings->add($setting);

$name = 'theme_spbspu/hide_tagline';
$title = get_string('hide_tagline','theme_spbspu');
$description = get_string('hide_taglinedesc', 'theme_spbspu');
$setting = new admin_setting_configcheckbox($name, $title, $description, 0);
$settings->add($setting);

 /*
// Block region width
$name = 'theme_spbspu/regionwidth';
$title = get_string('regionwidth','theme_spbspu');
$description = get_string('regionwidthdesc', 'theme_spbspu');
$default = 240;
$choices = array(200=>'200px', 240=>'240px', 290=>'290px', 350=>'350px', 420=>'420px');
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting); */
 
// Foot note setting
$name = 'theme_spbspu/footnote';
$title = get_string('footnote','theme_spbspu');
$description = get_string('footnotedesc', 'theme_spbspu');
$setting = new admin_setting_confightmleditor($name, $title, $description, '');
$settings->add($setting);

// Custom CSS file
$name = 'theme_spbspu/customcss';
$title = get_string('customcss','theme_spbspu');
$description = get_string('customcssdesc', 'theme_spbspu');
$setting = new admin_setting_configtextarea($name, $title, $description, '');
$settings->add($setting);

}