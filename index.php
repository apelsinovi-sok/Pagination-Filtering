<?php
define('ROOT', __DIR__);
require_once(ROOT.'/modules/build.php');

$create = new Origin;
$view = $create->build_object();

require_once(ROOT.'/modules/view.php');








