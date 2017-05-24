<?php
namespace core;

class app{
	public static $classMap =  array();
	public $assign;
	static public function run(){	
		\core\lib\log::init();		
		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->action;
		$ctrlfile = APP.'/ctrl/'.$ctrlClass.'Ctrl.php';
		$cltrlClass = '\\'.MODULE.'\ctrl\\'.$ctrlClass.'Ctrl';//new \xxx()形式
		// echo $cltrlClass;
		if(is_file($ctrlfile)){
			include $ctrlfile;
			$ctrl = new $cltrlClass();
			$ctrl ->$action();
			\core\lib\log::log('ctrl:'.$ctrlClass.'        action:'.$action);
		}else{
			throw new \Exception('找不到控制器'.$ctrlClass);			
		}
	}
	static public function load($class){
		//自动加载
		//new\core\route();
		//$class='\core\route'
		//IMMOC.'/core/route.php'			
		if(isset($classMap[$class])){
			return true;
		}else{
			$class = str_replace('\\', '/', $class);
			$file = ROOT.'/'.$class.'.php';
			if(is_file($file)){
				include $file;
				self::$classMap[$class] = $class;
			}else{
				return false;
			}
		}
		
	}

	public function assign($name,$value){
 		$this->assign[$name] = $value;
	}

	public function display($file){
		$file = APP.'/views/'.$file;		
		if(is_file($file))
			extract($this->assign);
			include $file;
	}
}