<?php
// error_reporting( E_ALL ^ E_DEPRECATED ^ E_WARNING );
@ob_gzhandler('ob_start');
session_start();
require_once '_config.php';
require_once 'database/dbtools.php';

require_once 'tools/tools.php';
require_once 'tools/base_oceanic.php';
require_once 'base_oceanic.php';
require_once 'tools/organization.php';

$obj_to_use = "Organization";

$json = base_process_request($obj_to_use);
exit($json);