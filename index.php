<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */

define('ROOT',realpath('./'));
define('CORE',ROOT.'/core');
define('APP',ROOT.'/app');
define('MODULE', 'app');
define('DEBUG',true);
if(DEBUG){
	ini_set('display_error', 'On');
}else{
	ini_set('display_error', 'off');	
}
include CORE.'/common/function.php';

include CORE.'/app.php';

spl_autoload_register('\core\app::load');//自动加载累
\core\app::run();

