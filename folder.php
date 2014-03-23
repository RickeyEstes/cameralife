<?php

/**
 * Displays the folders path file on the page
 * @author Will Entriken <cameralife@phor.net>
 * @copyright Copyright (c) 2001-2009 Will Entriken
 * @access public
 */

$features=array('theme','filestore', 'imageprocessing', 'security');
require 'main.inc';

$folder = new Folder(stripslashes($_GET['path']), true);

$count = array_sum($folder->getCounts());
if ($count == 0) {
  header("HTTP/1.0 404 Not Found");
  $cameralife->error("This folder does not exist, or it is empty.");
}

$folder->showPage();
