<?php

require_cli();
require_action($argv[1]);

init_oc();
start("$argv[1]");

function require_cli()
{
	if (defined('STDIN') && php_sapi_name() === 'cli' && empty($_SERVER['REMOTE_ADDR']) && !isset($_SERVER['HTTP_USER_AGENT']) && count($_SERVER['argv']) > 0 && !array_key_exists('REQUEST_METHOD', $_SERVER)) {
		return true;
	}
	
	exit;
}

function require_action($action){
	if (!isset($action)) {
		echo "Action not specified. Usage: php-cli cli.php [erply_action_name]\n";
		exit;
	}
	
	$actions = array("erply-sync");
	if(!in_array($action, $actions)){
		echo "Action $action unknown";
		exit;
	}
}

function init_oc(){
	define('VERSION', '3.0.2.0');
	
	if (is_file('../admin/config.php')) {
		require_once('../admin/config.php');
	}
	require_once(DIR_SYSTEM . 'startup.php');
}
