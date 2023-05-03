<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



define('APP_ROOT',dirname(__FILE__,2)); //dirtektorij od index.php
define("APP_DOMAIN",$_SERVER['HTTP_HOST']);
define('ROOT_FOLDER','/');

$this_folder = substr(__DIR__,strlen($_SERVER['DOCUMENT_ROOT']));
$parent_folder = dirname($this_folder);
$parent_folder=ltrim($parent_folder,'/');

define('HTTP_ROOT',pathinfo($_SERVER['PHP_SELF'],PATHINFO_DIRNAME));
define("DOC_ROOT",''.$parent_folder); // sa php server
//define("DOC_ROOT",$parent_folder.'');// za apache
define('TEMPLATE_DIR', APP_ROOT.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR);
define('TEMPLATE', DOC_ROOT.'/templates'.DIRECTORY_SEPARATOR);

require APP_ROOT.'/src/function/autoload.php';

?>